<header class="bar bar-nav bar-dark bg-primary px-0">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-left p-x-1" role="button" href="<?php echo RW('mod=settings') ?>" title="개인정보수정"></a>
  <?php endif; ?>

  <?php if ($my['uid']): ?>
  <?php else: ?>
  <a class="icon icon-person pull-right p-x-1" role="button" data-toggle="modal" href="#modal-login" data-title="<?php echo stripslashes($d['layout']['header_title'])?>"></a>
  <?php endif; ?>
  <a class="title" href="<?php echo RW(0)?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
</header>

<div class="bar bar-standard bar-header-secondary bar-light bg-faded p-x-0">
  <nav class="nav nav-inline">
    <a class="nav-link<?php if ($_HP['uid']==$_HS['m_startpage']): ?> active<?php endif; ?>" href="<?php echo RW(0)?>">홈</a>
    <?php include $g['dir_layout'].'/_includes/nav-menu.php' ?>
  </nav>
</div>
