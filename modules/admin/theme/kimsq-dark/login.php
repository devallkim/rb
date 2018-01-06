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
				<form class="loginForm" role="form" name="loginform" action="<?php echo $g['s']?>/" method="post" onsubmit="return loginCheck(this);" novalidate>
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="a" value="login">
					<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>">
					<input type="hidden" name="usertype" value="admin">
					<div class="form-group">
						<label for="id" class="control-label">아이디 또는 이메일</label>
						<input type="text" name="id"  class="form-control input-lg" id="id" placeholder="" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" autofocus required autocapitalize="off" autocorrect="off" tabindex="1">
					</div>
					<div class="form-group">
						<label for="pw" class="control-label">패스워드</label>
						<input type="password" name="pw" class="form-control input-lg" id="pw" placeholder="" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" required tabindex="2">
					</div>

					<div class="custom-control custom-checkbox mb-2" data-toggle="collapse" data-target="#collapsealert" aria-expanded="true">
					  <input type="checkbox" class="custom-control-input" id="login_cookie" name="login_cookie" value="checked">
					  <label class="custom-control-label" for="login_cookie">로그인 상태 유지</label>
					</div>

					<div class="collapse" id="collapsealert" style="">
					  <div class="alert alert-danger f12 mb-3">
					    개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
					  </div>
					</div>

					<button type="submit" class="btn btn-primary btn-block">로그인</button>

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

<!-- bootstrap Validator -->
<?php getImport('bootstrap-validator','dist/css/bootstrapValidator.min',false,'css')?>
<?php getImport('bootstrap-validator','dist/js/bootstrapValidator.min',false,'js')?>
<script>
$(document).ready(function() {
    $('.loginForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            id: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email or Username is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9\_\-\@\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            pw: {
                message: '패스워드가 일치하지 않습니다.',
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                }
            },
        }
    });
});

var bootmsg = '<div class="media"><i class="pull-left fa fa-exclamation-circle fa-4x hidden-xs"></i><div class="media-body">';
	bootmsg+= '<h4 class="media-heading">로그인 정보를 저장하시겠습니까?</h4>';
	bootmsg+= '로그인 정보를 저장할 경우 다음접속시 정보를 입력하지 않으셔도 됩니다.<br>그러나, 개인PC가 아닐 경우 타인이 로그인할 수 있습니다.<br>PC를 여러사람이 사용하는 공공장소에서는 체크하지 마세요.';
	bootmsg+= '</div></div>';

$('.rb-confirm').on('click', function() {
	bootbox.confirm(bootmsg, function(result){
		document.loginform.idpwsave.checked = result;
	});
});
function loginCheck(f)
{
	getIframeForAction(f);
	return true;
}
</script>
