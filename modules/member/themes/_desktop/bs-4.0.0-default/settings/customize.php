<!-- global css -->
<link href="/modules/member/pages/_desktop/join/_style.css" rel="stylesheet">

<style media="screen">
.custom-select.is-invalid, .form-control.is-invalid, .was-validated .custom-select:invalid, .was-validated .form-control:invalid {
	border-color: #dc3545;
}
</style>

<div class="bg-shade-gradient">
	<article class="page-wrapper">

		<div class="page-header mb-4">
			<h1>Welcome to kimsQ</h1>
			<p class="lead">@<?php echo $my['id'] ?> 님, 끊임없이 배우고, 코딩하고, 무한한 기회를 찾을 수 있습니다.</p>

			<ol class="steps mb-3">
		    <li class="complete">
					<div class="media">
						<i class="fa fa-check fa-2x d-flex mr-3" aria-hidden="true"></i>
					  <div class="media-body">
					    <h5 class="mt-0">가입완료</h5>
					    회원정보 입력
					  </div>
					</div>
		    </li>
		    <li class="complete">
					<div class="media">
						<i class="fa fa-file-text-o fa-2x d-flex mr-3" aria-hidden="true"></i>
					  <div class="media-body">
					    <h5 class="mt-0">Step 2:</h5>
					    멤버쉽 플랜 선택
					  </div>
					</div>
		    </li>
		    <li class="current">
					<div class="media">
						<i class="fa fa-cog fa-2x d-flex mr-3" aria-hidden="true"></i>
					  <div class="media-body">
					    <h5 class="mt-0">Step 3:</h5>
					    추가정보 입력
					  </div>
					</div>
		    </li>
		  </ol>

		</div>


		<!-- POST방식으로 액션요청 -->
		<form action="<?php echo $g['s']?>/" method="post" name="FormName" onsubmit="return FormCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $m?>">
			<input type="hidden" name="a" value="customize">

			<fieldset class="mb-3">
				<h3 class="f14 mb-2">당신의 프로그래밍 경험 수준을 어떻게 표현 하시겠습니까?</h3>
				<p>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 매우 경험이 많음
					  </label>
					</div>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 다소 경험 있음
					  </label>
					</div>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 입문자 입니다.
					  </label>
					</div>
				</p>
			</fieldset>


			<fieldset class="mb-3">
				<h3 class="f14">당신은 킴스큐를 어떻게 사용할 계획입니까? <span class="text-muted f12">(해당되는 모든 것을 체크하세요)</span></h3>
				<p>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Design
					  </label>
					</div>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> School projects
					  </label>
					</div>
					<div class="form-check form-check-inline">
					  <label class="form-check-label">
					    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3"> Research
					  </label>
					</div>
				</p>
			</fieldset>

			<fieldset class="mb-3">
				<h3 class="f14">어떻게 자신을 소개할 수 있나요?</h3>
				<p>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 학생입니다.
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 프로사용자
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 취미사용자
						</label>
					</div>
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 기타
						</label>
					</div>
				</p>
			</fieldset>


			<button class="btn btn-primary" type="submit" name="button">저장</button>
			<a class="btn btn-link" href="/">건너뛰기</a>

		</form>


	</article><!-- .page-wrapper -->
</div><!-- /.bg-shade-gradient -->






<script type="text/javascript">

document.title = '추가정보 · 킴스큐';

function FormCheck(f)
{
	getIframeForAction(f); // 액션을 동적 iframe 으로 보냄
	return true;
}

</script>
