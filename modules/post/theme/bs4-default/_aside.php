<?php if($my['admin'] || $d['blog']['writeperm']):?>
  <a class="btn btn-primary btn-block mb-3" href="<?php echo $g['blog_front']?>write">
    새 포스트 쓰기
  </a>
<?php endif?>

<?php if($ISCAT):?>
<div class="card">
    <div class="card-header">
        카테고리
    </div>
    <div class="card-body p-2">
        <link href="<?php echo $g['s']?>/_core/css/tree.css" rel="stylesheet">
        <?php $_treeOptions=array('table'=>$table[$m.'category'],'blog'=>$B['uid'],'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>false,'allOpen'=>false,'bookmark'=>'')?>
        <?php $_treeOptions['link'] = $g['blog_home'].'&amp;cat='?>
        <?php echo getTreeCategory($_treeOptions,$code,0,0,'')?>
    </div>
    <div class="card-footer p-2">
        <a href="<?php echo $g['blog_home'] ?>">전체 포스트</a>
    </div>
</div>
<?php endif?>



<?php if($my['admin'] || $d['blog']['writeperm']):?>
<div class="list-group mt-4">
  <a href="<?php echo $g['blog_front']?>my_confirm" class="list-group-item list-group-item-action<?php if ($front=='my_confirm'): ?> active<?php endif; ?>">
    <i class="fa fa-folder-o fa-fw"></i> 승인함
  </a>
  <a href="<?php echo $g['blog_front']?>my_all" class="list-group-item list-group-item-action<?php if ($front=='my_all'): ?> active<?php endif; ?>">
    <i class="fa fa-folder-o fa-fw"></i> 전체 보관함
  </a>
  <a href="<?php echo $g['blog_front']?>my_draft" class="list-group-item list-group-item-action<?php if ($front=='my_draft"'): ?> active<?php endif; ?>">
    <i class="fa fa-folder-o fa-fw"></i> 임시 보관함
  </a>
</div>
<?php endif?>
