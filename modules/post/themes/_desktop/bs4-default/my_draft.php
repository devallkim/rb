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
      <input type="hidden" name="a" value="">

      <p>외부에 발행되지 않은 포스트 입니다.</p>

      <!-- blog-body -->
      <?php include $g['dir_module_skin'].'my_body.php';?>
      <!-- / blog-body -->

      <div class="d-flex justify-content-end">
        <div class="mr-auto">
          <button type="button" class="btn btn-danger" onclick="actCheck('multi_delete');"><i class="fa fa-trash-o fa-fw"></i> 삭제하기</button>
        </div>
        <nav>
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
