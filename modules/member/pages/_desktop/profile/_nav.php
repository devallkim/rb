<?php
$bbsque_group	= 'memberuid='.$_MH['uid'].' and bbstype=2';
$bbsque_note	= 'memberuid='.$_MH['uid'].' and bbstype=3';

if ($my['uid'] == $_MH['uid'] ) {
  $pjtque	= 'auth=1 and (owner='.$_MH['uid'].' or manager='.$_MH['uid'].')';
} else {
  $pjtque	= 'auth=1 and hidden=0 and (owner='.$_MH['uid'].' or manager='.$_MH['uid'].')';
}

$NUM_PROJECT = getDbRows($table['projectlist'],$pjtque);
$NUM_GROUP = getDbRows($table['forummembers'],$bbsque_group);
$NUM_NOTE = getDbRows($table['forummembers'],$bbsque_note);

?>


<div class="user-profile-nav">
  <nav class="nav underline-nav">
    <a class="nav-link f16<?php if ($page=='main'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>">요약</a>
    <a class="nav-link f16<?php if ($page=='project'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=project" data-toggle="tooltip" title="프로젝트">
      프로젝트 <span class="badge badge-pill badge-light"> <?php echo $NUM_PROJECT ?> </span>
    </a>
    <a class="d-none nav-link f16<?php if ($page=='group'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=group" data-toggle="tooltip" title="그룹">
      <i class="fa fa-users fa-lg" aria-hidden="true"></i> <span class="badge badge-pill badge-light"> <?php echo $_MH['num_project'] ?> </span>
    </a>
    <a class="d-none nav-link f16<?php if ($page=='note'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=note" data-toggle="tooltip" title="노트">
      <i class="fa fa-book fa-lg" aria-hidden="true"></i> <span class="badge badge-pill badge-light"> <?php echo $_MH['num_project'] ?> </span>
    </a>

    <a class="nav-link f16<?php if ($page=='stars'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=stars" data-toggle="tooltip" title="별표">
      별표
      <span class="badge badge-pill badge-light"> <?php echo getDbRows($table['projectstar'],'mbruid='.$_MH['uid'])?> </span>
    </a>
    <a class="nav-link f16<?php if ($page=='follower'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=follower" data-toggle="tooltip" title="팔로워">
      팔로워
      <span class="badge badge-pill badge-light"> <?php echo getDbRows($table['s_friend'],'by_mbruid='.$_MH['uid'])?></span>
    </a>
    <a class="nav-link f16<?php if ($page=='following'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=following" data-toggle="tooltip" title="팔로잉">
      팔로잉
      <span class="badge badge-pill badge-light"> <?php echo getDbRows($table['s_friend'],'my_mbruid='.$_MH['uid'])?></span>
    </a>
    <a class="d-none nav-link f16<?php if ($page=='forum'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=forum" data-toggle="tooltip" title="포럼활동">
      <i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i>  <span class="badge badge-pill badge-light"> <?php echo $_MH['num_project'] ?> </span>
    </a>
    <a class="d-none nav-link f16<?php if ($page=='market'): ?> active<?php endif; ?>" href="/<?php echo $mbrid ?>?page=market" data-toggle="tooltip" title="마켓">
      <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>  <span class="badge badge-pill badge-light"><?php echo $NUM_NOTE ?></span>
    </a>

  </nav>
</div>
