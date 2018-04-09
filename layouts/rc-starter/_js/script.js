$(function() {

	//modal 로그인 - 실행
	$('#modal-login').find('form').submit( function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		siteLogin(form)
	});

	$('#modal-login').on('hidden.rc.modal', function () {
  $(this).find('input').removeClass('is-invalid')
})

	$("#modal-login").find('input').keyup(function() {
 	 $(this).removeClass('is-invalid') //에러 발생후 다시 입력 시도시에 에러 흔적 초기화
  });

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력

});
