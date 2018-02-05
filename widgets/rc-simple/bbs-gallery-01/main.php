<?php
$g['url_widget_skin'] = $g['s'].'/modules/bbs/themes/'.$wdgvar['theme'];
$g['dir_widget_skin'] = $g['path_module'].'/bbs/themes/'.$wdgvar['theme'].'/';
?>
<link href="<?php echo $g['url_widget_skin'] ?>/_main.css" rel="stylesheet">
<script src="<?php echo $g['url_widget_skin'] ?>/_main.js"></script>

<section class="widget mt-2">
  <header>
    <h3><?php echo $wdgvar['title']?></h3>
    <a href="<?php echo $wdgvar['link']?>">
      더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
  </header>

  <div class="px-2" data-role="bbs-list">

    <div class="card-deck">
      <?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
    	<?php $k=0;while($_R=db_fetch_array($_RCD)):$k++?>
    	<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
    	<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
    	<?php $_link=getBbsPostLink($_R)?>
      <div class="card" role="button" id="item-<?php echo $_R['uid'] ?>"
        data-target="#modal-bbs-view" data-toggle="modal"
        data-theme="<?php echo $wdgvar['theme'] ?>"
        data-uid="<?php echo $_R['uid'] ?>"
        data-url="<?php echo getBbsPostLink($_R)?>"
        data-cat="<?php echo $_R['category'] ?>"
        data-title="<?php echo $wdgvar['title']?>"
        data-subject="<?php echo $_R['subject'] ?>">
        <img class="card-img-top img-fluid" src="<?php echo getPreviewResize(getUpImageSrc($_R),'c') ?>" alt="">
        <div class="card-block">
          <p class="card-text"><span class="text-primary"><?php echo $_R['category']?></span> <?php echo $_R['subject']?></p>
        </div>
      </div>
      <?php if(!($k%2)):?></div><div class="card-deck"><?php endif?>
    <?php endwhile?>
    </div><!-- /.card-deck -->

  </div>
</section>
