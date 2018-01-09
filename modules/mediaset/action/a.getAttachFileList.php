<?php
if(!defined('__KIMS__')) exit;

$uid = $_POST['uid'];
$mod = '';
$theme = $_POST['theme'];

$R = getUidData($table['chaneldata'],$uid);

require_once $g['path_module'].'mediaset/themes/'.$theme.'/main.func.php';

$result=array();
$result['error']=false;

if($R['upload']) {
  $result['attachNum'] = getAttachNum($R['upload'],'view');
  $result['image'] = getAttachFileList($R,'upload','photo');
  $result['doc'] = getAttachFileList($R,'upload','doc');
  $result['file'] = getAttachFileList($R,'upload','file');
  $result['zip'] = getAttachFileList($R,'upload','zip');
  $result['video'] = getAttachFileList($R,'upload','video');
  $result['audio'] = getAttachFileList($R,'upload','audio');
  $result['youtube'] = getAttachPlatformList($R,'upload','default');
}

echo json_encode($result);
exit;
?>
