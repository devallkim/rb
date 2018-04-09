<?php
if(!defined('__KIMS__')) exit;
require_once $g['dir_module'].'includes/base.class.php';
require_once $g['dir_module'].'includes/module.class.php';

$comment = new Comment();

$result = array();
$result['error'] = false;

if (!$wcode){
	$result['error'] = true;
	$result['msg'] = '정상적인 접근이 아닙니다.';
    echo json_encode($result,true);
	exit;
}else{
	$mbruid		= $my['uid'];
	$id			= $my['id'];
	$name		= $my['uid'] ? $my['name'] : trim($name);
	$nic		= $my['uid'] ? $my['nic'] : $name;
	$pw			= $pw ? md5($pw) : '';
	$subject	= $my['admin'] ? trim($subject) : htmlspecialchars(trim($subject));
	$content	= trim($content);
	$subject	= $subject ? $subject : getStrCut(str_replace('&amp;',' ',strip_tags($content)),35,'..');
	$html		= $html ? $html : 'TEXT';
	$d_regis	= $date['totime'];
	$d_modify	= '';
	$d_oneline	= '';
	$ip			= $_SERVER['REMOTE_ADDR'];
	$agent		= $_SERVER['HTTP_USER_AGENT'];
	//$upload		= $upfiles; // upfiles 값을 배열로 받아서 풀어서 upload 에 저장한다.  아래 참조
	$adddata	= trim($adddata);
	$hit		= 0;
	$down		= 0;
	$oneline	= 0;
	$likes		= 0;
	$unlikes		= 0;
	$report		= 0;
	$point		= $d['comment']['give_point'];
	$hidden		= $hidden ? intval($hidden) : 0;
	$notice		= $notice ? intval($notice) : 0;
	$display	= $hidepost || $hidden ? 0 : 1;

	// 포토, 장소, 링크 존재여부
	$is_photo=0;
	$is_link=0;
	$is_place=0;

	if ($d['comment']['badword_action'])
	{
		$badwordarr = explode(',' , $d['comment']['badword']);
		$badwordlen = count($badwordarr);
		for($i = 0; $i < $badwordlen; $i++)
		{
			if(!$badwordarr[$i]) continue;
			if(strstr($subject,$badwordarr[$i]) || strstr($content,$badwordarr[$i]))
			{
				if ($d['comment']['badword_action'] == 1)
				{
					$result['error'] = true;
					$result['msg'] = '등록이 제한된 단어를 사용하셨습니다.';
				    echo json_encode($result,true);
					exit;
				}
				else {
					$badescape = strCopy($badwordarr[$i],$d['comment']['badword_escape']);
					$content = str_replace($badwordarr[$i],$badescape,$content);
					$subject = str_replace($badwordarr[$i],$badescape,$subject);
				}
			}
		}
	}
  // 업로드 파일 세팅
	if($upfiles)
	{
		$upload='';
		foreach ($upfiles as $file) {
	      $upload .=$file;
		}
		$upload=trim($upload);
		$is_photo=1;
    }

	if ($uid)
	{
		$R = getUidData($table['s_comment'],$uid);
		if (!$R['uid']){
			$result['error'] = true;
			$result['msg'] = '존재하지 않는 댓글입니다.';
		    echo json_encode($result,true);
			exit;
		}

		if (!$my['uid'] || ($my['uid'] != $R['mbruid'] && !$my['admin']))
		{
			if (!$pw)
			{
				$result['error'] = true;
				$result['msg'] = '정상적인 접근이 아닙니다.';
			    echo json_encode($result,true);
				exit;
			}
			else {
				if($pw != $R['pw'])
				{
					$result['error'] = true;
					$result['msg'] = '정상적인 접근이 아닙니다.';
				    echo json_encode($result,true);
					exit;
				}
			}
		}

		$QVAL = "display='$display',hidden='$hidden',notice='$notice',subject='$subject',content='$content',html='$html',";
		$QVAL .="d_modify='$d_regis',upload='$upload',adddata='$adddata'";
		getDbUpdate($table['s_comment'],$QVAL,'uid='.$R['uid']);

	}
	else
	{
		// $parent_set  가공
		$parent_arr=explode('-',$parent);
		$parent_uid=$parent_arr[1];
		$parent_set=str_replace('-','', $parent);

		$R = getUidData($feed_table,$parent_uid);
		getDbUpdate($feed_table,"comment=comment+1,d_comment='".$date['totime']."'",'uid='.$R['uid']);
		$sync = $feed_table.'|'.$parent_uid.'|'.$parentmbr;
		$minuid = getDbCnt($table['s_comment'],'min(uid)','');
		$uid = $minuid ? $minuid-1 : 1000000000;

		$QKEY = "uid,site,parent,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,subject,content,html,";
		$QKEY.= "hit,down,oneline,likes,unlikes,report,point,d_regis,d_modify,d_oneline,upload,ip,agent,sync,sns,adddata";
		$QVAL = "'$uid','$s','".$parent_set."','$parentmbr','$display','$hidden','$notice','$name','$nic','$mbruid','$id','$pw','$subject','$content','$html',";
		$QVAL.= "'$hit','$down','$oneline','$likes','$unlikes','$report','$point','$d_regis','$d_modify','$d_oneline','$upload','$ip','$agent','$sync','','$adddata'";
		getDbInsert($table['s_comment'],$QKEY,$QVAL);
		getDbUpdate($table['s_numinfo'],'comment=comment+1',"date='".$date['today']."' and site=".$s);


    $LASTUID = getDbCnt($table['s_comment'],'max(uid)','');

    $result['comment_row'] = $comment->getCommentRow($LASTUID,$p);
    echo json_encode($result,true);

    exit;

	}
	// 신규등록
}
?>
