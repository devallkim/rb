<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
$post_members=explode(',',$post_array);
$ymd=str_replace('/','',$ymd);
$hms=str_replace(':','',$hms);
$new_date=$ymd.$hms;
echo $new_date;
foreach($post_members as $val)
{
	$R = getUidData($table[$m.'data'],$val);
	if (!$R['uid']) continue;
	if($editType=='date') getDbUpdate($table[$m.'data'],"d_regis='".$new_date."',d_publish='".$new_date."',d_published='".$new_date."',d_modify='".$new_date."'",'uid='.$R['uid']);
}

getLink('reload','parent.parent.','','');
?>