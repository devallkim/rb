<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

for ($i = 1; $i < 6; $i++)
{
	$mfile = $g['path_var'].'site/'.$r.'/'.$m.'.agree'.$i.'.txt';
	$fp = fopen($mfile,'w');
	fwrite($fp,trim(stripslashes(${'agree'.$i})));
	fclose($fp);
	@chmod($mfile,0707);

}

$_SESSION['_join_menu'] = 'terms';
$_SESSION['_join_tab'] = $_join_tab;
setrawcookie('member_config_result', rawurlencode('약관/안내 메시지가 변경 되었습니다.|success'));  // 처리여부 cookie 저장
getLink('reload','parent.','','');
?>
