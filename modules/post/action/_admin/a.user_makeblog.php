<?php
if(!defined('__KIMS__')) exit;

if (!$set) getLink('','','정상적인 접근이 아닙니다.','');
$R = getUidData($table[$m.'list'],$set);
if (!$R['uid']) getLink('','','정상적인 접근이 아닙니다.','');
if ($my['uid']!=$R['mbruid']) getLink('','','관리권한이 없습니다.','');

include_once $g['path_core'].'function/thumb.func.php';

$settype	= $settype;
$members	= trim($members);
$name		= trim($name);

if (!$name) getLink('','','포스트셋 제목을 입력해 주세요.','');

$QVAL = "settype='$settype',members='$members',name='$name'";
getDbUpdate($table[$m.'list'],$QVAL,'uid='.$R['uid']);

$fdset = array('layout','m_layout','theme_pc','theme_mobile','iframe','snsconnect','vtype','recnum','vopen','editor','rlength');

$gfile= $g['dir_module'].'var/var.'.$R['id'].'.php';
$fp = fopen($gfile,'w');
fwrite($fp, "<?php\n");
foreach ($fdset as $val)
{
	fwrite($fp, "\$d['set']['".$val."'] = \"".trim(${$val})."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($gfile,0707);

getLink($_SERVER['HTTP_REFERER'],'','','');
?>