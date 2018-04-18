<header class="bar bar-nav bar-dark bg-primary px-0">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-right p-x-1" role="button"  href="<?php echo RW('mod=settings') ?>"></a>
  <h1 class="title">
    <img class="mt-2 mr-2 pull-left img-circle bg-faded" data-role="avatar" src="<?php echo getAavatarSrc($my['uid'],'56') ?>" width="28">
    <small><?php echo $my['nic']?$my['nic']:$my['name'] ?></small>
    <?php if ($my['admin']): ?><span class="badge badge-pill badge-danger">ADMIN</span><?php endif; ?>
  </h1>
  <?php else: ?>
  <a class="icon icon icon-close pull-right p-x-1" role="button" id="drawer-close" title="드로어닫기"></a>
  <h1 class="title" role="button" data-toggle="modal" href="#modal-login" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
    로그인 하세요
  </h1>
  <?php endif; ?>
</header>

<nav class="bar bar-tab bg-faded">
  <?php if ($my['uid']): ?>
  <a class="tab-item" role="button" href="<?php echo RW('mod=settings') ?>">
    <span class="icon icon-person"></span>
    <span class="tab-label">개인정보</span>
  </a>
  <a class="tab-item" role="button" href="<?php echo $g['s']?>/logout">
    <span class="icon fa fa-sign-out"></span>
    <span class="tab-label">로그아웃</span>
  </a>
  <?php else: ?>
  <a class="tab-item" role="button" href="#modal-login" data-toggle="modal" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
    <span class="icon fa fa-sign-in"></span>
    <span class="tab-label">로그인</span>
  </a>
  <a class="tab-item" role="button" href="<?php echo RW('mod=join') ?>">
    <span class="icon icon-person"></span>
    <span class="tab-label">회원가입</span>
  </a>
  <?php endif; ?>
</nav>

<div class="content">
  <!-- 관리자모드 > 위젯코드 추출기를 활용하세요. -->
  <?php getWidget('menu/rc-drawer-menu',array('smenu'=>'0','limit'=>'2','link'=>'link','collid'=>'drawer-menu','accordion'=>'1','collapse'=>'1',))?>
</div>
