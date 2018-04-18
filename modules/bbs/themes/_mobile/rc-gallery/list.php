<?php
if ($c) $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':''));
else $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':''));
?>


<section id="page-bbs-list" data-role="bbs-list" data-snap-ignore="true">

  <header class="bar bar-nav bar-dark bg-primary p-x-0">
    <a href="#drawer-left" data-toggle="drawer" class="icon icon-bars pull-left p-x-1" role="button"></a>

    <?php if ($my['uid']): ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="<?php echo $g['bbs_write']?>">
      <span class="icon icon-compose"></span>
    </a>
    <?php else: ?>
    <a class="btn btn-link btn-nav pull-right p-x-1" href="#modal-login" data-toggle="modal" data-title="<?php echo stripslashes($d['layout']['header_title'])?>">
      <span class="icon icon-compose"></span>
    </a>
    <?php endif; ?>

    <h1 class="title" data-location="reload">
      <?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?>
    </h1>
  </header>

  <div class="bar bar-standard bar-header-secondary bg-white px-0">
    <nav class="nav nav-inline">
      <a class="nav-link<?php echo !$type?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>" >
        전체글
        <span class="badge badge-primary badge-outline"><?php echo $NUM ?></span>
      </a>

      <?php if ($NUM_NOTICE): ?>
      <a class="nav-link<?php echo $type=="notice"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=notice" >
        공지
      </a>
      <?php endif; ?>

      <?php if ($B['category']): ?>
      <a class="nav-link<?php echo $type=="category"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=category" >분류</a>
      <?php endif; ?>

      <?php if($d['theme']['search']):?>
      <a class="nav-link<?php echo $type=="search"?' active':'' ?>" href="<?php echo $g['bbs_reset'] ?>&type=search" >검색</a>
      <?php endif; ?>
    </nav>
  </div>

  <?php if ($TPG > 1 && !$type): ?>
  <footer class="bar bar-standard bar-footer bar-light bg-white p-x-0">
    <div class="">
      <?php echo getPageLink_RC($d['theme']['pagenum'],$p,$TPG,'1')?>
    </div>
  </footer>
  <?php endif; ?>


  <div class="content">


      <?php if ($NUM): ?>
        <div class="row gutter-half">
        <!-- 일반글 출력부 -->
        <?php foreach($RCD as $R):?>
        <?php
        $R['mobile']=isMobileConnect($R['agent']);
        $d['upload'] = getArrayString($R['upload']);
        ?>
        <div class="<?php echo $col_xl.$col_lg.$col_md.$col_sm.$col_xs ?>">
          <div class="card" id="item-<?php echo $R['uid']?>">

            <div class="position-relative"
              data-toggle="openGallery"
              data-category="<?php echo $R['category']?>"
              data-subject="<?php echo $R['subject']?>"
              data-likes="<?php echo $R['likes']?>"
              data-comment="<?php echo $R['comment']; echo $R['oneline']?'+'.$R['oneline']:'' ?>"
              data-theme="<?php echo $d['bbs']['skin'] ?>"
              data-cat="<?php echo $R['category']?>"
              data-url="<?php echo $g['bbs_view'].$R['uid']?>"
              data-bid="<?php echo $B['id']?>"
              data-uid="<?php echo $R['uid'] ?>" role="button">

              <img src="<?php echo getPreviewResize(getUpImageSrc($R),'z') ?>" alt="" class="img-fluid">
            </div><!-- /.position-relative -->

            <div class="card-block text-center">

              <a class="muted-link" href="<?php echo $g['bbs_view'].$R['uid']?>">
                <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
              </a>

            </div>

          </div><!-- /.card -->
        </div>
        <?php endforeach?>
      </div>

      <?php else: ?>
      <div class="d-flex align-items-center justify-content-center text-muted" style="height: 350px">
        <div class="text-xs-center">
          <div class="display-1">
            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
          </div>
          <p>게시물이 없습니다.</p>
          <?php if ($keyword): ?><a href="<?php echo $g['bbs_reset'] ?>&type=search" class="btn btn-outline-primary btn-lg" >재검색</a><?php endif; ?>
          <?php if ($cat): ?><a href="<?php echo $g['bbs_reset'] ?>&type=category" class="btn btn-outline-primary btn-lg" >재탐색</a><?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

    </div>
    <!-- /.content -->



</section>



<script type="text/javascript">

$(function () {



})
</script>
