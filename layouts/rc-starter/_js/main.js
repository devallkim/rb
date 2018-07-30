/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 모바일 시작하기 레이아웃 스크립트 (rc-starter)
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */

var bar = $('.bar')
var drawer_left = $('#drawer-left')
var drawer_right = $('#drawer-right')

var noti_sort = 'uid';
var noti_orderby = 'desc';
var noti_recnum = '10';

function moreNOTI(container,totalPage){
  var noti_currentPage =1; // 처음엔 무조건 1, 아래 더보기 진행되면서 +1 증가
  container.infinitescroll({
    dataSource: function(helpers, callback){
      var noti_nextPage = parseInt(noti_currentPage)+1;
      console.log('noti_totalpage: '+totalPage)
      console.log('noti_currentPage: '+noti_currentPage)
      console.log('noti_sort: '+noti_sort)
      $.get(rooturl+'/?r='+raccount+'&m=notification&a=get_notiList',{
          page : noti_nextPage,
          sort: noti_sort,
          orderby: noti_orderby,
          recnum: noti_recnum,
          callMod: 'unread'
      },function(response) {
          var result = $.parseJSON(response);
          var error = result.error;
          var content = result.content;
          if(error) alert(result.error_comment);
          callback({ content: content });
          noti_currentPage++; // 현재 페이지 +1
          console.log(noti_currentPage+'페이지 불러옴')
          $('[data-plugin="timeago"]').timeago();
          if (totalPage<=noti_currentPage) {
            container.infinitescroll('end')
            console.log('더이상 불러올 알림이 없습니다.')
          }
      });
    },
    appendToEle : container.find('.table-view'),
    percentage : 95,  // 95% 아래로 스크롤할때 다움페이지 호출
    hybrid : false  // true: 버튼형, false: 자동
  });

}

$(function() {

  putCookieAlert('site_login_result') // 로그인/로그아웃 알림 메시지 출력

  RC_initPhotoSwipe(); // 포토갤러리 초기화 (모바일 전용)

	$('[data-plugin="timeago"]').timeago();  // 상대시간 플러그인 초기화
  $('[data-plugin="mediaelement"]').mediaelementplayer(); // 동영상, 오디오 플레이어 초기화 http://www.mediaelementjs.com/

  $(document).on('tap','[data-toggle="changeModal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var type    = $this.attr('data-type')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, '')))
    var $start = $($this.closest('.modal'))
    if ($this.is('a')) e.preventDefault()
    $start.modal('hide').removeClass('active')
    setTimeout(function(){ $target.modal('show'); }, 300);
	});

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
  $('body').on('tap click','[data-toggle="drawer-close"]',function(){
		drawer_left.drawer('hide')
    drawer_right.drawer('hide')
	});

  //내알림 드로어(사이드메뉴영역)가 열렸을때
  drawer_right.on('show.rc.drawer', function () {
    var drawer_right_content = drawer_right.find('.content')
    $.get(rooturl+'/?r='+raccount+'&m=notification&a=get_notiList',{
        sort: noti_sort,
        orderby: noti_orderby,
        recnum: noti_recnum,
        callMod: 'unread'
      },function(response){
       var result = $.parseJSON(response);
       var num=result.num;
       var tpg=result.tpg;
       var content=result.content;

       drawer_right.find('[data-role="noti-list"]').html(content);
       drawer_right.find('[data-plugin="timeago"]').timeago();
			 bar.find('[data-role="noti-status"]').text(num);
       drawer_right.find('[data-role="noti-status"]').text(num);
       drawer_right.find('[data-role="noti-list"]').attr('data-totalPage',tpg);
       moreNOTI(drawer_right_content,tpg)
    });
  })

  //내알림 드로어(사이드메뉴영역)가 닫혔을때
  drawer_right.on('hidden.rc.drawer', function () {
    //무한스크롤 리셋
    drawer_right.find('.content').infinitescroll('destroy')
    drawer_right.append('<div class="content bg-faded"><ul class="table-view table-view-full my-0 bg-white" data-role="noti-list"></ul></div>');
  })

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
  $('body').on('tap click','[data-act="keyword-reset"]',function(){
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

	//외부서비스 사용자 인증요청
  $('body').on('tap click','[data-connect]',function(){
    var provider = $(this).data('connect')

		// /core/engine/cssjs.engine.php 참고
		if (provider=='naver') var target = connect_naver
		if (provider=='kakao') var target = connect_kakao
		if (provider=='google') var target = connect_google
		if (provider=='facebook') var target = connect_facebook
		if (provider=='instagram') var target = connect_instagram
    var referer = window.location.href  // 연결후, 원래 페이지 복귀를 위해

    $(".content").loader({
      text:       "연결 중...",
      position:   "overlay"
    });

    $.post(rooturl+'/?r='+raccount+'&m=connect&a=save_referer',{
    	referer : referer
  		},function(response,status){

        if(status=='success'){
          setTimeout(function() {
  					$(".content").loader("hide");
  		      document.location = target;
  		    }, 500);
        }else{
          alert(status);
        }
    });
	});

});
