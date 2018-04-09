<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

unlink($g['dir_module'].'doc/'.$type.'.txt');

setrawcookie('maildoc_result', rawurlencode('삭제 되었습니다.|success'));
getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=maildoc','parent.','','');
?>
