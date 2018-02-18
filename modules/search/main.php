<?php
if(!defined('__KIMS__')) exit;

$g['searchVarForSite'] = $g['path_var'].'site/'.$r.'/search.var.php';
$_tmpdfile = file_exists($g['searchVarForSite']) ? $g['searchVarForSite'] : $g['path_module'].$m.'/var/var.search.php';

if ($g['mobile']&&$_SESSION['pcmode']!='Y'){
	$g['searchOrderVarForSite'] = $g['path_var'].'site/'.$r.'/search.order.mobile.php';
	$_ufile = file_exists($g['searchOrderVarForSite']) ? $g['searchOrderVarForSite'] : $g['path_module'].$m.'/var/var.order.mobile.php';
}else{
	$g['searchOrderVarForSite'] = $g['path_var'].'site/'.$r.'/search.order.desktop.php';
	$_ufile = file_exists($g['searchOrderVarForSite']) ? $g['searchOrderVarForSite'] : $g['path_module'].$m.'/var/var.order.desktop.php';
}

include_once $_tmpdfile;
include_once $_ufile;

$swhere	= $swhere ? $swhere : 'all';
$_ResultArray = array();
$_HM['layout'] = $d['search']['layout'];

if ($g['mobile']&&$_SESSION['pcmode']!='Y')
{
	$_HM['m_layout'] = $d['search']['m_layout'] ?$d['search']['m_layout'] : $d['search']['layout'];
	$d['search']['theme'] = $d['search']['m_theme'] ? $d['search']['m_theme'] : $d['search']['theme'];
}

$g['dir_module_skin'] = $g['dir_module'].'/themes/'.$d['search']['theme'].'/';
$g['url_module_skin'] = $g['url_module'].'/themes/'.$d['search']['theme'];
$g['img_module_skin'] = $g['url_module_skin'].'/images';

$g['dir_module_mode'] = $g['dir_module_skin'].'main';
$g['url_module_mode'] = $g['url_module_skin'].'/main';

$g['url_reset']	= $g['s'].'/?r='.$r.'&amp;m='.$m;
$g['url_where']	= $g['url_reset'].($sort?'&amp;sort='.$sort:'').($orderby?'&amp;sort='.$orderby:'').($keyword?'&amp;keyword='.urlencode($keyword):'').'&amp;swhere=';

$g['push_location'] = '<li class="active">'.$_HMD['name'].'</li>';

$g['main'] = $g['dir_module_mode'].'.php';
?>
