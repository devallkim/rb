/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 모바일 시작하기 레이아웃 스크립트 (rc-starter)
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */


$(function() {

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력
  RC_initPhotoSwipe(); // 포토갤러리 초기화 (모바일 전용)

	$('[data-plugin="timeago"]').timeago();  // 상대시간 플러그인 초기화
  $('[data-plugin="mediaelement"]').mediaelementplayer(); // 동영상, 오디오 플레이어 초기화 http://www.mediaelementjs.com/

	//modal 로그인 - 실행
	$('#modal-login').find('form').submit( function(e){
		e.preventDefault();
		e.stopPropagation();
		var form = $(this)
		siteLogin(form)
	});

	// modal 로그인이 닫혔을대
	$('#modal-login').on('hidden.rc.modal', function () {
	  $(this).find('input').removeClass('is-invalid') // 에러흔적 초기화
	})

	$("#modal-login").find('input').keyup(function() {
 	 $(this).removeClass('is-invalid') //에러 발생후 다시 입력 시도시에 에러 흔적 초기화
  });

	// 드로어(사이드메뉴영역) 닫기
	$('#drawer-close').tap(function() {
		$('#drawer-left').drawer('hide')
	});

	//검색 모달이 열렸을때
	$('#modal-search').on('shown.rc.modal', function () {
		setTimeout(function() {
			$('#search-input').val('').focus();
		}, 300);

		$('#search-input').autocomplete({
      lookup: function (query, done) {

         $.getJSON(rooturl+"/?m=tag&a=searchtag", {q: query}, function(res){
             var sg_tag = [];
             var data_arr = res.taglist.split(',');//console.log(data.usernames);
             $.each(data_arr,function(key,tag){
                 var tagData = tag.split('|');
                 var keyword = tagData[0];
                 var hit = tagData[1];
                 sg_tag.push({"value":keyword,"data":hit});
             });
             var result = {
                 suggestions: sg_tag
             };
              done(result);
         });
     },
        onSelect: function (suggestion) {
					if ($('#search-input').val().length >= 1) {
			      $( "#modal-search-form" ).submit();
			    }
        }
    });
	})

	// 검색버튼과 검색어 초기화 버튼 동적 출력
  $('#search-input').on('keyup', function(event) {
    var modal = $('#modal-search')
    modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
    modal.find("#drawer-search-footer").addClass('hidden') //검색풋터(검색버튼 포함) 숨김
    if ($(this).val().length >= 2) {
      modal.find('[data-role="keyword-reset"]').removeClass("hidden");
    }
  });

	// 검색어 입력필드 초기화
  $('[data-act="keyword-reset"]').tap(function(){
    var modal = $('#modal-search')
    modal.find("#search-input").val('').autocomplete('clear'); // 입력필드 초기화
    setTimeout(function(){
      modal.find("#search-input").focus(); // 입력필드 포커싱
      modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김
    }, 10);
  });

	// 검색모달이 닫혔을때
  $('#modal-search').on('hidden.rc.modal', function () {
		var modal = $(this)
    $('#search-input').autocomplete('clear');
		$('.autocomplete-suggestions').remove();
    modal.find('[data-role="keyword-reset"]').addClass("hidden"); // 검색어 초기화 버튼 숨김'
  })

});
