<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('','','정상적인 접근이 아닙니다.','');


if ($act == 'pw')  // 비밀번호 변경
{

	if ($my['last_pw']) {
		if (!$pw1 || !$pw2) {
			getLink('','','정상적인 접근이 아닙니다.','');
		}

		//if (getCrypt($pw,$my['d_regis']) != $my['pw'] && $my['tmpcode'] != getCrypt($pw,$my['d_regis'])) {
			//getLink('reload','parent.','현재 비밀번호가 일치하지 않습니다.','');
		//}

		if ($pw == $pw1) {
			getLink('reload','parent.','현재 비밀번호와 변경할 비밀번호가 같습니다.','');
		}
	}

	getDbUpdate($table['s_mbrid'],"pw='".getCrypt($pw1,$my['d_regis'])."'",'uid='.$my['uid']);
	getDbUpdate($table['s_mbrdata'],"last_pw='".$date['today']."',tmpcode=''",'memberuid='.$my['uid']);

	$_SESSION['mbr_pw']  = getCrypt($pw1,$my['d_regis']);

	setrawcookie('member_settings_result', rawurlencode('비밀번호가 변경되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

}

if ($act == 'id')
{

	$g['memberVarForSite'] = $g['path_var'].'site/'.$r.'/member.var.php';
	$_tmpvfile = file_exists($g['memberVarForSite']) ? $g['memberVarForSite'] : $g['path_module'].$module.'/var/var.php';
	include_once $_tmpvfile;

	if(!$id || $id==$my['id']) {
		echo '<script type="text/javascript">';
		echo 'parent.$("#idChangeForm").find("[type=submit]").attr("disabled",false);';
		echo '</script>';
		exit();
	}

	$isId = getDbRows($table['s_mbrid'],"id='".$id."' and id<>'".$my['id']."'");

	if (strstr(','.$d['member']['join_cutid'].',',','.$id.',') || $isId || !$d['member']['join_rejoin'] || is_file($g['path_tmp'].'out/'.$fvalue.'.txt')) {
		echo '<script type="text/javascript">';
		echo 'parent.$("#idChangeForm").find("[name=id]").addClass("is-invalid").focus();';
		echo 'parent.$("#idChangeForm").find("[name=check_id]").val(0);';
		echo 'parent.$("#id-feedback").text("사용할 수 없는 아이디입니다");';
		echo 'parent.$("#idChangeForm").find("[type=submit]").attr("disabled",false);';
		echo '</script>';
		exit();
	}

	getDbUpdate($table['s_mbrid'],"id='".$id."'",'uid='.$my['uid']);

	setrawcookie('member_settings_result', rawurlencode('아이디가 변경되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');
}
?>
