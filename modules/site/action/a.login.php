<?php
if(!defined('__KIMS__')) exit;

$history = $__target ? '-1' : '';
$id	= trim($_POST['id']);
$pw	= trim($_POST['pw']);

if (!$id || !$pw) getLink('','','아이디와 패스워드를 입력해 주세요.',$history);

if (strpos($id,'@') && strpos($id,'.'))
{
	$M1 = getDbData($table['s_mbrdata'],"email='".$id."'",'*');
	$M	= getUidData($table['s_mbrid'],$M1['memberuid']);
}
else {
	$M = getDbData($table['s_mbrid'],"id='".$id."'",'*');
	$M1 = getDbData($table['s_mbrdata'],'memberuid='.$M['uid'],'*');
}

if (!$M['uid'] || $M1['auth'] == 4) getLink('','','존재하지 않는 아이디입니다.',$history);
if ($M1['auth'] == 2) getLink('','','회원님은 인증보류 상태입니다.',$history);
if ($M1['auth'] == 3) getLink('','','회원님은 이메일 인증대기 상태입니다.',$history);
if ($M['pw'] != getCrypt($pw,$M1['d_regis']) && $M1['tmpcode'] != $pw) getLink('','','패스워드가 일치하지 않습니다.',$history);

if ($usertype == 'admin')
if (!$M1['admin']) getLink('','','회원님은 관리자가 아닙니다.',$history);

getDbUpdate($table['s_mbrdata'],"tmpcode='',num_login=num_login+1,now_log=1,last_log='".$date['totime']."'",'memberuid='.$M['uid']);
getDbUpdate($table['s_referer'],'mbruid='.$M['uid'],"d_regis like '".$date['today']."%' and site=".$s." and mbruid=0 and ip='".$_SERVER['REMOTE_ADDR']."'");

if ($idpwsave == 'checked') setcookie('svshop', $id.'|'.$pw, time()+60*60*24*30, '/');
else setcookie('svshop', '', 0, '/');

$_SESSION['mbr_uid'] = $M['uid'];
$_SESSION['mbr_pw']  = $M['pw'];
$referer = $referer ? urldecode($referer) : $_SERVER['HTTP_REFERER'];
$referer = str_replace('&panel=Y','',$referer);
$referer = str_replace('&a=logout','',$referer);

$fmktile = mktime();
$ffolder = $g['path_tmp'].'session/';
$opendir = opendir($ffolder);
while(false !== ($file = readdir($opendir)))
{
	if(!is_file($ffolder.$file)) continue;
	if($fmktile -  filemtime($ffolder.$file) > 1800 ) unlink($ffolder.$file);
}
closedir($opendir);

if ($usertype == 'admin') getLink($g['s'].'/?r='.$r.'&panel=Y&pickmodule=dashboard','parent.parent.','','');
if ($M1['admin']) getLink($g['s'].'/?r='.$r.'&panel=Y&_admpnl_='.urlencode($referer),'parent.parent.','','');
getLink($referer?$referer:$g['s'].'/?r='.$r,'parent.parent.','','');
?>
