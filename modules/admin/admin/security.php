<div id="configbox" class="p-4">

	<form class="form-horizontal" role="form" name="sendForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return sslCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="config">
		<input type="hidden" name="act" value="security">

		<h3>보안설정</h3>

		<div class="form-group row">
			<label class="col-md-2 col-form-label">에디터 제한태그</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="secu_tags" value="<?php echo $d['admin']['secu_tags']?>" placeholder="">
				<small class="form-text text-muted">
						제한할 태그를 콤마(,)로 구분해서 등록해 주세요.<br>
						보기) iframe,script,style,meta,<br>
						킴스큐에 포함된 위지위그 에디터를 사용할 경우 편리하게 문서를 편집할 수 있으나 특정태그를 허용하게 되면 XSS(Cross-site scripting, 크로스 사이트 스크립팅) 나 CSRF(Cross Site Request Forgery, 크로스 사이트 요청 변조)공격을 받을 수 있으므로 주의해야 합니다.<br>
						특히 <code>iframe</code> 이나 <code>script</code> 는 특수한 경우가 아니면 허용하지 말아야 합니다.
				</small>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">허용 도메인</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="secu_domain" value="<?php echo $d['admin']['secu_domain']?>" placeholder="">
				<small class="form-text text-muted">
						허용할 도메인을 콤마(,)로 구분해서 등록해 주세요.<br>
						iframe 태그를 허용하지 않아도 등록된 도메인들은 <code>iframe</code> 이 허용됩니다.<br>
						보기) youtube.com,naver.com,daum.net,vimeo.com
				</small>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 col-form-label">파라미터 공격차단</label>
			<div class="col-md-9">
				<input type="text" class="form-control" name="secu_param" value="<?php echo $d['admin']['secu_param']?>" placeholder="">
				<small class="form-text text-muted">
						특정 파라미터를 이용하여 액션을 요청하거나 공격할 경우 제한할 패턴을 등록해 주세요.<br>
						보기) ;a=,&amp;a=,?a=,m=admin,system=
				</small>
			</div>
		</div>
		<hr>

		<button class="btn btn-outline-primary btn-block btn-lg" type="submit">정보변경</button>

	</form>
</div>


<script>
function sslCheck(f)
{
	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?        ');
}
</script>
