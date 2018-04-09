<?php
$g['layoutVarForSite'] = $g['dir_layout'].'_var/_var.'.$r.'.php';
include is_file($g['layoutVarForSite']) ? $g['layoutVarForSite'] : $g['dir_layout'].'_var/_var.php';
?>
