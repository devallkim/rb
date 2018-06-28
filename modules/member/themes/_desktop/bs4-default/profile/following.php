<?php
$type = $type ? $type : 'following';
$sort	= 'uid';
$orderby= 'desc';
$recnum	= 15;
if($type == 'follower')
{
	$bbsque	= 'by_mbruid='.$_MP['uid'];
	$_fmemberuid = 'my_mbruid';
}
if($type == 'following')
{
	$bbsque	= 'my_mbruid='.$_MP['uid'];
	$_fmemberuid = 'by_mbruid';
}
if($type == 'friend')
{
	$bbsque	= 'by_mbruid='.$_MP['uid'].' and rel=1';
	$_fmemberuid = 'my_mbruid';
}
if ($where && $keyword) $bbsque .= getSearchSql($where,$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_friend'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_friend'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>

<div class="page-wrapper row">
	<div class="col-3 page-nav">

		<?php include $g['dir_module_skin'].'_vcard.php';?>
	</div>

	<div class="col-9 page-main">

		<?php include $g['dir_module_skin'].'_nav.php';?>





					<?php $i=0;while($_R=db_fetch_array($RCD)):$i++?>
					<?php $M = getUidData($table['s_mbrid'],$_R[$_fmemberuid])?>
					<?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$_R[$_fmemberuid],'*')?>
					<?php $_add = explode('<split>',$_M['addfield'])?>

					<div class="d-flex row w-100 py-4 border-bottom border-gray-light">
						<div class="col-1 v-align-top">
							<a href="/@<?php echo $M['id']?>"><img alt="@<?php echo $M['id']?>" class="avatar" height="50" src="<?php echo $g['url_root']?>/_var/avatar/<?php if($_M['photo']):?><?php echo $_M['photo']?><?php else:?>0.gif<?php endif?>" width="50"></a>
						</div>
						<div class="col-9 v-align-top pr-3">
					    <a href="/@<?php echo $M['id']?>" class="d-inline-block no-underline mb-1">
					      <span class="f4 link-gray-dark"><?php echo $_M['nic']?></span>
					      <span class="link-gray pl-1"><?php echo $M['id']?></span>
					    </a>

					      <?php if ($_add[0]): ?><p class="mb-1 text-gray text-small"><?php echo $_add[0]?></p><?php endif; ?>
					      <p class="text-gray text-small mb-0">
					        <svg aria-hidden="true" class="octicon octicon-location" height="16" version="1.1" viewBox="0 0 12 16" width="12"><path fill-rule="evenodd" d="M6 0C2.69 0 0 2.5 0 5.5 0 10.02 6 16 6 16s6-5.98 6-10.5C12 2.5 9.31 0 6 0zm0 14.55C4.14 12.52 1 8.44 1 5.5 1 3.02 3.25 1 6 1c1.34 0 2.61.48 3.56 1.36.92.86 1.44 1.97 1.44 3.14 0 2.94-3.14 7.02-5 9.05zM8 5.5c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"></path></svg>
									<?php echo $_M['location']?>
									(<?php echo $g['grade']['m'.$_M['level']]?> <?php echo $_M['level']?>)
					      </p>
					  </div>
						<div class="col-2 v-align-top text-right">
							<button class="btn btn-light btn-sm" type="button" name="button">팔로우</button>

							<?php if($my['uid']):?>
							<?php if($my['uid']==$_M['memberuid']):?>
							<a class="btnGray01 plusBlue filter">Follow</i></a>
							<?php else:?>
							<?php $ISF = getDbData($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$_M['memberuid'],'uid')?>
							<?php if($ISF['uid']):?>
							<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=friend_unfollow&amp;fuid=<?php echo $ISF['uid']?>&amp;mbruid=<?php echo $_M['memberuid']?>&amp;reload=Y" class="btnGray01 plusBlue hand" target="_action_" onclick="return confirm('정말로 Unfollow 하시겠습니까?');"><i><s>Unfollow</s></i></a>
							<?php else:?>
							<?php $ISF = getDbData($table['s_friend'],'my_mbruid='.$_M['memberuid'].' and by_mbruid='.$my['uid'],'uid')?>
							<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=friend_follow&amp;fuid=<?php echo $ISF['uid']?>&amp;mbruid=<?php echo $_M['memberuid']?>&amp;reload=Y" class="btnGray01 plusBlue hand" target="_action_" onclick="return confirm('정말로 Follow 하시겠습니까?');"><i><s>Follow</s></i></a>
							<?php endif?>
							<?php endif?>

							<?php else:?>
							<a class="btnGray01 plusBlue filter">Follow</a>
							<?php endif?>

					  </div>
					</div>

					<?php endwhile?>
					<?php if(!db_num_rows($RCD)):?>
						<div class="blankslate mt-4">
						  <i class="fa fa-user-plus fa-2x text-gray-light" aria-hidden="true"></i>
						  <h3 class="mt-2">아직 팔로잉하는 사용자가 없습니다.</h3>
						  <p>킴스큐의 <a href="">소셜활동</a>에 대해 자세히 확인해 보십시오.</p>
						</div>
					<?php else:?>
					<nav aria-label="Page navigation" class="mt-4">
						<ul class="pagination justify-content-center">
							<?php $_N =  './'.$mbrid.'?page=following&' ?>
			        <?php echo getPageLink(10,$p,$TPG,$_N)?>
						</ul>
					</nav>
					<?php endif?>






	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->
