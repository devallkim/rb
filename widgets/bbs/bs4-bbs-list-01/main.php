<?php
$B = getDbData($table['bbslist'],'id="'.$wdgvar['bid'].'"','uid');

if ($wdgvar['view']=='modal') {
  include_once $g['path_module'].'bbs/var/var.php';
  include_once $g['path_module'].'bbs/var/var.'.$wdgvar['bid'].'.php';
  $d['bbs']['skin'] = $d['bbs']['skin']?$d['bbs']['skin']:$d['bbs']['skin_main'];
  $g['url_module_skin'] = $g['s'].'/modules/bbs/themes/'.$d['bbs']['skin'];
  $g['dir_module_skin'] = $g['path_module'].'bbs/themes/'.$d['bbs']['skin'].'/';
  include_once $g['dir_module_skin'].'_widget.php';
}
?>

<section class="card widget">
  <header class="card-header d-flex justify-content-between align-items-center py-2">
    <strong><?php echo $wdgvar['title']?></strong>
    <?php if($wdgvar['link']):?>
    <a href="<?php echo $wdgvar['link']?>" class="muted-link small">
      더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <?php endif?>
  </header>
  <ul class="list-group list-group-flush" data-role="bbs-list">

    <?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$B['uid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
  	<?php while($_R=db_fetch_array($_RCD)):?>

    <li class="list-group-item d-flex justify-content-between align-items-center" id="item-<?php echo $_R['uid'] ?>">

      <?php if ($wdgvar['view']=='modal'): ?>
      <a class="text-nowrap text-truncate muted-link"
        href="#modal-bbs-view" data-toggle="modal"
        data-bid="<?php echo $wdgvar['bid'] ?>"
        data-uid="<?php echo $_R['uid'] ?>"
        data-url="<?php echo getBbsPostLink($_R)?>"
        data-cat="<?php echo $_R['category'] ?>"
        data-title="<?php echo $wdgvar['title']?>"
        data-subject="<?php echo $_R['subject']?>">
      <?php else: ?>
      <a class="text-nowrap text-truncate muted-link" href="<?php echo getBbsPostLink($_R)?>">
      <?php endif; ?>
        <?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'..')?>
      </a>
      <?php if(getNew($_R['d_regis'],24)):?><span class="rb-new ml-1"></span><?php endif?>

    </li>
    <?php endwhile?>
    <?php if(!db_num_rows($_RCD)):?><div class="none"></div><?php endif?>
  </ul>
</section><!-- /.widget -->
