/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 데스크탑 시작하기 레이아웃 스크립트 (bs4-starter)
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */


$(function () {

	// navbar dropdown 로그인 - 실행
	$('#popover-loginform').submit(function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		siteLogin(form)
	});

	// navbar dropdown 로그인 - 로그인 영역 내부 클릭시 dropdown 닫히지 않도록
	$(document).on('click', '#navbarPopoverLogin .dropdown-menu', function (e) {
		e.stopPropagation();
	});

	// navbar dropdown 로그인 - dropdown 열릴때
	$('#navbarPopoverLogin').on('shown.bs.dropdown', function () {
		$(this).find('[name=id]').focus()  // 아이디 focus
		$(this).find('.form-control').val('').removeClass('is-invalid')  //에러이력 초기화
	})
	$(document).on('keyup','#popover-loginform .form-control',function(){
		$(this).removeClass('is-invalid') //에러 흔적 초기화
	});

	//modal 로그인 - 실행
	$('#modal-login').find('form').submit(function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		siteLogin(form)
	});

	// modal 로그인 - modal 열릴때
	$('#modal-login').on('shown.bs.modal', function () {
		$(this).find('[name=id]').focus() // 아이디 focus
		$(this).find('.form-control').val('').removeClass('is-invalid')  //에러 흔적 초기화
	})

 $("#modal-login").find('.form-control').keyup(function() {
	 $(this).removeClass('is-invalid') //에러 흔적 초기화
 });

	$('[data-toggle="tooltip"]').tooltip()  // 툴팁 플러그인 초기화
	$('[data-plugin="timeago"]').timeago();  // 상대시간 플러그인 초기화
  $('[data-plugin="mediaelement"]').mediaelementplayer(); // 동영상, 오디오 플레이어 초기화 http://www.mediaelementjs.com/
	initPhotoSwipeFromDOM('[data-plugin="photoswipe"]'); // 포토갤러리 초기화

	// 사용자 액션에 대한 피드백 메시지 제공을 위해 액션 실행후 쿠키에 저장된 결과 메시지를 출력시키고 초기화 시킵니다.
	putCookieAlert('site_login_result') // 실행결과 알림 메시지 출력

})
