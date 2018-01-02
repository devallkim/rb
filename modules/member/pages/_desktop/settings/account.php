<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<div class="col-9 page-main">

			<div class="Subhead mt-0">
				<h2 class="Subhead-heading">회원 계정설정</h2>
			</div>

			<form name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="c" value="<?php echo $c?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="front" value="<?php echo $front?>">
				<input type="hidden" name="a" value="info_update">
				<input type="hidden" name="act" value="pw">


				<div class="form-group">
					<label>현재 패스워드</label>
					<input type="password" class="form-control w-50" name="pw" value="" id="user_old_password" required>
					<small class="form-text text-muted">현재 비밀번호는 마지막으로 등록된지 <mark><?php echo -getRemainDate($my['last_pw'])?>일</mark>이 경과되었습니다.</small>
				</div>

				<div class="form-group">
					<label>신규 패스워드</label>
					<input type="password" class="form-control w-50" name="pw1" value="" id="user_new_password" required onblur="pw1Check();">
					<div class="invalid-feedback" id="pw1-feedback">비밀번호를 입력해주세요.</div>
				</div>

				<div class="form-group">
					<label>패스워드 확인</label>
					<input type="password" class="form-control w-50" name="pw2" value="" id="user_confirm_new_password" required onblur="pw2Check();">
					<div class="invalid-feedback" id="pw2-feedback">다시한번 입력해 주세요.</div>
					<small class="form-text text-muted">비밀번호를 한번 더 입력하세요. 비밀번호는 잊지 않도록 주의하시기 바랍니다.</small>
				</div>

				<p>
					<button type="submit" class="btn btn-light">변경하기</button>
					<span class="ml-2"><a href="/password_reset">패스워드를 분실했어요.</a></span>
				</p>

			</form>


			<div class="Subhead Subhead-spacious">
	      <h2 class="Subhead-heading">아이디 변경 <small class="text-gray-light"><?php echo $my['id'] ?></small></h2>
	    </div>
			<p>아이디는 중복되지 않을 경우 변경이 가능합니다 <mark>https://kimsq.com/아이디</mark> 형식으로 접속하실 수 있습니다.</p>
			<p>
				<button type="button" class="btn btn-light" data-toggle="modal" data-target="#changeID_confirm">아이디 변경</button>
			</p>

			<div class="Subhead Subhead-spacious">
	      <h2 class="Subhead-heading Subhead-heading-danger">회원탈퇴</h2>
	    </div>

			<p>귀하께서는 단체계정의 소유자 입니다. (kimsQ, redblockcokr, and redblock5)</p>
			<p>회원탈퇴 이전에 단체계정의 <a href="http://help.kimsq.com/articles/transferring-organization-ownership">소유권이전</a>을 하거나 <a href="https://help.kimsq.com/articles/deleting-an-organization-account">단체계정 삭제</a>를 해야 합니다.</p>
			<p>
				<button type="button" class="btn btn-light text-danger disabled">회원탈퇴</button>
			</p>


		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>


<script type="text/javascript">

var f = document.procForm;
var pw1 = getId('user_new_password');
var pw2 = getId('user_confirm_new_password');

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
