$(function() {

	$('#modal-login-form').submit( function(event){
		$(this).find('.js-submit').attr("disabled",true);
		setTimeout(function(){
			var f = document.getElementById("modal-login-form");
			getIframeForAction(f);
			f.submit();
		}, 500);
		event.preventDefault();
		event.stopPropagation();
		}
	);

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력

});
