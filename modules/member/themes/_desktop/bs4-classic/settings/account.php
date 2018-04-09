<?php include_once $g['dir_module_skin'].'_header.php'?>

<div class="page-wrapper row">
	<nav class="col-3 page-nav">
    <?php include_once $g['dir_module_skin'].'_menu.php'?>
  </nav>

	<div class="col-9 page-main">

		<div class="subhead mt-0">
			<h2 class="subhead-heading">회원계정 설정</h2>
		</div>
	  <?php if (!getloginExpired($my['last_log'],$d['member']['settings_expire'])): //로그인 후 경과시간 비교(분 ?>
		<?php include_once $g['dir_module_skin'].'_pwConfirm.php'?>
		<?php else: ?>

			<div class="d-flex  align-items-center blankslate mt-4" style="height:300px">
				<p class="mb-0 text-muted mx-auto">
					<i class="fa fa-compress d-block fa-5x mb-3" aria-hidden="true"></i>
					소셜미디어 계정을 연결하고 통합관리 합니다. <br>스탠다드 계정 이상에서 지원됩니다.</p>
			</div>

		<?php endif; ?>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->

<?php include_once $g['dir_module_skin'].'_footer.php'?>


<script type="text/javascript">

var f = document.procForm;
var pw1 = getId('user_new_password');
var pw2 = getId('user_confirm_new_password');

putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

function pw1Check()
{
	var layer = 'pw1-feedback';

	if (!pw1.value) {
		pw1.classList.remove('is-valid','is-invalid');
	} else {

		f.classList.remove('was-validated');
		pw1.classList.add('is-invalid');
		pw1.classList.remove('is-valid');

		if (f.pw1.value.length < 8 || f.pw1.value.length > 16)
		{
			getId(layer).innerHTML = '비밀번호는 영문/숫자/특수문자중 2개 이상의 조합으로 최소 8~16자로 입력하셔야 합니다.';
			f.pw1.focus();
			return false;
		}
		if (getTypeCheck(f.pw1.value,"abcdefghijklmnopqrstuvwxyz"))
		{
			getId(layer).innerHTML = '비밀번호가 영문만으로 입력되었습니다.\n비밀번호는 영문/숫자/특수문자중 2개 이상의 조합으로 최소 8자이상 입력하셔야 합니다.';
			f.pw1.focus();
			return false;
		}
		if (getTypeCheck(f.pw1.value,"1234567890"))
		{
			getId(layer).innerHTML = '비밀번호가 숫자만으로 입력되었습니다.\n비밀번호는 영문/숫자/특수문자중 2개 이상의 조합으로 최소 8자이상 입력하셔야 합니다.';
			f.pw1.focus();
			return false;
		}

		pw1.classList.add('is-valid');
		pw1.classList.remove('is-invalid');
		getId(layer).innerHTML = '';

	}

}

function pw2Check()
{
	var layer = 'pw2-feedback';

	if (!f.pw1.value) {
		f.pw2.value = '';
		f.pw1.focus();
	} else {

		f.classList.remove('was-validated');
		pw2.classList.add('is-invalid');
		pw2.classList.remove('is-valid');

		if (f.pw1.value != f.pw2.value)
		{
			getId(layer).innerHTML = '비밀번호가 일치하지 않습니다.';
			f.classList.remove('was-validated');
			f.pw2.focus();
			f.check_pw.value = '0';
			return false;
		}

		pw2.classList.add('is-valid');
		pw2.classList.remove('is-invalid');
		getId(layer).innerHTML = '';

	 f.check_pw.value = '1';
	}

}


// 아이디 변경 확인 모달
function changeID_confirm() {
  var mid = 'changeID_confirm';
  var size = '';
  var src = '?m=member&front=settings&page=modal.changeID&iframe=Y&amp;mid='+mid;
  setModalIframe(mid,size,src);
}

changeID_confirm()

</script>
