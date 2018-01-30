<!-- 모달 -->

<!-- 로그인 -->
<div id="modal-login" class="modal" >
	<header class="bar bar-nav bar-light bg-faded p-x-0">
		<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
		<h1 class="title" data-role="title">로그인</h1>
	</header>

	<main class="content">
		<form id="modal-login-form" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="a" value="login">
			<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['REQUEST_URI']?>">

			<div class="card">
	      <div class="form-list">
	        <input type="text" placeholder="아이디" name="id" required autocapitalize="off" autocorrect="off">
					<div class="invalid-feedback">
						아이디를 입력해 주세요.
					</div>
	        <input type="password" placeholder="패스워드" name="pw" required autocapitalize="off" autocorrect="off">
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
				<button type="submit" class="btn btn-primary btn-lg btn-block js-submit">
					<span class="not-loading">로그인</span>
	        <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
				</button>
				<a class="btn btn-outline-primary btn-block" href="<?php echo RW('mod=join') ?>" role="button">회원가입</a>
			</div>
		</form>
		<p class="m-t-2 content-padded"><a href="<?php echo $g['s']?>/?m=member&front=login&page=password_reset" class="muted-link">비밀번호를 잊으셨나요?</a></p>
	</main>
</div><!-- /.modal -->
