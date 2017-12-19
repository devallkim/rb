<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('','','정상적인 접근이 아닙니다.','');

$NT_DATA = explode('|',$my['noticeconf']);

if ($member_uid)
{
	$NT_STRING = $NT_DATA[0].'|'.$NT_DATA[1].'|'.$NT_DATA[2].'|'.$NT_DATA[3].'|'.str_replace('['.$member_uid.']','',$NT_DATA[4]).'|'.$NT_DATA[5].'|';
	getDbUpdate($table['s_mbrdata'],"noticeconf='".$NT_STRING."'",'memberuid='.$my['uid']);
	getLink('reload','parent.','해제 되었습니다.','');
}
else if ($module_id)
{
	$NT_STRING = $NT_DATA[0].'|'.$NT_DATA[1].'|'.$NT_DATA[2].'|'.str_replace('['.$module_id.']','',$NT_DATA[3]).'|'.$NT_DATA[4].'|'.$NT_DATA[5].'|';
	getDbUpdate($table['s_mbrdata'],"noticeconf='".$NT_STRING."'",'memberuid='.$my['uid']);
	getLink('reload','parent.','해제 되었습니다.','');
}
else {
	$NT_STRING = $nt_rcv.'|'.$nt_rcvtype.'|'.$nt_rcvdel.'|'.$NT_DATA[3].'|'.$NT_DATA[4].'|'.$nt_email.'|';
	getDbUpdate($table['s_mbrdata'],"noticeconf='".$NT_STRING."'",'memberuid='.$my['uid']);
	getLink('','','','');
}
?>
