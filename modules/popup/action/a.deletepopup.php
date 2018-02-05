<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

getDbDelete($table['s_popup'],'uid='.$uid);

getLink('reload','parent.', $alert , $history);
?>