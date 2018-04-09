<!-- 모달 : 로그인 -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-login">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center my-4">회원 로그인</h3>
        <form class="px-4" id="modal-loginform" action="<?php echo $g['s']?>/" method="post">
          <input type="hidden" name="r" value="<?php echo $r?>">
          <input type="hidden" name="a" value="login">
          <input type="hidden" name="form" value="">

          <div class="form-group">
            <label class="sr-only">아이디 또는 이메일</label>
            <input type="text" class="form-control form-control-lg" name="id" placeholder="아이디 또는 이메일" tabindex="1" autocorrect="off" autocapitalize="off" required>
            <div class="invalid-feedback mt-2" data-role="idErrorBlock"></div>
          </div>
          <div class="form-group">
            <label class="sr-only">패스워드</label>
            <input type="password" class="form-control form-control-lg" name="pw" tabindex="2" required placeholder="비밀번호를 입력하세요.">
            <div class="invalid-feedback mt-2" data-role="passwordErrorBlock"></div>
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


<!-- 포토모달 : Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp pswp-common" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
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

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

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
