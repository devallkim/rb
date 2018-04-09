<!-- Modal 로그인 -->
<div id="modal-login" class="modal zoom">
	<header class="bar bar-nav bar-light bg-faded p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">로그인</h1>
	</header>

	<main class="content">
		<form id="modal-loginform" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="a" value="login">
			<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['REQUEST_URI']?>">
			<input type="hidden" name="form" value="">

			<div class="card">
	      <div class="form-list">
					<span class="position-relative">
						<input type="text" placeholder="아이디" name="id" required autocapitalize="off" autocorrect="off">
						<div class="invalid-tooltip" data-role="idErrorBlock"></div>
					</span>
					<span class="position-relative">
						<input type="password" placeholder="패스워드" name="pw" required autocapitalize="off" autocorrect="off">
						<div class="invalid-tooltip" data-role="passwordErrorBlock"></div>
					</span>
	      </div>
	    </div>

			<div class="content-padded">
				<div class="p-y-1">
					<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" name="login_cookie" value="checked" checked>
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">로그인 상태 유지</span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block" data-role="submit">
					<span class="not-loading">로그인</span>
	        <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
				</button>
				<a class="btn btn-outline-primary btn-block" href="<?php echo RW('mod=join') ?>" role="button">회원가입</a>
			</div>
		</form>
		<p class="m-t-2 content-padded"><a href="<?php echo $g['s']?>/?m=member&front=login&page=password_reset" class="muted-link">비밀번호를 잊으셨나요?</a></p>
	</main>
</div><!-- /.modal -->

<!-- Modal 통합검색 -->
<div id="modal-search" class="modal zoom">
	<header class="bar bar-nav bg-white px-0">
	  <form class="input-group input-group-inset" action="/" id="drawer-right-search">
	    <input type="hidden" name="m" value="search">
	    <span class="input-group-placeholder icon icon-search fa-2x"></span>
	    <input type="search" name="keyword" class="form-control" placeholder="통합검색" id="search-input" required autocomplete="off">
	    <span class="input-group-btn hidden" data-role="keyword-reset" >
	      <button class="btn btn-link pl-2 pr-3" type="button" data-act="keyword-reset" tabindex="-1">
	        <i class="fa fa-times-circle fa-lg" aria-hidden="true"></i>
	      </button>
	    </span>
	    <span class="input-group-btn">
	      <button class="btn btn-link pl-1 pr-3" type="button" data-history="back">취소</button>
	    </span>
	  </form>
	</header>
	<div class="bar bar-standard bar-footer bar-light bg-faded hidden" id="drawer-search-footer">
	  <button class="btn btn-secondary btn-block" id="drawer-search-submit">검색</button>
	</div>

	<main class="content">
		<div class="content-padded">

		</div>
	</main>
</div><!-- /.modal -->

<!-- Modal 사이트맵 -->
<div id="modal-sitemap" class="modal zoom">
	<header class="bar bar-nav bar-light bg-faded p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">사이드맵</h1>
	</header>

	<main class="content">
		<div class="content-padded">
			<?php getWidget('rc-simple/sitemap',array())?>
		</div>
	</main>
</div><!-- /.modal -->

<!-- Popup :  링크 공유 -->
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
