<header class="bar bar-nav bar-light bg-faded">
	<a class="icon icon-home pull-left" role="button" href="<?php  echo RW(0) ?>"></a>
	<h1 class="title">로그인</h1>
</header>

<main class="content">
	<form id="page-loginform" action="<?php echo $g['s']?>/" method="post" novalidate>
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="a" value="login">
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
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

$(function () {

	$('#page-loginform').submit(function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		var formID = form.attr('id')
		var f = document.getElementById(formID);
		form.find('[name="form"]').val('#'+formID);
		form.find('[type="submit"]').attr("disabled",true);
		form.find('input').removeClass('is-invalid')  //에러이력 초기화
		setTimeout(function(){
			getIframeForAction(f);
			f.submit();
		}, 500);
	});

	// page 로그인 관련
	$("#page-loginform").find('input').keyup(function() {
		$(this).removeClass('is-invalid') //에러 흔적 초기화
	});

})
</script>
