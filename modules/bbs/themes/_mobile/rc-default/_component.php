<!-- Modal : 게시물 보기 -->
<div id="modal-bbs-view" class="modal zoom">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-light bg-faded px-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
    <h1 class="title text-truncate text-nowrap w-75" style="left:12.5%" data-role="title">게시물 보기</h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>

      <div data-role="article">
        본문내용
      </div>

      <div data-role="attach">

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
    </div>


    <div class="commentting-container content-padded m-t-3" id="anchor-comments"></div>
  </div>
</div><!-- /.modal -->


<!-- 댓글 출력관련  -->
<link href="<?php echo $g['url_root']?>/modules/comment/themes/_mobile/rc-default/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>


<script>

// 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

// 페이지 푸시(page push)는 게시판 목록의 필터링,페이징에 적용 되었습니다. 페이지 푸시 후에는 페이지의 JS를 바인딩 처리해야 줘야 합니다.
// 참고 : https://kimsq.com/docs/rc/controls/push
window.addEventListener('push', doBbsList); // 페이지 푸시와 게시판 목록 JS 바인딩 처리
doBbsList(); // 게시판 목록 JS 실행

</script>
