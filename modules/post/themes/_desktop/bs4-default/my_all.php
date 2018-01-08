<section class="rb-module-post">

  <div class="pagehead">
    <div class="container d-flex justify-content-start align-items-center">
      <?php include $g['dir_module_skin'].'_myhead.php';?>
    </div><!-- /.container -->
  </div><!-- /.pagehead -->

  <div class="container">

     <form name="listForm" action="<?php echo $g['s']?>/" method="post">
      <input type="hidden" name="r" value="<?php echo $r?>">
      <input type="hidden" name="m" value="<?php echo $m?>">
      <input type="hidden" name="blog" value="<?php echo $B['uid']?>">
      <input type="hidden" name="front" value="<?php echo $front?>">
      <input type="hidden" name="a" value="my_act">
      <input type="hidden" name="act" value="">

      <p>회원님이 작성하신 전체 문서 입니다.</p>
      <!-- blog-body -->
      <?php include $g['dir_module_skin'].'my_body.php';?>
      <!-- / blog-body -->
      <div class="d-flex justify-content-end">
        <div class="mr-auto">
          <div class="btn-group" role="group">
            <button class="btn btn-light" type="button" onclick="actCheck('req_draft');">임시보관</button>
            <button class="btn btn-light" type="button" onclick="actCheck('req_wait');">발행요청</button>
          </div>
          <button class="btn btn-danger" type="button" onclick="actCheck('multi_delete');"><i class="fa fa-trash-o fa-fw"></i> 삭제</button>
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
