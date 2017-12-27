
<div class="text-center">
  <?php if($my['uid']==$_MH['uid']):?>
  <a href="/settings/profile" class="d-block" aria-label="Change your avatar" data-role="tooltip" title="아바타를 변경하세요.">
    <img src="<?php echo $g['s']?><?php echo $_MH['photo']?'/_var/avatar/'.$_MH['photo']:'/_core/images/avatar/default_gray.svg'?>"  alt="" class="rounded img-fluid">
  </a>
  <?php else:?>
  <img src="<?php echo $g['s']?><?php echo $_MH['photo']?'/_var/avatar/'.$_MH['photo']:'/_core/images/avatar/default_gray_light.svg'?>"  alt="" class="rounded img-fluid">
  <?php endif?>
</div>


<div class="vcard-names-container pt-3">
  <h1 class="vcard-names">
    <span class="p-name vcard-fullname d-block" itemprop="name"><?php echo $_MH['nic'] ?></span>
    <span class="p-nickname vcard-username d-block" itemprop="additionalName"><?php echo $mbrid ?></span>
  </h1>
</div>

<?php $_add = explode('<split>',$_MH['addfield'])?>


<p class="mb-3 text-gray">
  <?php if ($_add[0]): ?>
  <?php echo $_add[0]?>
  <?php else: ?>
  <a href="/settings/profile?focus_bio=1">소개말 추가</a>
  <?php endif; ?>
</p>

<?php if($my['uid']):?>

  <style media="screen">
  	.page-nav .btn::after {
  		content: ''
  	}
  	.page-nav .btn.active::after {
  		content: ' 취소'
  	}
  </style>


  <?php if($my['uid']==$_MH['uid']):?>
  <?php else:?>

    <?php $_isFollowing = getDbRows($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$_MH['uid']); ?>

    <button class="btn btn-block btn-light<?php echo $_isFollowing ?' active':'' ?>" data-action="iframe" data-url="<?php echo $g['url_action']?>profile_follow&amp;mbruid=<?php echo $_MH['uid']?>"  data-toggle="button">
      팔로우
    </button>


  <?php endif?>

<?php endif?>


<ul class="vcard-details border-top border-gray-light mt-3 pt-2 list-unstyled">
  <?php if ($_MH['addr0']): ?>
  <li aria-label="Home location" class="vcard-detail pt-1 text-truncate">
    <i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i> <?php if($_MH['addr0']):?> <?php echo $_MH['addr0']?><?php endif?>
  </li>
  <?php endif; ?>

  <li aria-label="Email" class="vcard-detail pt-1 text-truncate">
    <?php if ($my['uid']): ?>
    <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> <a href="mailto:<?php echo $_MH['email'] ?>"><?php echo $_MH['email'] ?></a>
    <?php else: ?>
      <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> <a href="/login">로그인후 확인가능</a>
    <?php endif; ?>
  </li>

  <?php if ($_MH['home']): ?>
  <li aria-label="Blog or website" class="vcard-detail pt-1 text-truncate">
    <i class="fa fa-link fa-fw" aria-hidden="true"></i> <a href="http://<?php echo $_MH['home'] ?>" target="_blank"><?php echo $_MH['home'] ?></a>
  </li>
  <?php endif; ?>
  <?php if ($_MH['company']): ?>
  <li aria-label="Blog or website" class="vcard-detail pt-1 text-truncate">
    <i class="fa fa-building-o fa-fw" aria-hidden="true"></i> <?php echo $_MH['company'] ?>
  </li>
  <?php endif; ?>
</ul>

<?php if ($my['uid']): ?>
<ul class="vcard-details border-top border-gray-light py-2 list-unstyled mb-0">
  <li class="pt-1 text-truncate">
    ㆍ나이/성별 : <?php if($_MH['birth1']):?><?php echo getAge($_MH['birth1'])?>세<?php else:?><span>미등록</span><?php endif?> (<?php if($_MH['sex']):?><?php echo $_MH['sex']==1?'남성':'여성'?><?php else:?><span>미등록</span><?php endif?>)
  </li>
  <li  class="pt-1 text-truncate">
    ㆍ분야 : <?php if($_MH['job']):?><?php echo $_MH['job']?><?php if($g['profile'][1]):?> <?php echo getAge($g['profile'][1])?>년차<?php endif?><?php else:?><span>미등록</span><?php endif?>
  </li>
  <li class="pt-1 text-truncate">
    ㆍ가입일자 : <?php echo getDateFormat($_MH['d_regis'],'Y.m.d')?>
  </li>
  <li class="pt-1 text-truncate">
    ㆍ<span class="cx">포인트</span> : <?php echo number_format($_MH['point'])?> P
  </li>
  <li class="pt-1 text-truncate">
    ㆍ<span class="cx">회원등급</span> : <?php echo $g['grade']['m'.$_MH['level']]?> <?php echo $_MH['level']?>
  </li>
</ul>
<?php endif; ?>

<div class="border-top py-3 clearfix">
  <h2 class="mb-2 h4">소속단체</h2>

  <?php $_RCD=getDbArray($table['orgsmember'],'mbruid='.$_MH['memberuid'].' and auth=1 and hidden=0','*','uid','asc',100,1)?>


  <?php while($_C=db_fetch_array($_RCD)):?>
  <?php $_M=getDbData($table['orgsdata'],'memberuid='.$_C['org'],'*')?>
  <?php $_MD=getDbData($table['s_mbrid'],'uid='.$_C['org'],'*')?>
  <a href="/<?php echo $_MD['id'] ?>" title="<?php echo $_M['name'] ?>" class="avatar-group-item" itemprop="follows" data-role="tooltip">
    <img alt="@<?php echo $_MD['id'] ?>" class="avatar" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?$_M['photo']:'organ.gif'?>" width="35" height="35">
  </a>
  <?php endwhile?>
  <?php if(!db_num_rows($_RCD)):?>
  <div class="p-2 text-center text-gray-light">소속단체가 없습니다.</div>
  <?php endif?>
</div>
