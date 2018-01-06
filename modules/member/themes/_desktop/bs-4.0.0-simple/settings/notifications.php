<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<div class="col-9 page-main">

			<div class="Subhead mt-0">
				<h3 class="Subhead-heading">알림설정</h3>
			</div>

			<div class="border border-primary text-primary p-3 mb-4">
				설정된 알림 설정은 개인의 전체 프로젝트에 일괄 적용 됩니다.
			</div>

			<form id="noti_update" role="form" action="<?php echo $g['s']?>/" method="post">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="a" value="info_update">
				<input type="hidden" name="act" value="noti">

			  <div class="form-group row">
			    <label class="col-2 col-form-label">이메일</label>
			    <div class="col-10">
			      <input type="text" readonly class="form-control-plaintext" name="email" value="<?php echo $my['email'] ?>">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-2 col-form-label">휴대폰</label>
			    <div class="col-10">
						<?php $tel2=explode('-',$my['tel2'])?>
						<div class="form-row mb-2">
							<div class="col-3">
								<input type="text" name="tel2_1" value="<?php echo $tel2[0]?>" maxlength="3" size="4" class="form-control">
							</div>
							<div class="col-3">
								<input type="text" name="tel2_2" value="<?php echo $tel2[1]?>" maxlength="4" size="4" class="form-control">
							</div>
							<div class="col-3">
								<input type="text" name="tel2_3" value="<?php echo $tel2[2]?>" maxlength="4" size="4" class="form-control">
							</div>
						</div>


			    </div>
			  </div>

				<div class="form-group row">
		      <div class="col-sm-2"></div>
		      <div class="col-sm-10">
						<div class="form-check">
						  <label class="form-check-label">
						    <input class="form-check-input" name="noti_mng" type="checkbox" value="1" <?php echo $my['noti_mng']?' checked':'' ?> >
						    시스템 알림을 수신합니다.
						  </label>
						</div>
						<div class="form-check">
						  <label class="form-check-label">
						    <input class="form-check-input" name="noti_rct" type="checkbox" value="1" <?php echo $my['noti_rct']?' checked':'' ?>>
						    요금/결제 관련 알림을 수신합니다.
						  </label>
						</div>
					</div>
			  </div>

				<button class="btn btn-primary mt-2" type="button" name="button" data-act="submit">
					<span class="not-loading">변경하기</span>
					<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 변경중 ...</span>
				</button>

			</form>

			<div class="mt-4 border bg-light p-3">
				<strong>시스템 알림은 아래의 경우 알림 이메일/SMS가 발송됩니다.</strong>
				<ul class="f13 text-gray mt-2">
					<li>호스팅 신청 완료 / 기간연장 완료</li>
					<li>호스팅 MySQL 용량 부족</li>
					<li>호스팅 트래픽 90%/트래픽 100% 차단/트래픽 90% 자동 초기화</li>
					<li>SSL 설치 완료/SSL 만료 전 알림/SSL 만료</li>
					<li>호스팅 중지</li>
					<li>호스팅 서비스 해지 신청</li>
					<li>SMS 잔여 용량 알림</li>
				</ul>

				<strong>요금/결제 관련 알림은 아래의 경우 알림 이메일/SMS가 발송됩니다.</strong>
				<ul class="f13 text-gray mt-2 mb-0">
					<li>호스팅 만기일 15일,7일,1일 전</li>
					<li>호스팅 중지</li>
					<li>호스팅 서비스 신청/결제 완료</li>
					<li>호스팅 서비스 해지 신청</li>
				</ul>
			</div>


			<ul class="list-group d-none">
			  <li class="list-group-item">
					<strong class="f16">프로젝트 알림</strong>
					<p class="text-gray-light mb-1">프로젝트에 대한 액세스 권한을 부여 받으면 자동으로 저장소에 대한 알림을 받습니다.</p>
					<div class="form-check mb-0">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" value="">
					    자동으로 알림 받기
					  </label>
					</div>
				</li>
				<li class="list-group-item">
					<strong class="f16">대화참여 알림</strong>
					<p class="text-gray-light mb-1">참여중인 대화에 대한 알림 또는 다른 사용자가 @mention으로 귀하를 인용 한 경우.</p>
					<div class="form-check form-check-inline mb-0">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 이메일
					  </label>
					</div>
					<div class="form-check form-check-inline mb-0">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 웹
					  </label>
					</div>
				</li>
				<li class="list-group-item">
					<strong class="f16">구독 알림</strong>
					<p class="text-gray-light mb-1">구독중인 모든 프로젝트 또는 대화에 대한 알림.</p>
					<div class="form-check form-check-inline mb-0">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> 이메일
					  </label>
					</div>
					<div class="form-check form-check-inline mb-0">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> 웹
					  </label>
					</div>
				</li>
			</ul>



			<dl class="form-group d-none">
				<dt>
					<label class="mb-2">기본 이메일</label>
				</dt>
				<dd>
					<select id="primary_email_select" name="id" class="form-control d-inline short">
						<option value="5706606" selected="selected">break@kimsq.com</option>
						<option value="5706606">live@kimsq.com</option>
					</select>
					<button class="btn btn-light btn-sm" type="button" name="button">저장</button>
				</dd>
			</dl>

		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<script>

var info_update_result = Cookies.get('info_update_result')  // 결과 가져오기
if (info_update_result == 'success') {
 setTimeout(function(){
	 $.notify('알림 정보가 변경 되었습니다.');
 }, 500);
}
Cookies.remove('info_update_result');  // 결과 초기화

var form =  document.querySelector("#noti_update");

$('[data-act="submit"]').click(function() {
  $(this).attr("disabled",true);
  setTimeout("_submitCheck();",500);
});

function _submitCheck() {
	getIframeForAction(form);
	form.submit();
}

</script>
