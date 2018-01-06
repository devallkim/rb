<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_layout'].'rc-kfm/_includes/Rb.class.php';
require_once $g['path_layout'].'rc-kfm/_includes/Module.class.php';
$module=new Module();

$uid = $_GET['uid']; // 포스트 고유번호

$result=array();
$result['error'] = false;

$result['total_comment'] = $module->getPostComment('set',$uid);

echo json_encode($result);
exit;
?>
