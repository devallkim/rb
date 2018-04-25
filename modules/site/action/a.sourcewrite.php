<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if ($markdown == 'Y') {

	// parsedown : https://github.com/erusev/parsedown
	include_once $g['path_core'].'opensrc/parsedown/Parsedown.php';
	$Parsedown = new Parsedown();
	$_source = trim(stripslashes($source));
	$__SRC__ = $Parsedown->text($_source);
	$source = preg_replace("'<tmp[^>]*?>'si",'',$__SRC__);

	$_mobile = trim(stripslashes($mobile));
	$__MSRC__ = $Parsedown->text($_mobile);
	$mobile = $__MSRC__;
}

$seo_src = '['.$featured_img.']';

if($editFilter) include $g['path_plugin'].$editFilter.'/filter.php';

$vfile = $type == 'menu' ? $g['path_page'].$r.'-menus/'.$id : $g['path_page'].$r.'-pages/'.$id;
$fp = fopen($vfile.'.php','w');
fwrite($fp, trim(stripslashes($source)));
fclose($fp);
@chmod($vfile.'.php',0707);

if ($wysiwyg != 'Y')
{
	if (trim($mobile))
	{
		$fp = fopen($vfile.'.mobile.php','w');
		fwrite($fp, trim(stripslashes($mobile)));
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

	if ($type == 'menu') {
		getDbUpdate($table['s_menu'],"upload='".$upload."',featured_img='".$featured_img."',d_last='".$date['totime']."'",'uid='.$uid);
		$_SEO = getDbData($table['s_seo'],'rel=1 and parent='.$uid,'image_src');
		if (!$_SEO['image_src']) getDbUpdate($table['s_seo'],"image_src='$seo_src'",'parent='.$uid);

	} else {
		getDbUpdate($table['s_page'],"upload='".$upload."',featured_img='".$featured_img."',d_last='".$date['totime']."'",'uid='.$uid);
		$_SEO = getDbData($table['s_seo'],'rel=2 and parent='.$uid,'image_src');
		if (!$_SEO['image_src']) getDbUpdate($table['s_seo'],"image_src='$seo_src'",'parent='.$uid);
	}

	setrawcookie('site_edit_result', rawurlencode('저장 되었습니다|success'));
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
