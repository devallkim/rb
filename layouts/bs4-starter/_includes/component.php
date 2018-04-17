<!--
컴포넌트 모음

1. 일반모달 : 로그인
2. 일반모달 : 게시물 보기
3. 포토모달 : 댓글형
4. 포토모달 : 갤러리형
5. 마크업 : 링크공유

-->


<!-- 1. 일반모달 : 로그인 -->
<div class="modal fade" id="modal-login" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center my-4">회원 로그인</h3>
        <form class="px-4" id="modal-loginform" action="<?php echo $g['s']?>/" method="post">
          <input type="hidden" name="r" value="<?php echo $r?>">
          <input type="hidden" name="a" value="login">
          <input type="hidden" name="form" value="">

          <div class="form-group position-relative">
            <label class="sr-only">아이디 또는 이메일</label>
            <input type="text" class="form-control form-control-lg" name="id" placeholder="아이디 또는 이메일" tabindex="1" autocorrect="off" autocapitalize="off" required>
            <div class="invalid-tooltip" data-role="idErrorBlock"></div>
          </div>
          <div class="form-group position-relative">
            <label class="sr-only">패스워드</label>
            <input type="password" class="form-control form-control-lg" name="pw" tabindex="2" required placeholder="비밀번호를 입력하세요.">
            <div class="invalid-tooltip" data-role="passwordErrorBlock"></div>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="custom-control custom-checkbox" data-toggle="collapse" data-target="#modal-collapsealert">
              <input type="checkbox" class="custom-control-input" id="modal-login-cookie" name="login_cookie" value="checked">
              <label class="custom-control-label" for="modal-login-cookie">로그인 상태 유지</label>
            </div>
            <a class="small muted-link" href="<?php echo RW('mod=password_reset')?>">비밀번호를 잊으셨나요?</a>
          </div>

          <div class="collapse" id="modal-collapsealert">
            <div class="alert alert-light border f12 mt-3">
              개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
            </div>
          </div>

          <div class="my-3">
            <button type="submit" class="btn btn-primary btn-lg btn-block" data-role="submit" tabindex="3">
              <span class="not-loading">로그인</span>
              <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-link muted-link" data-dismiss="modal">닫기</button>
        <a href="<?php echo RW('mod=join') ?>" tabindex="6" class="btn btn-link muted-link">회원계정이 없으신가요 ?</a>
      </div>
    </div>
  </div>
</div>

<!-- 2. 일반모달 : 게시물 보기-->
<div class="modal fade" id="modal-bbs-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <input type="hidden" name="bid" value="">
  <input type="hidden" name="uid" value="">
  <input type="hidden" name="theme" value="">
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

            <div class="commentting-container"></div>

          </aside>
        </div><!-- /.row -->

      </div><!-- /.modal-body -->

    </div>
  </div>
</div>

<!-- 3. 포토모달 : 댓글형 -->
<div class="pswp pswp-comment" tabindex="-1" role="dialog" aria-hidden="true">
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

<!-- 4. 포토모달 : 갤러리형 -->
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

<!-- 5. 마크업 : 링크공유 -->
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
