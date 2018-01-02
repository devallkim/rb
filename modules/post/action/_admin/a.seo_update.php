<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$QVAL = "subject='".${'s_subject'.$uid}."',title='".${'s_title'.$uid}."',keywords='".${'s_keywords'.$uid}."',description='".${'s_desc'.$uid}."',classification='".${'s_class'.$uid}."',replyto='".${'s_replyto'.$uid}."',language='".${'s_language'.$uid}."',build='".${'s_build'.$uid}."'";

getDbUpdate($table[$m.'seo'],$QVAL,'parent='.$uid);

getLink($_SERVER['HTTP_REFERER'],'','','');
?>
