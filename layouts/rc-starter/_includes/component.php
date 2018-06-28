<!--
컴포넌트 모음

1. 일반모달 : 회원가입
2. 일반모달 : 로그인
3. 팝업   : 로그아웃
4. 일반모달 : 통합검색
5. 일반모달 : 게시물 보기
6. 포토모달 : 갤러리형
7. 팝업 : 링크공유

-->

<!-- 1. 일반모달 : 회원가입 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/join/component.php'; ?>

<!-- 2. 일반모달 : 로그인 -->
<?php include_once $g['path_module'].'member/themes/'.$d['member']['theme_mobile'].'/login/component.php';  ?>

<!-- 3. 팝업 : 로그아웃-->
<div id="popup-logout" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <h1 class="title">로그아웃 전에 확인해주세요.</h1>
    </header>
    <nav class="bar bar-standard bar-footer">
      <div class="row">
        <div class="col-xs-6">
          <button type="button" class="btn btn-secondary btn-block" data-history="back">취소</button>
        </div>
        <div class="col-xs-6 p-l-0">
          <a href="<?php echo $g['s']?>/logout" type="button" class="btn btn-primary btn-block">로그이웃</a>
        </div>
      </div>
    </nav>
    <div class="content">
      <div class="p-a-3 text-xs-center">
				정말로 로그아웃 하시겠습니까?
			</div>
    </div>
  </div>
</div>

<!-- 4. 일반모달 : 통합검색 -->
<div id="modal-search" class="modal zoom">
	<header class="bar bar-nav bg-white p-2">
	  <form class="input-group input-group-lg border border-primary" action="<?php echo $g['s']?>/" id="modal-search-form">
			<input type="hidden" name="r" value="<?php echo $r?>">
	    <input type="hidden" name="m" value="search">
	    <input type="search" name="keyword" class="form-control bg-white" placeholder="검색어 입력" id="search-input" required autocomplete="off">
			<span class="input-group-btn hidden" data-role="keyword-reset" >
	      <button class="btn btn-link pr-2" type="button" data-act="keyword-reset" tabindex="-1">
	        <i class="fa fa-times-circle" aria-hidden="true"></i>
	      </button>
	    </span>
			<span class="input-group-btn">
			  <button class="btn btn-link text-primary" type="submit" id="modal-search-submit">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
	  </form>
	</header>
	<nav class="bar bar-tab bar-light bg-faded bg-white">
	  <a class="tab-item" role="button" data-history="back">
	    취소
	  </a>
	</nav>

	<main class="content bg-faded">
		<div class="content-padded">

		</div>
	</main>
</div><!-- /.modal -->

<!-- 5. 일반모달 : 게시물 보기 -->
<div id="modal-bbs-view" class="modal zoom">

	<section id="page-bbs-view" class="rb-bbs-list page center" data-role="bbs-list">
		<input type="hidden" name="bid" value="">
	  <input type="hidden" name="uid" value="">
	  <header class="bar bar-nav bar-light bg-faded px-0">
			<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
	    <h1 class="title text-truncate text-nowrap w-75" style="left:12.5%" data-role="title">게시물 보기</h1>
	  </header>
	  <div class="content">
	    <div class="content-padded" data-role="post">
	      <span data-role="cat" class="badge badge-primary badge-inverted">카테고리</span>
	      <h3 data-role="subject" class="rb-article-title">게시물 제목</h3>
			</div>

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
        <div class="card-group mb-3 hidden" data-role="attach-photo" data-plugin="photoswipe">
        </div>

        <!-- 기타파일 -->
        <ul class="table-view table-view-full bg-white mb-3 hidden" data-role="attach-file">
        </ul>
      </div>

	    <div class="commentting-container content-padded m-t-3" id="anchor-comments"></div>
	  </div>
	</section>

	<!-- 전체댓글보기 -->
	<section id="page-bbs-allcomments" class="page right">
		  <div class="commentting-all"></div>
	</section>


</div><!-- /.modal -->

<!-- 6. 포토모달 : 갤러리형 -->
<div class="pswp pswp-gallery" tabindex="-1" role="dialog" aria-hidden="true">
	<input type="hidden" name="uid" value="">
  <input type="hidden" name="bid" value="">

  <!-- Background of PhotoSwipe.
       It's a separate element, as animating opacity is faster than rgba(). -->
  <div class="pswp__bg"></div>

  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap page center" id="page1">

		<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
		<div class="pswp__container">
				<!-- don't modify these 3 pswp__item elements, data is added later on -->
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

						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

						<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
						<!-- element will get class pswp__preloader--active when preloader is running -->
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

	<div class="pswp__reaction" hidden>
		<button type="button" class="pswp__button" data-toggle="page" data-start="#page1" data-target="#page2">
			<i class="fa fa-comment-o fa-lg" aria-hidden="true"></i>
			<br> <span data-role="comment"></span>
		</button>
		<button type="button" class="pswp__button">
			<i class="fa fa fa-thumbs-o-up fa-lg" aria-hidden="true"></i>
			<br><span data-role="likes"></span>
		</button>
	</div>

</div>

<!-- 7. 팝업 : 링크공유 -->
<div id="popup-link-share" class="popup zoom">
  <div class="popup-content">
    <header class="bar bar-nav">
      <a class="icon icon-close pull-right" data-history="back" role="button"></a>
      <h1 class="title">
				<i class="fa fa-share-alt fa-fw" aria-hidden="true"></i>
				<span data-role="title">링크 공유</span>
			</h1>
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
