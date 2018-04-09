<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

if (!$mbruid) exit;

$M = getUidData($table['s_mbrid'],$mbruid);
if (!$M['uid']) getLink('','','존재하지 않는 회원입니다.','');

$_isFollowing = getDbRows($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$mbruid);

if ($_isFollowing)
{
	getDbDelete($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$mbruid);

	// 알림 메시지 전송
	$rcvmember = $mbruid ;
	$sendmodule = $M['id'];
	$sendmember = $my['uid'] ;
	$message = "회원님의 팔로우 취소했습니다";
	$referer = '';
	$target = '_self';
	putNotice($rcvmember,$sendmodule,$sendmember,$message,$referer,$target);


}
else {
	getDbInsert($table['s_friend'],'rel,my_mbruid,by_mbruid,category,d_regis',"'0','".$my['uid']."','".$mbruid."','','".$date['totime']."'");

	// 알림 메시지 전송
	$rcvmember = $mbruid ;
	$sendmodule = $M['id'];
	$sendmember = $my['uid'] ;
	$message = "회원님의 팔로우를 시작했습니다.";
	$referer = '';
	$target = '_self';
	putNotice($rcvmember,$sendmodule,$sendmember,$message,$referer,$target);

}
?>
<script>

window.parent.$.notify({

	<?php if ($_isFollowing): ?>
	message: "팔로우가 취소 되었습니다."
	<?php else:?>
	message: "팔로우 되었습니다."
	<?php endif; ?>

},{
	placement: {
		from: "bottom",
		align: "center"
	},
	allow_dismiss: false,
	offset: 20,
	type: "success",
	timer: 100,
	delay: 1500,
	animate: {
		enter: "animated fadeInUp",
		exit: "animated fadeOutDown"
	}
});

</script>
<?php
exit;
?>
