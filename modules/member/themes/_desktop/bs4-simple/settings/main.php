<h1 class="mb-4">개인정보 수정</h1>

<form name="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="m" value="<?php echo $m?>">
  <input type="hidden" name="front" value="<?php echo $front?>">
  <input type="hidden" name="a" value="info_update">
  <input type="hidden" name="act" value="info">
  <input type="hidden" name="check_nic" value="<?php echo $my['nic']?1:0?>">
	<input type="hidden" name="check_email" value="<?php echo $my['email']?1:0?>">

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">아이디</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" value="<?php echo $my['id'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">이름(실명) <span class="text-danger">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value="<?php echo $my['name']?>" maxlength="10" required>
    </div>
  </div>

  <?php if($d['member']['form_nic']):?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">닉네임<?php if($d['member']['form_nic_required']):?> <span class="text-danger">*</span><?php endif?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nic" value="<?php echo $my['nic']?>"  maxlength="20" required onblur="sameCheck(this,'hLayernic');">
      <div class="valid-feedback" id="hLayernic"></div>
      <small class="form-text text-muted">
        웹사이트에서 사용하고 싶은 이름을 입력해 주세요 (8자이내 중복불가)
      </small>
    </div>
  </div>
  <?php endif?>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">이메일 <span class="text-danger">*</span></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="email" value="<?php echo $my['email']?>" required onblur="sameCheck(this,'hLayeremail');">
      <div class="valid-feedback" id="hLayeremail"></div>
      <small class="form-text text-muted">
      </small>
    </div>
  </div>

  <?php if($d['member']['form_tel1']):?>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">전화번호 <?php if($d['member']['form_tel1_required']):?><span class="text-danger">*</span><?php endif?></label>
      <div class="col-sm-10">
        <?php $tel1=explode('-',$my['tel1'])?>
        <div class="form-inline">
          <input type="text" name="tel1_1" value="<?php echo $tel1[0]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
      		<input type="text" name="tel1_2" value="<?php echo $tel1[1]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
      		<input type="text" name="tel1_3" value="<?php echo $tel1[2]?>" maxlength="4" size="4" class="form-control">
        </div><!-- /.form-inline -->

      </div>
    </div>
	<?php endif?>

  <?php if($d['member']['form_tel2']):?>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">휴대전화 <?php if($d['member']['form_tel2_required']):?><span class="text-danger">*</span><?php endif?></label>
      <div class="col-sm-10">
        <?php $tel2=explode('-',$my['tel2'])?>
        <div class="form-inline">
      		<input type="text" name="tel2_1" value="<?php echo $tel2[0]?>" maxlength="3" size="4" class="form-control"><span class="px-1">-</span>
      		<input type="text" name="tel2_2" value="<?php echo $tel2[1]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
      		<input type="text" name="tel2_3" value="<?php echo $tel2[2]?>" maxlength="4" size="4" class="form-control">

          <div class="custom-control custom-checkbox ml-3">
            <input type="checkbox" class="custom-control-input" id="sms" name="sms" value="1"<?php if($my['sms']):?> checked="checked"<?php endif?> >
            <label class="custom-control-label" for="sms">알림문자를 받겠습니다.</label>
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
      		<option value="<?php echo $i?>"<?php if($my['birth1']==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>
    		<select class="form-control custom-select ml-2" name="birth_2">
      		<option value="">월</option>
      		<?php $birth_2=substr($my['birth2'],0,2)?>
      		<?php for($i = 1; $i < 13; $i++):?>
      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_2==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>
    		<select class="form-control custom-select ml-2" name="birth_3">
      		<option value="">일</option>
      		<?php $birth_3=substr($my['birth2'],2,2)?>
      		<?php for($i = 1; $i < 32; $i++):?>
      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_3==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>

        <div class="custom-control custom-checkbox ml-3">
          <input type="checkbox" class="custom-control-input" name="birthtype" id="birthtype" value="1"<?php if($my['birthtype']):?> checked="checked"<?php endif?>>
          <label class="custom-control-label" for="birthtype">음력</label>
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
        <input type="radio" id="sex_1" name="sex" class="custom-control-input" value="1"<?php if($my['sex']==1):?> checked="checked"<?php endif?>>
        <label class="custom-control-label" for="sex_1">남성</label>
      </div>
      <div class="custom-control custom-radio  custom-control-inline">
        <input type="radio" id="sex_2" name="sex" class="custom-control-input" value="2"<?php if($my['sex']==2):?> checked="checked"<?php endif?>>
        <label class="custom-control-label" for="sex_2">여성</label>
      </div>
    </div>
  </div>
	<?php endif?>

  <?php if($d['member']['form_addr']):?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">주소 <?php if($d['member']['form_addr_required']):?><span class="text-danger">*</span><?php endif?></label>
    <div class="col-sm-10">

      <div id="addrbox"<?php if($my['addr0']=='해외'):?> class="d-none"<?php endif?>>
        <div class="form-row">
         <div class="form-group col-3">
           <input type="text" class="form-control" name="zip_1" value="<?php echo substr($my['zip'],0,5)?>" id="zip1" maxlength="5" size="5" readonly>
         </div>
         <div class="form-group col-6">
           <button type="button" class="btn btn-light" role="button" onclick="openDaumPostcode();">우편번호찾기</button>
         </div>
       </div>

        <div class="form-row">
         <div class="form-group col-6">
           <input type="text" class="form-control" name="addr1" id="addr1" value="<?php echo $my['addr1']?>" readonly>
         </div>
         <div class="form-group col-6">
           <input type="text" class="form-control" name="addr2" id="addr2" value="<?php echo $my['addr2']?>">
         </div>
       </div>
      </div><!-- /#addrbox -->

      <?php if($d['member']['form_overseas']):?>
      <div class="remail shift">
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
    </div>
  </div>
  <?php endif?>

  <?php if($d['member']['form_home']):?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">홈페이지<?php if($d['member']['form_home_required']):?> <span class="text-danger">*</span><?php endif?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="home" value="<?php echo $my['home']?>" placeholder="URL을 입력하세요.">
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
    		<option value="<?php echo trim($_val)?>"<?php if(trim($_val)==$my['job']):?> selected="selected"<?php endif?>>ㆍ<?php echo trim($_val)?></option>
    		<?php endforeach?>
  		</select>
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
      		<option value="<?php echo $i?>"<?php if($i==$my['marr1']):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>
    		<select class="form-control custom-select ml-2" name="marr_2">
      		<option value="">월</option>
      		<?php for($i = 1; $i < 13; $i++):?>
      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>
    		<select class="form-control custom-select ml-2" name="marr_3">
      		<option value="">일</option>
      		<?php for($i = 1; $i < 32; $i++):?>
      		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
      		<?php endfor?>
    		</select>
      </div><!-- /.form-inline -->
    </div>
  </div>
	<?php endif?>

  <div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
      <button type="submit" class="btn btn-primary">수정하기</button>
    </div>
  </div>
</form>


<script>

putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

function overseasChk(obj)
{
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


function saveCheck(f)
{
	<?php if($d['member']['form_nic_required']):?>
	if (f.check_nic.value == '0')
	{
		alert('닉네임을 확인해 주세요.');
		f.nic.focus();
		return false;
	}
	<?php endif?>

	if (f.check_email.value == '0')
	{
		alert('이메일을 확인해 주세요.');
		f.email.focus();
		return false;
	}

  <?php if($d['member']['form_tel1']&&$d['member']['form_tel1_required']):?>
	if (f.tel1_1.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_1.focus();
		return false;
	}
	if (f.tel1_2.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_2.focus();
		return false;
	}
	if (f.tel1_3.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_3.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_tel2']&&$d['member']['form_tel2_required']):?>
	if (f.tel2_1.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_1.focus();
		return false;
	}
	if (f.tel2_2.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_2.focus();
		return false;
	}
	if (f.tel2_3.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_3.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_birth']&&$d['member']['form_birth_required']):?>
	if (f.birth_1.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_1.focus();
		return false;
	}
	if (f.birth_2.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_2.focus();
		return false;
	}
	if (f.birth_3.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_3.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_sex']&&$d['member']['form_sex_required']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		alert('성별을 선택해 주세요.  ');
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_addr']&&$d['member']['form_addr_required']):?>
  if (!f.overseas || f.overseas.checked == false)
  {
    if (f.addr1.value == ''||f.addr2.value == '')
    {
      alert('주소를 입력해 주세요.');
      f.addr2.focus();
      return false;
    }
  }
  <?php endif?>

  <?php if($d['member']['form_bio']&&$d['member']['form_bio_required']):?>
	if (f.bio.value == '')
	{
		alert('간단소개를 입력해 주세요.');
		f.bio.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_home']&&$d['member']['form_home_required']):?>
	if (f.home.value == '')
	{
		alert('홈페이지 주소를 입력해 주세요.');
		f.home.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_job']&&$d['member']['form_job_required']):?>
	if (f.job.value == '')
	{
		alert('직업을 선택해 주세요.');
		f.job.focus();
		return false;
	}
	<?php endif?>

  <?php if($d['member']['form_marr']&&$d['member']['form_marr_required']):?>
	if (f.marr_1.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_1.focus();
		return false;
	}
	if (f.marr_2.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_2.focus();
		return false;
	}
	if (f.marr_3.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_3.focus();
		return false;
	}
	<?php endif?>

	getIframeForAction(f);
	f.submit();
}

</script>
