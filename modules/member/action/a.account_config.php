<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

include_once $g['path_module'].'member/var/var.join.php';


if ($act == 'id')
{
	if(!$id || $id==$my['id']) exit;
	$isId = getDbRows($table['s_mbrid'],"id='".$id."' and id<>'".$my['id']."'");
	if($isId) getLink('','','존재하는 아이디입니다.','');

	getDbUpdate($table['s_mbrid'],"id='".$id."'",'uid='.$my['uid']);

	getLink('reload','parent.parent.','','');
}

?>
