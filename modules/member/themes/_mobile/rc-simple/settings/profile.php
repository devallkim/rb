<?php $_add = explode('<split>',$my['addfield'])?>

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<article class="col-9 page-main">

			<div class="Subhead mt-0">
				<h2 class="Subhead-heading">공개 프로필</h2>
			</div>

			<div class="column two-thirds">

				<form class="" name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="c" value="<?php echo $c?>">
					<input type="hidden" name="m" value="<?php echo $m?>">
					<input type="hidden" name="front" value="<?php echo $front?>">
					<input type="hidden" name="a" value="info_update">
					<input type="hidden" name="act" value="info">
					<input type="hidden" name="check_nic" value="<?php echo $my['nic']?1:0?>">
					<input type="hidden" name="check_email" value="<?php echo $my['email']?1:0?>">

					<div class="form-group">
						<label>이름</label>
				    <input type="text" class="form-control" name="name" value="<?php echo $my['name']?>" maxlength="12" required>
					</div>

					<div class="form-group">
						<label>닉네임</label>
				    <input type="text" class="form-control" name="nic" value="<?php echo $my['nic']?>"  maxlength="8" required>
						<div class="invalid-feedback" id="hLayernic"></div>
						<small class="form-text text-muted">
						  웹사이트에서 사용하고 싶은 이름을 입력해 주세요 (8자이내 중복불가)
						</small>

					</div>

					<div class="form-group">
						<label>공개 이메일</label>
						<input type="email" class="form-control" name="email" value="<?php echo $my['email']?>" required>

						<select class="form-control d-none" id="">
				      <option><?php echo $my['email']?></option>
				    </select>
						<small class="form-text text-muted">
							<a href="/settings/emails">이메일 설정</a>에서 본인확인 된 이메일 주소를 지정 할 수 있습니다.
						</small>
					</div>



					<div class="form-group">
				    <label>간단소개</label>
				    <textarea class="form-control" name="addfield_0" rows="3" placeholder="간략한 소개글을 입력해주세요."><?php echo $_add[0]?></textarea>
				  </div>

					<div class="form-group">
						<label>URL</label>
				    <input type="text" class="form-control" name="home" value="<?php echo $my['home']?>">
					</div>

					<div class="form-group">
						<label>회사</label>
						<input type="text" class="form-control" name="company" value="<?php echo $my['company']?>">
						<small class="form-text text-muted">kimsQ 단체계정을 @mention으로 호출하여 연결할 수 있습니다.</small>
					</div>

					<hr>

					 <div id="addrbox">
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

					<div id="overseasbox" hidden>

					</div>

					 <div class="form-group">
					   <label class="custom-control custom-checkbox" id="overseasCheck">
					     <input type="checkbox" name="overseas" class="custom-control-input" value="1">
					     <span class="custom-control-indicator"></span>
					     <span class="custom-control-description" id="foreign_ment">해외 거주자일 경우 체크해 주세요.</span>
					   </label>
					 </div>


























				 <button type="submit" class="btn btn-primary">정보수정</button>

			 </form>
			</div><!-- /.column -->

			<div class="edit-profile-avatar float-right">

				<form class="" name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" >
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="<?php echo $m?>">
					<input type="hidden" name="a" value="avatar">

					<dl class="form-group">
						<dt class="mb-2">프로필 사진</dt>
						<dd>
							<?php if(is_file($g['path_var'].'avatar/180.'.$my['photo'])):?>
							<img class="avatar rounded-2" src="<?php echo $g['s']?>/_var/avatar/180.<?php echo $my['photo']?>" width="200" alt="@<?php echo $my['id'] ?>">
							<?php elseif(is_file($g['path_var'].'avatar/'.$my['photo'])):?>
							<img class="avatar rounded-2" src="<?php echo $g['s']?>/_var/avatar/<?php echo $my['photo']?>" width="200" alt="@<?php echo $my['id'] ?>">
							<?php else:?>
							<div class="rb-avatar-default rounded">
								<img class="avatar rounded-2" src="<?php echo $g['s']?>/_core/images/avatar/default_gray_light.svg" alt="@<?php echo $my['id'] ?>" width="200">
							</div>

							<?php endif?>

							<div class="mt-3">

								<?php if($my['photo']):?>
									<a class="btn btn-light btn-block" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=avatar_delete&amp;reload=Y" title="<?php echo $my['photo']?>" onclick="return hrefCheck(this,true,'정말로 삭제 하시겠습니까?');">
										현재 사진삭제
									</a>
								<?php else: ?>

									<input type="file" name="upfile" id="upfile">

									<button type="submit" class="btn btn-light btn-block btn-sm mt-3">사진 업로드</button>
									<small class="text-muted">( gif/jpg/png - 180*180픽셀 이상)</small>
								<?php endif?>

							</div>

						</dd>
					</dl>
				</form>

			</div>

		</article>
	</div>

</div>

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>


<script type="text/javascript">

var info_update_result = Cookies.get('info_update_result')  // 결과 가져오기
if (info_update_result == 'success') {
 setTimeout(function(){
	 alertLayer("#alertBox","primary","프로필 정보가 변경 되었습니다. - <a href='/<?php echo $my['id'] ?>' class='alert-link'>프로필 보기</a>","Y","Y","");
 }, 200);
}
Cookies.remove('info_update_result');  // 결과 초기화


// 해외거주 체크
$("#overseasCheck").click(function() {
	var obj = $(this).find('.custom-control-input')

	if (obj.prop("checked"))
	{
		$('#addrbox').attr('hidden',true);
		$('#overseasbox').removeAttr('hidden');
		$('#foreign_ment').html('해외거주자 입니다.')
	}
	else {
		$('#addrbox').removeAttr('hidden');
		$('#overseasbox').attr('hidden',true);
		$('#foreign_ment').html('해외 거주자일 경우 체크해 주세요.')
	}
});

function sameCheck(obj,layer)
{

	if (!obj.value)
	{
		eval('obj.form.check_'+obj.name).value = '0';
		getId(layer).innerHTML = '유효성 결과';
	}
	else
	{
		if (obj.name == 'id')
		{
			if (obj.value.length < 4 || obj.value.length > 12 || !chkIdValue(obj.value))
			{
				obj.form.check_id.value = '0';
				setTimeout(function() {
			        obj.focus();
			    }, 0);
				getId(layer).innerHTML = '<span class="text-danger">사용할 수 없는 아이디입니다</span>';
				return false;
			}
		}
		if (obj.name == 'email')
		{
			if (!chkEmailAddr(obj.value))
			{
				obj.form.check_email.value = '0';
				setTimeout(function() {
			        obj.focus();
			    }, 0);
				getId(layer).innerHTML = '<span class="text-danger">이메일형식이 아닙니다</span>';
				return false;
			}
		}

		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
	}
}
function saveCheck(f)
{

	<?php if($d['member']['form_nic_p']):?>
	if (f.check_nic.value == '0')
	{
		alert('닉네임을 확인해 주세요.');
		f.nic.focus();
		return false;
	}
	<?php endif?>
	<?php if($d['member']['form_birth']&&$d['member']['form_birth_p']):?>
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

	if (f.check_email.value == '0')
	{
		alert('이메일을 확인해 주세요.');
		f.email.focus();
		return false;
	}


	<?php if($d['member']['form_tel2']&&$d['member']['form_tel2_p']):?>
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

	<?php if($d['member']['form_tel1']&&$d['member']['form_tel1_p']):?>
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

	<?php if($d['member']['form_addr']&&$d['member']['form_addr_p']):?>
	if (!f.foreign || f.foreign.checked == false)
	{
		if (f.addr1.value == ''||f.addr2.value == '')
		{
			alert('주소를 입력해 주세요.');
			f.addr2.focus();
			return false;
		}
	}
	<?php endif?>


	<?php if($d['member']['form_job']&&$d['member']['form_job_p']):?>
	if (f.job.value == '')
	{
		alert('직업을 선택해 주세요.');
		f.job.focus();
		return false;
	}
	<?php endif?>


	return confirm('정말로 가입하시겠습니까?       ');
}

</script>
