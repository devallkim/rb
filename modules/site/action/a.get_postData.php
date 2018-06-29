<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error']=false;

if ($_mtype == 'page')
{
	$_filekind = $r.'-pages/'.$id;
	$_filesbj = $_HP['name'];
}
if ($_mtype == 'menu')
{
	$_filekind = $r.'-menus/'.$id;
	$_filesbj = $_HM['name'];
}

$__SRC__ = is_file($g['path_page'].$_filekind.'.php') ? implode('',file($g['path_page'].$_filekind.'.php')) : '';
$result['article'] = getContents($__SRC__,'HTML');

echo json_encode($result);
exit;
?>
