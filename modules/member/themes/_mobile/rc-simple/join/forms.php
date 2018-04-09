<form class="content-padded" id="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $m?>">
	<input type="hidden" name="front" value="<?php echo $front?>">
	<input type="hidden" name="a" value="join">
	<input type="hidden" name="check_id" value="0">
	<input type="hidden" name="check_pw" value="0">
	<input type="hidden" name="check_nic" value="0">
	<input type="hidden" name="check_email" value="0">


<!-- 아이디 -->
<section id="page-id" class="page center">
	<header class="bar bar-nav bar-dark bg-primary px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
      <li class="nav-item">
        <span class="badge badge-pill badge-default">1</span>
		    <a class="nav-link">약관</a>
		  </li>
		  <li class="nav-item active">
        <span class="badge badge-pill badge-default">2</span>
		    <a class="nav-link">아이디</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">3</span>
		    <a class="nav-link">암호</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">4</span>
		    <a class="nav-link">이름</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">5</span>
		    <a class="nav-link">이메일</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">6</span>
		    <a class="nav-link">닉네임</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">7</span>
		    <a class="nav-link">완료</a>
		  </li>
		</ul>
	</div>
	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-secondary btn-block" data-toggle="page" data-start="#page-id" data-target="#page-pw" disabled id="page-id-next">
					다음
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="form-group content-padded animated fadeInUp delay-1">
			<label>아이디 <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="id" value="<?php echo $id ?>" maxlength="10" onkeyup="sameCheck(this,'id-feedback');" autocapitalize="off" autocomplete="off">
			<div id="id-feedback"></div>
			<div class="invalid-feedback" id="id-feedback">아이디를 입력해 주세요.</div>
			<small class="form-text text-muted">4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.</small>
		</div>
	</main>
</section><!-- /아이디 -->

<!-- 패스워드 -->
<section id="page-pw" class="page right">
	<header class="bar bar-nav bar-dark bg-inverse px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
      <li class="nav-item">
        <span class="badge badge-pill badge-default">1</span>
		    <a class="nav-link">약관</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">2</span>
		    <a class="nav-link">아이디</a>
		  </li>
		  <li class="nav-item active">
        <span class="badge badge-pill badge-default">3</span>
		    <a class="nav-link">암호</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">4</span>
		    <a class="nav-link">이름</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">5</span>
		    <a class="nav-link">이메일</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">6</span>
		    <a class="nav-link">닉네임</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">7</span>
		    <a class="nav-link">완료</a>
		  </li>
		</ul>
	</div>
	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-secondary btn-block" data-toggle="page" data-start="#page-pw" data-target="#page-name" disabled id="page-pw-next">
					다음
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="content-padded">
			<div class="form-group">
				<label>비밀번호 <span class="text-danger">*</span></label>
				<input type="password" class="form-control" name="pw1" id="pw1" value="<?php echo $pw ?>" placeholder="" onkeyup="pw1Check();" autocomplete="off">
	      <div class="valid-feedback" id="pw1-feedback">비밀번호를 입력해주세요.</div>
				<small class="form-text text-muted">8~16자의 영문/숫자/특수문자중 2개이상의 조합으로 만드셔야 합니다.</small>
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="pw2" id="pw2" placeholder="비밀번호를 한번더 입력해 주세요." onkeyup="pw2Check();" autocomplete="off">
				<div class="invalid-feedback" id="pw2-feedback">패스워드를 한번더 입력해 주세요.</div>
			</div>
		</div>
	</main>
</section><!-- /패스워드 -->

<!-- 이름 -->
<section id="page-name" class="page right">
	<header class="bar bar-nav bar-dark bg-inverse px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
      <li class="nav-item">
        <span class="badge badge-pill badge-default">1</span>
		    <a class="nav-link">약관</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">2</span>
		    <a class="nav-link">아이디</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">3</span>
		    <a class="nav-link">암호</a>
		  </li>
		  <li class="nav-item active">
        <span class="badge badge-pill badge-default">4</span>
		    <a class="nav-link">이름</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">5</span>
		    <a class="nav-link">이메일</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">6</span>
		    <a class="nav-link">닉네임</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">7</span>
		    <a class="nav-link">완료</a>
		  </li>
		</ul>
	</div>
	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-secondary btn-block" data-toggle="page" data-start="#page-name" data-target="#page-email" disabled id="page-name-next">
					다음
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="content-padded">
			<div class="form-group">
		    <label>이름(실명) <span class="text-danger">*</span></label>
		    <input type="text" class="form-control" name="name" value="" maxlength="10" autocomplete="off" onkeyup="formCheck(this,'name-feedback');">
				<div class="invalid-feedback" id="name-feedback">이름을 입력해주세요.</div>
		  </div>
		</div>
	</main>
</section><!-- /이름 -->

<!-- 이메일 -->
<section id="page-email" class="page right">
	<header class="bar bar-nav bar-dark bg-inverse px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
      <li class="nav-item">
        <span class="badge badge-pill badge-default">1</span>
		    <a class="nav-link">약관</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">2</span>
		    <a class="nav-link">아이디</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">3</span>
		    <a class="nav-link">암호</a>
		  </li>
		  <li class="nav-item">
        <span class="badge badge-pill badge-default">4</span>
		    <a class="nav-link">이름</a>
		  </li>
			<li class="nav-item active">
        <span class="badge badge-pill badge-default">5</span>
		    <a class="nav-link">이메일</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">6</span>
		    <a class="nav-link">닉네임</a>
		  </li>
			<li class="nav-item">
        <span class="badge badge-pill badge-default">7</span>
		    <a class="nav-link">완료</a>
		  </li>
		</ul>
	</div>
	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-secondary btn-block" data-toggle="page" data-start="#page-email" data-target="#page-nic" disabled id="page-email-next">
					다음
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="content-padded">
			<div class="form-group">
				<label>이메일 <span class="text-danger">*</span></label>
				<input type="email" class="form-control" name="email" value="" onkeyup="sameCheck(this,'hLayeremail');" autocomplete="off">
	      <div class="valid-feedback" id="hLayeremail"></div>
				<div class="invalid-feedback">
	        이메일을 확인해 주세요.
	      </div>
			</div>
		</div>
	</main>
</section><!-- /이메일 -->

<!-- 닉네임 -->
<section id="page-nic" class="page right">
	<header class="bar bar-nav bar-dark bg-inverse px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
			<li class="nav-item">
				<span class="badge badge-pill badge-default">1</span>
				<a class="nav-link">약관</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">2</span>
				<a class="nav-link">아이디</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">3</span>
				<a class="nav-link">암호</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">4</span>
				<a class="nav-link">이름</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">5</span>
				<a class="nav-link">이메일</a>
			</li>
			<li class="nav-item active">
				<span class="badge badge-pill badge-default">6</span>
				<a class="nav-link">닉네임</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">7</span>
				<a class="nav-link">완료</a>
			</li>
		</ul>
	</div>
	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-secondary btn-block" data-toggle="page" data-start="#page-nic" data-target="#page-etc" disabled id="page-nic-next">
					다음
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="content-padded">
			<div class="form-group">
				<label>닉네임<?php if($d['member']['form_join_nic_required']):?> <span class="text-danger">*</span><?php endif?></label>
				<input type="text" class="form-control" name="nic" value="" maxlength="20" onkeyup="sameCheck(this,'hLayernic');" autocomplete="off">
				<div class="form-control-feedback" id="hLayernic"></div>
				<div class="invalid-feedback">
					닉네임을 입력해 주세요.
				</div>
				<small class="form-text text-muted">
	        사용하고 싶은 이름을 입력해 주세요 (8자이내 중복불가)
	      </small>
			</div>
		</div>
	</main>
</section><!-- /닉네임 -->

<!-- 기타 -->
<section id="page-etc" class="page right">
	<header class="bar bar-nav bar-dark bg-inverse px-0">
  	<a class="icon icon-home pull-left p-x-1" role="button" href="<?php  echo RW(0) ?>"></a>
  	<h1 class="title">회원가입</h1>
  </header>
	<div class="bar bar-standard bar-header-secondary rb-step bg-white">
		<ul class="nav nav-inline">
			<li class="nav-item">
				<span class="badge badge-pill badge-default">1</span>
				<a class="nav-link">약관</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">2</span>
				<a class="nav-link">아이디</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">3</span>
				<a class="nav-link">암호</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">4</span>
				<a class="nav-link">이름</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">5</span>
				<a class="nav-link">이메일</a>
			</li>
			<li class="nav-item">
				<span class="badge badge-pill badge-default">6</span>
				<a class="nav-link">닉네임</a>
			</li>
			<li class="nav-item active">
				<span class="badge badge-pill badge-default">7</span>
				<a class="nav-link">완료</a>
			</li>
		</ul>
	</div>

	<footer class="bar bar-footer bar-light bg-faded">
		<div class="row">
			<div class="col-xs-6">
				<button type="button" class="btn btn-secondary btn-block" data-history="back">이전</button>
			</div>
			<div class="col-xs-6 p-l-0">
				<button type="button" class="btn btn-primary btn-block js-submit">
					가입하기
				</button>
			</div>
		</div>
	</footer>
	<main class="content">
		<div class="content-padded">

			<?php if($d['member']['form_join_tel1']):?>
			<div class="form-group">
				<label>전화번호 <?php if($d['member']['form_join_tel1_required']):?><span class="text-danger">*</span><?php endif?></label>
				<?php $tel1=explode('-',$my['tel1'])?>
				<div class="row">
				  <div class="col-xs-4">
				    <input type="text" name="tel1_1" value="" maxlength="4" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
				  </div>
				  <div class="col-xs-4">
				    <input type="text" name="tel1_2" value="" maxlength="4" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
				  </div>
				  <div class="col-xs-4">
				    <input type="text" name="tel1_3" value="" maxlength="4" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
				  </div>
				</div>
			</div>
			<?php endif?>

			<?php if($d['member']['form_join_tel2']):?>
			<div class="form-group">
				<label>휴대전화 <?php if($d['member']['form_join_tel2_required']):?><span class="text-danger">*</span><?php endif?></label>
				<?php $tel2=explode('-',$my['tel2'])?>
				<div class="row m-b-1">
					<div class="col-xs-4">
						<input type="text" name="tel2_1" value="" maxlength="3" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<input type="text" name="tel2_2" value="" maxlength="4" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<input type="text" name="tel2_3" value="" maxlength="4" size="4" class="form-control">
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
				</div>
				<label class="custom-control custom-checkbox m-t-3">
				  <input type="checkbox" class="custom-control-input" name="sms" value="1"<?php if($my['sms']):?> checked="checked"<?php endif?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">알림문자를 받겠습니다.</span>
				</label>
			</div>
			<?php endif?>

			<?php if($d['member']['form_join_birth']):?>
			<div class="form-group">
				<label>생년월일 <?php if($d['member']['form_join_birth_required']):?> <span class="text-danger">*</span><?php endif?></label>
				<?php $tel2=explode('-',$my['tel2'])?>
				<div class="row m-b-1">
					<div class="col-xs-4">
						<select class="form-control custom-select" name="birth_1">
		      		<option value="">년도</option>
		      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
		      		<option value="<?php echo $i?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<select class="form-control custom-select" name="birth_2">
		      		<option value="">월</option>
		      		<?php $birth_2=substr($my['birth2'],0,2)?>
		      		<?php for($i = 1; $i < 13; $i++):?>
		      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<select class="form-control custom-select" name="birth_3">
		      		<option value="">일</option>
		      		<?php $birth_3=substr($my['birth2'],2,2)?>
		      		<?php for($i = 1; $i < 32; $i++):?>
		      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
				</div>
				<label class="custom-control custom-checkbox m-t-3">
					<input type="checkbox" class="custom-control-input" name="birthtype" id="birthtype" value="1"<?php if($my['birthtype']):?> checked="checked"<?php endif?>>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">음력</span>
				</label>
			</div>
			<?php endif?>

			<?php if($d['member']['form_join_sex']):?>
			<div class="form-group">
				<label>성별 <?php if($d['member']['form_join_sex_required']):?><span class="text-danger">*</span><?php endif?></label>
				<div class="form-group">
					<label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="sex" class="custom-control-input" value="1">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">남자</span>
					</label>
					<label class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" name="sex" class="custom-control-input" value="2">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">여자</span>
					</label>
				</div>
			</div>
			<?php endif?>

			<!-- 주소 -->
			<?php if($d['member']['form_join_addr']):?>
			<div class="form-group">
				<label>주소 <?php if($d['member']['form_join_addr_required']):?><span class="text-danger">*</span><?php endif?></label>
				<div id="addrbox">
					<div class="input-group" style="margin-bottom: 5px">
						<input type="number" class="form-control" value="" name="zip_1" id="zip1" placeholder="" readonly>
						<span class="input-group-btn">
							<button class="btn btn-secondary" type="button" id="execDaumPostcode">
								<i class="fa fa-search"></i>우편번호
							</button>
						</span>
					</div>
					<input class="form-control" type="text" value="" name="addr1" id="addr1" readonly placeholder="우편번호를 선택" style="margin-bottom: 5px">
					<input class="form-control" type="text" value="" name="addr2" id="addr2" style="margin-bottom: 5px" placeholder="상세 주소를 입력">
					<div class="invalid-feedback">
						주소를 입력해주세요.
					</div>
				</div>

				<?php if($d['member']['form_join_overseas']):?>
	      <div class="m-t-1">
					<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" name="overseas" value="1" onclick="overseasChk(this);">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description" id="overseas_ment">해외거주자일 경우 체크해 주세요.</span>
					</label>
	      </div>
	      <?php endif?>

			</div><!-- /.form-group -->

			<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<script>
			$(document).on('click','#execDaumPostcode',function(){
		    // 우편번호 찾기 화면을 넣을 element
		    var element_wrap = document.getElementById('postLayer');

		    function execDaumPostcode() {
		        new daum.Postcode({
		             oncomplete: function(data) {
		               // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
		               // 각 주소의 노출 규칙에 따라 주소를 조합한다.
		               // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
		               var fullAddr = data.address; // 최종 주소 변수
		               var extraAddr = ''; // 조합형 주소 변수

		               // 기본 주소가 도로명 타입일때 조합한다.
		               if(data.addressType === 'R'){
		                   //법정동명이 있을 경우 추가한다.
		                   if(data.bname !== ''){
		                       extraAddr += data.bname;
		                   }
		                   // 건물명이 있을 경우 추가한다.
		                   if(data.buildingName !== ''){
		                       extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
		                   }
		                   // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
		                   fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
		               }

		               // 우편번호와 주소 정보를 해당 필드에 넣는다.
		               document.getElementById('zip1').value = data.zonecode; //5자리 새우편번호 사용
		               document.getElementById('addr1').value = fullAddr;
		               $('#modal-DaumPostcode').removeClass('active')  // 우편번호 검색모달을 숨김
		             },

		             // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
		             width : '100%',
		             height : '100%'
		         }).embed(element_wrap);
		         // element_wrap.style.display = 'block';
		        $('#modal-DaumPostcode').modal('show')
		    }
		    execDaumPostcode()

		  })
			</script>
			<?php endif?>

			<?php if($d['member']['form_join_bio']):?>
		  <div class="form-group">
		    <label>간단소개 <?php if($d['member']['form_join_bio_required']):?> <span class="text-danger">*</span><?php endif?></label>
		    <textarea class="form-control" name="bio" rows="3" placeholder="간략한 소개글을 입력해주세요."></textarea>
				<div class="invalid-feedback">
					간단소개를 입력해 주세요.
				</div>
		  </div>
			<?php endif?>

			<?php if($d['member']['form_join_home']):?>
			<div class="form-group">
		    <label>홈페이지<?php if($d['member']['form_join_home_required']):?> <span class="text-danger">*</span><?php endif?></label>
		    <input type="text" class="form-control" name="home" value="" placeholder="URL을 입력하세요.">
				<div class="invalid-feedback">
					홈페이지 주소를 입력해주세요.
				</div>
		  </div>
			<?php endif?>

			<?php if($d['member']['form_join_job']):?>
		  <div class="form-group">
		    <label>직업<?php if($d['member']['form_join_job_required']):?> <span class="text-danger">*</span><?php endif?></label>
		    <select class="form-control custom-select" name="job">
					<option value="">&nbsp;+ 선택하세요</option>
	    		<option value="" disabled>------------------</option>
	        <?php
	        $g['memberJobVarForSite'] = $g['path_var'].'site/'.$r.'/member.job.txt';
	      	$_tmpvfile = file_exists($g['memberJobVarForSite']) ? $g['memberJobVarForSite'] : $g['path_module'].$module.'/var/member.job.txt';
	        $_job=file($_tmpvfile);
	        ?>
	    		<?php foreach($_job as $_val):?>
	    		<option value="<?php echo trim($_val)?>">ㆍ<?php echo trim($_val)?></option>
	    		<?php endforeach?>
		    </select>
				<div class="invalid-feedback">
					직업을 선택해 주세요.
				</div>
		  </div>
			<?php endif?>

			<?php if($d['member']['form_join_marr']):?>
			<div class="form-group">
				<label>결혼기념일 <?php if($d['member']['form_join_marr_required']):?> <span class="text-danger">*</span><?php endif?></label>
				<?php $tel2=explode('-',$my['tel2'])?>
				<div class="row m-b-1">
					<div class="col-xs-4">
						<select class="form-control custom-select" name="marr_1">
							<option value="">년도</option>
		      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
		      		<option value="<?php echo $i?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<select class="form-control custom-select" name="marr_2">
							<option value="">월</option>
		      		<?php for($i = 1; $i < 13; $i++):?>
		      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
					<div class="col-xs-4">
						<select class="form-control custom-select" name="marr_3">
							<option value="">일</option>
		      		<?php for($i = 1; $i < 32; $i++):?>
		      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		      		<?php endfor?>
		    		</select>
						<div class="invalid-feedback">
							입력필요
						</div>
					</div>
				</div>
			</div>
			<?php endif?>

		</div>
	</main>
</section><!-- /기타 -->

</form>


<!-- Modal -->
<div id="modal-DaumPostcode" class="modal">
	<header class="bar bar-nav bar-light bg-faded px-0">
		<a class="icon icon-close pull-right p-x-1" data-history="back" role="button"></a>
		<h1 class="title">우편번호 검색</h1>
	</header>
	<div class="content" id="postLayer">
	</div>
</div>

<script>

var f = document.getElementById("memberForm");

function formCheck(obj,layer) {

  if (f.check_id.value == '0')
  {
    f.id.classList.add('is-invalid')
    f.id.focus();
    return false;
  }

	if (obj.name == 'name') {
	  if (obj.value.length < 2 || obj.value.length > 12)
	  {
	    f.name.classList.add('is-invalid');
			$('#page-name-next').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true)
			f.name.focus();
	    return false;
	  }
		$('#page-name-next').addClass('btn-primary').removeClass('btn-secondary').attr('disabled',false)
		f.name.classList.remove('is-invalid');
		f.name.focus();
	}


  <?php if($d['member']['form_join_nic_required']):?>
	if (obj.name == 'nic') {
	  if (f.check_nic.value == '0')
	  {
	    f.nic.classList.add('is-invalid')
	    return false;
	  }
	}
  <?php endif?>

	if (obj.name == 'email') {
	  if (f.check_email.value == '0')
	  {
	    f.email.classList.add('is-invalid');
	    return false;
	  }
	}

	if (obj.name == 'pw1') {
	  if (f.pw1.value == '')
	  {
	    f.pw1.classList.add('is-invalid');
	    f.pw1.focus();
	    return false;
	  }
	}

	if (obj.name == 'pw2') {
  	if (f.pw2.value == '')
	  {
	    f.pw2.classList.add('is-invalid');
	    f.pw2.focus();
	    return false;
	  }
	}

	if (obj.name == 'pw1' || obj.name == 'pw2') {
	  if (f.pw1.value != f.pw2.value)
	  {
	    alert('패스워드가 일치하지 않습니다.');
	    f.pw1.focus();
	    return false;
	  }
	}

}


function overseasChk(obj)
{
	if (obj.checked == true)
	{
    $('#addrbox').addClass('hidden')
    $('#overseas_ment').text('해외거주자 입니다.')
	}
	else {
    $('#addrbox').removeClass('hidden')
    $('#overseas_ment').text('해외거주자일 경우 체크해 주세요.')
	}
}

function sameCheck(obj,layer) {
	if (!obj.value)
	{
		eval('obj.form.check_'+obj.name).value = '0';
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
				$('#page-id-next').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true)
				return false;
			}
			$('#page-id-next').addClass('btn-primary').removeClass('btn-secondary').attr('disabled',false)
		}
		if (obj.name == 'email')
		{
			if (!chkEmailAddr(obj.value))
			{
				obj.form.check_email.value = '0';
				obj.focus();
				obj.classList.add('is-invalid');
				getId(layer).innerHTML = '이메일형식이 아닙니다.';
				$('#page-email-next').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true)
				return false;
			}
			$('#page-email-next').addClass('btn-primary').removeClass('btn-secondary').attr('disabled',false)
		}
		if (obj.name == 'nic')
		{
			if (obj.value.length < 2 || obj.value.length > 12 )
			{
				f.check_nic.value = '0';
				setTimeout(function() {
					// obj.focus();
				}, 0);
				f.classList.remove('was-validated');
				obj.classList.add('is-invalid');
				obj.classList.remove('is-valid');
				getId(layer).innerHTML = '사용할 수 없는 닉네임 입니다.';
				$('#page-nic-next').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true)
				return false;
			}
			$('#page-nic-next').addClass('btn-primary').removeClass('btn-secondary').attr('disabled',false)
		}

		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&device=mobile&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;


	}
}


$('#memberForm').submit( function(event){

  <?php if($d['member']['form_join_tel1']&&$d['member']['form_join_tel1_required']):?>
	if (f.tel1_1.value == '')
	{
		f.tel1_1.classList.add('is-invalid');
		f.tel1_1.focus();
		return false;
	}
	if (f.tel1_2.value == '')
	{
		f.tel1_2.classList.add('is-invalid');
		f.tel1_2.focus();
		return false;
	}
	if (f.tel1_3.value == '')
	{
		f.tel1_3.classList.add('is-invalid');
		f.tel1_3.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_join_tel2']&&$d['member']['form_join_tel2_required']):?>
	if (f.tel2_1.value == '')
	{
		f.tel2_1.classList.add('is-invalid');
		f.tel2_1.focus();
		return false;
	}
	if (f.tel2_2.value == '')
	{
		f.tel2_2.classList.add('is-invalid');
		f.tel2_2.focus();
		return false;
	}
	if (f.tel2_3.value == '')
	{
		f.tel2_3.classList.add('is-invalid');
		f.tel2_3.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_birth']&&$d['member']['form_join_birth_required']):?>
	if (f.birth_1.value == '')
	{
		f.birth_1.classList.add('is-invalid');
		f.birth_1.focus();
		return false;
	}
	if (f.birth_2.value == '')
	{
		f.birth_2.classList.add('is-invalid');
		f.birth_2.focus();
		return false;
	}
	if (f.birth_3.value == '')
	{
		f.birth_3.classList.add('is-invalid');
		f.birth_3.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_sex']&&$d['member']['form_join_sex_required']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		f.sex.classList.add('is-invalid');
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_addr']&&$d['member']['form_join_addr_required']):?>
  if (!f.overseas || f.overseas.checked == false)
  {
    if (f.addr1.value == ''||f.addr2.value == '')
    {
      f.addr2.classList.add('is-invalid');
      f.addr2.focus();
      return false;
    }
  }
  <?php endif?>

  <?php if($d['member']['form_join_bio']&&$d['member']['form_join_bio_required']):?>
	if (f.bio.value == '')
	{
    f.bio.classList.add('is-invalid');
		f.bio.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_home']&&$d['member']['form_join_home_required']):?>
	if (f.home.value == '')
	{
    f.home.classList.add('is-invalid');
		f.home.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_job']&&$d['member']['form_join_job_required']):?>
	if (f.job.value == '')
	{
    f.job.classList.add('is-invalid');
		f.job.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_join_marr']&&$d['member']['form_join_marr_required']):?>
	if (f.marr_1.value == '')
	{
    f.marr_1.classList.add('is-invalid');
		f.marr_1.focus();
		return false;
	}
	if (f.marr_2.value == '')
	{
    f.marr_2.classList.add('is-invalid');
		f.marr_2.focus();
		return false;
	}
	if (f.marr_3.value == '')
	{
    f.marr_3.classList.add('is-invalid');
		f.marr_3.focus();
		return false;
	}
	<?php endif?>

	if (f.check_id.value == '0' || f.check_email.value == '0' || f.check_pw.value == '0') {
		event.preventDefault();
		event.stopPropagation();
	}

  $('.js-submit').attr("disabled",true);

	$.loader({
	  text: "가입중..."
	});

  setTimeout("_submit();",500);
	event.preventDefault();
  event.stopPropagation();
  }
);

function pw1Check(){
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

function pw2Check(){
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
			$('#page-pw-next').addClass('btn-secondary').removeClass('btn-primary').attr('disabled',true)
			return false;
		}

		pw2.classList.add('is-valid');
		pw2.classList.remove('is-invalid');
		getId(layer).innerHTML = '';
	 f.check_pw.value = '1';
	 $('#page-pw-next').addClass('btn-primary').removeClass('btn-secondary').attr('disabled',false)
	}

}

$(".js-submit").click(function() {
	$('#memberForm').submit()
});

function _submit(){
	getIframeForAction(f);
	f.submit();
}


</script>
