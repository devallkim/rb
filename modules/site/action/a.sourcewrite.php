<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

// parsedown : https://github.com/erusev/parsedown
include_once $g['path_core'].'opensrc/parsedown/Parsedown.php';
$Parsedown = new Parsedown();
$_source = trim(stripslashes($source));
$__SRC__ = $Parsedown->text($_source);

if($editFilter) include $g['path_plugin'].$editFilter.'/filter.php';
$source = preg_replace("'<tmp[^>]*?>'si",'',$__SRC__);

$vfile = $type == 'menu' ? $g['path_page'].$r.'-menus/'.$id : $g['path_page'].$r.'-pages/'.$id;
$fp = fopen($vfile.'.php','w');
fwrite($fp, $source."\n");
fclose($fp);
@chmod($vfile.'.php',0707);

if ($wysiwyg != 'Y')
{
	if (trim($mobile))
	{
		$fp = fopen($vfile.'.mobile.php','w');
		fwrite($fp, trim(stripslashes($mobile))."\n");
		fclose($fp);
		@chmod($vfile.'.mobile.php',0707);
	}
	else {
		if(is_file($vfile.'.mobile.php'))
		{
			unlink($vfile.'.mobile.php');
		}
	}

	if (trim($css))
	{
		$fp = fopen($vfile.'.css','w');
		fwrite($fp, trim(stripslashes($css))."\n");
		fclose($fp);
		@chmod($vfile.'.css',0707);
	}
	else {
		if(is_file($vfile.'.css'))
		{
			unlink($vfile.'.css');
		}
	}

	if (trim($js))
	{
		$fp = fopen($vfile.'.js','w');
		fwrite($fp, trim(stripslashes($js))."\n");
		fclose($fp);
		@chmod($vfile.'.js',0707);
	}
	else {
		if(is_file($vfile.'.js'))
		{
			unlink($vfile.'.js');
		}
	}

	$cachefile_mobile = str_replace('.php','.cache',$vfile.'.mobile');
	if(file_exists($cachefile_mobile)) unlink($cachefile_mobile);
	setrawcookie('site_edit_result', rawurlencode('소스코드 수정사항이 반영 되었습니다|success'));
	getLink('reload','parent.','','');
}
else {
	$cachefile_pc = str_replace('.php','.cache',$vfile);
	if(file_exists($cachefile_pc)) unlink($cachefile_pc);
	setrawcookie('site_edit_result', rawurlencode('반영 되었습니다|success'));
	getLink('reload','parent.','','');
}
exit;
?>
