<script>
  // 브라우저 타이틀 지정
  document.title = '<?php if ($front=='my_confirm'): ?>승인함<?php elseif($front=='my_all'): ?>전체보관함<?php else: ?>임시보관함<?php endif; ?> | <?php echo $_HS['name'] ?>';
</script>


<h1>
  <a class="blog-title" href="<?php echo $g['blog_home'] ?>">
    <?php echo $B['name']?>
  </a>
  <span class="path-divider text-gray-light">	&gt;</span>

  <div class="dropdown d-inline-block">
    <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php if ($front=='my_confirm'): ?>
        <i class="fa fa-code-fork"></i> 승인함
      <?php elseif($front=='my_all'): ?>
        <i class="fa fa-folder-o"></i> 전체 보관함
      <?php else: ?>
        <i class="fa fa-folder-o"></i> 임시 보관함
      <?php endif; ?>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item<?php if ($front=='my_confirm'): ?> active<?php endif; ?>" href="<?php echo $g['blog_front']?>my_confirm">승인함</a>
      <a class="dropdown-item<?php if ($front=='my_all'): ?> active<?php endif; ?>" href="<?php echo $g['blog_front']?>my_all">전체보관함</a>
      <a class="dropdown-item<?php if ($front=='my_draft'): ?> active<?php endif; ?>" href="<?php echo $g['blog_front']?>my_draft">임시보관함</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo $g['blog_front']?>write">새 포스트 작성</a>
    </div>
  </div>
</h1>
