<article class="page-wrapper">

	<?php if (!$_HM['uid']): ?>
	<div class="mb-4">
		<h1>회원가입</h1>
		<p class="lead">웹사이트를 설계, 제작하고 서비스하는 가장 좋은 방법을 제공해 드립니다.</p>
	</div>
	<?php endif; ?>

	<div class="row">
		<div class="col-sm-8">

			<form id="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="c" value="<?php echo $c?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="front" value="<?php echo $front?>">
				<input type="hidden" name="a" value="join">
				<input type="hidden" name="check_id" value="0">
				<input type="hidden" name="check_pw" value="0">
				<input type="hidden" name="check_nic" value="0">
				<input type="hidden" name="check_email" value="0">

				<div class="form-group row">
			    <label class="col-sm-2 col-form-label">아이디 <span class="text-danger">*</span></label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="id" value="<?php echo $id ?>" onblur="sameCheck(this,'id-feedback');" autocapitalize="off">
						<div id="id-feedback"></div>
						<div class="invalid-feedback">아이디를 입력해 주세요.</div>
						<small class="form-text text-muted">4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.</small>
			    </div>
			  </div>

				<div class="form-group row">
			    <label class="col-sm-2 col-form-label">이름 <span class="text-danger">*</span></label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="name" id="name" value="" placeholder="실명을 입력해 주세요." autocomplete="off">
						<div class="invalid-feedback">이름을 입력해주세요.</div>
			    </div>
			  </div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">이메일 <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" onblur="sameCheck(this,'email-feedback');" placeholder="비밀번호 잊어버렸을 때 확인 받을 수 있습니다.">
						<div class="invalid-feedback" id="email-feedback">이메일을 입력해주세요.</div>
					</div>
				</div>

				<?php if($d['member']['form_nic']):?>
				<div class="form-group row">
			    <label class="col-sm-2 col-form-label">닉네임<?php if($d['member']['form_nic_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $nic?>" placeholder="닉네임을 입력해 주세요." onblur="sameCheck(this,'nic-feedback');">
						<div id="nic-feedback"></div>
						<div class="invalid-feedback">닉네임을 입력해주세요.</div>
						<small class="form-text text-muted">2~12자로 사용할 수 있습니다.</small>
			    </div>
			  </div>
				<?php endif?>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">비밀번호 <span class="text-danger">*</span></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="pw1" id="pw1" value="<?php echo $pw ?>" placeholder="" onblur="pw1Check();" autocomplete="off">
						<div class="invalid-feedback" id="pw1-feedback">비밀번호를 입력해주세요.</div>
						<small class="form-text text-muted">8~16자의 영문/숫자/특수문자중 2개이상의 조합으로 만드셔야 합니다.</small>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="pw2" id="pw2" placeholder="비밀번호를 한번더 입력해 주세요." onkeyup="pw2Check();" autocomplete="off">
						<div class="invalid-feedback" id="pw2-feedback">패스워드를 한번더 입력해 주세요.</div>
					</div>
				</div>


				<?php if($d['member']['form_tel1']):?>
			    <div class="form-group row">
			      <label class="col-sm-2 col-form-label">전화번호 <?php if($d['member']['form_tel1_required']):?><span class="text-danger">*</span><?php endif?></label>
			      <div class="col-sm-10">
			        <div class="form-inline">
			          <input type="text" name="tel1_1" value="" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
			      		<input type="text" name="tel1_2" value="" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
			      		<input type="text" name="tel1_3" value="" maxlength="4" size="4" class="form-control">
			          <div class="invalid-feedback">
			            전화번호를 입력해주세요.
			          </div>
			        </div><!-- /.form-inline -->

			      </div>
			    </div>
				<?php endif?>

				<?php if($d['member']['form_tel2']):?>
			    <div class="form-group row">
			      <label class="col-sm-2 col-form-label">휴대전화 <?php if($d['member']['form_tel2_required']):?><span class="text-danger">*</span><?php endif?></label>
			      <div class="col-sm-10">
			        <div class="form-inline">
			      		<input type="text" name="tel2_1" value="" maxlength="3" size="4" class="form-control"><span class="px-1">-</span>
			      		<input type="text" name="tel2_2" value="" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
			      		<input type="text" name="tel2_3" value="" maxlength="4" size="4" class="form-control">
			          <div class="custom-control custom-checkbox ml-3">
			            <input type="checkbox" class="custom-control-input" id="sms" name="sms" value="1"<?php if($my['sms']):?> checked="checked"<?php endif?>>
			            <label class="custom-control-label" for="sms">알림문자를 받겠습니다.</label>
			          </div>
			          <div class="invalid-feedback">
			            휴대전화 번호를 입력해주세요.
			          </div>
			        </div><!-- /.form-inline -->
			      </div>
			    </div>
				<?php endif?>

				<?php if($d['member']['form_birth']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">생년월일<?php if($d['member']['form_birth_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">

			      <div class="form-inline">
			        <select class="form-control custom-select" name="birth_1">
			      		<option value="">년도</option>
			      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
			      		<option value="<?php echo $i?>"<?php if(substr($i,-2)==substr($regis_jumin1,0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			    		<select class="form-control custom-select ml-2" name="birth_2">
			      		<option value="">월</option>
			      		<?php $birth_2=substr($my['birth2'],0,2)?>
			      		<?php for($i = 1; $i < 13; $i++):?>
			      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			    		<select class="form-control custom-select ml-2" name="birth_3">
			      		<option value="">일</option>
			      		<?php $birth_3=substr($my['birth2'],2,2)?>
			      		<?php for($i = 1; $i < 32; $i++):?>
			      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,4,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			        <div class="custom-control custom-checkbox ml-3">
			          <input type="checkbox" class="custom-control-input" name="birthtype" id="birthtype" value="1">
			          <label class="custom-control-label" for="birthtype">음력</label>
			        </div>
			        <div class="invalid-feedback">
			          생년월일을 지정해 주세요.
			        </div>
			      </div><!-- /.form-inline -->

			    </div>
			  </div>
				<?php endif?>


				<?php if($d['member']['form_sex']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">성별 <?php if($d['member']['form_sex_required']):?><span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">
			      <div class="custom-control custom-radio  custom-control-inline">
			        <input type="radio" id="sex_1" name="sex" class="custom-control-input" value="1"<?php if($regis_jumin2&&(substr($regis_jumin2,0,1)%2)==1):?> checked="checked"<?php endif?> >
			        <label class="custom-control-label" for="sex_1">남성</label>
			      </div>
			      <div class="custom-control custom-radio  custom-control-inline">
			        <input type="radio" id="sex_2" name="sex" class="custom-control-input" value="2"<?php if($regis_jumin2&&(substr($regis_jumin2,0,1)%2)==0):?> checked="checked"<?php endif?>>
			        <label class="custom-control-label" for="sex_2">여성</label>
			      </div>
			      <div class="invalid-feedback">
			        성별을 선택해 주세요.
			      </div>
			    </div>
			  </div>
				<?php endif?>


				<?php if($d['member']['form_addr']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">주소 <?php if($d['member']['form_addr_required']):?><span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">

			      <div id="addrbox">
			        <div class="form-row">
			         <div class="form-group col-3">
			           <input type="text" class="form-control" name="zip_1" value="" id="zip1" maxlength="5" size="5" readonly>
			         </div>
			         <div class="form-group col-6">
			           <button type="button" class="btn btn-light" role="button" onclick="openDaumPostcode();">우편번호찾기</button>
			         </div>
			       </div>
						 <input type="text" class="form-control mb-2" name="addr1" id="addr1" value="" readonly>
						 <input type="text" class="form-control mb-2" name="addr2" id="addr2" value="">
						 <div class="invalid-feedback">
							 주소를 입력해주세요.
						 </div>

			      </div><!-- /#addrbox -->

			      <?php if($d['member']['form_overseas']):?>
			      <div class="">
			        <?php if($my['addr0']=='해외'):?>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="overseas" name="overseas" value="1" checked="checked" onclick="overseasChk(this);">
			          <label class="custom-control-label" for="overseas" id="overseas_ment">해외거주자 입니다.</label>
			        </div>
			        <?php else:?>
			        <div class="custom-control custom-checkbox">
			          <input type="checkbox" class="custom-control-input" id="overseas" name="overseas" value="1" onclick="overseasChk(this);">
			          <label class="custom-control-label" for="overseas" id="overseas_ment">해외거주자일 경우 체크해 주세요.</label>
			        </div>
			        <?php endif?>
			      </div>
			      <?php endif?>

			      <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
			      <script>
			        function openDaumPostcode() {
			            new daum.Postcode({
			                oncomplete: function(data) {
			                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
			                    // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
			                    document.getElementById('zip1').value = data.zonecode;
			                    document.getElementById('addr1').value = data.address;
			                    //전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
			                    //아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
			                    //var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
			                    //document.getElementById('addr').value = addr;
			                    document.getElementById('addr2').focus();
			                }
			            }).open();
			          }
			      </script>

			    </div>
			  </div>
			  <?php endif?>


				<?php if($d['member']['form_bio']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">간단소개<?php if($d['member']['form_bio_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">
			      <textarea class="form-control" name="bio" rows="3" placeholder="간략한 소개글을 입력해주세요."><?php echo $my['bio']?></textarea>
			      <div class="invalid-feedback">
			        간단소개를 입력해 주세요.
			      </div>
			    </div>
			  </div>
			  <?php endif?>

			  <?php if($d['member']['form_home']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">홈페이지<?php if($d['member']['form_home_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="home" value="" placeholder="URL을 입력하세요.">
			      <div class="invalid-feedback">
			        홈페이지 주소를 입력해주세요.
			      </div>
			    </div>
			  </div>
			  <?php endif?>

			  <?php if($d['member']['form_job']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">직업<?php if($d['member']['form_job_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">
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
			  </div>
				<?php endif?>

				<?php if($d['member']['form_marr']):?>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">결혼기념일<?php if($d['member']['form_marr_required']):?> <span class="text-danger">*</span><?php endif?></label>
			    <div class="col-sm-10">

			      <div class="form-inline">

			        <select class="form-control custom-select" name="marr_1">
			      		<option value="">년도</option>
			      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
			      		<option value="<?php echo $i?>"><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			    		<select class="form-control custom-select ml-2" name="marr_2">
			      		<option value="">월</option>
			      		<?php for($i = 1; $i < 13; $i++):?>
			      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			    		<select class="form-control custom-select ml-2" name="marr_3">
			      		<option value="">일</option>
			      		<?php for($i = 1; $i < 32; $i++):?>
			      		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
			      		<?php endfor?>
			    		</select>
			        <div class="invalid-feedback">
			          결혼기념일을 입력해주세요.
			        </div>
			      </div><!-- /.form-inline -->
			    </div>
			  </div>
				<?php endif?>


				<button class="btn btn-primary js-submit" type="submit">
					<span class="not-loading">회원가입</span>
					<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 회원가입 중 ...</span>
				</button>

			</form>
		</div><!-- .page-main -->

		<div class="col-sm-4">
			웹사이트를 설계, 제작하고 서비스하는 가장 좋은 방법을 제공해 드립니다.
		</div>
	</div><!-- /.row -->

</article><!-- .page-wrapper -->


<script type="text/javascript">

var f = document.getElementById("memberForm");

function overseasChk(obj) {
	if (obj.checked == true)
	{
    $('#addrbox').addClass('d-none')
    $('#overseas_ment').text('해외거주자 입니다.')
	}
	else {
    $('#addrbox').removeClass('d-none')
    $('#overseas_ment').text('해외거주자일 경우 체크해 주세요.')
	}
}

function sameCheck(obj,layer) {
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


$('#memberForm').submit( function(event){

	if (f.check_id.value == '0')
	{
		f.id.classList.add('is-invalid')
		f.id.focus();
		return false;
	}
	if (f.name.value == '')
	{
		f.name.classList.add('is-invalid');
		f.name.focus();
		return false;
	}
	<?php if($d['member']['form_nic_required']):?>
	if (f.check_nic.value == '0')
	{
		f.nic.classList.add('is-invalid')
		f.nic.focus();
		return false;
	}
	<?php endif?>

	if (f.check_email.value == '0')
	{
		f.email.classList.add('is-invalid');
		f.email.focus();
		return false;
	}

	if (f.pw1.value == '')
	{
		f.pw1.classList.add('is-invalid');
		f.pw1.focus();
		return false;
	}
	if (f.pw2.value == '')
	{
		f.pw2.classList.add('is-invalid');
		f.pw2.focus();
		return false;
	}
	if (f.pw1.value != f.pw2.value)
	{
		alert('패스워드가 일치하지 않습니다.');
		f.pw1.focus();
		return false;
	}

	<?php if($d['member']['form_tel1']&&$d['member']['form_tel1_required']):?>
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

	<?php if($d['member']['form_tel2']&&$d['member']['form_tel2_required']):?>
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

	<?php if($d['member']['form_birth']&&$d['member']['form_birth_required']):?>
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

	<?php if($d['member']['form_sex']&&$d['member']['form_sex_required']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		f.sex.classList.add('is-invalid');
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_addr']&&$d['member']['form_addr_required']):?>
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

	<?php if($d['member']['form_bio']&&$d['member']['form_bio_required']):?>
	if (f.bio.value == '')
	{
		f.bio.classList.add('is-invalid');
		f.bio.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_home']&&$d['member']['form_home_required']):?>
	if (f.home.value == '')
	{
		f.home.classList.add('is-invalid');
		f.home.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_job']&&$d['member']['form_job_required']):?>
	if (f.job.value == '')
	{
		f.job.classList.add('is-invalid');
		f.job.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_marr']&&$d['member']['form_marr_required']):?>
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
			return false;
		}

		pw2.classList.add('is-valid');
		pw2.classList.remove('is-invalid');
		getId(layer).innerHTML = '';

	 f.check_pw.value = '1';
	}

}

function _submit() {
	getIframeForAction(f);
	f.submit();
}




</script>
