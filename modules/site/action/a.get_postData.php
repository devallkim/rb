<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error']=false;

if ($_mtype == 'page')
{
	$_HP = getUidData($table['s_page'],$uid);
	$_filekind = $r.'-pages/'.$_HP['id'];
	$_filesbj = $_HP['name'];
}
if ($_mtype == 'menu')
{
	$_HM = getUidData($table['s_menu'],$uid);
	$_filekind = $r.'-menus/'.$_HM['id'];
	$_filesbj = $_HM['name'];
}

$__SRC__ = is_file($g['path_page'].$_filekind.'.php') ? implode('',file($g['path_page'].$_filekind.'.php')) : '';
$result['article'] = getContents($__SRC__,'HTML');

echo json_encode($result);
exit;
?>
