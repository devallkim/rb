<?php
if(!defined('__KIMS__')) exit;

$U = getUidData($table['s_upload'],$uid);
 if ($U['uid'])
 {
     getDbDelete($table['s_upload'],'uid='.$U['uid']);
 }
 echo 'ok';
exit;
?>
