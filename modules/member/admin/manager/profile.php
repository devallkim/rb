<?php
$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$levelname= getDbData($table['s_mbrlevel'],'uid='.$_M['level'],'*');
$sosokname= getDbData($table['s_mbrgroup'],'uid='.$_M['mygroup'],'*');
$joinsite = getDbData($table['s_site'],'uid='.$_M['site'],'*');
$M1 = getUidData($table['s_mbrid'],$_M['memberuid']);
$lastlogdate = -getRemainDate($_M['last_log']);
?>

<section class="pt-4 f13">
	<div class="row no-gutters">
		<div class="col-sm-3 col-lg-3 text-center">
			<br><br>
			<p>
				<img alt="avatar" src="<?php echo getAavatarSrc($_M['uid'],'120') ?>" width="120" height="120" class="rounded-circle">
			</p>

			<a class="btn btn-light btn-sm" href="/@<?php echo $_M['id']?>" target="_blank">프로필 페이지</a>
		</div>
		<div class="col-sm-4 col-lg-4">

			<dl class="row no-gutters f13">
			  <dt class="col-3 text-muted">ㆍ 아이디</dt>
			  <dd class="col-9"><?php echo $_M['id']?></dd>

				<dt class="col-3 text-muted">ㆍ 이름</dt>
			  <dd class="col-9">
					<?php echo $_M['name']?>
					<?php if($_M['sex']):?><span class="badge badge-pill badge-dark"><?php echo getSex($_M['sex'])?>성</span><?php endif?>
				</dd>

				<dt class="col-3 text-muted">ㆍ 닉네임</dt>
				<dd class="col-9"><?php echo $_M['nic']?></dd>

				<dt class="col-3 text-muted">ㆍ 이메일</dt>
				<dd class="col-9">
					<?php echo $_M['email']?>
					<?php if ($_M['mailing']): ?>
					<span class="badge badge-pill badge-dark">공지수신</span>
					<?php endif; ?>
				</dd>

				<?php if ($_M['tel2']): ?>
				<dt class="col-3 text-muted">ㆍ 휴대폰</dt>
				<dd class="col-9">
					<?php echo $_M['tel2']?$_M['tel2']:'<small>미등록</small>'?>
					<?php if ($_M['sms']): ?>
					<span class="badge badge-pill badge-dark">알림수신</span>
					<?php endif; ?>
				</dd>
				<?php endif; ?>

				<?php if ($_M['tel1']): ?>
				<dt class="col-3 text-muted">ㆍ 전화</dt>
				<dd class="col-9"><?php echo $_M['tel1']?$_M['tel1']:'<small>미등록</small>'?></dd>
				<?php endif; ?>

				<dt class="col-3 text-muted">ㆍ 최근접속</dt>
				<dd class="col-9">
					<?php if($_M['last_log']):?><?php echo getDateFormat($_M['last_log'],'Y.m.d')?>
						<span class="badge badge-pill badge-dark"><?php echo sprintf('%d일전',-getRemainDate($_M['last_log']))?><?php else:?><small>기록없음</small></span>
					<?php endif?>
				</dd>

				<dt class="col-3 text-muted">ㆍ 등록일</dt>
				<dd class="col-9">
					<?php echo getDateFormat($_M['d_regis'],'Y.m.d H:i')?>
					<span class="badge badge-pill badge-dark"><?php echo sprintf('%d일전',-getRemainDate($_M['d_regis']))?></span>
				</dd>

			</dl>
		</div>

		<div class="col-sm-5 col-lg-5">

			<dl class="row f13">

				<?php if($_M['birth1']):?>
			  <dt class="col-4 text-muted">ㆍ 나이/성별</dt>
			  <dd class="col-8">
					<?php echo getAge($_M['birth1'])?>세
					<?php if($_M['birth1']&&$_M['sex']):?> / <?php endif?>
				</dd>


				<dt class="col-4 text-muted">ㆍ 생년월일</dt>
			  <dd class="col-8">
					<?php echo $_M['birth1']?>/<?php echo substr($_M['birth2'],0,2)?>/
					<?php echo substr($_M['birth2'],2,2)?>
					<?php if($_M['birthtype']):?><span class="badge badge-pill badge-dark">음력</span><?php endif?>
				</dd>
				<?php endif?>

				<dt class="col-4 text-muted">ㆍ 회원그룹</dt>
			  <dd class="col-8">
					<?php echo $sosokname['name']?>
				</dd>

				<dt class="col-4 text-muted">ㆍ 회원등급</dt>
			  <dd class="col-8">
					<?php echo $levelname['name']?> <span class="badge badge-pill badge-dark"><?php echo $_M['level']?> / <?php echo $levelnum['uid']?></span>
				</dd>

				<dt class="col-4 text-muted">ㆍ 가입사이트</dt>
				<dd class="col-8">
					<?php echo $joinsite['name']?>
				</dd>

				<dt class="col-4 text-muted">ㆍ 포인트</dt>
				<dd class="col-8">
					<?php echo number_format($_M['point'])?> <span class="badge badge-pill badge-dark">사용 : <?php echo number_format($_M['usepoint'])?></span>
				</dd>

				<dt class="col-4 text-muted">ㆍ 적립금</dt>
				<dd class="col-8">
					<?php echo number_format($_M['cash'])?>
				</dd>

				<dt class="col-4 text-muted">ㆍ 예치금</dt>
				<dd class="col-8">
					<?php echo number_format($_M['money'])?>
				</dd>

			</dl>
		</div>

	</div>

	<div class="row no-gutters">

		<div class="offset-sm-3 col">

			<dl class="row">

				<?php if($_M['addr0']):?>
				<dt class="col-2 text-muted">ㆍ 지역</dt>
				<dd class="col-10">
					<?php echo $_M['addr0']=='해외'?$_M['addr0']:$_M['addr1'].' '.$_M['addr2']?>
				</dd>
				<?php endif?>

				<?php if($_M['bio']):?>
				<dt class="col-2 text-muted">ㆍ 간단소개</dt>
				<dd class="col-10">
					<?php echo $_M['bio']?>
				</dd>
				<?php endif?>

				<?php if($_M['marr1']):?>
				<dt class="col-2 text-muted">ㆍ 결혼기념일</dt>
			  <dd class="col-10">
					<?php echo $_M['marr1']?>/<?php echo substr($_M['marr2'],0,2)?>/
					<?php echo substr($_M['marr2'],2,2)?>
				</dd>
				<?php endif?>

				<?php if($_M['job']):?>
				<dt class="col-2 text-muted">ㆍ 직업</dt>
				<dd class="col-10">
					<?php echo $_M['job']?>
				</dd>
				<?php endif?>


			</dl>

		</div>

	</div>

</section>
