<?php
$g['url_widget_skin'] = $g['s'].'/modules/bbs/themes/'.$wdgvar['theme'];
$g['dir_widget_skin'] = $g['path_module'].'/bbs/themes/'.$wdgvar['theme'].'/';
?>
<link href="<?php echo $g['url_widget_skin'] ?>/_main.css" rel="stylesheet">
<script src="<?php echo $g['url_widget_skin'] ?>/_main.js"></script>

<section class="widget">
  <header>
    <h3><?php echo $wdgvar['title']?></h3>
    <?php if($wdgvar['link']):?>
    <a href="<?php echo $wdgvar['link']?>">
      더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <?php endif?>
  </header>
  <ul class="table-view bg-white" data-role="bbs-list">

    <?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
  	<?php while($_R=db_fetch_array($_RCD)):?>

    <li class="table-view-cell" id="item-<?php echo $_R['uid'] ?>">
      <a class="text-nowrap text-truncate"
        href="#modal-bbs-view" data-toggle="modal"
        data-theme="<?php echo $wdgvar['theme'] ?>"
        data-uid="<?php echo $_R['uid'] ?>"
        data-url="<?php echo getBbsPostLink($_R)?>"
        data-cat="<?php echo $_R['category'] ?>"
        data-title="<?php echo $wdgvar['title']?>"
        data-subject="<?php echo $_R['subject'] ?>">
        <?php echo $_R['subject'] ?> <?php if(getNew($_R['d_regis'],24)):?><small class="text-danger ml-1">N</small><?php endif?>
      </a>
      <span class="badge badge-default badge-inverted"><?php echo getDateFormat($_R['d_regis'],'m.d')?></span>
    </li>
    <?php endwhile?>
    <?php if(!db_num_rows($_RCD)):?><div class="none"></div><?php endif?>
  </ul>
</section><!-- /.widget -->
