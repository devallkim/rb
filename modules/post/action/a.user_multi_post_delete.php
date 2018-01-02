<?php
if(!defined('__KIMS__')) exit;

include $g['dir_module'].'var/var.php';

foreach ($post_members as $val)
{
	$R = getUidData($table[$m.'data'],$val);
	if (!$R['uid']) continue;
	$B = getUidData($table[$m.'list'],$R['blog']);
	if (!$B['uid']) continue;

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
}

getLink('reload','parent.','','');
?>
