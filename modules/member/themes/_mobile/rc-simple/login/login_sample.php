<style>
.rb-root {
	display: table;
	height: 100%;
	width: 100%;
	padding: 0;
}
#rb-login {
	display: table-cell;
	text-align: left;
	margin: 0 auto;
	padding: 10% 0 100px;
}
#rb-login .panel {
	margin:0 auto 15px;
	border: 1px solid #AAA;
	border-bottom: 1px solid #888;
	border-radius: 3px;
	color: #444;
	box-shadow: 0px 2px 2px #AAA;
}
#rb-login .panel .form-group label {
	font-weight: normal;
}
#rb-login .panel .form-control.input-lg {
	border-radius: 2px;
}
#rb-login .panel-footer ul {
	margin-bottom: 0	
}
#rb-login .panel-foote a {
	font-size: 90%;
}

/*반응형 설정*/
@media (min-width: 481px) {
	#rb-login .panel {
		width: 350px;
	}	
}
@media (max-width: 480px) {
	body {
		background-color: #fff !important
   }
	#rb-login {
		padding: 0;
	}
	#rb-login .panel {
		box-shadow : none;
		border: none;
		border-radius: none;
		background-color: inherit;
	}
	#rb-login .panel-footer {
		background-color: transparent;
	}
	#rb-login h1 {
		font-size: 20px
	}
	#rb-login .btn.btn-primary {
		width: 100%;
		padding: 10px 16px;
		font-size: 18px;
		line-height: 1.33;
		border-radius: 6px;
	}
}

</style>

<div class="rb-root">
	<div id="rb-login">
		<div class="panel panel-default">
			<div class="panel-heading">
				 <h4 class="panel-title">회원 로그인</h4>
			</div>
			<div class="panel-body">
					<form role="form">
							<div class="form-group">
								<label class="sr-only" for="">아이디 또는 이메일을 입력해주세요</label>
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="email" class="form-control" id="" placeholder="아이디 또는 이메일을 입력해주세요">
								</div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="">Password</label>
								<div class="input-icon">
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" id="" placeholder="비밀번호를 입력해주세요.">
								</div>
							</div>
							<p>
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> 정보기억 
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox2" value="option2"> <abbr title="SSL:Secure Sockets Layer">보안접속</abbr>
								</label>
							</p>				
							<div class="well well-sm">
								<ul class="list-unstyled">
								  <li>비밀번호를 잊으셨나요 ? <a href="<?php echo $g['url_reset']?>&page=idpwsearch">도움이 필요하세요?</a></li>
								  <li>회원계정이 없으신가요 ? <a href="<?php echo RW('mod=signup')?>">가입하기</a></li>
								</ul>
							</div>
						</form>	
				</div>
				<div class="panel-footer text-right">
					 <button type="input" class="btn btn-primary">로그인</button>
			   </div>
		</div>
	</div>
</div>