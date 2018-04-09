<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';

$g['memberVarForSite'] = $g['path_var'].'site/'.$_HS['id'].'/member.var.php'; // 사이트 회원모듈 변수파일
$_varfile = file_exists($g['memberVarForSite']) ? $g['memberVarForSite'] : $g['dir_module'].'var/var.php';
include_once $_varfile; // 변수파일 인클루드

$result=array();
$result['error']=false;

$mbruid = $_POST['mbruid'];
$theme = $_POST['theme'];

$_MH = getUidData($table['s_mbrid'],$mbruid);
$_MD = getDbData($table['s_mbrdata'],"memberuid='".$mbruid."'",'*');

$TMPL['id'] = $_MH['id'];
$TMPL['nic'] = $_MD['nic'];
$TMPL['name'] = $_MD['name'];
$TMPL['point'] = number_format($_MD['point']);
$TMPL['level'] = $_MD['level'];
$TMPL['bio'] = $_MD['bio'];
$TMPL['d_regis'] = getDateFormat($_MD['d_regis'],'Y.m.d');
$TMPL['avatar'] = getAavatarSrc($mbruid,'84');

$markup_file = 'profile-popover'; // 기본 마크업 페이지 전달 (테마 내부 _html/profile-popover.html)


// 최종 결과값 추출 (sys.class.php)
$skin=new skin($markup_file);
$result['profile']=$skin->make();


echo json_encode($result);
exit;
?>
