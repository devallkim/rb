<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
	<a class="icon icon-home pull-right p-x-1" href="/" role="button"></a>
	<h1 class="title">
		KFM 99.9 고객센터
	</h1>
</header>
<section class="content bg-faded">

	<p class="content-padded">회원 정보는 개인정보 취급방침에 따라 안전하게 보호되며, 회원님의 동의 없이 공개 또는 제 3자에게 제공되지 않습니다.</p>
	<ul class="table-view bg-white">
		<li class="table-view-divider">내정보</li>
		<li class="table-view-cell">
			아이디
			<span class="badge badge-primary badge-inverted"><?php echo $my['id']?></span>
		</li>
		<li class="table-view-cell">
			이름
			<span class="badge badge-primary badge-inverted"><?php echo $my['name']?></span>
		</li>
		<li class="table-view-cell">
			닉네임
			<span class="badge badge-primary badge-inverted"><?php echo $my['nic']?$my['nic']:'없음'?></span>
		</li>
		<li class="table-view-cell">
			가입일자
			<span class="badge badge-primary badge-inverted"><?php echo getDateFormat($my['d_regis'],'Y/m/d H:i')?></span>
		</li>
		<li class="table-view-cell">
			최근접속
			<span class="badge badge-primary badge-inverted"><?php echo getDateFormat($my['last_log'],'Y/m/d H:i')?> (<?php echo $lastlogdate?$lastlogdate.'일전':'오늘'?>)</span>
		</li>
		<li class="table-view-divider">정보 변경</li>
		<?php if($my['join_type'] == 'kimsq'):?>
		<li class="table-view-cell"><a href="/customer/c/user/modify" class="navigate-right">개인정보 변경</a></li>
		<li class="table-view-cell"><a href="/customer/c/user/password" class="navigate-right">비밀번호 변경</a></li>
		<?php endif?>
		<li class="table-view-cell"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout&amp;r=home&amp;referer=/" class="navigate-right">로그아웃</a></li>
		<li class="table-view-cell"><a href="/customer/c/user/leaveId" class="navigate-right">회원탈퇴</a></li>
		<li class="table-view-cell hidden"><a href="/customer/c/user/account" class="navigate-right">계정관리</a></li>
	</ul>


</section>

<!-- 공통 스크립트 -->
<?php include $g['dir_module_skin'].'_common_script.php'?>
