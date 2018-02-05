<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

if (is_file($g['path_var'].'avatar/'.$my['photo']))
{
	unlink($g['path_var'].'avatar/'.$my['photo']);
}
getDbUpdate($table['s_mbrdata'],"photo=''",'memberuid='.$my['uid']);

// getLink('','parent.','삭제되었습니다.','');
?>

<script>
parent.$('[data-role="avatar"]').attr('src',parent.rooturl + '/_var/avatar/0.svg');
parent.$('[data-role="avatar-wrapper"]').removeClass('active')
setTimeout(function(){
	parent.$.notify({message: '아바타가 삭제되었습니다.'},{type: 'default'});
}, 500);

</script>

<?php
exit;
?>
