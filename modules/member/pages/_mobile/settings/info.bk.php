<section class="agreement">
	<h1>
		<i class="fa fa-circle-o text-primary align-middle" aria-hidden="true"></i>
		개인정보 변경
	</h1>

	<p>회원 정보는 개인정보 취급방침에 따라 안전하게 보호되며, 회원님의 동의 없이 공개 또는 제 3자에게 제공되지 않습니다.</p>


	<?php if(($my['join_type'] == 'kimsq') && !($_SESSION["pw_confirm"])):?>
	<form name="procForm" class="mb-5" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" id="confirm-pw">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<input type="hidden" name="a" value="pw_confirm" />
		<!-- 사이트 계정일 경우 -->
		<p class="text-danger">정보를 안전하게 보호하기 위해 비밀번호를 다시 한번 확인합니다.</p>
		<table class="table table-bordered">
			<colgroup>
				<col width="20%">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row">아이디</th>
					<td class="text-left"><?php echo $my['id']?></td>
				</tr>
				<tr>
					<th scope="row" class="align-middle">비밀번호</th>
					<td>
						<input type="password" class="form-control w-75" name="pw" id="pw" placeholder="비밀번호를 입력해주세요." autocomplete="off" required="">
					</td>
				</tr>
			</tbody>
			</table>

			<div class="text-center mt-3">
				<button type="submit" class="btn btn-primary" role="button">확인</button>
			</div>


			<!-- 소셜계정인 경우 -->
			<p class="mt-5 hidden"><code>소셜 계정일 경우</code>개인정보 보호를 위해 가입된 SNS로 한번 더 로그인해 주세요.</p>
			<div class="row hidden">
				<div class="col-6 pr-2">
					<button type="button" class="btn btn-lg btn-secondary btn-block btn-sns btn-facebook" data-href="https://graph.facebook.com/oauth/authorize?client_id=1844542332433497&amp;redirect_uri=http%3A%2F%2Fnew.kfm.co.kr%2F%3Fr%3Dhome%26m%3Dsociallogin%26a%3Dslogin%26sloginReturn%3Dfacebook&amp;scope=email%20user_birthday">
						<span>페이스북</span>
					</button>
				</div>
				<div class="col-6 pl-0">
					<button type="button" class="btn btn-lg btn-secondary btn-block btn-sns btn-naver" data-href="https://nid.naver.com/oauth2.0/authorize?client_id=x6uTeO4rgQaVffwxZnyO&amp;response_type=code&amp;redirect_uri=http%3A%2F%2Fnew.kfm.co.kr%2F%3Fr%3Dhome%26m%3Dsociallogin%26a%3Dslogin%26sloginReturn%3Dnaver&amp;state=6e315be12a2176cbedd51f9aa60dfbda">
	        	<span>네이버 로그인</span>
	        </button>
				</div>

				<div class="col-6 mt-2 pr-2">
					<button type="button" class="btn btn-lg btn-secondary btn-sns btn-block btn btn-google" data-href="https://accounts.google.com/o/oauth2/auth?client_id=801508937586-qqvkn2uavmh14daedeitjcfbgvbhakjs.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Fnew.kfm.co.kr%2F%3Fr%3Dhome%26m%3Dsociallogin%26a%3Dslogin%26sloginReturn%3Dgoogle&amp;response_type=code&amp;scope=email%20profile&amp;state=%2Fprofile&amp;approval_prompt=auto">
	        	<span>구글 로그인</span>
	        </button>
				</div>
				<div class="col-6 mt-2 pl-0">
					<button type="button" class="btn btn-lg btn-secondary btn-block btn-sns btn-kakaotalk" data-href="https://kauth.kakao.com/oauth/authorize?client_id=e8cffcf672991d8084f7138d8b7b37f7&amp;redirect_uri=http%3A%2F%2Fnew.kfm.co.kr%2F%3Fr%3Dhome%26m%3Dsociallogin%26a%3Dslogin%26sloginReturn%3Dkakao&amp;response_type=code&amp;scope=">
	        	<span>카카오 로그인</span>
	        </button>
				</div>
			</div>

	</form>

	<?php endif?>

	<?php if ($_SESSION["pw_confirm"]): ?>
		<article id="pages-signup">
			<form name="procForm" class="form-horizontal" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="c" value="<?php echo $c?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="front" value="<?php echo $front?>" />
			<input type="hidden" name="a" value="info_update" />
			<input type="hidden" name="check_nic" value="<?php echo $my['nic']?1:0?>" />
			<input type="hidden" name="check_email" value="<?php echo $my['email']?1:0?>" />

			<div class="">
			 <?php if($d['member']['form_qa']):?>
			 <div class="form-group row">
				 <label for="pw_q" class="col-2 col-form-label"><?php if($d['member']['form_qa_p']):?><span class="text-danger">*</span><?php endif?> 비번찾기 질문</label>
					<div class="col-9">
					 <select name="pw_q" class="form-control" >
						 <option>질문을 선택하십시오</option>
						 <option value=""></option>
						 <?php $_pw_question=file($g['dir_module'].'var/pw_question.txt')?>
						 <?php foreach($_pw_question as $_val):?>
						 <option value="<?php echo trim($_val)?>" <?php if(trim($_val)==$my['pw_q']):?>selected<?php endif?>><?php echo trim($_val)?></option>
						 <?php endforeach?>
						</select>
								 </div>
						 </div>
						 <div class="form-group row">
								<label for="pw_q" class="col-2 col-form-label"><?php if($d['member']['form_qa_p']):?><span class="text-danger">*</span><?php endif?> 비번찾기 답변</label>
					<div class="col-9">
						<input type="text" class="form-control" name="pw_a" value="<?php echo $my['pw_a']?>" placeholder="답변을 입력해 주세요">
					 <span class="help-block">
						 비밀번호찾기 질문에 대한 답변을 혼자만 알 수 있는 단어나 기호로 입력해 주세요.
						 비밀번호를 찾을 때 필요하므로 반드시 기억해 주세요.
						 </span>
				 </div>
			 </div>
			 <?php endif?>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label">아이디</label>
				 <div class="col-9">
					 <p class="form-control-static"><?php echo $my['id']?></p>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="email" class="col-2 col-form-label">이메일</label>
				 <div class="col-9">
					 <div class="input-group w-75">
						 <input type="email" class="form-control" name="email" value="<?php echo $my['email']?>" id="email" onblur="sameCheck(this,'hLayeremail');" placeholder="<?php if($join_type=='kimsq'):?>비밀번호 잊어버렸을 때 확인 받을 수 있습니다.<?php endif?>">
							<span class="input-group-addon" id="hLayeremail"></span>
					 </div>
					 <div class="form-check mt-1">
						 <label class="form-check-label">
							 <input class="form-check-input" type="checkbox" name="remail" value="1" <?php if($my['mailing']):?> checked="checked"<?php endif?>> 뉴스레터나 공지메일을 수신 하겠습니다.
						 </label>
					 </div>

					</div>
			 </div>
			 <?php if($d['member']['form_tel2']):?>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label">휴대폰</label>
				 <div class="col-9"><?php $tel2=explode('-',$my['tel2'])?>
					 <div class="form-inline">
						 <input type="tel" name="tel2_1" value="<?php echo $tel2[0]?>" class="form-control mr-1" maxlength="3" style="width:80px">
						 <span class="rb-divider"></span>
						 <input type="tel" name="tel2_2" value="<?php echo $tel2[1]?>" class="form-control mr-1" maxlength="4" style="width:100px">
						 <span class="rb-divider"></span>
						 <input type="tel" name="tel2_3" value="<?php echo $tel2[2]?>" class="form-control" maxlength="4" style="width:100px">
					 </div>
					 <div class="form-check mt-1">
						 <label class="form-check-label">
							 <input class="form-check-input" type="checkbox" name="sms" value="1" <?php if($my['sms']):?> checked="checked"<?php endif?>> 알림 SMS를 받겠습니다.
						 </label>
					 </div>

				 </div>
			 </div>
			 <?php endif?>

				<?php if($d['member']['form_nic']):?>
			 <div class="form-group row">
				 <label for="for" class="col-2 col-form-label">닉네임</label>
				 <div class="col-9">
					 <div class="input-group w-75">
						 <input type="text" name="nic" class="form-control" id="nic" value="<?php echo $my['nic']?>" onblur="sameCheck(this,'hLayernic');" placeholder="자신을 표현할 수 있는 단어로 20자까지 자유롭게 입력">
						 <span class="input-group-addon" id="hLayernic"></span>
					 </div>
				 </div>
			 </div>
			 <?php endif?>

			 <?php if($d['member']['form_home']):?>
			 <div class="form-group row">
				 <label for="home" class="col-2 col-form-label"><?php if($d['member']['form_home_p']):?><span class="text-danger">*</span><?php endif?> 홈페이지</label>
				 <div class="col-9">
						 <input type="text" class="form-control" id="home" name="home"  value="<?php echo $my['home']?>" />
				 </div>
			 </div>
			 <?php endif?>

			 <?php if($d['member']['form_tel1']):?>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label"><?php if($d['member']['form_tel1_p']):?><span class="text-danger">*</span><?php endif?> 전화번호</label>
				 <div class="col-9"><?php $tel1=explode('-',$my['tel1'])?>
					 <input type="tel" name="tel1_1" value="<?php echo $tel1[0]?>" class="form-control input-sm rb-tel-num-1" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="tel1_2" value="<?php echo $tel1[1]?>" class="form-control input-sm rb-tel-num-2" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="tel1_3" value="<?php echo $tel1[2]?>" class="form-control input-sm rb-tel-num-3" maxlength="4">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <?php endif?>
			 <?php if($d['member']['form_addr']):?>
			<div class="form-group row">
				 <label for="" class="col-2 col-form-label"><?php if($d['member']['form_addr_p']):?><span class="text-danger">*</span><?php endif?> 주소</label>
				 <div class="col-9">
					 <div id="addrbox">
							 <div class="form-inline mb-2">
								 <input type="text" name="zip_1" value="<?php echo substr($my['zip'],0,5)?>" id="zip1" maxlength="5" size="5" class="form-control input-sm mr-1" readonly="" style="width:100px">
								 <button type="button" class="btn btn-secondary rb-zipsearch" role="button" onclick="openDaumPostcode();"><i class="fa fa-search"></i> 우편번호</button>
							 </div>
							 <input type="text" class="form-control mb-2" name="addr1" id="addr1" value="<?php echo $my['addr1']?>" readonly="">
							 <input type="text" class="form-control mb-2" name="addr2" id="addr2"  value="<?php echo $my['addr2']?>">
					 </div>

					 <div class="form-check">
						 <label class="form-check-label">
							 <?php if($my['addr0']=='해외'):?>
							 <input type="checkbox" name="foreign" class="form-check-input" value="1" checked="checked" onclick="foreignChk(this);" /><span id="foreign_ment">해외거주자 입니다.</span>
							 <?php else:?>
							 <input type="checkbox" name="foreign" class="form-check-input" value="1" onclick="foreignChk(this);" /><span id="foreign_ment">해외거주자일 경우 체크해 주세요.</span>
							 <?php endif?>
						 </label>
					 </div>

				 </div>
			 </div>
			 <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
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
			 <?php if($d['member']['form_job']):?>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label"><?php if($d['member']['form_job_p']):?><span class="text-danger">*</span><?php endif?> 직업</label>
				 <div class="col-9">
					 <select name="job" class="form-control">
						 <option value="">&nbsp;+ 선택하세요</option>
						 <option value="">------------------</option>
						 <?php $_job=file($g['dir_module'].'var/job.txt')?>
						 <?php foreach($_job as $_val):?>
						 <option value="<?php echo trim($_val)?>" <?php if(trim($_val)==$my['job']):?> selected="selected"<?php endif?>><?php echo trim($_val)?></option>
						 <?php endforeach?>
						 </select>
				 </div>
			 </div>
			 <?php endif?>
			 <?php if($d['member']['form_marr']):?>
				<div class="form-group row">
				 <label for="" class="col-2 col-form-label"><?php if($d['member']['form_marr_p']):?><span class="text-danger">*</span><?php endif?> 결혼 기념일</label>
				 <div class="col-9">
					 <select name="marr_1" class="form-control input-sm pull-left" style="width:80px">
						 <option value="">년도</option>
								<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
								<option value="<?php echo $i?>" <?php if($i==$my['marr1']):?> selected="selected"<?php endif?>><?php echo $i?></option>
						 <?php endfor?>
						 </select>
					 <select name="marr_2" class="form-control input-sm pull-left" style="width:80px;margin-left:5px">
						 <option value="">월</option>
						 <?php for($i = 1; $i < 13; $i++):?>
						 <option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
						 <?php endfor?>
					 </select>
					 <select name="marr_3" class="form-control input-sm pull-left" style="width:60px;margin-left:5px">
						 <option value="">일</option>
						 <?php for($i = 1; $i < 32; $i++):?>
						 <option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($my['marr2'],2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
						 <?php endfor?>
					 </select>
				 </div>
			 </div>
			 <?php endif?>

			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label">SNS</label>
				 <div class="col-9">
					 <?php $sns=explode('|',$my['home'])?>

					<div class="input-group mb-2">
						<span class="input-group-addon">페이스북</span>
						<input type="home" name="sns_1" value="<?php echo $sns[0]?>" class="form-control input-sm" placeholder="URL을 입력하세요.">
					</div>

					<div class="input-group mb-2">
						<span class="input-group-addon">카카오 스토리</span>
						<input type="home" name="sns_2" value="<?php echo $sns[1]?>" class="form-control input-sm" placeholder="URL을 입력하세요.">
					</div>

					<div class="input-group mb-2">
						<span class="input-group-addon">네이버 블로그</span>
						<input type="home" name="sns_3" value="<?php echo $sns[2]?>" class="form-control input-sm" placeholder="URL을 입력하세요.">
					</div>

					<div class="input-group mb-2">
						<span class="input-group-addon">트위터</span>
						<input type="home" name="sns_4" value="<?php echo $sns[3]?>" class="form-control input-sm" placeholder="URL을 입력하세요.">
					</div>

					<div class="input-group">
						<span class="input-group-addon">유튜브</span>
						<input type="home" name="sns_5" value="<?php echo $sns[4]?>" class="form-control input-sm" placeholder="URL을 입력하세요.">
					</div>
				 </div>
			 </div>


			<!-- 추가필드 시작 -->
			<?php $_add = file($g['dir_module'].'var/add_field.txt')?>
			<?php foreach($_add as $_key):?>
			<?php $_val = explode('|',trim($_key))?>
			<?php if($_val[6]) continue?>
			<div class="form-group row">
				<label  for="<?php echo $_val[0]?>" class="col-2 col-form-label"><?php if($_val[5]):?><span class="text-danger">*</span><?php endif?> <?php echo $_val[1]?></label>
			 <div class="col-9">
						 <!-- 일반 input=text -->
					 <?php if($_val[2]=='text'):?>
							 <input type="text" id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" value="<?php echo $_val[3]?>" class="form-control"/>
					 <?php endif?>

					 <!-- password input=text -->
					 <?php if($_val[2]=='password'):?>
								<input type="password" id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" value="<?php echo $_val[3]?>" class="form-control" />
					 <?php endif?>

										<!-- select box -->
					 <?php if($_val[2]=='select'): $_skey=explode(',',$_val[3])?>
						 <select name="add_<?php echo $_val[0]?>" id="<?php echo $_val[0]?>" class="form-control">
							 <option value="">&nbsp;+ 선택하세요</option>
							 <?php foreach($_skey as $_sval):?>
							 <option value="<?php echo trim($_sval)?>">ㆍ<?php echo trim($_sval)?></option>
							 <?php endforeach?>
						 </select>
					 <?php endif?>

					 <!-- input=radio -->
					 <?php if($_val[2]=='radio'): $_skey=explode(',',$_val[3])?>
						 <?php foreach($_skey as $_sval):?>
								 <label class="radio-inline">
									 <input type="radio" name="add_<?php echo $_val[0]?>" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
										</label>
							<?php endforeach?>
					 <?php endif?>

					 <!-- input=checkbox -->
					 <?php if($_val[2]=='checkbox'): $_skey=explode(',',$_val[3])?>
							 <?php foreach($_skey as $_sval):?>
									<label class="checkbox-inline">
											<input type="checkbox" name="add_<?php echo $_val[0]?>[]" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
									</label>
								 <?php endforeach?>
					 <?php endif?>

					 <!-- textarea -->
					 <?php if($_val[2]=='textarea'):?>
					 <textarea id="<?php echo $_val[0]?>" name="add_<?php echo $_val[0]?>" rows="5" class="form-control"><?php echo $_val[3]?></textarea>
					 <?php endif?>

								</div> <!-- .col-9 -->
			 </div> <!-- .form-group -->
			 <?php endforeach?>
						<!-- 추가필드 끝 -->

			 <?php if($d['member']['form_comp']):?>
			 <?php if($my['comp']) $myc = getDbData($table['s_mbrcomp'],'memberuid='.$my['uid'],'*')?>
			 <?php $tel = explode('-',$myc['comp_tel'])?>
			 <?php $fax = explode('-',$myc['comp_fax'])?>
			 <h5><i class="fa fa-building-o"></i>
						 기업정보
				 <?php if(!$my['comp']):?>
				 <label> ( <input type="checkbox" name="comp" value="1" onclick="compCheck(this)" /> 기업정보를 등록합니다 )</label>
				 <?php else:?>
				 <input type="checkbox" name="comp" value="1" checked="checked" class="hidden" />
				 <?php endif?>
			 </h5>
			 <hr>
			 <div id="comp_box" <?php if(!$my['comp']):?>class="hidden"<?php endif?>>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label"><span class="text-danger">*</span> 사업자등록번호</label>
				 <div class="col-9">
					 <input type="text" maxlength="3" class="form-control input-sm rb-comp-num-1" name="comp_num_1" value="<?php echo substr($myc['comp_num'],0,3)?>" >
					 <span class="rb-divider"></span>
					 <input type="text" maxlength="2" class="form-control input-sm rb-comp-num-2" name="comp_num_2" value="<?php echo substr($myc['comp_num'],3,2)?>" >
					 <span class="rb-divider"></span>
					 <input type="text" maxlength="5" class="form-control input-sm rb-comp-num-3" name="comp_num_3" value="<?php echo substr($myc['comp_num'],5,5)?>" >
					 <div class="rb-comp-type">
						 <label class="radio-inline">
							 <input type="radio" id="" name="comp_type" value="1"<?php if($myc['comp_type']==1||!$myc['comp_type']):?> checked="checked"<?php endif?>> 개인
						 </label>
						 <label class="radio-inline">
							 <input type="radio" id="" name="comp_type" value="2"<?php if($myc['comp_type']==2):?> checked="checked"<?php endif?>> 법인
						 </label>
					 </div>
					 <span class="help-block"></span>
				 </div>
			 </div>

			 <div class="form-group row">
				 <label for="comp_name" class="col-2 col-form-label"><span class="text-danger">*</span> 회사명</label>
				 <div class="col-9">
					 <input type="text" class="form-control" name="comp_name" value="<?php echo $myc['comp_name']?>" id="comp_name" placeholder="회사명을 입력해주세요.">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_ceo" class="col-2 col-form-label"><span class="text-danger">*</span> 대표자명</label>
				 <div class="col-9">
					 <input type="text" class="form-control" name="comp_ceo" value="<?php echo $myc['comp_ceo']?>"  id="comp_ceo" placeholder="대표자명을 입력해주세요.">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_condition" class="col-2 col-form-label"><span class="text-danger">*</span> 업태</label>
				 <div class="col-9">
					 <input type="text" class="form-control" name="comp_condition" value="<?php echo $myc['comp_condition']?>" id="comp_condition" placeholder="업태를 입력해주세요.">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_item" class="col-2 col-form-label"><span class="text-danger">*</span> 종목</label>
				 <div class="col-9">
					 <input type="text" class="form-control" name="comp_item" value="<?php echo $myc['comp_item']?>" id="comp_item" value="" placeholder="종목을 입력해주세요.">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_tel" class="col-2 col-form-label"><span class="text-danger">*</span> 대표전화</label>
				 <div class="col-9">
					 <input type="tel" name="comp_tel_1"  value="<?php echo $tel[0]?>" id="comp_tel_1" class="form-control input-sm rb-tel-num-1" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="comp_tel_2"  value="<?php echo $tel[1]?>" id="comp_tel_1" class="form-control input-sm rb-tel-num-2" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="comp_tel_3"  value="<?php echo $tel[2]?>" class="form-control input-sm rb-tel-num-3" maxlength="4">
					 <span class="help-block" name="comp_tel_1" id="comp_tel_1"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_fax" class="col-2 col-form-label">팩스</label>
				 <div class="col-9">
					 <input type="tel"  name="comp_fax_1" value="<?php echo $fax[0]?>" id="comp_fax_1" class="form-control input-sm rb-tel-num-1" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="comp_fax_2" value="<?php echo $fax[1]?>" id="comp_fax_2" class="form-control input-sm rb-tel-num-2" maxlength="4">
					 <span class="rb-divider"></span>
					 <input type="tel" name="comp_fax_3" value="<?php echo $fax[2]?>" id="comp_fax_3" class="form-control input-sm rb-tel-num-3" maxlength="4">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_part" class="col-2 col-form-label">소속부서</label>
				 <div class="col-9">
					 <input type="text" name="comp_part" value="<?php echo $myc['comp_part']?>" id="comp_part" class="form-control" placeholder="">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="comp_level" class="col-2 col-form-label">직책</label>
				 <div class="col-9">
					 <input type="text" name="comp_level" value="<?php echo $myc['comp_level']?>" id="comp_level" class="form-control" placeholder="">
					 <span class="help-block"></span>
				 </div>
			 </div>
			 <div class="form-group row">
				 <label for="" class="col-2 col-form-label"><span class="text-danger">*</span> 사업장 주소</label>
				 <div class="col-9">
					 <div class="clearfix" style="margin-bottom: 5px">
						 <input type="text" name="comp_zip_1" value="<?php echo substr($myc['comp_zip'],0,3)?>" id="comp_zip1" class="form-control input-sm pull-left" readonly="" style="width:50px">
						 <span class="rb-divider"></span>
						 <input type="text"name="comp_zip_2"  value="<?php echo substr($myc['comp_zip'],3,3)?>" id="comp_zip2"  class="form-control input-sm pull-left" readonly="" style="width:50px;">
						 <span class="separator"></span>
						 <button type="button" class="btn btn-secondary btn-sm pull-left rb-zipsearch" onclick="openDaumPostcode2();"><i class="fa fa-search"></i> 우편번호</button>
					 </div>
					 <input type="text" name="comp_addr1" value="<?php echo $myc['comp_addr1']?>" id="comp_addr1" class="form-control mb-1" readonly="">
					 <input type="text" name="comp_addr2" value="<?php echo $myc['comp_addr2']?>" id="comp_addr2" class="form-control" >
				 </div>
				 <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
				 <script>
						 function openDaumPostcode2() {
								 new daum.Postcode({
										 oncomplete: function(data) {
												 // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
												 // 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
												 document.getElementById('comp_zip1').value = data.postcode1;
												 document.getElementById('comp_addr1').value = data.address;

												 //전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
												 //아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
												 //var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
												 //document.getElementById('addr').value = addr;

												 document.getElementById('comp_addr2').focus();
										 }
								 }).open();
						 }
				 </script>
			 </div>
			 <?php endif?>
				</div> <!--#comp_box : 기업등록 체크할 경우에만 보이게 한다. -->
			 <hr>
			 <div class="rb-form-footer text-center">
					 <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-lg"></i> 정보수정</button>
			 </div>

		</form>
		</article>
	<?php endif; ?>


</section>




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
