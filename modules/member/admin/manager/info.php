	<form name="addForm" class="f13 p-4" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $module?>">
		<input type="hidden" name="a" value="admin_member_add">
		<input type="hidden" name="id" value="<?php echo $_M['id']?>">
		<input type="hidden" name="uid" value="<?php echo $_M['uid']?>">
		<input type="hidden" name="avatar" value="<?php echo $_M['photo']?>">
		<input type="hidden" name="check_id" value="1">
		<input type="hidden" name="check_nic" value="1">
		<input type="hidden" name="check_email" value="1">
		<input type="submit" style="position:absolute;left:-1000px;">


		<div class="row">
			<div class="col">

				<div class="media">
					<img alt="avatar" src="<?php echo getAavatarSrc($_M['uid'],'64') ?>" width="64" height="64" class="rounded-circle mr-3">
					<div class="media-body">
						<p class="mb-1">
							<input type="file" name="upfile" class="hidden" id="rb-upfile-avatar" accept="image/jpg" onchange="getId('rb-photo-btn').innerHTML='이미지 파일 선택됨';">
							<button type="button" class="btn btn-light btn-sm" onclick="$('#rb-upfile-avatar').click();" id="rb-photo-btn">
								<i class="fa fa-upload" aria-hidden="true"></i>
								업로드
							</button>
						</p>
						<span class="text-muted">
							<strong>사이즈</strong>는 250*250 <strong>이상</strong>
							<?php if($_M['photo']):?> <label>( <input type="checkbox" name="avatar_delete" value="1"> 현재 아바타 삭제 )</label><?php endif?>
						</span>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="sr-only">비밀번호</label>
					<input type="password" class="form-control form-control-sm mb-2" name="pw1" placeholder="새 비밀번호">
					<input type="password" class="form-control form-control-sm" name="pw2" placeholder="비밀번호 재입력">
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">아이디</label>
					<div class="col-sm-10 pt-2">
						<span><?php echo $_M['id']?></span>
					</div>
				</div>

				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">이름</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm" name="name" placeholder="" value="<?php echo $_M['name']?>" maxlength="10">
					</div>
				</div>
				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">닉네임</label>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="text" class="form-control form-control-sm" name="nic" placeholder="" value="<?php echo $_M['nic']?>" maxlength="20" onchange="sendCheck('rb-nickcheck','nic');">
							<span class="input-group-append">
								<button type="button" class="btn btn-light" id="rb-nickcheck" onclick="sendCheck('rb-nickcheck','nic');">중복확인</button>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">이메일</label>
					<div class="col-sm-10">
						<div class="input-group">
							<input type="email" class="form-control form-control-sm" name="email" placeholder="" value="<?php echo $_M['email']?>" onchange="sendCheck('rb-emailcheck','email');">
							<span class="input-group-append">
								<button type="button" class="btn btn-light" id="rb-emailcheck" onclick="sendCheck('rb-emailcheck','email');">중복확인</button>
							</span>
						</div>

						<div class="custom-control custom-checkbox mt-2">
							<input type="checkbox" class="custom-control-input" id="remail" name="remail" value="1"<?php if($_M['mailing']):?> checked="checked"<?php endif?>>
							<label class="custom-control-label" for="remail">공지 이메일 수신</label>
						</div>

					</div>
				</div>
				<hr>

				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">휴대전화</label>
					<div class="col-sm-10">
						<?php $tel2=explode('-',$_M['tel2'])?>
						<div class="form-inline">
							<input type="text" name="tel2_1" value="<?php echo $tel2[0]?>" maxlength="3" size="4" class="form-control form-control-sm">
							<input type="text" name="tel2_2" value="<?php echo $tel2[1]?>" maxlength="4" size="4" class="form-control form-control-sm ml-2">
							<input type="text" name="tel2_3" value="<?php echo $tel2[2]?>" maxlength="4" size="4" class="form-control form-control-sm ml-2">

							<div class="custom-control custom-checkbox ml-3">
								<input type="checkbox" class="custom-control-input" id="sms" name="sms" value="1"<?php if($_M['sms']):?> checked="checked"<?php endif?>>
								<label class="custom-control-label" for="sms">알림문자 수신</label>
							</div>

							<div class="invalid-feedback">
								휴대전화 번호를 입력해주세요.
							</div>
						</div><!-- /.form-inline -->

					</div>
				</div>

				<div class="form-group row no-gutters mb-0">
					<label class="col-sm-2 col-form-label">전화번호</label>
					<div class="col-sm-10">
						<?php $tel1=explode('-',$_M['tel1'])?>
						<div class="form-inline">
							<input type="text" name="tel1_1" value="<?php echo $tel1[0]?>" maxlength="4" size="4" class="form-control form-control-sm">
							<input type="text" name="tel1_2" value="<?php echo $tel1[1]?>" maxlength="4" size="4" class="form-control form-control-sm ml-2">
							<input type="text" name="tel1_3" value="<?php echo $tel1[2]?>" maxlength="4" size="4" class="form-control form-control-sm ml-2">
							<div class="invalid-feedback">
								전화번호를 입력해주세요.
							</div>
						</div><!-- /.form-inline -->

					</div>
				</div>


			</div><!-- /.col -->
			<div class="col border-left">

				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">생년월일</label>
					<div class="col-sm-10">

						<div class="form-inline">
							<select class="form-control custom-select form-control-sm" name="birth_1">
								<option value="">년도</option>
								<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
								<option value="<?php echo $i?>"<?php if($_M['birth1']==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<select class="form-control custom-select ml-2 form-control-sm" name="birth_2">
								<option value="">월</option>
								<?php $birth_2=substr($_M['birth2'],0,2)?>
								<?php for($i = 1; $i < 13; $i++):?>
								<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_2==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<select class="form-control custom-select ml-2 form-control-sm" name="birth_3">
								<option value="">일</option>
								<?php $birth_3=substr($_M['birth2'],2,2)?>
								<?php for($i = 1; $i < 32; $i++):?>
								<option value="<?php echo sprintf('%02d',$i)?>"<?php if($birth_3==$i):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<div class="custom-control custom-checkbox ml-3">
								<input type="checkbox" class="custom-control-input" name="birthtype" id="birthtype" value="1"<?php if($_M['birthtype']):?> checked="checked"<?php endif?>>
								<label class="custom-control-label" for="birthtype">음력</label>
							</div>
							<div class="invalid-feedback">
								생년월일을 지정해 주세요.
							</div>
						</div><!-- /.form-inline -->

					</div>
				</div>

				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">성별</label>
					<div class="col-sm-10 pt-1">
						<div class="custom-control custom-radio  custom-control-inline">
							<input type="radio" id="sex_1" name="sex" class="custom-control-input" value="1"<?php if($_M['sex']==1):?> checked="checked"<?php endif?>>
							<label class="custom-control-label" for="sex_1">남성</label>
						</div>
						<div class="custom-control custom-radio  custom-control-inline">
							<input type="radio" id="sex_2" name="sex" class="custom-control-input" value="2"<?php if($_M['sex']==2):?> checked="checked"<?php endif?>>
							<label class="custom-control-label" for="sex_2">여성</label>
						</div>
						<div class="invalid-feedback">
							성별을 선택해 주세요.
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="sr-only">주소</label>
					<div>

						<div id="addrbox"<?php if($_M['addr0']=='해외'):?> class="d-none"<?php endif?>>
							<div class="form-row">
							 <div class="form-group col-3">
								 <input type="text" class="form-control form-control-sm" name="zip" value="<?php echo substr($_M['zip'],0,5)?>" id="zip" maxlength="5" size="5" readonly>
							 </div>
							 <div class="form-group col-6">
								 <button type="button" class="btn btn-light" role="button" id="execDaumPostcode">우편번호찾기</button>
							 </div>
						 </div>

						 <div class="form-group mb-1">
							 <input type="text" class="form-control form-control-sm" name="addr1" id="addr1" value="<?php echo $_M['addr1']?>" readonly>
						 </div>
						 <div class="form-group">
							 <input type="text" class="form-control form-control-sm" name="addr2" id="addr2" value="<?php echo $_M['addr2']?>">
							 <div class="invalid-feedback">
								 주소를 입력해주세요.
							 </div>
						 </div>

						</div><!-- /#addrbox -->

						<div class="">
							<?php if($_M['addr0']=='해외'):?>
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

					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="sr-only">간단소개</label>
					<textarea class="form-control" name="bio" rows="2" placeholder="간단소개를 입력해 주세요."><?php echo $_M['bio']?></textarea>
				</div>
				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">홈페이지</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm" name="home" value="<?php echo $_M['home']?>" placeholder="URL을 입력하세요.">
						<div class="invalid-feedback">
							홈페이지 주소를 입력해주세요.
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">직업</label>
					<div class="col-sm-10">
						<select class="form-control custom-select form-control-sm" name="job">
							<option value="">&nbsp;+ 선택하세요</option>
							<option value="" disabled>------------------</option>
							<?php
							$g['memberJobVarForSite'] = $g['path_var'].'site/'.$r.'/member.job.txt';
							$_tmpvfile = file_exists($g['memberJobVarForSite']) ? $g['memberJobVarForSite'] : $g['path_module'].$module.'/var/member.job.txt';
							$_job=file($_tmpvfile);
							?>
							<?php foreach($_job as $_val):?>
							<option value="<?php echo trim($_val)?>"<?php if(trim($_val)==$_M['job']):?> selected="selected"<?php endif?>>ㆍ<?php echo trim($_val)?></option>
							<?php endforeach?>
						</select>
						<div class="invalid-feedback">
							직업을 선택해 주세요.
						</div>
					</div>
				</div>

				<div class="form-group row no-gutters">
					<label class="col-sm-2 col-form-label">결혼기념일</label>
					<div class="col-sm-10">

						<div class="form-inline">

							<select class="form-control custom-select form-control-sm" name="marr_1">
								<option value="">년도</option>
								<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
								<option value="<?php echo $i?>"<?php if($i==$_M['marr1']):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<select class="form-control custom-select ml-2 form-control-sm" name="marr_2">
								<option value="">월</option>
								<?php for($i = 1; $i < 13; $i++):?>
								<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($_M['marr2'],0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<select class="form-control custom-select ml-2 form-control-sm" name="marr_3">
								<option value="">일</option>
								<?php for($i = 1; $i < 32; $i++):?>
								<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($_M['marr2'],2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
								<?php endfor?>
							</select>
							<div class="invalid-feedback">
								결혼기념일을 입력해주세요.
							</div>
						</div><!-- /.form-inline -->
					</div>
				</div>

			</div><!-- /.col -->

		</div>

		</form>

		<form name="actionform" action="<?php echo $g['s']?>/" method="post">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="admin_member_add_check">
			<input type="hidden" name="type" value="">
			<input type="hidden" name="fvalue" value="">
		</form>


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

</script>
