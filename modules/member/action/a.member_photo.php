<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) exit;

include $g['path_core'].'function/thumb.func.php';

if ($_FILES['upfile']['tmp_name'])
{
	$fileName	= strtolower($_FILES['upfile']['name']);
	$fileSize	= $_FILES['upfile']['size'];
	$fileExt	= getExt($fileName);
	$fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
	$fileType	= getFileType($fileExt);
	$filePhoto	= $my['uid'].'-'.$g['time_srnad'].'.'.$fileExt;
	$saveFile1	= $g['path_var'].'avatar/'.$filePhoto;

	if (strstr('[jpg][png][gif]',$fileExt))
	{
		ResizeWidth($_FILES['upfile']['tmp_name'],$saveFile1,680);
		@chmod($saveFile1,0707);

		getDbUpdate($table['s_mbrdata'],"photo='".$filePhoto."'",'memberuid='.$my['uid']);
	}
	else {
		getLink('reload','parent.','이미지파일이 아닙니다. JPG/PNG 파일만 허용됩니다.','');
	}
?>
<script>
var avatar = '<?php echo $filePhoto?>';

function logoChange(logo) {
	//parent.location.reload();
	parent.$('[data-role="avatar"]').attr('src',parent.rooturl + '/_core/opensrc/timthumb/thumb.php?src=/_var/avatar/' + logo+'&w=320&h=320&s=1');
	parent.$('#page-profile').find('.content').loader("hide");
}
logoChange(avatar);
parent.$('[data-role="avatar-wrapper"]').addClass('active');
setTimeout(function(){
	parent.$.notify({message: '아바타가 등록되었습니다.'},{type: 'default'});
}, 500);

</script>
<?php
}
exit;
?>