<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-left-nav pull-left p-x-1" data-history="back" role="button"></a>
	<a class="icon icon-home pull-right p-x-1" href="/" role="button"></a>
	<h1 class="title">
		KFM 99.9 고객센터
	</h1>
</header>
<div class="bar bar-standard bar-header-secondary bar-light bg-white p-x-0">
	<nav class="nav nav-inline">
		<a class="nav-link active" href="#"><?php echo $d['member']['login_emailid']?'이메일':'아이디'?> 찾기</a>
		<a class="nav-link" href="#">임시비밀번호 요청</a>
	</nav>
</div>

<div class="content bg-faded">

	<?php $id_or_email='회원 가입 시 등록한 '.($d['member']['login_emailid']?'아이디':'이메일').'을 입력해주세요.'?>
	<div id="pages_idpw" class="swiper-container">

		<div class="swiper-wrapper">

			<!-- 아이디 찾기 -->
			<div class="swiper-slide" id="idpwsearch-1">
				<div class="idw_content">
					<form name="procForm1" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return idCheck(this);">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="a" value="id_search" />

					<div class="card" style="padding-right: 20px;">
				    <div class="form-list">
				      <input type="text" name="name" id="join_name" placeholder="회원 가입 시 등록한 이름을 입력해 주세요." autocomplete="off">
				      <input type="email" name="email" id="join_email" placeholder="<?php echo $id_or_email?>"  autocomplete="off">
				    </div>
				  </div>

					<div class="content-padded">
						<button type="submit" class="btn btn-primary btn-block">
							<i class="fa fa-search" aria-hidden="true"></i> <?php echo $d['member']['login_emailid']?'이메일':'아이디'?> 찾기
						</button>

						<p class="mt-3 text-muted">회원가입 시 등록한 이름(실명)과 이메일을 입력하시면 정보를 확인하실 수 있습니다.</p>
						<p class="text-muted mb-0">본인 인증을 통해 아이디를 찾거나 비밀번호를 재설정 할 수 있습니다.</p>

						<button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="#modal-login">
							로그인 하기
						</button>
					</div>

					</form>
				</div>
			</div>

			<!-- 비밀번호 요청  -->
			<div class="swiper-slide" id="idpwsearch-2">

				<div class="idw_content">
					<form name="procForm3" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return idCheck(this);">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="a" value="id_auth" />
					<p></p>

					<div class="card" style="padding-right: 20px;">
				    <div class="form-list">
				      <input type="text" name="name" id="join_name" placeholder="회원가입시에 등록한 이름을 입력 해주세요." autocomplete="off">
				      <input type="email" name="email" id="join_email" placeholder="<?php echo $id_or_email?>" autocomplete="off">
				    </div>
				  </div>

					<div class="content-padded">
						<button type="submit" class="btn btn-primary btn-block">
							<i class="fa fa-key" aria-hidden="true"></i> 임시비밀번호 요청
						</button>

						<p class="mt-3 text-muted">회원가입 시 등록한 이름(실명)과 이메일을 입력하시면 해당 메일로 임시번호를 발급해 드립니다.</p>
						<p class="text-muted">메일수신이 안되었을 경우, 스펨함을 확인해 보시고 기타사항에 대해서는 <b>관리자</b>에게  문의해주세요.</p>
						<p class="mb-0"><span class="text-danger">임시비밀번호로 로그인한 후 비밀번호를 변경해주세요.</span></p>
						<button type="button" class="btn btn-link btn-block" data-toggle="modal" data-target="#modal-login">
							로그인 하기
						</button>
					</div>

					</form>
				</div><!-- //idw_content -->

			</div><!-- //idpwsearch-2 -->

		</div> <!-- .swiper-wrapper -->
	</div>

</div><!-- .content -->

<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

<script type="text/javascript">
//<![CDATA[

	// Initialize Swiper
	var swiper = new Swiper('.swiper-container', {
		pagination: '.bar-header-secondary .nav-inline',
		paginationClickable: true,
		effect: 'slide',
		loop: false,
		autoHeight: true,
		slideActiveClass :'active',
		bulletClass : 'nav-link',
		bulletActiveClass : 'active' ,
		paginationBulletRender: function (index, className) {
		var title;
		if (index === 0) title = '<?php echo $d['member']['login_emailid']?'이메일':'아이디'?> 찾기'
		if (index === 1) title = '임시비밀번호 요청'
		return '<a class="' + className + '">'+title+'</a>';
		},
		onSlideChangeEnd: function (swiper) {
			$('.content').animate({scrollTop:0}, '100');
		}
	});


function idCheck(f)
{
	if (f.name.value == '')
	{
		alert('이름을 입력해 주세요.   ');
		f.name.focus();
		return false;
	}
	if (f.email.value == '')
	{
		alert('<?php echo $d['member']['login_emailid']?'아이디를':'이메일을'?> 입력해 주세요.   ');
		f.email.focus();
		return false;
	}
}
function pwCheck(f)
{
	if (f.new_id.value == '')
	{
		alert('<?php echo $d['member']['login_emailid']?'이메일을':'아이디를'?> 입력해 주세요.   ');
		f.new_id.focus();
		return false;
	}
	if (f.id_auth.value == '2')
	{
		if (f.new_pw_a.value == '')
		{
			alert('답변을 입력해 주세요.   ');
			f.new_pw_a.focus();
			return false;
		}
	}
	if (f.id_auth.value == '3')
	{
		if (f.new_pw1.value == '')
		{
			alert('새 패스워드를 입력해 주세요.');
			f.new_pw1.focus();
			return false;
		}
		if (f.new_pw2.value == '')
		{
			alert('새 패스워드를 한번더 입력해 주세요.');
			f.new_pw2.focus();
			return false;
		}
		if (f.new_pw1.value != f.new_pw2.value)
		{
			alert('새 패스워드가 일치하지 않습니다.');
			f.new_pw1.focus();
			return false;
		}

		alert('입력하신 패스워드로 재등록 되었습니다.');
	}
}

window.onload = function()
{
	<?php if($ftype == 'pw'):?>
	tabShow(2);
	<?php elseif($ftype == 'auth'):?>
	tabShow(3);
	<?php else:?>
	document.procForm1.name.focus();
	<?php endif?>
}
//]]>
</script>
