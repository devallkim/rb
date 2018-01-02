<section class="rb-module-post">

  <div class="pagehead">
    <div class="container d-flex justify-content-start align-items-center">
      <?php include $g['dir_module_skin'].'_myhead.php';?>
    </div><!-- /.container -->
  </div><!-- /.pagehead -->


  <div class="container clearfix">

    <form name="listForm" action="<?php echo $g['s']?>/" method="post">
      <input type="hidden" name="r" value="<?php echo $r?>">
      <input type="hidden" name="m" value="<?php echo $m?>">
      <input type="hidden" name="blog" value="<?php echo $B['uid']?>">
      <input type="hidden" name="front" value="<?php echo $front?>">
      <input type="hidden" name="a" value="my_act">
      <input type="hidden" name="act" value="">

      <p>승인을 기다리는 문서들 입니다.</p>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
              <a class="nav-link<?php echo $type=='request'?' active':''?>" href="<?php echo $g['blog_front'].'my_confirm&type=request'?>">대기 <span class="badge badge-light"><?php echo number_format($wait_num)?></span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php echo $type=='hold'?' active':''?>" href="<?php echo $g['blog_front'].'my_confirm&type=hold'?>">보류  <span class="badge badge-light"><?php echo number_format($hold_num)?></span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link<?php echo $type=='publish'?' active':''?>" href="<?php echo $g['blog_front'].'my_confirm&type=publish'?>">발행 <span class="badge badge-light"><?php echo number_format($publish_num)?></span></a>
          </li>
      </ul>
      <div class="tab-content">
          <?php include $g['dir_module_skin'].'my_body.php';?>
      </div>

      <div class="d-flex justify-content-end">
        <div class="mr-auto">
          <div class="btn-group" role="group">
            <?php if($type!='request'):?><button class="btn btn-light" type="button" onclick="actCheck('req_wait');">대기 처리</button><?php endif?>
            <?php if($type!='hold'):?><button class="btn btn-light" type="button"  onclick="actCheck('req_hold');">보류 처리</button><?php endif?>
            <?php if($type!='publish'):?><button class="btn btn-light" type="button"  onclick="actCheck('req_publish');">발행 처리</button><?php endif?>
          </div>
        </div>
        <nav class="">
          <ul class="pagination">
            <?php echo getPageLink(5,$p,$TPG,'','')?>
          </ul>
        </nav>


      </div>
    </form>

  </div><!-- /.container -->

</section>
<!-- 공통 스크립트 인클루드 -->
<?php include $g['dir_module_skin'].'my_common_script.php';?>
