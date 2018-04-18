<?php
include_once $g['path_module'].'bbs/var/var.php';
include_once $g['path_module'].'bbs/var/var.'.$wdgvar['bid'].'.php';
$B = getDbData($table['bbslist'],'id="'.$wdgvar['bid'].'"','uid');

$d['bbs']['skin'] = $d['bbs']['m_skin']?$d['bbs']['m_skin']:$d['bbs']['skin_mobile'];
$d['bbs']['c_mskin_modal'] = $d['bbs']['c_mskin_modal']?$d['bbs']['c_mskin_modal']:$d['bbs']['comment_mobile_modal'];

$g['url_module_skin'] = $g['s'].'/modules/bbs/themes/'.$d['bbs']['skin'];
$g['dir_module_skin'] = $g['path_module'].'bbs/themes/'.$d['bbs']['skin'].'/';
include_once $g['dir_module_skin'].'_widget.php';
?>

<section class="widget bg-white">
  <header class="d-flex justify-content-between align-items-center p-2">
    <strong><?php echo $wdgvar['title']?></strong>
    <?php if($wdgvar['link']):?>
    <a class="muted-link small" href="<?php echo $wdgvar['link']?>">
      더보기 <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <?php endif?>
  </header>
  <ul class="table-view mb-0" data-role="bbs-list">

    <?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$B['uid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
  	<?php while($_R=db_fetch_array($_RCD)):?>

    <li class="table-view-cell" id="item-<?php echo $_R['uid'] ?>">
      <a class="text-nowrap text-truncate"
        href="#modal-bbs-view" data-toggle="modal"
        data-bid="<?php echo $wdgvar['bid'] ?>"
        data-uid="<?php echo $_R['uid'] ?>"
        data-url="<?php echo getBbsPostLink($_R)?>"
        data-cat="<?php echo $_R['category'] ?>"
        data-title="<?php echo $wdgvar['title']?>"
        data-subject="<?php echo $_R['subject'] ?>">
        <?php if(getNew($_R['d_regis'],24)):?>
        <small class="rb-new mr-1" aria-hidden="true"></small>
        <?php endif?>
        <?php echo $_R['subject'] ?>
      </a>
      <span class="badge badge-default badge-outline rounded" data-role="total_comment">
        <?php echo $_R['comment']?><?php echo $_R['oneline']?'+'.$_R['oneline']:'' ?>
      </span>

    </li>
    <?php endwhile?>
    <?php if(!db_num_rows($_RCD)):?><div class="none"></div><?php endif?>
  </ul>
</section><!-- /.widget -->
