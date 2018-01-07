<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_tmpvfile = $g['path_var'].'site/'.$r.'/'.$m.'.var.php';

$fp = fopen($_tmpvfile,'w');
fwrite($fp, "<?php\n");

//기초환경 설정
fwrite($fp, "\$d['member']['theme_main'] = \"".$theme_main."\";\n");
fwrite($fp, "\$d['member']['theme_mobile'] = \"".$theme_mobile."\";\n");
fwrite($fp, "\$d['member']['layout_join'] = \"".$layout_join."\";\n");
fwrite($fp, "\$d['member']['layout_join_mobile'] = \"".$layout_join_mobile."\";\n");
fwrite($fp, "\$d['member']['layout_login'] = \"".$layout_login."\";\n");
fwrite($fp, "\$d['member']['layout_login_mobile'] = \"".$layout_login_mobile."\";\n");
fwrite($fp, "\$d['member']['layout_profile'] = \"".$layout_profile."\";\n");
fwrite($fp, "\$d['member']['layout_profile_mobile'] = \"".$layout_profile_mobile."\";\n");
fwrite($fp, "\$d['member']['layout_settings'] = \"".$layout_settings."\";\n");
fwrite($fp, "\$d['member']['layout_settings_mobile'] = \"".$layout_settings_mobile."\";\n");
fwrite($fp, "\$d['member']['sosokmenu_join'] = \"".$sosokmenu_join."\";\n");
fwrite($fp, "\$d['member']['sosokmenu_login'] = \"".$sosokmenu_login."\";\n");
fwrite($fp, "\$d['member']['sosokmenu_profile'] = \"".$sosokmenu_profile."\";\n");
fwrite($fp, "\$d['member']['sosokmenu_settings'] = \"".$sosokmenu_settings."\";\n");

//로그인
fwrite($fp, "\$d['member']['login_expire'] = \"".$login_expire."\";\n");
fwrite($fp, "\$d['member']['login_emailid'] = \"".$login_emailid."\";\n");
fwrite($fp, "\$d['member']['login_cookie'] = \"".$login_cookie."\";\n");
fwrite($fp, "\$d['member']['login_ssl'] = \"".$login_ssl."\";\n");

//회원가입
fwrite($fp, "\$d['member']['join_enable'] = \"".$join_enable."\";\n");
fwrite($fp, "\$d['member']['join_mobile'] = \"".$join_mobile."\";\n");
fwrite($fp, "\$d['member']['join_out'] = \"".$join_out."\";\n");
fwrite($fp, "\$d['member']['join_rejoin'] = \"".$join_rejoin."\";\n");
fwrite($fp, "\$d['member']['join_auth'] = \"".$join_auth."\";\n");
fwrite($fp, "\$d['member']['join_level'] = \"".$join_level."\";\n");
fwrite($fp, "\$d['member']['join_group'] = \"".$join_group."\";\n");
fwrite($fp, "\$d['member']['join_point'] = \"".$join_point."\";\n");
fwrite($fp, "\$d['member']['join_pointmsg'] = \"".$join_pointmsg."\";\n");
fwrite($fp, "\$d['member']['join_cutid'] = \"".$join_cutid."\";\n");
fwrite($fp, "\$d['member']['join_cutnic'] = \"".$join_cutnic."\";\n");
fwrite($fp, "\$d['member']['join_cutemail'] = \"".$join_cutemail."\";\n");
fwrite($fp, "\$d['member']['join_email'] = \"".$join_email."\";\n");
fwrite($fp, "\$d['member']['join_email_send'] = \"".$join_email_send."\";\n");

//가입양식
fwrite($fp, "\$d['member']['form_agree'] = \"".$form_agree."\";\n");
fwrite($fp, "\$d['member']['form_jumin'] = \"".$form_jumin."\";\n");
fwrite($fp, "\$d['member']['form_foreign'] = \"".$form_foreign."\";\n");
fwrite($fp, "\$d['member']['form_comp'] = \"".$form_comp."\";\n");
fwrite($fp, "\$d['member']['form_age'] = \"".$form_age."\";\n");
fwrite($fp, "\$d['member']['form_qa'] = \"".$form_qa."\";\n");
fwrite($fp, "\$d['member']['form_home'] = \"".$form_home."\";\n");
fwrite($fp, "\$d['member']['form_tel1'] = \"".$form_tel1."\";\n");
fwrite($fp, "\$d['member']['form_tel2'] = \"".$form_tel2."\";\n");
fwrite($fp, "\$d['member']['form_job'] = \"".$form_job."\";\n");
fwrite($fp, "\$d['member']['form_marr'] = \"".$form_marr."\";\n");
fwrite($fp, "\$d['member']['form_addr'] = \"".$form_addr."\";\n");
fwrite($fp, "\$d['member']['form_qa_p'] = \"".$form_qa_p."\";\n");
fwrite($fp, "\$d['member']['form_home_p'] = \"".$form_home_p."\";\n");
fwrite($fp, "\$d['member']['form_tel1_p'] = \"".$form_tel1_p."\";\n");
fwrite($fp, "\$d['member']['form_tel2_p'] = \"".$form_tel2_p."\";\n");
fwrite($fp, "\$d['member']['form_job_p'] = \"".$form_job_p."\";\n");
fwrite($fp, "\$d['member']['form_marr_p'] = \"".$form_marr_p."\";\n");
fwrite($fp, "\$d['member']['form_addr_p'] = \"".$form_addr_p."\";\n");
fwrite($fp, "\$d['member']['form_nic'] = \"".$form_nic."\";\n");
fwrite($fp, "\$d['member']['form_nic_p'] = \"".$form_nic_p."\";\n");
fwrite($fp, "\$d['member']['form_birth'] = \"".$form_birth."\";\n");
fwrite($fp, "\$d['member']['form_birth_p'] = \"".$form_birth_p."\";\n");
fwrite($fp, "\$d['member']['form_sex'] = \"".$form_sex."\";\n");
fwrite($fp, "\$d['member']['form_sex_p'] = \"".$form_sex_p."\";\n");

//마이페이지
fwrite($fp, "\$d['member']['mytab_post'] = \"".$mytab_post."\";\n");
fwrite($fp, "\$d['member']['mytab_comment'] = \"".$mytab_comment."\";\n");
fwrite($fp, "\$d['member']['mytab_oneline'] = \"".$mytab_oneline."\";\n");
fwrite($fp, "\$d['member']['mytab_avatar'] = \"".$mytab_avatar."\";\n");
fwrite($fp, "\$d['member']['mytab_covimg'] = \"".$mytab_covimg."\";\n");
fwrite($fp, "\$d['member']['mytab_scrap'] = \"".$mytab_scrap."\";\n");
fwrite($fp, "\$d['member']['mytab_friend'] = \"".$mytab_friend."\";\n");
fwrite($fp, "\$d['member']['mytab_paper'] = \"".$mytab_paper."\";\n");
fwrite($fp, "\$d['member']['mytab_point'] = \"".$mytab_point."\";\n");
fwrite($fp, "\$d['member']['mytab_log'] = \"".$mytab_log."\";\n");
fwrite($fp, "\$d['member']['mytab_info'] = \"".$mytab_info."\";\n");
fwrite($fp, "\$d['member']['mytab_pw'] = \"".$mytab_pw."\";\n");
fwrite($fp, "\$d['member']['mytab_out'] = \"".$mytab_out."\";\n");
fwrite($fp, "\$d['member']['mytab_recnum'] = \"".$mytab_recnum."\";\n");

fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpvfile,0707);


if ($_join_menu == 'signup-form-config')
{
	$mfile = $g['path_var'].'site/'.$r.'/'.$m.'.job.txt';

	$fp = fopen($mfile,'w');
	fwrite($fp,trim(stripslashes($job)));
	fclose($fp);
	@chmod($mfile,0707);

}
if ($_join_menu == 'signup-form-add')
{
	$mfile = $g['path_var'].'site/'.$r.'/'.$m.'.add_field.txt';
	if(!is_array($addFieldMembers))
	{
		$addFieldMembers = array();
	}

	$fp = fopen($mfile,'w');
	foreach($addFieldMembers as $val)
	{
		fwrite($fp,$val.'|'.${'add_name_'.$val}.'|'.${'add_type_'.$val}.'|'.${'add_value_'.$val}.'|'.${'add_size_'.$val}.'|'.${'add_pilsu_'.$val}.'|'.${'add_hidden_'.$val}."\n");
	}
	if ($add_name)
	{
		fwrite($fp,$date['totime'].'|'.$add_name.'|'.$add_type.'|'.$add_value.'|'.$add_size.'|'.$add_pilsu.'|'.$add_hidden."\n");
	}
	fclose($fp);
	@chmod($mfile,0707);
}

$_SESSION['_join_menu'] = $_join_menu;
setrawcookie('member_config_result', rawurlencode('설정이 변경 되었습니다.|success'));  // 처리여부 cookie 저장

getLink('reload','parent.','','');
?>
