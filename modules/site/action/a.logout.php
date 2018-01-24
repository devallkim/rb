<?php
if(!defined('__KIMS__')) exit;

if ($my['uid'])
{
	getDbUpdate($table['s_mbrdata'],'now_log=0','memberuid='.$my['uid']);
	$_SESSION['mbr_uid'] = '';
	$_SESSION['mbr_logout'] = '1';
	setAccessToken($my['uid'],'logout'); // 토큰 데이타 삭제 및 쿠키 초기화
}

$referer = $referer ? urldecode($referer) : $_SERVER['HTTP_REFERER'];
$referer = explode('&_admpnl_',$referer);
$referer = $referer[0];

setrawcookie('site_login_result', rawurlencode('로그아웃 되었습니다.|default'));  // 처리여부 cookie 저장
getLink($referer,'top.','','');
?>
