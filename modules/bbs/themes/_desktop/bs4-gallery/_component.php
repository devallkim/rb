<!-- 사진전용모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','default-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','photoswipe.min','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>


<!-- 댓글이 포함된 포토모달 -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="theme" value="">
  <div class="pswp__bg"></div>

  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap">

    <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>

    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
    <div class="pswp__ui pswp__ui--hidden">

      <div class="pswp__top-bar">

        <!--  Controls are self-explanatory. Order can be changed. -->
        <div class="pswp__subject">
          <span data-role="category" class="text-primary"></span>
          <span data-role="subject"></span>
        </div>
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--fs" data-toggle="tooltip" title="전체 화면으로 보기"></button>

        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
        <!-- element will get class pswp__preloader-active when preloader is running -->
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>

      <button class="pswp__button pswp__button--arrow--left" title="이전">
            </button>

      <button class="pswp__button pswp__button--arrow--right" title="다음">
            </button>

      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>

    </div>

  </div>

  <div class="rb__area bg-light">
    <div data-role="article"></div>
    <div class="commentting-container mt-4"></div>
  </div>

  <button class="pswp__button pswp__button--close" data-toggle="tooltip" title="닫기(Esc)"></button>

</div>



<!-- 링크공유 -->
<div id="rb-share" hidden>
  <ul class="share list-inline mt-2 mb-0 mx-2">
    <li class="list-inline-item text-center">
      <a href="" role="button" data-role="facebook" target="_blank" class="muted-link">
        <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="rounded-circle" style="width: 50px">
        <p><small>페이스북</small></p>
      </a>
    </li>
    <li class="list-inline-item text-center">
      <a href="" role="button" data-role="kakaostory" target="_blank" class="muted-link">
        <img src="<?php echo $g['img_core']?>/sns/kakaostory.png" alt="카카오스토리" class="rounded-circle" style="width: 50px">
        <p><small>카카오스토리</small></p>
      </a>
    </li>
    <li class="list-inline-item text-center">
      <a href="" role="button" data-role="naver" target="_blank" class="muted-link">
        <img src="<?php echo $g['img_core']?>/sns/naver.png" alt="네이버" class="rounded-circle" style="width: 50px">
        <p><small>네이버</small></p>
      </a>
    </li>
    <li class="list-inline-item text-center">
      <a href="" role="button" data-role="twitter" target="_blank" class="muted-link">
        <img src="<?php echo $g['img_core']?>/sns/twitter.png" alt="트위터" class="rounded-circle" style="width: 50px">
        <p><small>트위터</small></p>
      </a>
    </li>
  </ul>
  <div class="input-group input-group-sm mb-2">
    <input type="text" class="form-control" value="" readonly data-role="share">
    <div class="input-group-append">
      <button class="btn btn-light" type="button"
        data-plugin="clipboard"
        data-toggle="tooltip" title="클립보드 복사">
        <i class="fa fa-clipboard"></i>
      </button>
    </div>
  </div>
</div>


<!-- 소셜공유시 URL 클립보드저장 : clipboard.js  : https://github.com/zenorocha/clipboard.js-->
<?php getImport('clipboard','clipboard.min','1.5.5','js') ?>

<!-- 댓글 출력관련  -->
<link href="<?php echo $g['url_root']?>/modules/comment/themes/_desktop/bs4-modal/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>

<script src="<?php echo $g['s']?>/_core/js/jquery.autolink.js"></script>
<?php getImport('autosize','autosize.min','3.0.14','js')?>

<script>

// 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
putCookieAlert('bbs_action_result') // 실행결과 알림 메시지 출력

</script>
