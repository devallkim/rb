<header class="bar bar-nav bar-dark bg-inverse">
	<a class="icon icon-home pull-left" role="button" href="<?php  echo RW(0) ?>"></a>
	<h1 class="title">개인정보관리</h1>
</header>
<footer class="bar bar-footer bar-light bg-faded">
	<button class="btn btn-primary btn-block js-submit" type="button">
		수정하기
	</button>
</footer>

<main class="content">
	<form class="content-padded" id="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" autocomplete="off">
		<input type="hidden" name="r" value="<?php echo $r?>">
	  <input type="hidden" name="m" value="<?php echo $m?>">
	  <input type="hidden" name="front" value="<?php echo $front?>">
	  <input type="hidden" name="a" value="info_update">
	  <input type="hidden" name="act" value="info">
	  <input type="hidden" name="check_nic" value="<?php echo $my['nic']?1:0?>">
		<input type="hidden" name="check_email" value="<?php echo $my['email']?1:0?>">

		<div class="form-group">
	    <label>아이디</label>
			<p class="form-control-static"><?php echo $my['id'] ?></p>
	  </div>

	  <div class="form-group">
	    <label>이름(실명) <span class="text-danger">*</span></label>
	    <input type="text" class="form-control" name="name" value="<?php echo $my['name']?>" maxlength="10" required>
	  </div>

		<?php if($d['member']['form_settings_nic']):?>
		<div class="form-group">
			<label>닉네임<?php if($d['member']['form_settings_nic_required']):?> <span class="text-danger">*</span><?php endif?></label>
			<input type="text" class="form-control" name="nic" value="<?php echo $my['nic']?>"  maxlength="20" required onblur="sameCheck(this,'hLayernic');">
			<div class="form-control-feedback" id="hLayernic"></div>
			<div class="invalid-feedback">
				닉네임을 입력해 주세요.
			</div>
			<small class="form-text text-muted">
        사용하고 싶은 이름을 입력해 주세요 (8자이내 중복불가)
      </small>
		</div>
		<?php endif?>

		<div class="form-group">
			<label>이메일 <span class="text-danger">*</span></label>
			<input type="email" class="form-control" name="email" value="<?php echo $my['email']?>" required onblur="sameCheck(this,'hLayeremail');">
      <div class="valid-feedback" id="hLayeremail"></div>
			<div class="invalid-feedback">
        이메일을 확인해 주세요.
      </div>
		</div>

		<?php if($d['member']['form_settings_tel1']):?>
		<div class="form-group">
			<label>전화번호 <?php if($d['member']['form_settings_tel1_required']):?><span class="text-danger">*</span><?php endif?></label>
			<?php $tel1=explode('-',$my['tel1'])?>
			<div class="row">
			  <div class="col-xs-4">
			    <input type="text" name="tel1_1" value="<?php echo $tel1[0]?>" maxlength="4" size="4" class="form-control">
					<div class="invalid-feedback">
						입력필요
					</div>
			  </div>
			  <div class="col-xs-4">
			    <input type="text" name="tel1_2" value="<?php echo $tel1[1]?>" maxlength="4" size="4" class="form-control">
					<div class="invalid-feedback">
						입력필요
					</div>
			  </div>
			  <div class="col-xs-4">
			    <input type="text" name="tel1_3" value="<?php echo $tel1[2]?>" maxlength="4" size="4" class="form-control">
					<div class="invalid-feedback">
						입력필요
					</div>
			  </div>
			</div>
		</div>
		<?php endif?>

		<?php if($d['member']['form_settings_tel2']):?>
		<div class="form-group">
			<label>휴대전화 <?php if($d['member']['form_settings_tel2_required']):?><span class="text-danger">*</span><?php endif?></label>
			<?php $tel2=explode('-',$my['tel2'])?>
			<div class="row m-b-1">
				<div class="col-xs-4">
					<input type="text" name="tel2_1" value="<?php echo $tel2[0]?>" maxlength="3" size="4" class="form-control">
					<div class="invalid-feedback">
						입력필요
					</div>
				</div>
				<div class="col-xs-4">
					<input type="text" name="tel2_2" value="<?php echo $tel2[1]?>" maxlength="4" size="4" class="form-control">
					<div class="invalid-feedback">
						입력필요
					</div>
				</div>
				<div class="col-xs-4">
					<input type="text" name="tel2_3" value="<?php echo $tel2[2]?>" maxlength="4" size="4" class="form-control">
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

		<?php if($d['member']['form_settings_birth']):?>
		<div class="form-group">
			<label>생년월일 <?php if($d['member']['form_settings_birth_required']):?> <span class="text-danger">*</span><?php endif?></label>
			<?php $tel2=explode('-',$my['tel2'])?>
			<div class="row m-b-1">
				<div class="col-xs-4">
					<select class="form-control custom-select" name="birth_1">
	      		<option value="">년도</option>
	      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
	      		<option value="<?php echo $i?>"<?php if($my['birth1']==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
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
	      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_2==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
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
	      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_3==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
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

		<?php if($d['member']['form_settings_sex']):?>
		<div class="form-group">
			<label>성별 <?php if($d['member']['form_settings_sex_required']):?><span class="text-danger">*</span><?php endif?></label>
			<div class="form-group">
				<label class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" name="sex" class="custom-control-input" value="1"<?php if($my['sex']==1):?> checked="checked"<?php endif?>>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">남자</span>
				</label>
				<label class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" name="sex" class="custom-control-input" value="2"<?php if($my['sex']==2):?> checked="checked"<?php endif?>>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">여자</span>
				</label>
			</div>
		</div>
		<?php endif?>

		<!-- 주소 -->
		<?php if($d['member']['form_settings_addr']):?>
		<div class="form-group">
			<label>주소 <?php if($d['member']['form_settings_addr_required']):?><span class="text-danger">*</span><?php endif?></label>
			<div id="addrbox"<?php if($my['addr0']=='해외'):?> class="hidden"<?php endif?>>
				<div class="input-group" style="margin-bottom: 5px">
					<input type="number" class="form-control" name="zip_1" value="<?php echo substr($my['zip'],0,5)?>" id="zip1" placeholder="" readonly>
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="button" onclick="openDaumPostcode();">
							<i class="fa fa-search"></i>우편번호
						</button>
					</span>
				</div>
				<input class="form-control" type="text" value="<?php echo $my['addr1']?>" name="addr1" id="addr1" readonly placeholder="우편번호를 선택" style="margin-bottom: 5px">
				<input class="form-control" type="text" value="<?php echo $my['addr2']?>" name="addr2" id="addr2" style="margin-bottom: 5px" placeholder="상세 주소를 입력">
				<div class="invalid-feedback">
					주소를 입력해주세요.
				</div>
			</div>

			<?php if($d['member']['form_settings_overseas']):?>
      <div class="m-t-1">
        <?php if($my['addr0']=='해외'):?>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" class="custom-control-input" name="overseas" value="1" checked="checked" onclick="overseasChk(this);">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description" id="overseas_ment">해외거주자 입니다.</span>
				</label>
        <?php else:?>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" class="custom-control-input" name="overseas" value="1" onclick="overseasChk(this);">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description" id="overseas_ment">해외거주자일 경우 체크해 주세요.</span>
				</label>
        <?php endif?>
      </div>
      <?php endif?>

		</div><!-- /.form-group -->

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
		<?php endif?>

		<?php if($d['member']['form_settings_bio']):?>
	  <div class="form-group">
	    <label>간단소개 <?php if($d['member']['form_settings_bio_required']):?> <span class="text-danger">*</span><?php endif?></label>
	    <textarea class="form-control" name="bio" rows="3" placeholder="간략한 소개글을 입력해주세요."><?php echo $my['bio']?></textarea>
			<div class="invalid-feedback">
				간단소개를 입력해 주세요.
			</div>
	  </div>
		<?php endif?>

		<?php if($d['member']['form_settings_home']):?>
		<div class="form-group">
	    <label>홈페이지<?php if($d['member']['form_settings_home_required']):?> <span class="text-danger">*</span><?php endif?></label>
	    <input type="text" class="form-control" name="home" value="<?php echo $my['home']?>" placeholder="URL을 입력하세요.">
			<div class="invalid-feedback">
				홈페이지 주소를 입력해주세요.
			</div>
	  </div>
		<?php endif?>

		<?php if($d['member']['form_settings_job']):?>
	  <div class="form-group">
	    <label>직업<?php if($d['member']['form_settings_job_required']):?> <span class="text-danger">*</span><?php endif?></label>
	    <select class="form-control custom-select" name="job">
				<option value="">&nbsp;+ 선택하세요</option>
    		<option value="" disabled>------------------</option>
        <?php
        $g['memberJobVarForSite'] = $g['path_var'].'site/'.$r.'/member.job.txt';
      	$_tmpvfile = file_exists($g['memberJobVarForSite']) ? $g['memberJobVarForSite'] : $g['path_module'].$module.'/var/member.job.txt';
        $_job=file($_tmpvfile);
        ?>
    		<?php foreach($_job as $_val):?>
    		<option value="<?php echo trim($_val)?>"<?php if(trim($_val)==$my['job']):?> selected="selected"<?php endif?>>ㆍ<?php echo trim($_val)?></option>
    		<?php endforeach?>
	    </select>
			<div class="invalid-feedback">
				직업을 선택해 주세요.
			</div>
	  </div>
		<?php endif?>

		<?php if($d['member']['form_settings_marr']):?>
		<div class="form-group">
			<label>결혼기념일 <?php if($d['member']['form_settings_marr_required']):?> <span class="text-danger">*</span><?php endif?></label>
			<?php $tel2=explode('-',$my['tel2'])?>
			<div class="row m-b-1">
				<div class="col-xs-4">
					<select class="form-control custom-select" name="marr_1">
						<option value="">년도</option>
	      		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
	      		<option value="<?php echo $i?>"<?php if($i==$my['marr1']):?> selected="selected"<?php endif?>><?php echo $i?></option>
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
	      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
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
	      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
	      		<?php endfor?>
	    		</select>
					<div class="invalid-feedback">
						입력필요
					</div>
				</div>
			</div>
		</div>
		<?php endif?>


	</form>
</main>


<script>

putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

var f = document.getElementById("memberForm");

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
		if (obj.name == 'email')
		{
			if (!chkEmailAddr(obj.value))
			{
				obj.form.check_email.value = '0';
				obj.focus();
				getId(layer).innerHTML = '이메일형식이 아닙니다.';
				return false;
			}
		}
		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
	}
}


$('#memberForm').submit( function(event){

  <?php if($d['member']['form_settings_nic_required']):?>
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

  <?php if($d['member']['form_settings_tel1']&&$d['member']['form_settings_tel1_required']):?>
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

	<?php if($d['member']['form_settings_tel2']&&$d['member']['form_settings_tel2_required']):?>
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

  <?php if($d['member']['form_settings_birth']&&$d['member']['form_settings_birth_required']):?>
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

  <?php if($d['member']['form_settings_sex']&&$d['member']['form_settings_sex_required']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		f.sex.classList.add('is-invalid');
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_settings_addr']&&$d['member']['form_settings_addr_required']):?>
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

  <?php if($d['member']['form_settings_bio']&&$d['member']['form_settings_bio_required']):?>
	if (f.bio.value == '')
	{
    f.bio.classList.add('is-invalid');
		f.bio.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_settings_home']&&$d['member']['form_settings_home_required']):?>
	if (f.home.value == '')
	{
    f.home.classList.add('is-invalid');
		f.home.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_settings_job']&&$d['member']['form_settings_job_required']):?>
	if (f.job.value == '')
	{
    f.job.classList.add('is-invalid');
		f.job.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_settings_marr']&&$d['member']['form_settings_marr_required']):?>
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
  $('.js-submit').attr("disabled",true);

	$.loader({
	  text: "저장중..."
	});

  setTimeout("_submit();",500);
	event.preventDefault();
  event.stopPropagation();
  }
);

$(".js-submit").click(function() {
	$('#memberForm').submit()
});

function _submit(){
	getIframeForAction(f);
	f.submit();
}

</script>
