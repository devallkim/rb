<?php
if(!defined('__KIMS__')) exit;

if (!$uid) getLink('','','잘못된 접근입니다.','');
$R = getUidData($table['s_upload'],$uid);
if (!$R['uid']) getLink('','','없는 파일입니다.','');
if (!$my['admin'] && $my['uid'] != $R['mbruid']) getLink('','','권한이 없습니다.','');

$name = trim($name);
$name = str_replace('.'.$R['ext'],'',$name).'.'.$R['ext'];
$name = strip_tags($name);
$alt = strip_tags(trim($alt));
$linkurl = trim($linkurl);
$caption = $my['admin'] ? trim($caption) : strip_tags(trim($caption));
$description = $my['admin'] ? trim($description) : strip_tags(trim($description));
if ($R['type']<0) $src = trim($src);
else $src = $R['src'];

getDbUpdate($table['s_upload'],"hidden='".$hidden."',name='".$name."',alt='".$alt."',caption='".$caption."',description='".$description."',src='".$src."',linkto='".$linkto."',license='".$license."',d_update='".$date['totime']."',linkurl='".$linkurl."'",'uid='.$R['uid']);

getLink('reload','parent.','수정 되었습니다.','');
?>
