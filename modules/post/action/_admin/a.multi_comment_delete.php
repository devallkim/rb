<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
include $g['dir_module'].'var/var.php';

foreach($comment_members as $val)
{
	$R = getUidData($table[$m.'comment'],$val);
	if (!$R['uid']) continue;

	//한줄의견삭제
	if ($R['oneline'])
	{
		$_ONELINE = getDbSelect($table[$m.'oneline'],'parent='.$R['uid'],'*');
		while($_O=db_fetch_array($_ONELINE))
		{
			if ($d['set']['c_give_opoint']&&$_O['mbruid'])
			{
				getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$_O['mbruid']."','0','-".$d['set']['c_give_opoint']."','한줄의견삭제(".getStrCut(str_replace('&amp;',' ',strip_tags($_O['content'])),15,'').")환원','".$date['totime']."'");
				getDbUpdate($table['s_mbrdata'],'point=point-'.$d['set']['c_give_opoint'],'memberuid='.$_O['mbruid']);
			}
		}
		getDbDelete($table[$m.'oneline'],'parent='.$R['uid']);
	}

	getDbDelete($table[$m.'comment'],'uid='.$R['uid']);
	getDbUpdate($table[$m.'data'],'comment=comment-1,oneline=oneline-'.$R['oneline'],'uid='.$R['parent']);
	getDbUpdate($table[$m.'list'],'num_c=num_c-1,num_o=num_o-'.$R['oneline'],'uid='.$R['set']);
	getDbUpdate($table[$m.'members'],'num_c=num_c-1,num_o=num_o-'.$R['oneline'],'set='.$R['set'].' and mbruid='.$R['mbruid']);


	if ($d['set']['c_give_opoint']&&$R['mbruid'])
	{
		getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$R['mbruid']."','0','-".$d['set']['c_give_opoint']."','포스트셋 댓글삭제(".getStrCut($R['subject'],15,'').")환원','".$date['totime']."'");
		getDbUpdate($table['s_mbrdata'],'point=point-'.$d['set']['c_give_opoint'],'memberuid='.$R['mbruid']);
	}
}

getLink('reload','parent.','','');
?>