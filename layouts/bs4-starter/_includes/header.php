<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
	<div class="container">
		<a class="navbar-brand" href="<?php  echo RW(0) ?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsDefault">
			<ul class="navbar-nav mr-auto">
				<?php getWidget('bs4-simple/navbar-menu',array('smenu'=>'0','limit'=>'2','dropdown'=>'1','dispfmenu'=>'1'))?>
			</ul>

			<ul class="navbar-nav">
				<?php if ($my['uid']): ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo RW('mod=settings') ?>">개인정보수정</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $g['s']?>/?r=<?php echo $r?>&a=logout">로그아웃</a>
				</li>
				<?php else: ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo RW('mod=join') ?>">회원가입</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo RW('mod=login') ?>">로그인</a>
				</li>
				<?php endif; ?>
	    </ul>
		</div>
	</div><!-- /.container -->
</nav>
