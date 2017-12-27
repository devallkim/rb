<?php
//if($_POST["authinfo"] && $_POST["authinfo"] != "1") getLink('', '', '인증에 실패하였습니다.', '-1');
//if($_POST["result_cd"] && $_POST["result_cd"] != "B000") getLink('', '', '인증에 실패하였습니다.', '-1');

/*****************************************************
POST Data 가공
*****************************************************/
// 이름/생일/성별/핸드폰번호 판별 (return 값. trim 추가 14/11/13)
// 실명
if(trim($_POST["realname"]) != "") {
	$regis_name = $_POST["realname"];
}

// 성별
if(trim($_POST["birthdate"]) != "") {
	if($_POST["sex"] == "1") $regis_jumin2 = "1";
	elseif($_POST["sex"] == "0") $regis_jumin2 = "2";
}

// 생일
if(trim($_POST["birthdate"]) != "") {
	$regis_jumin1 = substr($_POST["birthdate"], 2);
}

// 핸드폰번호
if(trim($_POST["hp_num"]) != "") {
	$regis_hp1 = substr($_POST["hp_num"], 0, 3);
	$regis_hp_etc = substr($_POST["hp_num"], 3);

	if(strlen($regis_hp_etc) == "8")
	{
		$regis_hp2 = substr($regis_hp_etc, 0, 4);
		$regis_hp3 = substr($regis_hp_etc, 4, 4);
	}
	elseif(strlen($regis_hp_etc) == "7")
	{
		$regis_hp2 = substr($regis_hp_etc, 0, 3);
		$regis_hp3 = substr($regis_hp_etc, 3, 4);
	}
}

// 생년월일 고정 (14/11/13)
$jumin1_y = substr($regis_jumin1, 0, 2);
$jumin1_m = substr($regis_jumin1, 2, 2);
$jumin1_d = substr($regis_jumin1, 4, 2);

$jumin1_y = $jumin1_y > substr($date['today'], 2, 2) ? '19'.$jumin1_y : '20'.$jumin1_y;
?>

<style media="screen">
/*step*/
.hd-step {
height: 3.125rem
}
.bar-header-secondary.hd-step ~ .content {
	padding-top: 5.875rem;
}
.hd-step .nav-inline {
position: relative;
display: flex;
}
.hd-step .nav-inline .nav-item {
width: 10%;
line-height: 3.1rem;
z-index: 20
}
.hd-step .nav-inline .nav-item.active {
width: 80%;
}

.hd-step .nav-inline .nav-link {
display: none
}
.hd-step .nav-inline .active .nav-link {
margin-left: -4px;
display: inline;
width: 100%;
padding-left: 5px;
padding-right: 5px;
color: #626470;
background-color: #fff
}
.hd-step .nav-inline .nav-item.active:last-child {
background-color: #fff
}
.hd-step .nav-inline .badge-default {
width: 32px;
height: 32px;
padding: 0;
font-size: 1rem;
line-height: 28px;
background-color: #b4b8c4;
border-radius: 100%;
text-align: center;
border: 2px solid #d8dce2;
}
.hd-step .nav-inline .active .badge-default {
background-color: #0275d8;
}

.hd-step .nav-inline .nav-item + .nav-item,
.hd-step .nav-inline .nav-link + .nav-link {
	margin-left: .625rem;
}
.hd-step .nav-inline:before {
display: block;
position: absolute;
top: 25px;
width: 100%;
height: 1px;
content: '';
background-color: #d8dce2;
z-index: 18
}

</style>



<?php getImport('bootstrap-validator','css/bootstrapValidator',false,'css') ?>

<!-- Modal : 우편번호 검색 : 현재 사용안함 추후 모달 사용가능성을 위해 남겨둠 -->
<div id="modal-zipsearch" class="modal">
	<div class="bar bar-standard bar-footer bar-light bg-faded">
		<button class="btn btn-secondary btn-block" data-history="back">닫기</button>
	</div>
</div>


<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-home pull-right p-x-1" href="/" role="button"></a>
	<h1 class="title">
		KFM 99.9  회원가입
	</h1>
</header>
<div class="bar bar-standard bar-header-secondary hd-step bg-white">
	<ul class="nav nav-inline">
	  <li class="nav-item">
      <span class="badge badge-pill badge-default">1</span>
	    <a class="nav-link">약관동의</a>
	  </li>
	  <li class="nav-item">
      <span class="badge badge-pill badge-default">2</span>
	    <a class="nav-link">본인인증</a>
	  </li>
		<li class="nav-item active">
      <span class="badge badge-pill badge-default">3</span>
	    <a class="nav-link">회원정보입력</a>
	  </li>
	</ul>
</div>

<div class="content">
<article id="pages-signup" class="content-padded">

	<form name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" id="pages-signup-form" autocomplete="off">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="c" value="<?php echo $c?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="front" value="<?php echo $front?>">
		<input type="hidden" name="a" value="join">
		<input type="hidden" name="check_id" value="0">
		<input type="hidden" name="check_nic" value="0">
		<input type="hidden" name="check_email" value="1">
		<input type="hidden" name="comp" value="<?php echo $comp?>">


	<?php if($d['member']['form_jumin']):?>
	<!-- 생년월일 고정 (14/11/13) -->
	<input type="hidden" name="birth_1" value="<?php echo $jumin1_y?>" />
	<input type="hidden" name="birth_2" value="<?php echo $jumin1_m?>" />
	<input type="hidden" name="birth_3" value="<?php echo $jumin1_d?>" />
	<?php endif?>


	<?php if($regis_hp1!=""){ ?>
	<!-- 휴대폰 고정 -->
	<input type="hidden" name="tel2_1" value="<?php echo $regis_hp1?>">
	<input type="hidden" name="tel2_2" value="<?php echo $regis_hp2?>">
	<input type="hidden" name="tel2_3" value="<?php echo $regis_hp3?>">
	<?php }?>

		<div class="join_form" id="joinForm">
			<div class="form-group">
			  <input type="text" class="form-control" name="id" id="id" placeholder="아이디" onblur="sameCheck(this,'rb-idcheck');" maxlength="12" autocomplete="off">
				<div class="form-control-feedback" id="rb-idcheck"></div>
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="pw1" id="pw1" placeholder="비밀번호 입력" maxlength="16"  autocomplete="off">
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="pw2" id="pw2" placeholder="비밀번호 재입력" maxlength="16"  autocomplete="off">
			</div>

			<div class="form-group form_join_div">
				<input type="text" class="form-control" name="name" value="<?php echo $regis_name?>" placeholder="이름" <?php if($regis_name):?>readonly<?php endif?>>
			</div><!-- //form_join_div -->

			<?php if($d['member']['form_sex']):?>
			<div class="form-group">
				<label class="custom-control custom-radio">
				  <input id="radio1" name="sex" type="radio" class="custom-control-input" id="sex" value="1" <?php if($_POST["sex"] == "1"):?> checked<?php endif?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">남성</span>
				</label>
				<label class="custom-control custom-radio">
				  <input id="radio2" name="sex" type="radio" class="custom-control-input"  id="sex2" value="2" <?php if($_POST["sex"] == "0"):?> checked<?php endif?>>
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">여성</span>
				</label>
			</div>
			<?php endif?>


			<div class="form-group">
				<input type="email" class="form-control" name="email" id="email" placeholder="이메일" onblur="sameCheck(this,'rb-emailcheck');" onfocus="this.style.color='#000';" autocomplete="off">
				<div class="form-control-feedback" id="rb-emailcheck"></div>
				<small class="form-text text-muted">비밀번호 잊어버렸을 때 확인 받을 수 있습니다.</small>

				<?php if($d['member']['join_auth']==3):?>
				<p class="form-text">
				  <i class="fa fa-info-circle"></i> 가입후 입력하신 이메일로 인증메일이 발송되며 인증을 거쳐야만 가입승인이 이루어집니다.
				</p>
				<?php endif?>
			</div>

			<div class="form-group">
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" name="remail" id="remail" value="" checked>
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">뉴스레터나 공지메일을 수신 하겠습니다.</span>
				</label>
			</div>

			<?php if($d['member']['form_tel2']):?>
			<div class="form-group row">
				<label class="col-sm-2 col-xs-3 col-form-label">휴대폰</label>
				<div class="col-sm-10 col-xs-9">
					<div class="form-control-static">
						<?php if($regis_hp1!=""){ ?>
						<div class="bg_phone"><span><?php echo $regis_hp1?></span>-<span><?php echo $regis_hp2?></span>-<span class="last"><?php echo $regis_hp3?></span></div>
						<?php }else{?>
						<select name="tel2_1" class="form-control d-inline" style="width: 80px">
							<option value="010" <?php if($regis_hp1=="" || $regis_hp1=="010"){ ?>selected<?php }?> >010</option>
							<option value="011" <?php if($regis_hp1=="011"){ ?>selected<?php }?> >011</option>
							<option value="016" <?php if($regis_hp1=="016"){ ?>selected<?php }?> >016</option>
							<option value="017" <?php if($regis_hp1=="017"){ ?>selected<?php }?> >017</option>
							<option value="018" <?php if($regis_hp1=="018"){ ?>selected<?php }?> >018</option>
							<option value="019" <?php if($regis_hp1=="019"){ ?>selected<?php }?> >019</option>
						</select>
						<input type="number" name="tel2_2" class="form-control d-inline" style="width: 70px" max="9999" maxlength="4" value="<?php echo $regis_hp2?>" placeholder="앞자리" />
						<input type="number" name="tel2_3" class="form-control d-inline" style="width: 70px" max="9999" maxlength="4" value="<?php echo $regis_hp3?>" placeholder="뒷자리" />
						<div class="form-control-feedback"></div>
						<?php }?>
					</div>
					<label class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" type="checkbox" name="sms" value="1">
						<span class="custom-control-indicator"></span>
						<span class="custom-control-description">알림 SMS를 받겠습니다.</span>
					</label>
				</div>
			</div><!-- /.form-group -->
			<?php endif?>

			<?php if($d['member']['form_nic']):?>
			<div class="form-group">
					<input type="text" class="form-control" name="nic" id="nic" placeholder="닉네임" onblur="sameCheck(this,'rb-niccheck');">
					<div class="form-control-feedback" id="rb-niccheck"></div>
			</div><!-- /.form-group -->
			<?php endif?>

			<?php if($d['member']['form_birth'] && $jumin1_m):?>

			<div class="form-group row">
				<label class="col-sm-2 col-xs-3 col-form-label">생년월일</label>
				<?php if($d['member']['form_jumin']):?>
				<div class="col-sm-10 col-xs-9">
					<p class="form-control-static"><?php echo $jumin1_y?>년</span> <span><?php echo $jumin1_m?>월</span> <span><?php echo $jumin1_d?>일</span></p>
				</div>
				<?php else:?>
				<div class="form_birth">
					<div class="">
						<label class="sr-only" for="">년도</label>
						<select name="birth_1" class="s_birth1">
						<option value="">년도</option>
							 <?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
							 <option value="<?php echo $i?>"><?php echo $i?></option>
						<?php endfor?>
						</select>

						<label class="sr-only" for="">월</label>
						<select name="birth_2" class="s_birth2">
							<option value="">월</option>
							<?php for($i = 1; $i < 13; $i++):?>
							<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,2,2)):?> selected<?php endif?>><?php echo $i?></option>
							<?php endfor?>
						</select>

						<label class="sr-only" for="">일</label>
						<select name="birth_3" class="s_birth2">
							<option value="">일</option>
							<?php for($i = 1; $i < 32; $i++):?>
							<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,4,2)):?> selected<?php endif?>><?php echo $i?></option>
							<?php endfor?>
						</select>

						<div class="chk_birth">
							<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" type="checkbox" name="birthtype" value="1">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">음력</span>
							 </label>
						</div>
					</div><!-- / -->
					<?php endif?>
				</div>
			</div><!-- //form-group form_chk_div-->
			<?php endif?>

			<!-- 주소 -->
			<?php if($d['member']['form_addr']):?>
			<div class="form-group">
				<label for="id" class="col-form-label rb-form-required hide">
				<?php if($d['member']['form_addr_p']):?><?php endif?>주소</label>

				<div id="addrbox">

					<div class="input-group mb-2">
					  <input type="number" class="form-control" name="zip_1" id="zip1" placeholder="" readonly>
					  <span class="input-group-btn">
					    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#modal-zipsearch">
								<i class="fa fa-search"></i>우편번호
							</button>
					  </span>
					</div>

					<input class="form-control mb-2" type="text" value="" name="addr1" id="addr1" readonly placeholder="우편번호를 선택">
					<input class="form-control mb-3" type="text" value="" name="addr2" id="addr2" style="margin-bottom: 5px" placeholder="상세 주소를 입력">
				</div>
				<?php if($d['member']['form_foreign']):?>
				<div class="form_chk_div mt">
					<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" type="checkbox" name="foreign" valule="1" onclick="foreignChk(this);">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">해외거주자일 경우 체크해 주세요.</span>
				  </label>
				</div><!-- //form_chk_div -->
				<?php endif?>
			</div><!-- /.form-group -->


			<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<script>

			$('#modal-zipsearch').on('show.rc.modal', function (e) {
				// 입력폼의 포커스를 제거
				$('.form-control').blur();
			  openDaumPostcode();
			})

			// 우편번호 찾기 화면을 넣을 element
	    var element_layer = document.getElementById('modal-zipsearch');

	    function openDaumPostcode() {
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

								// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
								// 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
								document.getElementById('zip1').value = data.zonecode;
								document.getElementById('addr1').value = data.address;
								//전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
								//아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
								//var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
								//document.getElementById('addr').value = addr;
								//document.getElementById('addr2').focus();

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_layer.style.display = 'none';
            },
            width : '100%',
            height : '100%',
            maxSuggestItems : 5
        }).embed(element_layer);
	    }

			</script>
			<?php endif?>
			<hr>
			<div class="my-4">
			  <div class="row">
			    <div class="col-xs-6">
			      <a href="/" class="btn btn-secondary btn-block">가입취소</a>
			    </div>
			    <div class="col-xs-6 p-l-0">
			      <button type="submit" class="btn btn-primary btn-block">회원가입</button>
			    </div>
			  </div>
			</div>

		</div><!-- //join_form -->



	</form>
	</article>
</div>


<?php getImport('bootstrap-validator','js/bootstrapValidator',false,'js') ?>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

		$('#pages-signup-form').bootstrapValidator({
        message: 'This value is not valid',
				icon: {
					valid: 'fa fa-check',
					invalid: 'fa fa-times',
					validating: 'fa fa-refresh'
				},
				fields: {
					id: {
							message: 'The username is not valid',
							validators: {
									notEmpty: {
											message: '반드시 입력해야 합니다.'
									},
									regexp: {
											regexp: /^[a-z0-9]+$/,
											message: '아이디는 영문(소문자)과 숫자만 가능합니다.'
									},
									stringLength: {
											min: 4,
											max: 12,
											message: '4자 이상 12자 이하로 입력해 주세요.'
									}
							}
					},
						pw1: {
								message: 'The username is not valid',
								validators: {
										notEmpty: {
												message: '반드시 입력해야 합니다.'
										},
										stringLength: {
												min: 8,
												max: 16,
												message: '8자 이상 16자 이하로 입력해 주세요. '
										},
										different: {
												field: 'id',
												message: '패스워드는 아이디와 같을수 없습니다.'
										}
								}
						},
						pw2: {
							validators: {
									notEmpty: {
											message: '반드시 입력해야 합니다.'
									},
									stringLength: {
											min: 8,
											max: 16,
											message: '8자 이상 16자 이하로 입력해 주세요. '
									},
									identical: {
											field: 'pw1',
											message: '비밀번호가 같지 않습니다.'
									}
							}
					},

					email: {
							validators: {
									notEmpty: {
											message: '반드시 입력해야 합니다.'
									},
									emailAddress: {
											message: '이메일 형식이 아닙니다.'
									}
							}
					},
					nic: {
							validators: {
									notEmpty: {
											message: '반드시 입력해야 합니다.'
									},
									stringLength: {
											max: 20,
											message: '20자 이하로 입력해 주세요.'
									}
							}
					}

				}
		});


});

function foreignChk(obj)
{
	if (obj.checked == true)
	{
		getId('addrbox').style.display = 'none';
		getId('foreign_ment').innerHTML= '해외거주자 입니다.';
	}
	else {
		getId('addrbox').style.display = 'block';
		getId('foreign_ment').innerHTML= '해외거주자일 경우 체크해 주세요.';
	}
}
function sameCheck(obj,layer)
{

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
				obj.form.check_id.value = '0';
				setTimeout(function() {
			        //obj.focus();
			    }, 0);
				getId(layer).innerHTML = '사용할 수 없는 아이디입니다.';
				return false;
			}
		}

		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
	}
}
function saveCheck(f)
{


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
	<?php if($d['member']['form_sex']&&$d['member']['form_sex_p']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		alert('성별을 선택해 주세요.  ');
		return false;
	}
	<?php endif?>


	<?php if($d['member']['form_qa']&&$d['member']['form_qa_p']):?>
	if (f.pw_q.value == '')
	{
		alert('비밀번호 찾기 질문을 입력해 주세요.');
		f.pw_q.focus();
		return false;
	}
	if (f.pw_a.value == '')
	{
		alert('비밀번호 찾기 답변을 입력해 주세요.');
		f.pw_a.focus();
		return false;
	}
	<?php endif?>


	<?php if($d['member']['form_home']&&$d['member']['form_home_p']):?>
	if (f.home.value == '')
	{
		alert('홈페이지 주소를 입력해 주세요.');
		f.home.focus();
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

	<?php if($d['member']['form_marr']&&$d['member']['form_marr_p']):?>
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


	<?php if($d['member']['form_comp'] && $comp):?>
	if (f.comp_num_1.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_1.focus();
		return false;
	}
	if (f.comp_num_2.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_2.focus();
		return false;
	}
	if (f.comp_num_3.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_3.focus();
		return false;
	}

	if (f.comp_name.value == '')
	{
		alert('회사명을 입력해 주세요.     ');
		f.comp_name.focus();
		return false;
	}
	if (f.comp_ceo.value == '')
	{
		alert('대표자명을 입력해 주세요.     ');
		f.comp_ceo.focus();
		return false;
	}
	if (f.comp_condition.value == '')
	{
		alert('업태를 입력해 주세요.     ');
		f.comp_condition.focus();
		return false;
	}
	if (f.comp_item.value == '')
	{
		alert('종목을 입력해 주세요.     ');
		f.comp_item.focus();
		return false;
	}
	if (f.comp_tel_1.value == '')
	{
		alert('대표전화번호를 입력해 주세요.');
		f.comp_tel_1.focus();
		return false;
	}
	if (f.comp_tel_2.value == '')
	{
		alert('대표전화번호를 입력해 주세요.');
		f.comp_tel_2.focus();
		return false;
	}

	if (f.comp_addr1.value == '')
	{
		alert('사업장주소를 입력해 주세요.');
		f.comp_addr2.focus();
		return false;
	}
	<?php endif?>
}

//폰번호 자리수 체크 제한
function maxLengthCheck(object){
	if (object.value.length > object.maxLength){
		object.value = object.value.slice(0, object.maxLength);
	}
}

//]]>
</script>
