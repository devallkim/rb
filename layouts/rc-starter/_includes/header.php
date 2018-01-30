<header class="bar bar-nav bar-dark bg-primary">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-left" role="button" href="<?php echo RW('mod=settings') ?>" title="개인정보수정"></a>
  <?php endif; ?>

  <?php if ($my['uid']): ?>
  <?php else: ?>
  <a class="icon icon-person pull-right" role="button" data-toggle="modal" href="#modal-login" data-title="로그인"></a>
  <?php endif; ?>
  <a class="title" href="<?php echo RW(0)?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
</header>
<div class="bar bar-standard bar-header-secondary bar-light bg-faded p-x-0">
  <nav class="nav nav-inline">
    <a class="nav-link<?php if (!$c): ?> active<?php endif; ?>" href="<?php echo RW(0)?>">홈</a>
    <?php getWidget('rc-simple/nav-menu',array('smenu'=>'0','limit'=>'1','dropdown'=>'1','dispfmenu'=>'1'))?>
  </nav>
</div>
