<form class="card mb-5" id="page-confirmPW" action="<?php echo $g['s']?>/" method="post" novalidate>

	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $m?>">
	<input type="hidden" name="a" value="pwConfirm">
	<input type="hidden" name="form" value="">

  <div class="card-header">
    <div class="media">
      <i class="fa fa-lock fa-4x mx-3" aria-hidden="true"></i>
      <div class="media-body">
        개인정보를 안전하게 보호하기 위해, 로그인 후 <mark><?php echo $d['member']['settings_expire'] ?>분</mark>이 경과하면 비밀번호를 다시 한번 확인합니다.<br>
        <?php echo $my['nic']; ?>님의
        마지막 로그인 일시는 <mark><time data-plugin="timeago" datetime="<?php echo getDateFormat($my['last_log'],'c')?>"></time></mark>
        <small>(<?php echo getDateFormat($my['last_log'],'Y.m.d H:i')?>)</small> 입니다.<br>
        회원 정보는 개인정보 취급방침에 따라 안전하게 보호되며, 회원님의 동의 없이 공개 또는 제 3자에게 제공되지 않습니다.
      </div>
    </div>
  </div>

	<div class="card-body">
		<div class="form-group row">
			<label class="col-sm-2 col-form-label text-center">아이디</label>
      <div class="col-sm-10">
        <input type="text" name="id" readonly class="form-control-plaintext" value="<?php echo $my['id'] ?>">
      </div>
		</div>

		<div class="form-group row">
			<label class="col-sm-2 col-form-label text-center">패스워드</label>
      <div class="col-sm-8">
        <input type="password" name="pw" id="password" class="form-control form-control-lg" placeholder="" tabindex="2" required="" value="" autocomplete="new-pw">
        <div class="invalid-feedback mt-2" data-role="passwordErrorBlock"></div>
      </div>
		</div>

	</div>
  <div class="card-footer d-flex justify-content-between align-items-center">
    <a href="<?php echo RW('mod=password_reset')?>">패스워드를 분실했어요.</a>
		<button class="btn btn-light" type="submit" data-role="submit" tabindex="3">
			<span class="not-loading">확인하기</span>
			<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 확인중 ...</span>
		</button>
  </div>
</form>

<script>
	setTimeout(function(){
		$('#password').val('').focus()
	}, 400);
</script>
