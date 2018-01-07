<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<article class="col-9 page-main">

			<div class="Subhead mt-0">
				<h2 class="Subhead-heading">이메일 관리</h2>
			</div>

			<ul class="list-group mb-4">
			  <li class="list-group-item">
					<span class="text-truncate" style="max-width: 300px">
						break@kimsq.com
					</span>
					<span class="badge badge-primary ml-2">Primary</span>
					<span class="badge badge-secondary ml-1">Public</span>
					<div class="float-right">
						<button class="btn btn-link py-0 muted-link" type="button" name="button">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</div>
				</li>
				<li class="list-group-item">
					<span class="text-truncate" style="max-width: 300px">
						live@kimsq.com
					</span>
					<div class="float-right">
						<button class="btn btn-link py-0 muted-link" type="button" name="button">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</div>
				</li>
				<li class="list-group-item">
					<span class="text-truncate" style="max-width: 300px">
						contact@kimsq.com
					</span>
					<span class="badge badge-secondary ml-2">본인 미확인</span>
					<div class="float-right">
						본인확인 메일이 발송되었습니다.
						<button class="btn btn-link py-0 text-danger" type="button" name="button">
							재발송
						</button>
						<button class="btn btn-link py-0 muted-link" type="button" name="button">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</div>
				</li>
			</ul>

			<div class="form-group">
				<label class="d-block">이메일 추가</label>
				<input type="email" class="form-control short d-inline" name="email" value="">
				<button class="btn btn-light btn-sm" type="button" name="button">추가</button>
			</div>

			<hr>

			<form class="">
				<dl class="form-group">
					<dt>
						<label class="mb-0">기본 이메일</label>
						<p class="font-weight-normal">
		          break@kimsq.com 은 계정정관련 알림 등에 사용 됩니다.
			      </p>
					</dt>
					<dd>
						<select id="primary_email_select" name="id" class="form-control d-inline short">
							<option value="5706606" selected="selected">break@kimsq.com</option>
							<option value="5706606">live@kimsq.com</option>
						</select>
						<button class="btn btn-light btn-sm" type="button" name="button">저장</button>
					</dd>
				</dl>
			</form>

			<hr>

			<form class="">
				<dl class="form-group">
					<dt>
						<label class="mb-0">보조 이메일 설정</label>
						<p class="font-weight-normal">
		          기본 이메일을 사용하지 못할 경우, 보조 이메일을 사용하여 패스워드를 재설정 할 수 있습니다.
			      </p>
					</dt>
					<dd>
						<select id="primary_email_select" name="id" class="form-control d-inline short">
							<option value="" selected="selected">모든 이메일 허용 (본인확인)</option>
							<option value="">사용 안함</option>
						</select>
						<button class="btn btn-light btn-sm" type="button" name="button">저장</button>
					</dd>
				</dl>
			</form>


			<div class="form-check mt-4">
	      <label class="form-check-label">
	        <input checked="checked" class="" name="type" type="radio" value="">
	        <div class="media ml-2">
	          <div class="media-body">
	            <h6 class="mt-0 mb-0"> 이메일 비공개</h6>
	            <small class="text-muted">공개프로필에서 이메일을 숨김처리 합니다.</small>
	          </div>
	        </div>
	      </label>
	    </div>

			<div class="Subhead Subhead-spacious">
			  <h2 class="Subhead-heading">이메일 수신 설정</h2>
			</div>

			<div class="form-check mt-4">
	      <label class="form-check-label">
	        <input class="" name="type" type="radio" value="">
	        <div class="media ml-2">
	          <div class="media-body">
	            <h6 class="mt-0 mb-0"> 모든 소식을 수신합니다.</h6>
	            <small class="text-muted">계정과 관련된 내용과 구독내용만 수신 합니다.</small>
	          </div>
	        </div>
	      </label>
	    </div>
			<div class="form-check mt-4">
	      <label class="form-check-label">
	        <input class="" name="type" type="radio" value="">
	        <div class="media ml-2">
	          <div class="media-body">
	            <h6 class="mt-0 mb-0"> 모든 소식을 수신합니다.</h6>
	            <small class="text-muted">계정과 관련된 내용과 구독내용만 수신 합니다.</small>
	          </div>
	        </div>
	      </label>
	    </div>



			<form class="clearfix" name="procForm" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="c" value="<?php echo $c?>" />
				<input type="hidden" name="m" value="<?php echo $m?>" />
				<input type="hidden" name="front" value="<?php echo $front?>" />
				<input type="hidden" name="a" value="info_update" />
				<input type="hidden" name="check_nic" value="<?php echo $my['nic']?1:0?>" />
				<input type="hidden" name="check_email" value="<?php echo $my['email']?1:0?>" />

				<div class="form-group">
					<label>이메일</label>
					<div class="input-group">
				    <input type="email" class="form-control" name="email" value="<?php echo $my['email']?>" id="email" onblur="sameCheck(this,'hLayeremail');" placeholder="비밀번호 잊어버렸을 때 확인 받을 수 있습니다.">
				    <span class="input-group-btn">
           		<button class="btn btn-light" disabled><span id="hLayeremail">유효성 결과</span></button>
			    	</span>
					</div>
				</div>

			 <button type="submit" class="btn btn-light">정보수정</button>

			</form>


			<hr>

			<?php
				include $g['path_core'].'function/rss.func.php';
				$g['livequry'] = 'https://ssl.3-pod.com/User/api.aspx?ptncode=0331&ptnkey=FD08508FA0220C53BA94BE59EBC06045&enc=utf-8&cmd=';
				$_SMID=getUrlData($g['livequry'].'GET_MEMBER_INFO&type=SMNO&mno='.$my['mbrno'],10);
				?>
			<div class="guide">
				이 계정의 관리자와 담당자 정보를 입력해 주세요.<br />
				정보가 변경되었을 경우에는 반드시 변경된 정보로 재 등록해 주시기 바랍니다.<br />
			</div>


			<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="m" value="<?php echo $m?>" />
				<input type="hidden" name="a" value="hosting_admin" />
				<input type="hidden" name="svc_no" value="<?php echo $_svc_no?>" />
				<input type="hidden" name="owner" value="<?php echo $owner?>" />
				<input type="hidden" name="project" value="<?php echo $project?>" />

				<?php
				// 전화번호 핸드폰번호 분리 (by. taiji88 13/8/20)
				$MngTel_ARR = explode("-", getRssContent($_SMID,'MngTel'));
				$MngHTel_ARR = explode("-", getRssContent($_SMID,'MngHTel'));
				$RctTel_ARR = explode("-", getRssContent($_SMID,'RctTel'));
				$RctHTel_ARR = explode("-", getRssContent($_SMID,'RctHTel'));
				?>

				<table class="table">
					<tr>
					<td>관리자 이름</td>
					<td><input type="text" name="mng_name" value="<?php echo getRssContent($_SMID,'MngName')?>" class="inputx" /></td>
					<td>관리자 이메일</td>
					<td><input type="text" name="mng_email" class="inputx" value="<?php echo getRssContent($_SMID,'MngEmail')?>" /></td>
					</tr>
					<tr>
					<td>관리자 전화번호</td>
					<td>
					<input type="text" name="mng_tel1" class="inputx1" maxlength='3' value="<?php echo $MngTel_ARR[0]?>" /> -
					<input type="text" name="mng_tel2" class="inputx1" maxlength='4' value="<?php echo $MngTel_ARR[1]?>" /> -
					<input type="text" name="mng_tel3" class="inputx1" maxlength='4' value="<?php echo $MngTel_ARR[2]?>" />
					</td>
					<td>관리자 휴대폰</td>
					<td>
					<input type="text" name="mng_htel1" class="inputx1" maxlength='3' value="<?php echo $MngHTel_ARR[0]?>" /> -
					<input type="text" name="mng_htel2" class="inputx1" maxlength='4' value="<?php echo $MngHTel_ARR[1]?>" /> -
					<input type="text" name="mng_htel3" class="inputx1" maxlength='4' value="<?php echo $MngHTel_ARR[2]?>" />
					</td>
					</tr>
					<tr>
					<td>요금담당자 이름</td>
					<td><input type="text" name="rct_name" class="inputx" value="<?php echo getRssContent($_SMID,'RctName')?>" /></td>
					<td>요금담당자 이메일</td>
					<td><input type="text" name="rct_email" class="inputx" value="<?php echo getRssContent($_SMID,'RctEmail')?>" /></td>
					</tr>
					<tr>
					<td>요금담당자 전화번호</td>
					<td>
					<input type="text" name="rct_tel1" class="inputx1" maxlength='3' value="<?php echo $RctTel_ARR[0]?>" /> -
					<input type="text" name="rct_tel2" class="inputx1" maxlength='4' value="<?php echo $RctTel_ARR[1]?>" /> -
					<input type="text" name="rct_tel3" class="inputx1" maxlength='4' value="<?php echo $RctTel_ARR[2]?>" />
					</td>
					<td>요금담당자 휴대폰</td>
					<td>
					<input type="text" name="rct_htel1" class="inputx1" maxlength='3' value="<?php echo $RctHTel_ARR[0]?>" /> -
					<input type="text" name="rct_htel2" class="inputx1" maxlength='4' value="<?php echo $RctHTel_ARR[1]?>" /> -
					<input type="text" name="rct_htel3" class="inputx1" maxlength='4' value="<?php echo $RctHTel_ARR[2]?>" />
					</td>
					</tr>

				</table>

				<div class="mt-4">
					<button class="btn btn-light" type="submit">정보등록(수정)</button>
				</div>
			</form>











		</article>
	</div>

</div>

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>


<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
});

// 기업등록 체크
function compCheck(obj)
{
	var comp_box=$('#comp_box');
	if (obj.checked == true) $(comp_box).removeClass('hidden');
	else $(comp_box).addClass('hidden');
}

// 해외거주 체크
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
	if (f.name.value == '')
	{
		alert('이름을 입력해 주세요.');
		f.name.focus();
		return false;
	}
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


	if (f.check_email.value == '0')
	{
		alert('이메일을 확인해 주세요.');
		f.email.focus();
		return false;
	}

	<?php if($d['member']['form_home']&&$d['member']['form_home_p']):?>
	if (f.home.value == '')
	{
		alert('홈페이지 주소를 입력해 주세요.');
		f.home.focus();
		return false;
	}
	<?php endif?>


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

	return confirm('정말로 가입하시겠습니까?       ');
}
//]]>
</script>
