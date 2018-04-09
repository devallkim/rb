<?php
if(!defined('__KIMS__')) exit;

//if (!$_SESSION['wcode']||$_SESSION['wcode']!=$pcode) exit;
if (!$bid) getLink('','','게시판 아이디가 지정되지 않았습니다.','');
$B = getDbData($table[$m.'list'],"id='".$bid."'",'*');
if (!$B['uid']) getLink('','','존재하지 않는 게시판입니다.','');
if (!$subject) getLink('reload','parent.','제목이 입력되지 않았습니다.','');
include_once $g['dir_module'].'var/var.php';
include_once $g['dir_module'].'var/var.'.$B['id'].'.php';

//마크다운 필터링 클래스 세팅
include_once $g['path_core'].'opensrc/markdown-to-html/Michelf/Markdown.inc.php';
use \Michelf\Markdown;
use \Michelf\MarkdownExtra;

$bbsuid		= $B['uid'];
$bbsid		= $B['id'];
$mbruid		= $my['uid'];
$id			= $my['id'];
$name		= $my['uid'] ? $my['name'] : trim($name);
$nic		= $my['uid'] ? $my['nic'] : $name;
$category	= trim($category);
$subject	= $my['admin'] ? trim($subject) : htmlspecialchars(trim($subject));

if ($markdown) $content= MarkdownExtra::defaultTransform($content); //Markdown parser 로 본문내용 구조화 적용
else $content	= trim($content);

$html		= $html ? $html : 'TEXT';
$tag		= trim($tag);
$d_regis	= $date['totime'];
$d_comment	= '';
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= $_SERVER['HTTP_USER_AGENT'];
$upload		= $upfiles;
$adddata	= trim($adddata);
$hidden		= $hidden ? intval($hidden) : 0;
$notice		= $notice ? intval($notice) : 0;
$display	= $d['bbs']['display'] || $hidepost || $hidden ? 0 : 1;
$parentmbr	= 0;
$point1		= trim($d['bbs']['point1']);
$point2		= trim($d['bbs']['point2']);
$point3		= $point3 ? filterstr(trim($point3)) : 0;
$point4		= $point4 ? filterstr(trim($point4)) : 0;

if ($d['bbs']['badword_action'])
{
	$badwordarr = explode(',' , $d['bbs']['badword']);
	$badwordlen = count($badwordarr);
	for($i = 0; $i < $badwordlen; $i++)
	{
		if(!$badwordarr[$i]) continue;

		if(strstr($subject,$badwordarr[$i]) || strstr($content,$badwordarr[$i]))
		{
			if ($d['bbs']['badword_action'] == 1)
			{
				getLink('','','등록이 제한된 단어를 사용하셨습니다.','');
			}
			else {
				$badescape = strCopy($badwordarr[$i],$d['bbs']['badword_escape']);
				$content = str_replace($badwordarr[$i],$badescape,$content);
				$subject = str_replace($badwordarr[$i],$badescape,$subject);
			}
		}
	}
}

if (!$uid || $reply == 'Y')
{
	if(!getDbRows($table[$m.'day'],"date='".$date['today']."' and site=".$s.' and bbs='.$bbsuid))
	getDbInsert($table[$m.'day'],'date,site,bbs,num',"'".$date['today']."','".$s."','".$bbsuid."','0'");
	if(!getDbRows($table[$m.'month'],"date='".$date['month']."' and site=".$s.' and bbs='.$bbsuid))
	getDbInsert($table[$m.'month'],'date,site,bbs,num',"'".$date['month']."','".$s."','".$bbsuid."','0'");
}

if ($uid)
{
	$R = getUidData($table[$m.'data'],$uid);
	if (!$R['uid']) getLink('','','존재하지 않는 게시물입니다.','');

	if ($reply == 'Y')
	{
		if (!$my['admin'] && !strstr(','.($d['bbs']['admin']?$d['bbs']['admin']:'.').',',','.$my['id'].','))
		{
			if ($d['bbs']['perm_l_write'] > $my['level'] || strstr($d['bbs']['perm_g_write'],'['.$my['sosok'].']'))
			{
				getLink('','','정상적인 접근이 아닙니다.','');
			}
		}

		$RNUM = getDbRows($table[$m.'idx'],'gid >= '.$R['gid'].' and gid < '.(intval($R['gid'])+1));
		if ($RNUM > 98) getLink('','','죄송합니다. 더이상 답글을 달 수 없습니다.','');

		getDbUpdate($table[$m.'idx'],'gid=gid+0.01','gid > '.$R['gid'].' and gid < '.(intval($R['gid'])+1));
		getDbUpdate($table[$m.'data'],'gid=gid+0.01','gid > '.$R['gid'].' and gid < '.(intval($R['gid'])+1));

		if ($R['hidden'] && $hidden)
		{
			if ($R['mbruid'])
			{
				$pw = $R['mbruid'];
			}
			else {
				$pw = $my['uid'] ? $R['pw'] : ($pw == $R['pw'] ? $R['pw'] : md5($pw));
			}
		}
		else {
			$pw = $pw ? md5($pw) : '';
		}

		$gid	= $R['gid']+0.01;
		$depth	= $R['depth']+1;
		$parentmbr = $R['mbruid'];

		$QKEY = "site,gid,bbs,bbsid,depth,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,category,subject,content,html,tag,";
		$QKEY.= "hit,down,comment,oneline,trackback,likes,dislikes,report,point1,point2,point3,point4,d_regis,d_modify,d_comment,d_trackback,upload,ip,agent,sns,featured_img,location,pin,adddata";
		$QVAL = "'$s','$gid','$bbsuid','$bbsid','$depth','$parentmbr','$display','$hidden','$notice','$name','$nic','$mbruid','$id','$pw','$category','$subject','$content','$html','$tag',";
		$QVAL.= "'0','0','0','0','0','0','0','0','$point1','$point2','$point3','$point4','$d_regis','','','','$upload','$ip','$agent','','$featured_img','$location','$pin','$adddata'";
		getDbInsert($table[$m.'data'],$QKEY,$QVAL);
		getDbInsert($table[$m.'idx'],'site,notice,bbs,gid',"'$s','$notice','$bbsuid','$gid'");
		getDbUpdate($table[$m.'list'],"num_r=num_r+1,d_last='".$d_regis."'",'uid='.$bbsuid);
		getDbUpdate($table[$m.'month'],'num=num+1',"date='".$date['month']."' and site=".$s.' and bbs='.$bbsuid);
		getDbUpdate($table[$m.'day'],'num=num+1',"date='".$date['today']."' and site=".$s.' and bbs='.$bbsuid);
		$LASTUID = getDbCnt($table[$m.'data'],'max(uid)','');
		if ($cuid) getDbUpdate($table['s_menu'],"num='".getDbCnt($table[$m.'month'],'sum(num)','site='.$s.' and bbs='.$bbsuid)."',d_last='".$d_regis."'",'uid='.$cuid);

		if ($point1&&$my['uid'])
		{
			getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$my['uid']."','0','".$point1."','게시물(".getStrCut($subject,15,'').")포인트','".$date['totime']."'");
			getDbUpdate($table['s_mbrdata'],'point=point+'.$point1,'memberuid='.$my['uid']);
		}
	}
	else
	{

		if ($my['uid'] != $R['mbruid'] && !$my['admin'] && !strstr(','.($d['bbs']['admin']?$d['bbs']['admin']:'.').',',','.$my['id'].','))
		{
			 if (!strstr($_SESSION['module_'.$m.'_pwcheck'],$R['uid'])) getLink('','','정상적인 접근이 아닙니다.','');
		}

		$pw = !$R['pw'] && !$R['hidden'] && $hidden && $R['mbruid'] ? $R['mbruid'] : $R['pw'];

		$QVAL = "display='$display',hidden='$hidden',notice='$notice',pw='$pw',category='$category',subject='$subject',content='$content',html='$html',tag='$tag',point3='$point3',point4='$point4',d_modify='$d_regis',upload='$upload',featured_img='$featured_img',location='$location',pin='$pin',adddata='$adddata'";
		getDbUpdate($table[$m.'data'],$QVAL,'uid='.$R['uid']);
		getDbUpdate($table[$m.'idx'],'notice='.$notice,'gid='.$R['gid']);
		if ($cuid) getDbUpdate($table['s_menu'],"num='".getDbCnt($table[$m.'month'],'sum(num)','site='.$R['site'].' and bbs='.$R['bbs'])."'",'uid='.$cuid);
	}
}
else
{
	if (!$my['admin'] && !strstr(','.($d['bbs']['admin']?$d['bbs']['admin']:'.').',',','.$my['id'].','))
	{
		if ($d['bbs']['perm_l_write'] > $my['level'] || strstr($d['bbs']['perm_g_write'],'['.$my['sosok'].']'))
		{
			getLink('','','정상적인 접근이 아닙니다.','');
		}
	}

	$pw = $hidden && $my['uid'] ? $my['uid'] : ($pw ? md5($pw) : '');
	$mingid = getDbCnt($table[$m.'data'],'min(gid)','');
	$gid = $mingid ? $mingid-1 : 100000000.00;

	$QKEY = "site,gid,bbs,bbsid,depth,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,category,subject,content,html,tag,";
	$QKEY.= "hit,down,comment,oneline,trackback,likes,dislikes,report,point1,point2,point3,point4,d_regis,d_modify,d_comment,d_trackback,upload,ip,agent,sns,featured_img,location,pin,adddata";
	$QVAL = "'$s','$gid','$bbsuid','$bbsid','$depth','$parentmbr','$display','$hidden','$notice','$name','$nic','$mbruid','$id','$pw','$category','$subject','$content','$html','$tag',";
	$QVAL.= "'0','0','0','0','0','0','0','0','$point1','$point2','$point3','$point4','$d_regis','','','','$upload','$ip','$agent','','$featured_img','$location','$pin','$adddata'";
	getDbInsert($table[$m.'data'],$QKEY,$QVAL);
	getDbInsert($table[$m.'idx'],'site,notice,bbs,gid',"'$s','$notice','$bbsuid','$gid'");
	getDbUpdate($table[$m.'list'],"num_r=num_r+1,d_last='".$d_regis."'",'uid='.$bbsuid);
	getDbUpdate($table[$m.'month'],'num=num+1',"date='".$date['month']."' and site=".$s.' and bbs='.$bbsuid);
	getDbUpdate($table[$m.'day'],'num=num+1',"date='".$date['today']."' and site=".$s.' and bbs='.$bbsuid);
	$LASTUID = getDbCnt($table[$m.'data'],'max(uid)','');
	if ($cuid) getDbUpdate($table['s_menu'],"num='".getDbCnt($table[$m.'month'],'sum(num)','site='.$s.' and bbs='.$bbsuid)."',d_last='".$d_regis."'",'uid='.$cuid);
	if ($point1&&$my['uid'])
	{
		getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$my['uid']."','0','".$point1."','게시물(".getStrCut($subject,15,'').")포인트','".$date['totime']."'");
		getDbUpdate($table['s_mbrdata'],'point=point+'.$point1,'memberuid='.$my['uid']);
	}

	if ($gid == 100000000.00)
	{
		db_query("OPTIMIZE TABLE ".$table[$m.'idx'],$DB_CONNECT);
		db_query("OPTIMIZE TABLE ".$table[$m.'data'],$DB_CONNECT);
		db_query("OPTIMIZE TABLE ".$table[$m.'month'],$DB_CONNECT);
		db_query("OPTIMIZE TABLE ".$table[$m.'day'],$DB_CONNECT);
	}
}

$NOWUID = $LASTUID ? $LASTUID : $R['uid'];


if ($tag || $R['tag'])
{
	$_tagarr1 = array();
	$_tagarr2 = explode(',',$tag);
	$_tagdate = $date['today'];

	if ($R['uid'] && $reply != 'Y')
	{
		$_tagdate = substr($R['d_regis'],0,8);
		$_tagarr1 = explode(',',$R['tag']);
		foreach($_tagarr1 as $_t)
		{
			if(!$_t || in_array($_t,$_tagarr2)) continue;
			$_TAG = getDbData($table['s_tag'],"site=".$R['site']." and date='".$_tagdate."' and keyword='".$_t."'",'*');
			if($_TAG['uid'])
			{
				if($_TAG['hit']>1) getDbUpdate($table['s_tag'],'hit=hit-1','uid='.$_TAG['uid']);
				else getDbDelete($table['s_tag'],'uid='.$_TAG['uid']);
			}
		}
	}

	foreach($_tagarr2 as $_t)
	{
		if(!$_t || in_array($_t,$_tagarr1)) continue;
		$_TAG = getDbData($table['s_tag'],'site='.$s." and date='".$_tagdate."' and keyword='".$_t."'",'*');
		if($_TAG['uid']) getDbUpdate($table['s_tag'],'hit=hit+1','uid='.$_TAG['uid']);
		else getDbInsert($table['s_tag'],'site,date,keyword,hit',"'".$s."','".$_tagdate."','".$_t."','1'");
	}
}


if ($snsCallBack && ($sns_t||$sns_f||$sns_m||$sns_y))
{
	$xcync = "[][][][][][m:".$m.",bid:".$bbsid.",uid:".$NOWUID."]";
	$orignSubject = strip_tags($subject);
	$orignContent = getStrCut($orignSubject,60,'..');
	$orignUrl = 'http://'.$_SERVER['SERVER_NAME'].str_replace('./','/',getCyncUrl($xcync)).'#CMT';

	include_once $g['path_module'].$snsCallBack;

	if ($snsSendResult)
	{
		getDbUpdate($table[$m.'data'],"sns='".$snsSendResult."'",'uid='.$LASTUID);
	}
}

$_SESSION['bbsback'] = $backtype;

if ($reply == 'Y') $msg = '답변';
else if ($uid) $msg = '수정';
else $msg = '등록';

setrawcookie('bbs_action_result', rawurlencode('게시물이 '.$msg.' 되었습니다.|success'));  // 처리여부 cookie 저장

if ($backtype == 'list')
{
	getLink($nlist,'parent.','','');
}
else if ($backtype == 'view')
{
	if ($_HS['rewrite']&&!strstr($nlist,'&'))
	{
		getLink($nlist.'/'.$NOWUID,'parent.','','');
	}
	else {
		getLink($nlist.'&mod=view&uid='.$NOWUID,'parent.','','');
	}
}
else {
	getLink('reload','parent.','','');
}
?>
