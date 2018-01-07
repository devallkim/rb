<div class="card mb-3">
  <div class="card-header">
    개인 계정설정
  </div>
  <div class="list-group list-group-flush">
    <a href="/settings/profile" class="list-group-item <?php if($page=='profile'):?>selected<?php else:?>list-group-item-action<?php endif?>">프로필 관리</a>
    <a href="/settings/account" class="list-group-item <?php if($page=='account'):?>selected<?php else:?>list-group-item-action<?php endif?>">회원계정</a>
    <a href="/settings/emails" class="d-none list-group-item <?php if($page=='emails'):?>selected<?php else:?>list-group-item-action<?php endif?>">이메일</a>
    <a href="/settings/notifications" class="list-group-item <?php if($page=='notifications'):?>selected<?php else:?>list-group-item-action<?php endif?>">알림설정</a>
    <a href="/settings/billing" class="list-group-item <?php if($page=='billing'):?>selected<?php else:?>list-group-item-action<?php endif?>">결제정보</a>
    <a href="/settings/point" class="list-group-item <?php if($page=='point'):?>selected<?php else:?>list-group-item-action<?php endif?>">포인트</a>
    <a href="/settings/organizations" class="list-group-item <?php if($page=='organizations'):?>selected<?php else:?>list-group-item-action<?php endif?>">소속 단체</a>
  </div>
</div>

<?php $sqlque	= 'mbruid='.$my['uid'].' and auth=1 and owner=1'; ?>
<?php $_RCD=getDbArray($table['orgsmember'],$sqlque,'*','uid','asc',100,1)?>
<?php $NUM=getDbRows($table['orgsmember'],$sqlque); ?>

<?php if ($NUM): ?>
<div class="card">
  <div class="card-header">
    단체 계정설정
  </div>
  <div class="list-group list-group-flush">


    <?php while($_C=db_fetch_array($_RCD)):?>
    <?php $_M=getDbData($table['orgsdata'],'memberuid='.$_C['org'],'*')?>
    <?php $_MD=getDbData($table['s_mbrid'],'uid='.$_C['org'],'*')?>
    <a href="/organizations/<?php echo $_MD['id']?>/settings/profile" class="list-group-item list-group-item-action">
      <img alt="@<?php echo $_M['name'] ?>" class="rounded" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?$_M['photo']:'organ.gif'?>" height="20" src="" width="20">
      <span class="align-text-top ml-1"><?php echo $_M['name'] ?></span>
    </a>
    <?php endwhile?>

  </div>
</div>
<?php endif; ?>
