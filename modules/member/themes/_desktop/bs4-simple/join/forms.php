<div class="bg-shade-gradient">
	<article class="page-wrapper">

		<?php if (!$_HM['uid']): ?>
		<div class="mb-4">
			<h1>회원가입</h1>
			<p class="lead">웹사이트를 설계, 제작하고 서비스하는 가장 좋은 방법을 제공해 드립니다.</p>
		</div>
		<?php endif; ?>

		<div class="page-main">

			<form name="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" id="signupForm" novalidate autocomplete="off">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="c" value="<?php echo $c?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="front" value="<?php echo $front?>">
				<input type="hidden" name="a" value="join">
				<input type="hidden" name="check_id" value="<?php echo $check_id?$check_id:0 ?>">
				<input type="hidden" name="check_pw" value="0">
				<input type="hidden" name="check_email" value="<?php echo $check_email?$check_email:0 ?>">
				<input type="hidden" name="check_nic" value="<?php echo $check_nic?$check_nic:0 ?>">

				<div class="form-group">
					<label for="id">아이디</label>
					<input type="text" class="form-control" name="id" id="id" value="<?php echo $id ?>" placeholder="" onblur="sameCheck(this,'id-feedback');" autocapitalize="off" required>
					<div class="invalid-feedback" id="id-feedback"></div>
					<small class="form-text text-muted">4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.</small>
				</div>
				<div class="form-group">
					<label for="email">이메일</label>
					<input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" onblur="sameCheck(this,'email-feedback');" placeholder="비밀번호 잊어버렸을 때 확인 받을 수 있습니다." required>
					<div class="invalid-feedback" id="email-feedback"></div>
				</div>
				<div class="form-group">
					<label for="name">닉네임</label>
					<input type="text" class="form-control" name="nic" id="nic" value="<?php echo $nic?>" placeholder="닉네임을 입력해 주세요."  required  onblur="sameCheck(this,'nic-feedback');">
					<div class="invalid-feedback" id="nic-feedback"></div>
					<small class="form-text text-muted">2~12자로 사용할 수 있습니다.</small>
				</div>
				<div class="form-group">
					<label for="name">이름</label>
					<input type="text" class="form-control" name="name" id="name" value="" placeholder="실명을 입력해 주세요."  required autocomplete="off">
					<div class="invalid-feedback">이름을 입력해주세요.</div>
					<span class="help-block"></span>
				</div>
				<div class="form-group">
					<label for="pw1">비밀번호</label>
					<input type="password" class="form-control" name="pw1" id="pw1" value="<?php echo $pw ?>" placeholder="" required onblur="pw1Check();" autocomplete="off">
					<div class="invalid-feedback" id="pw1-feedback">비밀번호를 입력해주세요.</div>
					<small class="form-text text-muted">8~16자의 영문/숫자/특수문자중 2개이상의 조합으로 만드셔야 합니다.</small>
				</div>
				<div class="form-group">
					<label for="pw2">비밀번호 확인</label>
					<input type="password" class="form-control" name="pw2" id="pw2" placeholder="" required onkeyup="pw2Check();" autocomplete="off">
					<div class="invalid-feedback" id="pw2-feedback">다시한번 입력해 주세요.</div>
				</div>


				<p class="form-info">아래의 '회원가입' 버튼을 클릭하면
				  <a href="/terms" target="_blank">이용약관</a> 과
				  <a href="/privacy" target="_blank">개인정보취급방침</a>에 동의하게 됩니다.
				</p>

				<button class="btn btn-primary" type="submit" id="rb-submit">
					<span class="not-loading">회원가입</span>
					<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 회원가입 중 ...</span>
				</button>

			</form>
		</div><!-- .page-main -->

		<div class="page-secondary">

		</div>

	</article><!-- .page-wrapper -->
</div><!-- /.bg-shade-gradient -->





<!-- Modal : 우편번호 검색 : 현재 사용안함 추후 모달 사용가능성을 위해 남겨둠 -->
<div class="modal fade" id="modal-zipsearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-search fa-lg"></i> 우편번호 검색</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="input-group">
							<span class="input-group-addon">지역명</span>
							<input type="search" class="form-control" placeholder="찾고자하는 주소의 동(읍/면/리)을 입력하세요.">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">검색</button>
							</span>
						</div>
					</div>
					<div class="list-group resultbox">
						<a href="#" class="list-group-item">서울 종로구 서린동 광화문우체국 <span class="badge">110-110</span></a>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
//<![CDATA[

var f = document.memberForm;

function sameCheck(obj,layer)
{
	if (!obj.value)
	{
		eval('f.check_'+obj.name).value = '0';
		f.classList.remove('was-validated');
		obj.classList.remove('is-invalid','is-valid');
		getId(layer).innerHTML = '';
	}
	else
	{
		if (obj.name == 'id')
		{
			if (obj.value.length < 4 || obj.value.length > 12 || !chkIdValue(obj.value))
			{
				f.check_id.value = '0';
				setTimeout(function() {
	        obj.focus();
		    }, 0);
				f.classList.remove('was-validated');
				obj.classList.add('is-invalid');
				obj.classList.remove('is-valid');
				getId(layer).innerHTML = '사용할 수 없는 아이디 입니다.';
				return false;
			}
		}
		if (obj.name == 'email')
		{
			if (!chkEmailAddr(obj.value))
			{
				f.check_email.value = '0';
				setTimeout(function() {
			        obj.focus();
			    }, 0);
				f.classList.remove('was-validated');
				obj.classList.add('is-invalid');
				obj.classList.remove('is-valid');
				getId(layer).innerHTML = '이메일형식이 아닙니다';
				return false;
			}
		}
		if (obj.name == 'nic')
		{
			if (obj.value.length < 2 || obj.value.length > 12 )
			{
				f.check_nic.value = '0';
				setTimeout(function() {
					obj.focus();
				}, 0);
				f.classList.remove('was-validated');
				obj.classList.add('is-invalid');
				obj.classList.remove('is-valid');
				getId(layer).innerHTML = '사용할 수 없는 닉네임 입니다.';
				return false;
			}
		}
		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
	}
}


(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('signupForm');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
				$('.form-control').removeClass('is-invalid'); // 폼유용성 검사상태 초기화
				$("#id-feedback").html("아이디를 입력하세요.");
				$("#email-feedback").html("이메일을 입력하세요.");
				$("#nic-feedback").html("닉네임을 입력하세요.");
        event.preventDefault();
        event.stopPropagation();
      } else {

				if (form.check_id.value == '0' || form.check_email.value == '0' || form.check_pw.value == '0') {
					event.preventDefault();
					event.stopPropagation();
				} else {
					$('#rb-submit').attr("disabled",true);
					setTimeout("_submitCheck();",500);
				}
      }

      form.classList.add('was-validated');

    }, false);
  }, false);
})();


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

function _submitCheck()
{
	getIframeForAction(f);
	f.submit();
}


//]]>
</script>
