<!-- global css -->
<link href="/modules/member/pages/_desktop/join/_style.css" rel="stylesheet">

<style media="screen">
.custom-select.is-invalid, .form-control.is-invalid, .was-validated .custom-select:invalid, .was-validated .form-control:invalid {
	border-color: #dc3545;
}
</style>

<div class="jumbotron jumbotron-fluid bg-white">
  <div class="container text-center">
		<div class="display-3 mb-3 text-gray-light">
			<i class="fa fa-envelope-o" aria-hidden="true"></i>
		</div>
    <h1 class="h2">이메일 <mark>본인확인</mark>이 필요합니다.</h1>
    <p class="lead">
			킴스큐에 참여하기 전에 이메일을 통한 본인확인을 수행해야 합니다.<br>
			본인확인 링크가 담긴 이메일을 <code><?php echo $my['email'] ?></code>로 보내드렸습니다.
		</p>

		<p class="text-gray mt-4">혹시 이메일을 못받으셨다면, <a href="/settings/emails">확인메일 재발송</a> 및 <a href="/settings/emails">이메일 변경</a>을 수행해 주세요.</p>

  </div>
</div>





<script type="text/javascript">

document.title = '이메일 본인확인이 필요합니다 · 킴스큐';


</script>
