<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$R = getUidData($table[$m.'list'],$uid);
if (!$R['uid']) getLink('','','존재하지 않는 포스트셋입니다.','');

include $g['dir_module'].'var/var.php';
include $g['dir_module'].'lib/action.func.php';

$RCD = getDbArray($table[$m.'data'],'set='.$R['uid'],'*','gid','asc',0,0);
while($_R=db_fetch_array($RCD))
{
	//댓글삭제
	if ($_R['comment']) DeleteComment($_R,$d);
	
	//첨부파일삭제
	if ($_R['upload']) DeleteUpfile($_R,$d);

	//태그삭제
	if ($_R['tag']) DeletePostTag($_R,$m);
	
   getDbUpdate($table[$m.'month'],'num=num-1',"date='".substr($_R['d_regis'],0,6)."' and set=".$_R['set']); 
	getDbUpdate($table[$m.'day'],'num=num-1',"date='".substr($_R['d_regis'],0,8)."' and set=".$_R['set']);
}

getDbDelete($table[$m.'data'],'set='.$R['uid']);
getDbDelete($table[$m.'category'],'set='.$R['uid']);
getDbDelete($table[$m.'catidx'],'set='.$R['uid']);
getDbDelete($table[$m.'seo'],'set='.$R['uid']);
getDbDelete($table[$m.'members'],'set='.$R['uid']);
getDbDelete($table[$m.'list'],'uid='.$R['uid']);

unlink($g['dir_module'].'var/var.'.$R['id'].'.php');

getLink('reload','parent.','','');
?>
