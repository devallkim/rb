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
			<p class="lead">@<?php echo $my['id'] ?> 님, 킴스큐 세상의 당신의 첫발을 내딛었습니다.</p>

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
		    <li class="current">
					<div class="media">
						<i class="fa fa-file-text-o fa-2x d-flex mr-3" aria-hidden="true"></i>
					  <div class="media-body">
					    <h5 class="mt-0">Step 2:</h5>
					    멤버쉽 플랜 선택
					  </div>
					</div>
		    </li>
		    <li>
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

		<div class="page-main">
			<h2 class="f2-light mb-2">
        멤버쉽 플랜을 선택하세요.
      </h2>

			<form action="<?php echo $g['s']?>/" method="post" name="FormName" onsubmit="return FormCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="a" value="plan">

				<ul class="list-group">
					<li class="list-group-item">
						<div class="form-check mb-0">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="plan" id="" value="0" checked>
								개발/서비스용 프로젝트 무제한 제공 <span class="badge badge-warning">무료</span>
							</label>
						</div>
					</li>
					<li class="list-group-item disabled">
						<div class="form-check disabled mb-0">
							<label class="form-check-label">
								<input class="form-check-input" type="radio" name="" id="" value="" disabled>
								월정액 멤버쉽 서비스 <span class="badge badge-light">준비중</span>
							</label>
						</div>
					</li>
				</ul>

				<p class="mt-2 f12 text-gray">
					월정액 멤버쉽 서비스는 준비중이며, 추후에 업그레이드 가능합니다.
				</p>
				<hr>
				<div class="form-check mt-3 mb-4">
					<label class="form-check-label">
						<input class="form-check-input" type="checkbox" name="remail" value="1">
						<strong class="text-gray d-block mb-0">공지메일 수신</strong>
						<span class="f12 text-muted">킴스큐에서 전하는 업그레이드 소식 및 이벤트 이메일을 수신하시겠습니까 ?</span>
					</label>
				</div>

				<button class="btn btn-primary" type="submit" name="button">계속</button>
			</form>

		</div><!-- .page-main -->

		<div class="page-secondary">
			<div class="card">
			  <div class="card-header bg-transparent">
			    개발계정 제공
			  </div>
			  <div class="card-body">
			    <p class="card-text mb-0">체험 및 서비스 개발을 위한 개발계정을 <mark>30일</mark>간 <mark>무료</mark>로 제공해 드립니다. (커뮤니티 포인트 소요)</p>
			  </div>
				<ul class="list-group list-group-flush">
			    <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i> HDD 500M</li>
			    <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i> MySQL 50M</li>
			    <li class="list-group-item"><i class="fa fa-check" aria-hidden="true"></i> 일트래픽 500M</li>
			  </ul>
			</div>
		</div>

	</article><!-- .page-wrapper -->
</div><!-- /.bg-shade-gradient -->






<script type="text/javascript">

document.title = '플랜 선택 · 킴스큐';

function FormCheck(f)
{
	getIframeForAction(f); // 액션을 동적 iframe 으로 보냄
	return true;
}

</script>
