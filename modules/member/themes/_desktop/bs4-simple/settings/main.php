<?php include_once $g['dir_module_skin'].'_header.php'?>

<div class="page-wrapper row">
  <nav class="col-3 page-nav">
    <?php include_once $g['dir_module_skin'].'_menu.php'?>
  </nav>
  <div class="col-9 page-main">

    <div class="subhead mt-0">
      <h2 class="subhead-heading">개인정보 관리</h2>
    </div>

    <?php if (!getloginExpired($my['last_log'],$d['member']['settings_expire'])): //로그인 후 경과시간 비교(분 ?>
    <?php include_once $g['dir_module_skin'].'_pwConfirm.php'?>
    <?php else: ?>

      <div class="clearfix">
        <form class="float-left" id="memberForm" role="form" action="<?php echo $g['s']?>/" method="post" style="width: 500px;">
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
              <input type="text" name="id" readonly class="form-control-plaintext" value="<?php echo $my['id'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">이름 <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" value="<?php echo $my['name']?>" maxlength="10" required>
            </div>
          </div>

          <?php if($d['member']['form_settings_nic']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">닉네임<?php if($d['member']['form_settings_nic_required']):?> <span class="text-danger">*</span><?php endif?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nic" value="<?php echo $my['nic']?>"  maxlength="20" onblur="sameCheck(this,'hLayernic');">
              <div class="valid-feedback" id="hLayernic"></div>
              <div class="invalid-feedback">
                닉네임을 입력해 주세요.
              </div>
              <small class="form-text text-muted">
                웹사이트에서 사용하고 싶은 이름을 입력해 주세요 (8자이내 중복불가)
              </small>
            </div>
          </div>
          <?php endif?>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">이메일 <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" value="<?php echo $my['email']?>" onblur="sameCheck(this,'hLayeremail');">
              <div class="valid-feedback" id="hLayeremail"></div>
              <div class="invalid-feedback">
                이메일을 확인해 주세요.
              </div>

              <div class="custom-control custom-checkbox mt-2">
                <input type="checkbox" class="custom-control-input" id="remail" name="remail" value="1"<?php if($my['mailing']):?> checked="checked"<?php endif?>>
                <label class="custom-control-label" for="remail">뉴스레터나 공지이메일을 수신받겠습니다.</label>
              </div>

            </div>
          </div>

          <?php if($d['member']['form_settings_tel1']):?>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">전화번호 <?php if($d['member']['form_settings_tel1_required']):?><span class="text-danger">*</span><?php endif?></label>
              <div class="col-sm-10">
                <?php $tel1=explode('-',$my['tel1'])?>
                <div class="form-inline">
                  <input type="text" name="tel1_1" value="<?php echo $tel1[0]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
              		<input type="text" name="tel1_2" value="<?php echo $tel1[1]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
              		<input type="text" name="tel1_3" value="<?php echo $tel1[2]?>" maxlength="4" size="4" class="form-control">
                  <div class="invalid-feedback">
                    전화번호를 입력해주세요.
                  </div>
                </div><!-- /.form-inline -->

              </div>
            </div>
        	<?php endif?>

          <?php if($d['member']['form_settings_tel2']):?>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">휴대전화 <?php if($d['member']['form_settings_tel2_required']):?><span class="text-danger">*</span><?php endif?></label>
              <div class="col-sm-10">
                <?php $tel2=explode('-',$my['tel2'])?>
                <div class="form-inline">
              		<input type="text" name="tel2_1" value="<?php echo $tel2[0]?>" maxlength="3" size="4" class="form-control"><span class="px-1">-</span>
              		<input type="text" name="tel2_2" value="<?php echo $tel2[1]?>" maxlength="4" size="4" class="form-control"><span class="px-1">-</span>
              		<input type="text" name="tel2_3" value="<?php echo $tel2[2]?>" maxlength="4" size="4" class="form-control">
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

          <?php if($d['member']['form_settings_birth']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">생년월일<?php if($d['member']['form_settings_birth_required']):?> <span class="text-danger">*</span><?php endif?></label>
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
                <div class="invalid-feedback">
                  생년월일을 지정해 주세요.
                </div>
              </div><!-- /.form-inline -->

            </div>
          </div>
        	<?php endif?>

          <?php if($d['member']['form_settings_sex']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">성별 <?php if($d['member']['form_settings_sex_required']):?><span class="text-danger">*</span><?php endif?></label>
            <div class="col-sm-10">
              <div class="custom-control custom-radio  custom-control-inline">
                <input type="radio" id="sex_1" name="sex" class="custom-control-input" value="1"<?php if($my['sex']==1):?> checked="checked"<?php endif?>>
                <label class="custom-control-label" for="sex_1">남성</label>
              </div>
              <div class="custom-control custom-radio  custom-control-inline">
                <input type="radio" id="sex_2" name="sex" class="custom-control-input" value="2"<?php if($my['sex']==2):?> checked="checked"<?php endif?>>
                <label class="custom-control-label" for="sex_2">여성</label>
              </div>
              <div class="invalid-feedback">
                성별을 선택해 주세요.
              </div>
            </div>
          </div>
        	<?php endif?>

          <?php if($d['member']['form_settings_addr']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">주소 <?php if($d['member']['form_settings_addr_required']):?><span class="text-danger">*</span><?php endif?></label>
            <div class="col-sm-10">

              <div id="addrbox"<?php if($my['addr0']=='해외'):?> class="d-none"<?php endif?>>
                <div class="form-row mb-2">
                 <div class="col-3">
                   <input type="text" class="form-control" name="zip" value="<?php echo substr($my['zip'],0,5)?>" id="zip" maxlength="5" size="5" readonly>
                 </div>
                 <div class="col-6">
                   <button type="button" class="btn btn-light" role="button" id="execDaumPostcode">우편번호찾기</button>
                 </div>
               </div>

                <div class="form-row">
                 <div class="form-group col-12">
                   <input type="text" class="form-control mb-2" name="addr1" id="addr1" value="<?php echo $my['addr1']?>" readonly>
                   <input type="text" class="form-control" name="addr2" id="addr2" value="<?php echo $my['addr2']?>">
                   <div class="invalid-feedback">
                     주소를 입력해주세요.
                   </div>
                 </div>
               </div>

              </div><!-- /#addrbox -->

              <?php if($d['member']['form_settings_overseas']):?>
              <div class="">
                <?php if($my['addr0']=='해외'):?>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input js-overseasChk" id="overseas" name="overseas" value="1" checked="checked" onclick="overseasChk(this);">
                  <label class="custom-control-label" for="overseas" id="overseas_ment">해외거주자 입니다.</label>
                </div>
                <?php else:?>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input js-overseasChk" id="overseas" name="overseas" value="1" onclick="overseasChk(this);">
                  <label class="custom-control-label" for="overseas" id="overseas_ment">해외거주자일 경우 체크해 주세요.</label>
                </div>
                <?php endif?>
              </div>
              <?php endif?>

              <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
              <script>
                $(function() {
                  $("#execDaumPostcode").click(function() {
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
                                 document.getElementById('zip').value = data.zonecode; //5자리 새우편번호 사용
                                 document.getElementById('addr1').value = fullAddr;
                                 $('#modal-DaumPostcode').modal('hide')// 우편번호 검색모달을 숨김
                                 $('#addr2').focus()
                             },

                             // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
                             width : '100%',
                             height : '100%'
                         }).embed(element_wrap);
                         element_wrap.style.display = 'block';
                        $('#modal-DaumPostcode').modal('show')
                    }
                    execDaumPostcode()

                  })
                });
              </script>

            </div>
          </div>

          <!-- Modal -->
          <div id="modal-DaumPostcode" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">우편번호 찾기</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body p-0" id="postLayer" style="height: 500px">
                </div>
              </div>
            </div>
          </div>

          <?php endif?>

          <?php if($d['member']['form_settings_bio']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">간단소개<?php if($d['member']['form_settings_bio_required']):?> <span class="text-danger">*</span><?php endif?></label>
            <div class="col-sm-10">
              <textarea class="form-control" name="bio" rows="3" placeholder="간략한 소개글을 입력해주세요."><?php echo $my['bio']?></textarea>
              <div class="invalid-feedback">
                간단소개를 입력해 주세요.
              </div>
            </div>
          </div>
          <?php endif?>

          <?php if($d['member']['form_settings_home']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">홈페이지<?php if($d['member']['form_settings_home_required']):?> <span class="text-danger">*</span><?php endif?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="home" value="<?php echo $my['home']?>" placeholder="URL을 입력하세요.">
              <div class="invalid-feedback">
                홈페이지 주소를 입력해주세요.
              </div>
            </div>
          </div>
          <?php endif?>

          <?php if($d['member']['form_settings_job']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">직업<?php if($d['member']['form_settings_job_required']):?> <span class="text-danger">*</span><?php endif?></label>
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
              <div class="invalid-feedback">
                직업을 선택해 주세요.
              </div>
            </div>
          </div>
        	<?php endif?>

        	<?php if($d['member']['form_settings_marr']):?>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">결혼기념일<?php if($d['member']['form_settings_marr_required']):?> <span class="text-danger">*</span><?php endif?></label>
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
                <div class="invalid-feedback">
                  결혼기념일을 입력해주세요.
                </div>
              </div><!-- /.form-inline -->
            </div>
          </div>
        	<?php endif?>

          <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
              <button type="submit" class="btn btn-primary js-submit">
                <span class="not-loading">수정하기</span>
                <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 수정중 ...</span>
              </button>
            </div>
          </div>
        </form>

        <aside class="edit-profile-avatar float-right">
          <dl class="form-group">
            <dt class="mb-2">프로필 사진</dt>
            <dd>
              <div data-toggle="avatar"role="button" class="position-relative rounded border">
                <img src="<?php echo getAavatarSrc($my['uid'],'200') ?>" width="200" height="200" alt="" class="">
                <i class="position-absolute fa fa-upload fa-3x" aria-hidden="true" data-toggle="tooltip" title="사진을 변경합니다." data-placement="right"></i>
              </div>
              <div class="mt-2">
              <?php if($my['photo']):?>
                <a class="btn btn-light btn-block" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=avatar_delete&amp;reload=Y" title="<?php echo $my['photo']?>" onclick="return hrefCheck(this,true,'정말로 삭제 하시겠습니까?');">
                  <i class="fa fa-trash fa-fw" aria-hidden="true"></i> 현재 사진삭제
                </a>
              <?php else: ?>

              <div class="text-center">
                <small class="text-muted">gif/jpg/png - 250*250픽셀 이상</small>
              </div>
              <?php endif?>
              </div>

              <form name="MbrPhotoForm" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="r" value="<?php echo $r?>">
                <input type="hidden" name="m" value="<?php echo $m?>">
                <input type="hidden" name="a" value="avatar">
                <input type="file" name="upfile" id="rb-upfile-avatar" accept="image/jpg" class="d-none">
              </form>
            </dd>
          </dl>
        </aside><!-- /.edit-profile-avatar -->
      </div>


    <?php endif; ?>

  </div><!-- /.page-main -->
</div><!-- /.row -->

<?php include_once $g['dir_module_skin'].'_footer.php'?>


<script>

var f = document.getElementById("memberForm");

$(function () {

  putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

  $(".js-overseasChk").click(function() {
    var obj = $(this).data('object')

  });

})


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
  setTimeout("_submit();",500);

	event.preventDefault();
  event.stopPropagation();
  }
);

function _submit() {
	getIframeForAction(f);
	f.submit();
}

</script>
