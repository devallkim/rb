<!-- Modal : 게시물 보기 -->
<div id="modal-bbs-view" class="modal zoom">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
  <header class="bar bar-nav bar-light bg-faded">
    <a class="icon icon-close pull-right" data-history="back" role="button"></a>
    <h1 class="title text-truncate text-nowrap w-75" style="left:12.5%">게시물 보기</h1>
  </header>
  <div class="content">
    <div class="content-padded" data-role="post">
      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
      <h3 data-role="title" class="rb-article-title">게시물 제목</h3>

      <div data-role="article">
        <!-- 본문 및 첨부내용-테마폴더 > _html > view.html -->
      </div>

    </div>


    <div class="commentting-container content-padded m-t-3" id="anchor-comments"></div>
  </div>
</div><!-- /.modal -->


<!-- Popup :  게시물 공유 -->
<div id="popup-bbs-view-share" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title"><i class="fa fa-share-alt fa-fw" aria-hidden="true"></i> 게시물 공유</h1>
    </header>
    <div class="content text-xs-center">
      <ul class="share list-inline m-b-0 m-t-2">
        <li class="list-inline-item">
          <a role="button" id="kakao-link-btn">
            <img src="<?php echo $g['img_core']?>/sns/kakaotalk.png" alt="카카오톡" class="img-circle">
            <p><small>카카오톡</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="facebook" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="img-circle">
            <p><small>페이스북</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="kakaostory" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/kakaostory.png" alt="카카오스토리" class="img-circle">
            <p><small>카카오스토리</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="naver" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/naver.png" alt="네이버" class="img-circle">
            <p><small>네이버</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" role="button" data-role="twitter" target="_blank">
            <img src="<?php echo $g['img_core']?>/sns/twitter.png" alt="트위터" class="img-circle">
            <p><small>트위터</small></p>
          </a>
        </li>
        <li class="list-inline-item">
          <a href="" data-role="email">
            <img src="<?php echo $g['img_core']?>/sns/mail.png" alt="메일" class="img-circle">
            <p><small>메일보내기</small></p>
          </a>
        </li>
      </ul>
      <p class="content-padded">
        <input class="form-control form-control-sm" type="text" data-role="share" readonly>
        <small>외부 공유시에 사용할 게시물의 URL 입니다.</small>
      </p>
    </div><!-- /.content -->
  </div><!-- /.popup-content -->
</div><!-- /.popup -->


<!-- 댓글 출력관련  -->
<link href="<?php echo $g['url_root']?>/modules/comment/themes/_mobile/rc-default/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>
