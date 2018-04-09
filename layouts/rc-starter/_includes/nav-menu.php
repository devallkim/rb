<?php
$CD=getDbSelect($table,($site?'site='.$site.' and ':'').'hidden=0 and parent='.$parent.' and depth='.($depth+1).($w['mobile']?' and mobile=1':' and mobile=1').' order by gid asc','*');

?>
