<?php
if(!defined('__KIMS__')) exit;

$R = getUidData($table[$m.'data'],$uid);
if (!$R['uid']) getLink('','','존재하지 않는 포스트입니다.','');
$B = getUidData($table[$m.'list'],$R['blog']);
if (!$my['uid'] || ($my['uid']!=$B['mbruid'] && !strpos('_,'.$B['members'].',',','.$my['id'].','))) getLink('','','포스트 삭제권한이 없습니다.','');
include $g['dir_module'].'var/var.php';
include $g['dir_module'].'var/var.'.$B['id'].'.php';
include $g['dir_module'].'lib/action.func.php';

//댓글삭제
if ($R['comment']) DeleteComment($R,$d,$m,$B);

//첨부파일삭제
if ($R['upload']) DeleteUpfile($R,$d);

//태그삭제
if ($R['tag']) DeletePostTag($R,$m);

getDbUpdate($table[$m.'month'],'num=num-1',"date='".substr($R['d_regis'],0,6)."' and blog=".$B['uid']);
getDbUpdate($table[$m.'day'],'num=num-1',"date='".substr($R['d_regis'],0,8)."' and blog=".$B['uid']);
getDbDelete($table[$m.'data'],'uid='.$R['uid']);
getDbDelete($table[$m.'seo'],'parent='.$R['uid']);
getDbUpdate($table[$m.'list'],'num_w=num_w-1,num_c=num_c-'.$R['comment'].',num_o=num_o-'.$R['oneline'],'uid='.$B['uid']);
getDbUpdate($table[$m.'members'],'num_w=num_w-1','blog='.$B['uid'].' and mbruid='.$R['mbruid']);


$_orign_category_members = getDbArray($table[$m.'catidx'],'post='.$R['uid'],'*','uid','asc',0,1);
while($_ocm=db_fetch_array($_orign_category_members))
{
	getDbDelete($table[$m.'catidx'],'uid='.$_ocm['uid']);

	if ($R['isreserve'])
	{
		getDbUpdate($table[$m.'category'],'num_reserve=num_reserve-1','uid='.$_ocm['category']);
	}
	else {
		getDbUpdate($table[$m.'category'],'num_open=num_open-1','uid='.$_ocm['category']);
	}
}

getLink($g['s'].'/?r='.$r.'&m='.$m.'&set='.$B['id'].'&front=list&cat='.$cat.'&vtype='.$vtype.'&recnum='.$recnum,'parent.','','');
?>
