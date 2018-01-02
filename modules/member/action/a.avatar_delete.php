<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

if (is_file($g['path_var'].'avatar/'.$my['photo']))
{
	unlink($g['path_var'].'avatar/'.$my['photo']);
}
if (is_file($g['path_var'].'avatar/180.'.$my['photo']))
{
	unlink($g['path_var'].'avatar/180.'.$my['photo']);
}
getDbUpdate($table['s_mbrdata'],"photo=''",'memberuid='.$my['uid']);

getLink('reload','parent.','','');
?>
