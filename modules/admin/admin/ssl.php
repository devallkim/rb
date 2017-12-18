<form class="form-horizontal" role="form" name="sendForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return sslCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $module?>">
	<input type="hidden" name="a" value="config">
	<input type="hidden" name="act" value="ssl">

	<h3>SSL 환경설정</h3>

	<div class="form-group row">
		<label class="col-md-2 col-form-label">SSL 적용</label>
		<div class="col-md-10">

			<div class="form-check form-check-inline">
			  <label class="form-check-label">
					<input class="form-check-input" type="radio" name="ssl_type" value=""<?php if(!$d['admin']['ssl_type']):?> checked<?php endif?>> 적용안함
			  </label>
			</div>

			<div class="form-check form-check-inline">
			  <label class="form-check-label">
					<input class="form-check-input" type="radio" name="ssl_type" value="2"<?php if($d['admin']['ssl_type']==2):?> checked<?php endif?>> 코드값 적용
			  </label>
			</div>

			<div class="form-check form-check-inline">
			  <label class="form-check-label">
					<input class="form-check-input" type="radio" name="ssl_type" value="1"<?php if($d['admin']['ssl_type']==1):?> checked<?php endif?> onclick="alert('[주의] 아래의 안내사항을 확인하셨나요?');"> 전체사이트 적용
			  </label>
			</div>

			<small id="ssl_guide" class="form-text text-muted">
				보안서버가 설치되지 않은 상태에서 전체사이트 적용을 체크하시면 사이트에 접속할 수 없게 됩니다.<br>
				반드시 보안서버 설치 후 체크해 주세요.<br>
				혹시, 보안서버 미설치 상태에서 전체사이트 체크 후 이상이 생겼을 경우에는 킴스큐 공식포털에서 해결방법을 얻을 수 있습니다.
			</small>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">http 포트번호</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="http_port" value="<?php echo $d['admin']['http_port']?>"  placeholder="" style="width:100px;">
			<small class="form-text text-muted">
				80포트일 경우 공백으로 두세요.
			</small>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">SSL 포트번호</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="ssl_port" value="<?php echo $d['admin']['ssl_port']?>"  placeholder="" style="width:100px;">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">SSL 적용모듈</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="ssl_module" value="<?php echo $d['admin']['ssl_module']?>" placeholder="">
			<small class="form-text text-muted">
				적용할 모듈의 아이디(폴더명)를 콤마(,)로 구분해서 등록해 주세요.<br>
				보기) <code>/rb/?m=member</code> 일 경우 코드값은 <code>member</code>
			</small>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-2 col-form-label">SSL 적용메뉴</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="ssl_menu" value="<?php echo $d['admin']['ssl_menu']?>" placeholder="">
			<small class="form-text text-muted">
				적용할 메뉴의 코드값을 콤마(,)로 구분해서 등록해 주세요.<br>
				보기) <code>/rb/?c=ssl</code> 일 경우 코드값은 <code>ssl</code>
			</small>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-2 col-form-label">SSL 적용페이지</label>
		<div class="col-md-9">
			<input type="text" class="form-control" name="ssl_page" value="<?php echo $d['admin']['ssl_page']?>" placeholder="">
			<small class="form-text text-muted">
				적용할 페이지의 코드값을 콤마(,)로 구분해서 등록해 주세요.<br>
				보기) <code>/rb/?mod=ssl</code> 일 경우 코드값은 <code>ssl</code>
			</small>
		</div>
	</div>

	<hr>

	<div class="form-group row">
		<div class="col-md-offset-2 col-md-9">
			<button class="btn btn-primary btn-lg<?php if($g['device']):?> btn-block<?php endif?>" type="submit">정보변경</button>
		</div>
	</div>

</form>

<script>
function sslCheck(f)
{
	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?         ');
}
</script>
