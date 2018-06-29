<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) {
	getLink('','','정상적인 접근이 아닙니다.','');
}

//환경설정 저장
if ($act=='save_config') {
	getDbUpdate($table['s_mbrdata'],'email_noti="'.$email_noti.'"','memberuid='.$my['uid']);  //회원정보 저장
	setrawcookie('member_settings_result', rawurlencode('설정이 저장 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}

exit();
?>
