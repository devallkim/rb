<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'] || $category < 1) getLink('','','정상적인 접근이 아닙니다.','');

$_CT = getUidData($table['s_uploadcat'],$category);
if (!$_CT['uid']) getLink('','','정상적인 접근이 아닙니다.','');
if ($my['uid'] != $_CT['mbruid']) getLink('','','삭제권한이 없습니다.','');

getDbDelete($table['s_uploadcat'],'uid='.$_CT['uid']);
getDbUpdate($table['s_uploadcat'],'r_num=r_num+'.$_CT['r_num'],"mbruid=".$my['uid']." and type=".$ablum_type." and name='trash'");
getDbUpdate($table['s_upload'],'category=-1','category='.$_CT['uid']);

getLink('reload','parent.','','');
?>
