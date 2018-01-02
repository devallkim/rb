<?php
/*
  태그 등록 함수
  $tag : 태그,태그1...
  $module: bbs,blog,comment...
  $moduleid : bbs uid, blog uid....
  $entry : 포스트(data) uid
*/   
function RegisPostTag($tag,$R,$module,$moduleid,$reply,$entry)
{
   global $table,$s,$date;

    $_tagarr1 = array();
    $_tagarr2 = explode(',',$tag);
    $_tagdate = $date['today'];
    
    // 수정일 경우 당일날짜 기준으로 같은 태그가 있는 경우 hit -1 을 해준다. (아래에서 hit+1 혹은 insert 될 것이기 때문 )
    if ($R['uid'] && $reply != 'Y')
    {
        $_tagdate = substr($R['d_regis'],0,8);
        $_tagarr1 = explode(',',$R['tag']);
        foreach($_tagarr1 as $_t)
        {
            if(!$_t || in_array($_t,$_tagarr2)) continue;
            $_TAG = getDbData($table['s_tag'],"site=".$R['site']." and keyword='".$_t."'",'*');
            if($_TAG['uid'])
            {
                if($_TAG['hit']>1) getDbUpdate($table['s_tag'],'hit=hit-1','uid='.$_TAG['uid']);
                else getDbDelete($table['s_tag'],'uid='.$_TAG['uid']);                
                DeleteTagRelation($module,$moduleid,$entry,$_TAG['uid']); 
            }
        }
    }

    foreach($_tagarr2 as $_t)
    {
        if(!$_t || in_array($_t,$_tagarr1)) continue;
        $_TAG = getDbData($table['s_tag'],'site='.$s." and keyword='".$_t."'",'*');
        if($_TAG['uid']) getDbUpdate($table['s_tag'],'hit=hit+1','uid='.$_TAG['uid']);
        else getDbInsert($table['s_tag'],'site,keyword,hit',"'".$s."','".$_t."','1'");
     
        // 중복이든 아니든 무조건 insert 한다. 
        if($_TAG['uid']) $tag=$_TAG['uid'];
        else $tag=getDbCnt($table['s_tag'],'max(uid)','');
        InsertTagRelation($module,$moduleid,$entry,$tag);
    }
}

// 태그 log(s_tagrelation) 저장 함수 
function InsertTagRelation($module,$moduleid,$entry,$tag)
{
    global $s,$table,$my,$date;
    $mbruid=$my['uid'];
    $_date = $date['today'];
    $QKEY="site,module,moduleid,entry,mbruid,tag,date";
    $QVAL="'$s','$module','$moduleid','$entry','$mbruid','$tag','$_date'";

    getDbInsert($table['s_tagrelation'],$QKEY,$QVAL);
}

// 태그 log(s_tagrelation) 삭제 함수 
function DeleteTagRelation($module,$moduleid,$entry,$tag)
{
    global $table;
    getDbDelete($table['s_tagrelation'],"module='".$module."' and moduleid='".$moduleid."' and entry='".$entry."' and tag='".$tag."'");  
}

// 태그 삭제 함수 
function DeletePostTag($R,$module)
{
   global $table;

    $moduleid=$R['blog'];
    $entry=$R['uid'];
    $_tagarr = explode(',',$R['tag']);
    foreach($_tagarr as $_t)
    {
        if(!$_t) continue;
        $_TAG = getDbData($table['s_tag'],"site=".$R['site']." and keyword='".$_t."'",'*');
        if($_TAG['uid'])
        {
            if($_TAG['hit']>1) getDbUpdate($table['s_tag'],'hit=hit-1','uid='.$_TAG['uid']);
            else getDbDelete($table['s_tag'],'uid='.$_TAG['uid']);
            DeleteTagRelation($module,$moduleid,$entry,$_TAG['uid']); 
        }
    }
}

/*
댓글 삭제 함수
$d : 설정 파일 내역 배열, $m : 모듈명 $B : 블로그 uid 
parent 가 $m.$R['uid'] 형식인점에 유의 !!!
*/
function DeleteComment($R,$d,$m,$B)
{
	global $table,$date;

	$CCD = getDbArray($table['s_comment'],"parent='".$m.$R['uid']."'",'*','uid','asc',0,0);

	while($C=db_fetch_array($CCD))
	{
		if ($C['upload']) DeleteUpfile($C,$d);
		if ($C['oneline']) DeleteOneline($C,$d);
		getDbDelete($table['s_comment'],'uid='.$C['uid']);

		if ($d['blog']['c_give_opoint']&&$C['mbruid'])
		{
			getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$C['mbruid']."','0','-".$d['blog']['c_give_opoint']."','댓글삭제(".getStrCut($C['subject'],15,'').")환원','".$date['totime']."'");
			getDbUpdate($table['s_mbrdata'],'point=point-'.$d['blog']['c_give_opoint'],'memberuid='.$C['mbruid']);			
		}
		getDbUpdate($table[$m.'members'],'num_c=num_c-1','blog='.$B['uid'].' and mbruid='.$C['mbruid']);
	}
}

//한줄의견 삭제 함수
function DeleteOneline($C,$d)
{
	global $table,$date;

	$_ONELINE = getDbSelect($table['s_oneline'],'parent='.$C['uid'],'*');
	while($_O=db_fetch_array($_ONELINE))
	{
		if ($d['blog']['c_give_opoint']&&$_O['mbruid'])
		{
			getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$_O['mbruid']."','0','-".$d['blog']['c_give_opoint']."','한줄의견삭제(".getStrCut(str_replace('&amp;',' ',strip_tags($_O['content'])),15,'').")환원','".$date['totime']."'");
			getDbUpdate($table['s_mbrdata'],'point=point-'.$d['blog']['c_give_opoint'],'memberuid='.$_O['mbruid']);
		}
	}
	getDbDelete($table['s_oneline'],'parent='.$C['uid']);
}

//첨부파일 삭제 함수
function DeleteUpfile($R,$d)
{
   global $g,$table;

   $UPFILES = getArrayString($R['upload']);

	foreach($UPFILES['data'] as $_val)
	{
		$U = getUidData($table['s_upload'],$_val);
		if ($U['uid'])
		{
			if ($U['url']==$d['blog']['ftp_urlpath'])
			{
				$FTP_CONNECT = ftp_connect($d['blog']['ftp_host'],$d['blog']['ftp_port']); 
				$FTP_CRESULT = ftp_login($FTP_CONNECT,$d['blog']['ftp_user'],$d['blog']['ftp_pass']); 
				if ($d['blog']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);
				if (!$FTP_CONNECT) getLink('','','FTP서버 연결에 문제가 발생했습니다.','');
				if (!$FTP_CRESULT) getLink('','','FTP서버 아이디나 패스워드가 일치하지 않습니다.','');

				ftp_delete($FTP_CONNECT,$d['blog']['ftp_folder'].$U['folder'].'/'.$U['tmpname']);
				if($U['type']==2) ftp_delete($FTP_CONNECT,$d['blog']['ftp_folder'].$U['folder'].'/'.$U['thumbname']);
				ftp_close($FTP_CONNECT);
			}
			else {
				 unlink('.'.$U['url'].$U['folder'].'/'.$U['tmpname']);
                       if($U['type']==2) unlink('.'.$U['url'].$U['folder'].'/'.$U['thumbname']);
			}
			getDbDelete($table['s_upload'],'uid='.$U['uid']);
		}
	}
}

?>
