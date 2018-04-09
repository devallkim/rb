<!-- Modal : 게시물 보기 -->
<div id="modal-bbs-view" class="modal zoom">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-light bg-faded">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title text-truncate text-nowrap w-75" style="left:12.5%" data-role="title">게시물 보기</h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>

      <div data-role="article">
        본문내용
      </div>

      <!-- 유튜브 -->
      <div class="card-group mb-3 hidden" data-role="attach-youtube">
      </div>

      <!-- 비디오 -->
      <div class="mb-3 hidden" data-role="attach-video">
      </div>

      <!-- 오디오 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-audio">
      </ul>

      <!-- 이미지 -->
      <div class="card-group mb-3 hidden" data-role="attach-photo" data-extension="photoswipe">
      </div>

      <!-- 기타파일 -->
      <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-file">
      </ul>

    </div>


    <div class="commentting-container content-padded m-t-3" id="anchor-comments"></div>
  </div>
</div><!-- /.modal -->


<!-- 댓글 출력관련  -->
<link href="<?php echo $g['url_root']?>/modules/comment/themes/_mobile/rc-default/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>


<script>

doBbsList(); // 게시판 목록 JS 실행

</script>
