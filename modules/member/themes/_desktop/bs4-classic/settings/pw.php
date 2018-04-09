<div class="page-wrapper row">
		<nav class="col-3 page-nav">
	    <?php include_once $g['dir_module_skin'].'_menu.php'?>
	  </nav>

		<div class="col-9 page-main">

			<div class="subhead mt-0">
				<h2 class="subhead-heading">비밀번호 변경</h2>
			</div>


			<form class="card" name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
				<div class="card-header">
					<div class="media">
			      <i class="fa fa-key fa-3x mx-3" aria-hidden="true"></i>
			      <div class="media-body">
							현재 비밀번호는 <mark><?php echo getDateFormat($my['last_pw'],'Y.m.d')?></mark> 에 변경(등록)되었으며 <mark><?php echo -getRemainDate($my['last_pw'])?>일</mark>이 경과되었습니다. <br>
							비밀번호는 가급적 주기적으로 변경해 주세요.
			      </div>
			    </div>
				</div>
				<div class="card-body">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="c" value="<?php echo $c?>">
					<input type="hidden" name="m" value="<?php echo $m?>">
					<input type="hidden" name="front" value="<?php echo $front?>">
					<input type="hidden" name="a" value="info_update">
					<input type="hidden" name="act" value="pw">

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">현재 패스워드</label>
						<div class="col-sm-10">
							<input type="password" class="form-control w-50" name="pw" value="" id="user_old_password" required autofocus>
							<small class="form-text text-muted"></small>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">신규 패스워드</label>
						<div class="col-sm-10">
							<input type="password" class="form-control w-50" name="pw1" value="" id="user_new_password" required onblur="pw1Check();">
							<div class="invalid-feedback" id="pw1-feedback">비밀번호를 입력해주세요.</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label">패스워드 확인</label>
						<div class="col-sm-10">
							<input type="password" class="form-control w-50" name="pw2" value="" id="user_confirm_new_password" required onblur="pw2Check();">
							<div class="invalid-feedback" id="pw2-feedback">다시한번 입력해 주세요.</div>
							<small class="form-text text-muted mt-3">비밀번호를 한번 더 입력하세요. 비밀번호는 잊지 않도록 주의하시기 바랍니다.</small>
						</div>
					</div>

				</div><!-- ./card-body -->
				<div class="card-footer d-flex justify-content-between align-items-center">
					<a href="<?php echo RW('mod=password_reset')?>">패스워드를 분실했어요.</a>
					<button type="submit" class="btn btn-light">변경하기</button>
				</div>

			</form><!-- /.card -->







		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->

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
