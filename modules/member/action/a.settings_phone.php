<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) {
	getLink('','','정상적인 접근이 아닙니다.','');
}

$g['memberVarForSite'] = $g['path_var'].'site/'.$r.'/member.var.php';
$_tmpvfile = file_exists($g['memberVarForSite']) ? $g['memberVarForSite'] : $g['path_module'].$module.'/var/var.php';
include_once $_tmpvfile;

$R = getUidData($table['s_mbrphone'],$uid);
$phone = str_replace('-','',$phone);

// 휴대폰 추가
if ($act=='add') {

	if (!$phone) getLink('','','정상적인 접근이 아닙니다.','');

	$isId = getDbRows($table['s_mbrphone'],"phone='".$phone."'");

	$numphones = getDbRows($table['s_mbrphone'],"mbruid='".$my['uid']."'");

	if ($numphones>2) {
		getLink('reload','parent.','더 이상 휴대폰을 추가할 수 없습니다.','');
	}

	if ($isId) {
		echo '<script type="text/javascript">';
		echo 'parent.$("#phonesForm").find("[name=phone]").addClass("is-invalid");';
		echo 'parent.$("#phonesForm").find(".invalid-feedback").text("이미 추가된 휴대폰입니다");';
		echo 'parent.$("#phonesForm").find("[type=submit]").attr("disabled",false);';
		echo '</script>';
	} else {
		$d_regis	= $date['totime'];
		getDbInsert($table['s_mbrphone'],'mbruid,phone,d_regis,d_verified',"'".$my['uid']."','".trim($phone)."',$d_regis,''");
		setrawcookie('member_settings_result', rawurlencode('휴대폰이 추가 되었습니다.|success'));  // 처리여부 cookie 저장
		getLink('reload','parent.','','');
	}
}

//휴대폰 삭제
if ($act=='del') {
	if (!$uid || !$R['uid']) getLink('','','정상적인 접근이 아닙니다.','');
	getDbDelete($table['s_mbrphone'],'uid='.$uid.' and mbruid='.$my['uid']);
	getDbDelete($table['s_code'],'entry='.$uid.' and mbruid='.$my['uid'].' and name="settings_phone" and sms=1');

	if ($R['prim']==1) {  //삭제한 휴대폰이 기본 휴대폰 경우
		getDbUpdate($table['s_mbrdata'],'phone=""','memberuid='.$my['uid']);  //회원정보에서 휴대폰 정보 제거
	}

	if ($R['backup']==1) {  //삭제한 휴대폰이 백업 휴대폰 경우
		getDbUpdate($table['s_mbrdata'],'phone_backup=1','memberuid='.$my['uid']);  //백업휴대폰 설정을 본인확인된 전체메일로 설정
	}

	setrawcookie('member_settings_result', rawurlencode('휴대폰이 삭제 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

}

//인증번호 발송
if ($act=='send_code') {

	$g['memberVarForSite'] = $g['path_var'].'site/'.$r.'/member.var.php';
	$_tmpvfile = file_exists($g['memberVarForSite']) ? $g['memberVarForSite'] : $g['path_module'].$module.'/var/var.php';
	include_once $_tmpvfile;

	$verify_code = date('His');
	$code_name	= 'settings_phone';
	$d_regis = $date['totime'];
	$mbruid = $my['uid'];

	if (!$d['member']['join_tel']) {
		getLink('','','죄송합니다. 대표전화가 등록되지 않았습니다. 관리자에게 문의해 주세요.','');
	}

	if (!$R['phone']) getLink('','','등록된 휴대폰이 아닙니다.','');

	include_once $g['path_core'].'function/sms.func.php';
	$content = str_replace('{NAME}',$my['name'],$content);
	$content = str_replace('{NICK}',$my['nic'],$content);
	$content = str_replace('{ID}',$R['id'],$content);
	$content = str_replace('{phone}',$my['phone'],$content);
	$content.= $_HS['name'].' 인증번호 ['.$verify_code.'] '.$d['member']['settings_keyexpire'].'분 이내에 입력해주세요.';

	$result = getSendSMS($R['phone'],$d['member']['join_tel'],'',$content,'sms');

	if (!$result) {
		getLink('reload','parent.','죄송합니다. 문자메시지 발송서버가 응답하지 않아 SMS를 보내드리지 못했습니다.','');
	}

	$has_code_query = 'mbruid='.$my['uid'].' and name="settings_phone" and entry='.$uid.' and sms=1';
	$has_code=getDbRows($table['s_code'],$has_code_query);  // 코드 발급여부

	getDbDelete($table['s_code'],$has_code_query); 		//재발급시 기존 인증코드 삭제

	// 신규 인증코드 저장
	$_QKEY = "mbruid,name,entry,code,sms,email,d_regis";
	$_QVAL = "'$mbruid','$code_name','$uid','$verify_code','1','0','$d_regis'";
	getDbInsert($table['s_code'],$_QKEY,$_QVAL);

	//코드발급시점 저장(갱신)
	getDbUpdate($table['s_mbrphone'],'d_code='.$d_regis,'uid='.$R['uid']);

	setrawcookie('member_settings_result', rawurlencode('요청하신 휴대폰으로 인증번호가 전송 되었습니다.|success'));  // 처리여부 cookie 저장
	//setrawcookie('settings_phone_code_'.$uid, rawurlencode(''));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

}

//기본 휴대폰 저장
if ($act=='save_primary') {

	$phone = $R['phone'];

	getDbUpdate($table['s_mbrphone'],'prim=0','mbruid='.$my['uid']); // 기본 휴대폰 초기화
	getDbUpdate($table['s_mbrphone'],'prim=1','uid='.$R['uid'].' and mbruid='.$my['uid']); // 기본 휴대폰 지정
	getDbUpdate($table['s_mbrdata'],'phone="'.$phone.'"','memberuid='.$my['uid']);  //회원정보 저장

	setrawcookie('member_settings_result', rawurlencode('기본 휴대폰이 설정 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

}

//백업 휴대폰 저장
if ($act=='save_backup') {

	getDbUpdate($table['s_mbrphone'],'backup=0','mbruid='.$my['uid']); // 백업 휴대폰 초기화

	if ($uid=='none') {  // 기본 휴대폰만(사용안함)
		$backup_type = 0;
	} else if ($uid=='all') { //본인확인된 전체메일
		$backup_type = 1;
	} else {
		$backup_type = 2;
		getDbUpdate($table['s_mbrphone'],'backup=1','uid='.$R['uid'].' and mbruid='.$my['uid']); // 백업 휴대폰 지정
	}

	getDbUpdate($table['s_mbrdata'],'phone_backup='.$backup_type,'memberuid='.$my['uid']);  //회원정보 백업 휴대폰 설정 저장

	setrawcookie('member_settings_result', rawurlencode('백업 휴대폰이 설정 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

}

//인증코드 확인
if ($act=='confirm_code') {

	$L=getValid($R['d_code'],$d['member']['settings_keyexpire']);
	$CD = getDbData($table['s_code'],'entry='.$uid,'code');

	if (!$code) getLink('reload','parent.','인증번호를 입력해 주세요.','');
	if (!$L) getLink('reload','parent.','인증번호가 만료 되었습니다.','');
	if ($CD['code']!=$code) {

		echo '<script type="text/javascript">';
		echo 'parent.$("#item-'.$uid.'").find("[data-act=confirm_code]").attr("disabled",false);';
		echo 'parent.$("#item-'.$uid.'").find(".invalid-tooltip").text("인증번호를 확인해 주세요.");';
		echo 'parent.$("#item-'.$uid.'").find("[type=number]").focus().addClass("is-invalid");';
		echo '</script>';
		exit();
	}

	$d_regis	= $date['totime'];
	$_QVAL = "d_verified='$d_regis',d_code=''";
	getDbUpdate($table['s_mbrphone'],$_QVAL,'uid='.$uid);  // 본인확인 처리
	getDbDelete($table['s_code'],'mbruid='.$my['uid'].' and name="settings_phone"  and entry='.$uid.' and phone=1'); //인증코드 삭제

	// 기본 휴대폰이 없을 경우, 기본 휴대폰으로 지정
	if (!$my['phone']) {
		getDbUpdate($table['s_mbrphone'],'prim=1','uid='.$uid.' and mbruid='.$my['uid']); // 기본 휴대폰 지정
		getDbUpdate($table['s_mbrdata'],'phone="'.$R['phone'].'"','memberuid='.$my['uid']);  //회원정보 저장
	}

	setrawcookie('member_settings_result', rawurlencode('본인인증이 성공 하였습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}

//환경설정 저장
if ($act=='save_config') {
	getDbUpdate($table['s_mbrdata'],'mailing='.$mailing,'memberuid='.$my['uid']);  //회원정보 저장
	setrawcookie('member_settings_result', rawurlencode('설정이 변경 되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}

exit();
?>
