<header class="bar bar-nav bar-dark bg-inverse">
	<a class="icon icon-home pull-left" role="button" href="<?php  echo RW(0) ?>"></a>
	<h1 class="title">로그인</h1>
</header>

<main class="content">
	<form name="loginform" id="loginform" action="<?php echo $g['s']?>/" method="post" novalidate>
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="a" value="login">
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
		<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>">

		<div class="form-list stacked">
			<div class="input-row">
				<label>아이디</label>
				<input type="text" name="id" id="id" class="form-control" placeholder="" tabindex="1" autocorrect="off" autocapitalize="off" autofocus="autofocus" required placeholder="아이디를 입력하세요.">
			</div>
			<div class="input-row">
				<label>패스워드</label>
				<input type="password" name="pw" id="password" class="form-control" placeholder="" tabindex="2" required placeholder="패스워드를 입력하세요.">
			</div>
			<div class="content-padded">

				<div class="p-y-1">
					<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" name="login_cookie" value="checked" checked>
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">로그인 상태 유지</span>
					</label>
				</div>


				<button type="submit" id="rb-submit" class="btn btn-primary btn-lg btn-block">로그인</button>
				<a class="btn btn-outline-primary btn-block" href="./?mod=join" role="button">회원가입</a>
			</div>
		</div>
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
