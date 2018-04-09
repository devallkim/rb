<?php
//시간비교 (분)
function getloginExpired($time,$term)
{
	if(!$time) return false;
	$dtime = date('YmdHis',mktime(substr($time,8,2),substr($time,10,2)+$term,substr($time,12,2),substr($time,4,2),substr($time,6,2),substr($time,0,4)));
	if ($dtime > $GLOBALS['date']['totime']) return true;
	else return false;
}

?>
