<!--
컴포넌트 모음

1. 일반모달 : 로그인
2. 일반모달 : 로그인(기존계정에 연결하기)
4. 일반모달 : 게시물 보기
5. 포토모달 : 댓글형
6. 포토모달 : 갤러리형
7. 마크업 참조: 링크공유

-->

<!-- 1. 일반모달 : 회원가입 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_main'].'/join/component.php'; ?>

<!-- 1. 일반모달 : 로그인 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_main'].'/login/component.php';  ?>

<!-- 4. 일반모달 : 게시물 보기-->
<div class="modal fade" id="modal-bbs-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1000px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" data-role="title">게시물 보기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">

        <div class="row no-gutters">
          <main class="col-8">
            <div data-role="article"></div>
          </main>
          <aside class="col-4 border-left">
            <div class="commentting-container" data-role="comment-area"></div>
            <div data-role="comment-alert" class="d-none">
              <div class="d-flex align-items-center justify-content-center text-muted" style="height: calc(100vh - 9.5rem);">
                댓글이 지원되지 않습니다.
              </div>
            </div>
          </aside>
        </div><!-- /.row -->

      </div><!-- /.modal-body -->

    </div>
  </div>
</div>

<!-- 5. 포토모달 : 댓글형 -->
<div class="pswp pswp-comment" tabindex="-1" role="dialog" aria-hidden="true">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="bid" value="">
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
    <div class="commentting-container mt-4" data-role="comment-area"></div>
    <div data-role="comment-alert" class="d-none">
      <div class="d-flex align-items-center justify-content-center text-muted" style="height: calc(100vh - 27.5rem);">
        댓글이 지원되지 않습니다.
      </div>
    </div>
  </div>

  <button class="pswp__button pswp__button--close" data-toggle="tooltip" title="닫기(Esc)"></button>

</div>

<!-- 6. 포토모달 : 갤러리형 -->
<div class="pswp pswp-gallery" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="닫기 (Esc)"></button>

                <button class="pswp__button pswp__button--fs" title="전체화면 보기"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
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

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

          </div>

        </div>

</div>

<!-- 7. 마크업 참조 : 링크공유 -->
<div id="rb-share" hidden>
  <ul class="share list-inline mt-2 mb-0 mx-2">
    <li class="list-inline-item text-center">
      <a href="" role="button" data-role="facebook" target="_blank" class="muted-link">
        <img src="<?php echo $g['img_core']?>/sns/facebook.png" alt="페이스북공유" class="rounded-circle" style="width: 50px">
        <p><small>페이스북1</small></p>
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
  <div class="input-group input-group-sm mb-2" hidden>
    <input type="text" class="form-control" value="" readonly data-role="share" id="share-input">
    <div class="input-group-append">
      <button class="btn btn-light" type="button"
        data-plugin="clipboard"
        data-clipboard-target="#share-input"
        data-toggle="tooltip" title="클립보드 복사">
        <i class="fa fa-clipboard"></i>
      </button>
    </div>
  </div>
</div>
