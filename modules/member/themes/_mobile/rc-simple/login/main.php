<header class="bar bar-nav bar-light bg-faded">
	<a class="icon icon-home pull-left" role="button" href="<?php  echo RW(0) ?>"></a>
	<h1 class="title">로그인</h1>
</header>

<main class="content">
	<form name="loginform" id="loginform" action="<?php echo $g['s']?>/" method="post" novalidate>
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="a" value="login">
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">

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
			<a class="btn btn-outline-primary btn-block" href="./?mod=join" role="button">회원가입</a>
		</div>
		<p class="m-t-2 content-padded"><a href="./?m=member&front=login&page=password_reset" class="muted-link">비밀번호를 잊으셨나요?</a></p>
	</form>
</main>

<script type="text/javascript">

(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('loginform');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
				$('.form-control').removeClass('is-invalid'); // 폼유용성 검사상태 초기화
				$("#idErrorBlock").html("아이디 및 이메일을 입력하세요.")
				$("#passwordErrorBlock").html("비밀번호를 입력하세요.")
				event.preventDefault();
        event.stopPropagation();
      } else {
				$('.form-control').removeClass('is-invalid'); // 폼유용성 검사상태 초기화
				$('#rb-submit').attr("disabled",true);
				setTimeout("_loginCheck();",500);
				event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);

})();


function _loginCheck()
{
	var f = document.loginform;
	getIframeForAction(f);
	f.submit();
}

</script>
