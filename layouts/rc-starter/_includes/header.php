<header class="bar bar-nav bar-dark bg-inverse">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-left" role="button" href="./?mod=settings" title="개인정보수정"></a>
  <?php endif; ?>

  <?php if ($my['uid']): ?>
  <a class="icon fa fa-sign-out pull-right" role="button" href="<?php echo $g['s']?>/?r=<?php echo $r?>&a=logout" title="로그아웃"></a>
  <?php else: ?>
  <a class="icon icon-person pull-right" role="button" href="./?mod=login" title="로그인"></a>
  <?php endif; ?>
  <a class="title" href="<?php echo RW(0)?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
</header>
