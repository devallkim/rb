<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

$tmpname	= $_FILES['upfile']['tmp_name'];
$realname	= $_FILES['upfile']['name'];
$fileExt	= strtolower(getExt($realname));
$fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
$photo		= $my['id'].'.'.$fileExt;
$saveFile1	= $g['path_var'].'avatar/'.$photo;
$saveFile2	= $g['path_var'].'avatar/180.'.$photo;

if (is_uploaded_file($tmpname))
{
	if (!strstr('[gif][jpg][png]',$fileExt))
	{
		getLink('','','gif/jpg/png 파일만 등록할 수 있습니다.','');
	}
	if (is_file($saveFile1))
	{
		unlink($saveFile1);
	}
	if (is_file($saveFile2))
	{
		unlink($saveFile2);
	}

	$wh = getimagesize($tmpname);
	if ($wh[0] < 250 || $wh[1] < 250)
	{
		getLink('','','가로/세로 250픽셀 이상이어야 합니다.','');
	}

	include_once $g['path_core'].'function/thumb.func.php';

	if ($fileExt == 'gif')
	{
		move_uploaded_file($tmpname,$saveFile1);
		copy($saveFile1,$saveFile2);
	}
	else {
		move_uploaded_file($tmpname,$saveFile2);
		ResizeWidth($saveFile2,$saveFile2,250);
		ResizeWidthHeight($saveFile2,$saveFile1,50,50);
	}

	getDbUpdate($table['s_mbrdata'],"photo='".$photo."'",'memberuid='.$my['uid']);
}

getLink('reload','parent.','','');
?>

<script>
parent.window.scrollTo(0,0);
parent.alertLayer("#alertBox","primary","아바타 이미지가 수정되었습니다. - <a href=\"/'.$my['id'].'\" class=\"alert-link\">프로필 보기</a>","Y","Y","");
</script>

<?php
exit;
?>
