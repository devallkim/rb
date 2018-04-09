<div class="container">

	<form class="form-signin" name="loginform" id="page-loginform" action="<?php echo $g['s']?>/" method="post" novalidate>
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="a" value="login">
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
		<input type="hidden" name="form" value="">

    <h2 class="form-signin-heading text-center pt-5">회원 로그인</h2>

		<div class="card">
			<div class="card-body">
				<fieldset>
					<div class="form-group">
						<label for="">아이디 또는 이메일</label>
						<input type="text" name="id" id="id" class="form-control" placeholder="" tabindex="1" autocorrect="off" autocapitalize="off" autofocus="autofocus" required>
						<div class="invalid-feedback mt-2" data-role="idErrorBlock"></div>
					</div>

					<div class="form-group">
						<label for="">
							패스워드
							<a href="<?php echo RW('mod=password_reset') ?>" class="label-link" id="password_reset">비밀번호를 잊으셨나요?</a>
						</label>
						<input type="password" name="pw" id="password" class="form-control" placeholder="" tabindex="2" required>
						<div class="invalid-feedback mt-2" data-role="passwordErrorBlock"></div>
					</div>

					<div class="custom-control custom-checkbox" data-toggle="collapse" data-target="#page-collapsealert">
					  <input type="checkbox" class="custom-control-input" id="page-loginCookie" name="login_cookie" value="checked" tabindex="4">
					  <label class="custom-control-label" for="page-loginCookie">로그인 상태 유지</label>
					</div>

					<div class="collapse" id="page-collapsealert">
					  <div class="alert alert-danger f12 mb-3">
					    개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
					  </div>
					</div>

					<button class="btn btn-lg btn-primary btn-block" type="submit" id="rb-submit" data-role="submit" tabindex="3">
						<span class="not-loading">로그인</span>
						<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
					</button>



				</fieldset>
			</div>
		</div>

  </form>

	<div class="card form-signin mt-3 bg-transparent">
		<div class="card-body">
			<p class="mb-0"><a href="<?php echo RW('mod=join') ?>" tabindex="6">회원계정이 없으신가요 ?</a></p>
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


<script type="text/javascript">

$(function () {

	$('#page-loginform').submit(function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		var formID = form.attr('id')
		var f = document.getElementById(formID);
		form.find('[name="form"]').val('#'+formID);
		form.find('[type="submit"]').attr("disabled",true);
		form.find('.form-control').removeClass('is-invalid')  //에러이력 초기화
		setTimeout(function(){
			getIframeForAction(f);
			f.submit();
		}, 500);
	});

})

</script>
