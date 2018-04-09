<div class="rb-root">
	<div id="rb-login">
		<div class="card">
			<div class="card-header">
				<h1>
					<a href="<?php echo $g['r']?>/">
						<i class="kf-bi-01"></i>
					</a>
					<small>관리자 모드</small>
				</h1>
			</div>
			<div class="card-body">
				<form class="loginForm" role="form" name="loginform" id="admin-loginform" action="<?php echo $g['s']?>/" method="post">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="a" value="login">
					<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
					<input type="hidden" name="usertype" value="admin">
					<input type="hidden" name="form" value="">

					<div class="form-group">
						<label for="id" class="control-label">아이디 또는 이메일</label>
						<input type="text" name="id"  class="form-control input-lg" id="id" placeholder="" value="" autofocus required autocapitalize="off" autocorrect="off" tabindex="1">
						<div class="invalid-feedback mt-2" data-role="idErrorBlock"></div>
					</div>
					<div class="form-group">
						<label for="pw" class="control-label">패스워드</label>
						<input type="password" name="pw" class="form-control input-lg" id="pw" placeholder="" value="" required tabindex="2">
						<div class="invalid-feedback mt-2" data-role="passwordErrorBlock"></div>
					</div>

					<div class="custom-control custom-checkbox mb-2">
					  <input type="checkbox" class="custom-control-input" id="login_cookie" name="login_cookie" value="checked"  data-toggle="collapse" data-target="#collapsealert">
					  <label class="custom-control-label" for="login_cookie">로그인 상태 유지</label>
					</div>

					<div class="collapse" id="collapsealert" style="">
					  <div class="alert alert-danger f12 mb-3">
					    개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
					  </div>
					</div>

					<button class="btn btn-lg btn-primary btn-block" type="submit" id="rb-submit" data-role="submit" tabindex="3">
						<span class="not-loading">로그인</span>
						<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
					</button>


					<p class="mt-3">
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=tmppw" onclick="return hrefCheck(this,true,'임시 패스워드를 가입하신 이메일로 받으시겠습니까?');">
							<small>비밀번호를 잊으셨나요?</small>
						</a>
					</p>

				</form>
			</div>
		</div>
	</div>
</div>


<script>

$(function () {

	$('#admin-loginform').submit(function(e){
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

	// 로그인 에러 흔적 초기화
	$("#admin-loginform").find('.form-control').keyup(function() {
		$(this).removeClass('is-invalid')
	});


})

</script>
