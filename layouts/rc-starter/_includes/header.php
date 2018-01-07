<header class="bar bar-nav bar-dark bg-inverse">
  <?php if ($my['uid']): ?>
  <a class="icon icon icon-gear pull-left" role="button" href="./?mod=settings"></a>
  <?php endif; ?>
  <a class="icon icon-person pull-right" role="button" href="<?php echo $my['uid']?'./?mod=profile':'./?mod=login' ?>"></a>
  <h1 class="title">Title</h1>
</header>
