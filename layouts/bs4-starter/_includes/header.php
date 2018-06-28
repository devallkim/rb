<nav class="navbar navbar-expand navbar-dark bg-dark mb-3">
	<div class="container">
		<a class="navbar-brand" href="<?php  echo RW(0) ?>">
			<?php echo $d['layout']['header_file']?'<img src="'.$g['url_layout'].'/_var/'.$d['layout']['header_file'].'">':stripslashes($d['layout']['header_title'])?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsDefault">
			<ul class="navbar-nav mr-auto">
				<!-- 관리자모드 > 위젯코드 추출기를 활용하세요. -->
				<?php getWidget('menu/bs4-navbar-nav',array('smenu'=>'0','limit'=>'2','link'=>'link','dropdown'=>'1',))?>
			</ul>

			<?php if($d['layout']['header_search']=='true'):?>
			<form class="form-inline my-2 my-lg-0" action="<?php echo $g['s']?>/" role="search">
				<input type="hidden" name="r" value="<?php echo $r ?>">
				<input type="hidden" name="m" value="search">
	      <input class="form-control mr-sm-2" type="search" placeholder="통합검색" aria-label="Search" name="keyword" value="<?php echo $_keyword ?>" >
	    </form>
			<?php endif?>

			<?php if($d['layout']['header_login']=='true'):?>
			<ul class="navbar-nav">
				<?php if ($my['uid']): ?>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-role="tooltip" title="프로필보기 및 회원계정관리">
				    <img src="<?php echo getAavatarSrc($my['uid'],'20') ?>" width="20" height="20" alt="" class="rounded d-inline-block align-top">
						<?php echo $my['nic'] ?>
				  </a>
				  <div class="dropdown-menu dropdown-menu-right dropdown-menu-sw" aria-labelledby="navbarDropdownMenuLink2">
				    <h6 class="dropdown-header"><?php echo $my['nic'] ?> 님</h6>
				    <div class="dropdown-divider"></div>
				    <a class="dropdown-item" href="/@<?php echo $my['id'] ?>">
							<i class="fa fa-address-card-o fa-fw" aria-hidden="true"></i> 내 프로필
						</a>
				    <a class="dropdown-item" href="<?php echo RW('mod=saved')?>">
							<i class="fa fa-bookmark-o fa-fw" aria-hidden="true"></i> 내 저장함
						</a>
				    <div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo RW('mod=settings')?>">개인정보 관리</a>
				    <a class="dropdown-item" href="<?php echo $g['s']?>/logout">로그아웃</a>
				  </div>
				</li>
				<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="#modal-join" data-toggle="modal" data-backdrop="static">회원가입</a>
				</li>
				<li class="nav-item position-relative" id="navbarPopoverLogin">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="드롭다운형 로그인">
						로그인
					</a>
					<div class="dropdown-menu dropdown-menu-right">

						<?php if ($d['member']['login_emailid']): ?>
					  <form class="px-4 py-3" id="popover-loginform" action="<?php echo $g['s']?>/" method="post" style="width:250px">
							<input type="hidden" name="r" value="<?php echo $r?>">
							<input type="hidden" name="a" value="login">
							<input type="hidden" name="form" value="">

					    <div class="form-group position-relative">
					      <label for="">이메일 또는 휴대폰 번호</label>
					      <input type="text" class="form-control" name="id" placeholder="" tabindex="1" autocorrect="off" autocapitalize="off" required tabindex="1">
								<div class="invalid-tooltip" data-role="idErrorBlock"></div>
					    </div>
					    <div class="form-group position-relative">
					      <label for="">패스워드</label>
					      <input type="password" class="form-control" name="pw" tabindex="2" required tabindex="2">
								<div class="invalid-tooltip" data-role="passwordErrorBlock"></div>
					    </div>

							<?php if ($d['member']['login_cookie']): ?>
							<div class="custom-control custom-checkbox" data-toggle="collapse" data-target="#popover-collapsealert">
							  <input type="checkbox" class="custom-control-input" id="popover-loginCookie" name="login_cookie" value="checked">
							  <label class="custom-control-label" for="popover-loginCookie">로그인 상태 유지</label>
							</div>
							<div class="collapse" id="popover-collapsealert">
							  <div class="alert alert-light border f12 mt-3">
							    개인정보 보호를 위해, 개인 PC에서만 사용해 주세요.
							  </div>
							</div>
							<?php endif; ?>

					    <button type="submit" class="btn btn-primary btn-block mt-2" data-role="submit" tabindex="3">
								<span class="not-loading">로그인</span>
								<span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 로그인중 ...</span>
							</button>
					  </form>

					  <div class="dropdown-divider"></div>
					  <a class="dropdown-item" href="#modal-join" data-toggle="modal" data-backdrop="static">회원가입</a>
					  <a class="dropdown-item" href="#modal-pwReset" data-toggle="modal" data-backdrop="static">비밀번호를 잊으셨나요?</a>
						<?php endif; ?>

						<?php if ($d['member']['login_emailid'] && $d['member']['login_social']): ?>
						<span class="section-divider"><span>또는</span></span>
						<?php endif; ?>

						<?php if ($d['member']['login_social']): ?>
						<div class="px-2 mt-2">

							<?php if ($d['connect']['use_n']): ?>
							<button type="button" class="btn btn-block btn-social btn-naver" data-connect="naver" role="button">
								<span></span>
								네이버로 로그인
							</button>
							<?php endif; ?>

							<?php if ($d['connect']['use_k']): ?>
		          <button type="button" class="btn btn-block btn-social btn-kakao" data-connect="kakao" role="button">
								<span></span>
		            카카오톡으로 로그인
		          </button>
							<?php endif; ?>

							<?php if ($d['connect']['use_g']): ?>
		          <button type="button" class="btn btn-block btn-social btn-google" data-connect="google" role="button">
								<span class="fa fa-google"></span>
		            구글로 로그인
		          </button>
							<?php endif; ?>

							<?php if ($d['connect']['use_f']): ?>
		          <button type="button" class="btn btn-block btn-social btn-facebook" data-connect="facebook" role="button">
								<span class="fa fa-facebook"></span>
		            페이스북으로 로그인
		          </button>
							<?php endif; ?>

							<?php if ($d['connect']['use_i']): ?>
		          <button type="button" class="btn btn-block btn-social btn-instagram" data-connect="instagram" role="button">
								<span class="fa fa-instagram"></span>
		            인스타그램으로 로그인
		          </button>
							<?php endif; ?>

		        </div>
						<?php endif; ?>


					</div>
				</li>

				<?php endif; ?>
	    </ul>
			<?php endif?>
		</div>
	</div><!-- /.container -->
</nav>
