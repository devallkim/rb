<div class="card">

	<div class="card-body">

		<p>
			회원관리 모듈은 <strong>회원가입/로그인/마이페이지</strong>를 포함하고 있습니다.<br>
			연결할 페이지를 선택해 주세요.
		</p>

		<button type="button" class="btn btn-light" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&front=join');">
			회원가입
		</button>
		<button type="button" class="btn btn-light" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&front=login');">
			로그인
		</button>
		<button type="button" class="btn btn-light" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&front=profile');">
			프로필
		</button>
		<button type="button" class="btn btn-light" onclick="dropJoint('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $smodule?>&front=settings');">
			개인정보 관리
		</button>
	</div>

</div>
