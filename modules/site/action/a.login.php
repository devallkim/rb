<?php
if(!defined('__KIMS__')) exit;

$history = $__target ? '-1' : '';
$id	= trim($_POST['id']);
$pw	= trim($_POST['pw']);

if (!$id || !$pw) getLink('reload','parent.','이메일과 패스워드를 입력해 주세요.',$history);

if (strpos($id,'@') && strpos($id,'.'))
{
	$M1 = getDbData($table['s_mbrdata'],"email='".$id."'",'*');
	$M	= getUidData($table['s_mbrid'],$M1['memberuid']);
}
else {
	$M = getDbData($table['s_mbrid'],"id='".$id."'",'*');
	$M1 = getDbData($table['s_mbrdata'],'memberuid='.$M['uid'],'*');
}

if (!$M['uid'] || $M1['auth'] == 4) {
	echo "<script>";
	echo "parent.$('".$form."').removeClass('was-validated');";
	echo "parent.$('".$form."').find('[type=submit]').prop('disabled', false);";
	echo "parent.$('".$form."').find('[data-role=idErrorBlock]').text('존재하지 않는 계정입니다.');";
	echo "parent.$('".$form."').find('[name=id]').focus().addClass('is-invalid');";
	echo "</script>";
	exit();
}
if ($M1['auth'] == 2) getLink('reload','parent.','회원님은 인증보류 상태입니다.',$history);
if ($M1['auth'] == 3) getLink('reload','parent.','회원님은 이메일 인증대기 상태입니다.',$history);
if ($M['pw'] != getCrypt($pw,$M1['d_regis']) && $M1['tmpcode'] != $pw) {
  echo "<script>";
	echo "parent.$('".$form."').removeClass('was-validated');";
	echo "parent.$('".$form."').find('[type=submit]').prop('disabled', false);";
	echo "parent.$('".$form."').find('[data-role=passwordErrorBlock]').text('패스워드가 일치하지 않습니다.');";
	echo "parent.$('".$form."').find('[name=pw]').val('').focus().addClass('is-invalid');";
	echo "</script>";
	exit();
}


if ($usertype == 'admin')
if (!$M1['admin']) getLink('reload','parent.','회원님은 관리자가 아닙니다.',$history);

getDbUpdate($table['s_mbrdata'],"tmpcode='',num_login=num_login+1,now_log=1,last_log='".$date['totime']."'",'memberuid='.$M['uid']);
getDbUpdate($table['s_referer'],'mbruid='.$M['uid'],"d_regis like '".$date['today']."%' and site=".$s." and mbruid=0 and ip='".$_SERVER['REMOTE_ADDR']."'");

if($login_cookie=='checked'){
 setAccessToken($M1['memberuid'],'login');
}

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

if ($usertype == 'admin' || $M1['admin']) {
	if (!$M1['super'] && !$M1['adm_site']) getLink($g['s'].'/?r='.$r,'parent.','관리 사이트가 지정되지 않았습니다.','');
	$_siteArray = getArrayString($M1['adm_site']);
	$SD	= getUidData($table['s_site'],$_siteArray[data][0]);
	$r = $SD['id'];
}

if ($usertype == 'admin') getLink($g['s'].'/?r='.$r.'&panel=Y&pickmodule=site','parent.parent.','','');

if ($M1['admin']) {
	setrawcookie('site_login_result', rawurlencode('관리자 로그인 되었습니다.|default'));  // 알림처리를 위한 로그인 상태 cookie 저장
	if ($g['mobile']&&$_SESSION['pcmode']!='Y') getLink($referer?$referer:$g['s'].'/?r='.$r,'parent.','','');
	getLink($g['s'].'/?r='.$r.'&panel=Y&_admpnl_='.urlencode($referer),'parent.','','');
}
setrawcookie('site_login_result', rawurlencode('로그인 되었습니다.|default'));  // 알림처리를 위한 로그인 상태 cookie 저장
getLink($referer?$referer:$g['s'].'/?r='.$r,'parent.','','');
?>
