<div class="container">

	<form class="form-signin" name="loginform" id="loginform" action="<?php echo $g['s']?>/" method="post" novalidate>
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="a" value="login">
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
		<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>">

		<a href="/" title="홈" class="logo pt-5 pb-2"><i class="kf kf-bi-06"></i></a>

    <h2 class="form-signin-heading text-center">회원 로그인</h2>

		<div class="card">
			<div class="card-body">
				<fieldset>
					<div class="form-group">
						<label for="">아이디 또는 이메일</label>
						<input type="text" name="id" id="id" class="form-control" placeholder="" tabindex="1" autocorrect="off" autocapitalize="off" autofocus="autofocus" required>
						<div class="invalid-feedback" id="idErrorBlock"></div>
					</div>

					<div class="form-group">
						<label for="">
							패스워드
							<a href="/password_reset" class="label-link" id="password_reset">비밀번호를 잊으셨나요?</a>
						</label>
						<input type="password" name="pw" id="password" class="form-control" placeholder="" tabindex="2" required>
						<div class="invalid-feedback" id="passwordErrorBlock"></div>
					</div>

					<div class="checkbox d-none">
						<label>
							<input type="checkbox" name="idpwsave" value="checked" onclick="remember_idpw(this)"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?>> 로그인 상태 유지
						</label>
					</div>

					<label class="custom-control custom-checkbox" data-toggle="collapse" data-target="#collapseExample">
					  <input type="checkbox" name="idpwsave" value="checked" class="custom-control-input">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">로그인 상태 유지</span>
					</label>
					<div class="collapse" id="collapseExample">
					  <div class="alert alert-danger f12 mb-3">
					    개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
					  </div>
					</div>

					<button class="btn btn-lg btn-primary btn-block" type="submit" id="rb-submit">
						<span class="not-loading">로그인</span>
						<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
					</button>



				</fieldset>
			</div>
		</div>

  </form>

	<div class="card form-signin mt-3 bg-transparent">
		<div class="card-body">
			<p class="mb-0"><a href="/join">회원계정이 없으신가요 ?</a></p>
		</div>
	</div>

</div>

<div class="container py-4 mt-4 h7">
	<ul class="list-inline text-center">
	  <li class="list-inline-item mr-3">
			<a href="/terms" class="link-gray">이용약관</a>
		</li>
		<li class="list-inline-item mr-3">
			<a href="/privacy" class="link-gray">개인정보취급방침</a>
		</li>
		<li class="list-inline-item">
			<a href="/contact" class="link-gray">연락하기</a>
		</li>
	</ul>
</div>


<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="login" />
	<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="pw" value="" />
	<input type="hidden" name="idpwsave" value="" />
</form>


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

function remember_idpw(ths)
{
	if (ths.checked == true)
	{
		if (!confirm('패스워드정보를 저장할 경우 다음접속시 \n\n패스워드를 입력하지 않으셔도 됩니다.\n\n그러나, 개인PC가 아닐 경우 타인이 로그인할 수 있습니다.     \n\nPC를 여러사람이 사용하는 공공장소에서는 체크하지 마세요.\n\n정말로 패스워드를 기억시키겠습니까?\n\n'))
		{
			ths.checked = false;
		}
	}
}

</script>
