<?php
if(!defined('__KIMS__')) exit;

include $g['dir_module'].'var/var.php';
include $g['dir_module'].'lib/tree.func.php'; // 알림전송 함수 

if($act=='req_wait' || $act=='req_hold' || $act=='req_publish') $published=1;
else if($act=='req_draft') $published=0;
$act_to_step=array('req_draft'=>0,'req_wait'=>1,'req_hold'=>2,'req_publish'=>3);

foreach ($post_members as $val)
{ 
	$R = getUidData($table[$m.'data'],$val);
	if (!$R['uid']) continue;
	$B = getUidData($table[$m.'list'],$R['blog']);
	if (!$B['uid']) continue;
   
    getDbUpdate($table[$m.'data'],'published='.$published.', step='.$act_to_step[$act],'uid='.$val);
     
    // 발행처리를 한 경우에는 발행일을 업데이트 해주고 나머지는 발행일을 지운다.
    if($act=='req_publish')  getDbUpdate($table[$m.'data'],"d_published='".$date['totime']."'",'uid='.$val);
    else getDbUpdate($table[$m.'data'],"d_published=''",'uid='.$val);

   	$_AUTHORS=explode(',',$B['members']);
	$MNG=getDbData($table['s_mbrid'],"id='".trim($_AUTHORS[0])."'",'*');
	$mnguid=$MNG['uid'];
	$SM=getDbData($table['s_mbrdata'],'memberuid='.$mnguid,'*'); // 승인자  정보  
	$RM=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*'); // 필자 정보 
   
    if($act=='req_hold') putPostNotice($SM,$RM,$B['id'],'hold'); // 보류알림 전송
    if($act=='req_publish') putPostNotice($SM,$RM,$B['id'],'publish'); // 발행알림 전송

}	

getLink('reload','parent.','','');
?>
