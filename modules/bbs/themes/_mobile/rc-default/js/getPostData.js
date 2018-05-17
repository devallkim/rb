/**
 * --------------------------------------------------------------------------
 * kimsQ Rb v2.2 모바일 기본형 게시판 테마 스크립트 (rc-default): getPostData.js
 * Homepage: http://www.kimsq.com
 * Licensed under RBL
 * Copyright 2018 redblock inc
 * --------------------------------------------------------------------------
 */


function getPostData(settings){
  var type=settings.type; //컴포넌트 타입
  var mid=settings.mid; // 컴포넌트 아이디
  var ctheme=settings.ctheme; // 댓글테마
  var page = $('.page')
  var page_allcomment = $('#page-bbs-allcomments')  // 댓글 전체보기 페이지
  var popup_linkshare = $('#popup-link-share')  //링크공유 팝업
  var kakao_link_btn = $('#kakao-link-btn')  //카카오톡 링크공유 버튼

  //  게시물보기 모달이 보여질때 : 게시물 본문영역 셋팅
  $(mid).on('show.rc.'+type, function(event) {
    var ele = $(event.relatedTarget) // 모달을 호출한 아이템 정의
    var bid = $(ele).attr('data-bid')?$(ele).attr('data-bid'):''; // 게시판 아이디
    var uid = $(ele).attr('data-uid')?$(ele).attr('data-uid'):''; // 대상 PK
    var subject = $(ele).attr('data-subject')?$(ele).attr('data-subject'):''; // 제목
    var cat = $(ele).attr('data-cat')?$(ele).attr('data-cat'):''; // 카테고리
    var url = $(ele).attr('data-url')?$(ele).attr('data-url'):''; // url
    var item = ele.closest('.table-view-cell')
    item.attr('tabindex','-1').focus();  // 모달을 호출한 아이템을 포커싱 처리함 (css로 배경색 적용)
    var modal = $(this)
    modal.find('[name="uid"]').val(uid)
    modal.find('[name="bid"]').val(bid)
    page.find('[data-role="subject"]').text(subject)
    page.find('[data-role="cat"]').text(cat)

    modal.find('[data-role="article"]').loader({  //  로더 출력
      position:   "inside"
    });
    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         bid : bid,
         uid : uid,
         device : 'mobile'
      },function(response){
       modal.find('[data-role="article"]').loader("hide");
       var result = $.parseJSON(response);
       var article=result.article;
       var adddata=result.adddata;
       var photo=result.photo;
       var video=result.video;
       var audio=result.audio;
       var youtube=result.youtube;
       var file=result.file;
       var zip=result.zip;
       var doc=result.doc;
       var hidden=result.hidden;
       var hidden_attach=result.hidden_attach;
       var mypost=result.mypost;

       var is_post_liked=result.is_post_liked;
       var is_post_disliked=result.is_post_disliked;
       var is_post_tag=result.is_post_tag;

       var bbs_c_hidden=result.bbs_c_hidden;  // 댓글 사용여부
       var theme_use_reply=result.theme_use_reply;
       var theme_show_tag=result.theme_show_tag;
       var theme_show_upfile=result.theme_show_upfile;
       var theme_show_like=result.theme_show_like;
       var theme_show_dislike=result.theme_show_dislike;
       var theme_show_share=result.theme_show_share;

       modal.find('[data-role="article"]').html(article);
       modal.find('[data-role="linkShare"]').attr('data-url',url)

       if (is_post_liked) modal.find('[data-role="btn_post_like"]').addClass('active');
       if (is_post_disliked) modal.find('[data-role="btn_post_dislike"]').addClass('active')

       if (bbs_c_hidden) {
        modal.find('[data-role="btn_comment"]').remove()  // 좋아요 버튼 제거
       }

       if (theme_show_like==0) {
        modal.find('[data-role="btn_post_like"]').remove()  // 좋아요 버튼 제거
       }
       if (theme_show_dislike==0) {
        modal.find('[data-role="btn_post_dislike"]').remove()  // 싫어요 버튼 제거
       }
       if (theme_show_share==0) {
        modal.find('[data-role="linkShare"]').remove()  // sns공유 버튼 제거
       }

       if (theme_show_tag==0 || !is_post_tag) {
        modal.find('[data-role="post_tags"]').remove()  // 테그목록 제거
       }

       if (photo) {  // 첨부 이미지가 있을 경우
         modal.find('[data-role="attach-photo"]').removeClass('hidden').html(photo)
         RC_initPhotoSwipe(); // photoswipe 초기화
       }

       if (video) {  // 첨부 비디오가 있을 경우
         modal.find('[data-role="attach-video"]').removeClass('hidden').html(video)
         modal.find('[data-plugin="mediaelement"]').mediaelementplayer(); // http://www.mediaelementjs.com/
         modal.find('.mejs__overlay-button').css('margin','0') //mejs-player 플레이버튼 위치재조정
       }

       if (audio) {  // 첨부 오디오가 있을 경우
         modal.find('[data-role="attach-audio"]').removeClass('hidden').html(audio)
         modal.find('[data-plugin="mediaelement"]').mediaelementplayer(); // http://www.mediaelementjs.com/
       }

       if (doc) {  // 첨부 문서 있을 경우
         modal.find('[data-role="attach-file"]').removeClass('hidden').html(doc)
       }

       if (zip) {  // 첨부 압축파일이 있을 경우
         modal.find('[data-role="attach-file"]').removeClass('hidden').html(zip)
       }

       if (file) {  // 첨부 기타파일이 있을 경우
         modal.find('[data-role="attach-file"]').removeClass('hidden').html(file)
       }

       if (youtube) {  // 첨부 유튜브가 있을 경우
         modal.find('[data-role="attach-youtube"]').removeClass('hidden').html(youtube)
         modal.find('[data-plugin="mediaelement"]').mediaelementplayer(); // http://www.mediaelementjs.com/
       }

       if (theme_show_upfile==0) {
        modal.find('[data-role="attach"]').remove()  // 첨부목록 제거
       }

       // 댓글 출력 함수 정의
       var get_Rb_Comment = function(p_module,p_table,p_uid,theme){
         page_allcomment.find('.commentting-all').Rb_comment({
          moduleName : 'comment', // 댓글 모듈명 지정 (수정금지)
          parent : p_module+'-'+p_uid, // rb_s_comment parent 필드에 저장되는 형태가 p_modulep_uid 형태임 참조.(- 는 저장시 제거됨)
          parent_table : p_table, // 부모 uid 가 저장된 테이블 (게시판인 경우 rb_bbs_data : 댓글, 한줄의견 추가/삭제시 전체 합계 업데이트용)
          theme_name : theme, // 댓글 테마
          containerClass :'', // 본 엘리먼트(#commentting-container)에 추가되는 class
          recnum: 5, // 출력갯수
          commentPlaceHolder : '댓글을 입력해주세요.',
          noMoreCommentMsg : '댓글 없음 ',
          commentLength : 200, // 댓글 입력 글자 수 제한
         });
       }
       // 댓글 출력 함수 실행
       var p_module = 'bbs';
       var p_table = 'rb_bbs_data';
       var p_uid = uid; // 게시물 고유번호 적용
       var theme = ctheme;

       if (!hidden) {
         get_Rb_Comment(p_module,p_table,p_uid,theme);

         setTimeout(function(){
           page.find('[data-role="subject"]').text(subject)
           page.find('[data-role="cat"]').text(cat)
         }, 300);
       }

       if (!mypost) {  // 내글이 아니거나 관리자가 아닐때
        modal.find('[data-role="toolbar"]').remove()  // 수정,삭제가 포함된 툴바,첨부파일,댓글을 제거함
       }

       if (hidden || hidden_attach) {  // 권한이 없거나 비밀글 이거나 첨부파일 권한이 없을 경우 일때
        modal.find('[data-role="attach-photo"]').empty()
        modal.find('[data-role="attach-video"]').empty()
        modal.find('[data-role="attach-audio"]').empty()
        modal.find('[data-role="attach-file"]').empty()
       }

    });
  })

  //  게시물보기 모달이 보여진 후에..
   $(mid).on('shown.rc.'+type, function(event) {
    var ele = $(event.relatedTarget) // element that triggered the modal
    var uid = ele.data('uid') // 게시물 고유번호 추출
    var modal = $(this);


   });

   //좋아요,싫어요
   $(mid).on('click','[data-act="opinion"]',function(){
     var send = $(this).data('send')
     var uid = $(this).data('uid')
     var opinion = $(this).data('opinion')
     var effect = $(this).data('effect')
     var myid = $(this).data('myid')
     $.post(rooturl+'/?r='+raccount+'&m=bbs&a=opinion',{
       send : send,
       opinion : opinion,
       uid : uid,
       memberid : memberid
       },function(response){
        var result = $.parseJSON(response);
        var error=result.error;
        var is_post_liked=result.is_post_liked;
        var is__post_disliked=result.is_post_disliked;
        var likes=result.likes;
        var dislikes=result.dislikes;
        var msg=result.msg;

        if (!error) {
          if (opinion=='like') {
            if (is_post_liked) {
              var msg = '좋아요가 취소 되었습니다.';
              $('[data-role="btn_post_like"]').removeClass('active '+effect);
            }
            else {
              var msg = '좋아요가 추가 되었습니다.';
              $('[data-role="btn_post_like"]').addClass('active '+effect);
              $('[data-role="btn_post_dislike"]').removeClass('active '+effect);
            }
          }
          if (opinion=='dislike') {
            if (is_post_disliked) {
              var msg = '싫어요 취소 되었습니다.';
              $('[data-role="btn_post_dislike"]').removeClass('active '+effect);
            }
            else {
              var msg = '싫어요 추가 되었습니다.';
              $('[data-role="btn_post_dislike"]').addClass('active '+effect)
              $('[data-role="btn_post_like"]').removeClass('active '+effect)
            }
          }
          $('[data-role="likes_'+uid+'"]').text(likes)
          $('[data-role="dislikes_'+uid+'"]').text(dislikes)
        }
        $.notify({message: msg},{type: 'default'});
      });
    });

   //게시물보기 모달이 닫혔을 때
   $(mid).on('hidden.rc.'+type, function() {
      var modal = $(this);
      var uid = modal.find('[name="uid"]').val()
      var list_parent =  $('[data-role="bbs-list"]').find('#item-'+uid)
      list_parent.attr('tabindex','-1').focus();  // 모달을 호출한 아이템을 포커싱 처리함 (css로 배경색 적용)
      modal.find('[data-role="article"]').html(''); // 본문영역 내용 비우기

      modal.find('[data-role="attach-photo"]').addClass('hidden').empty() // 사진 영역 초기화
      modal.find('[data-role="attach-video"]').addClass('hidden').empty() // 비디오 영역 초기화
      modal.find('[data-role="attach-youtube"]').addClass('hidden').empty() // 유튜브 영역 초기화
      modal.find('[data-role="attach-audio"]').addClass('hidden').empty() // 오디오 영역 초기화
      modal.find('[data-role="attach-file"]').addClass('hidden').empty() // 기타파일 영역 초기화
      page.find('.commentting-all').html(''); // 댓글영역 내용 비우기
   });

   //전체댓글보기 페이지가 호출되었을때
   page_allcomment.on('show.rc.page', function(event) {
      var button = $(event.relatedTarget)
      var num = button.data('num')
      var page = $(this);
      var uid = $(mid).find('[name="uid"]').val()
      page.find('[data-role="total_comment"]').text(num); //댓글갯수 적용

      // 댓글 등록창 자동 리사이즈
  		autosize($('.commentting-all textarea'));

  		// 댓글 등록 버튼 동적 출력
  		$('.commentting-all .input-group textarea').on('keyup', function(event) {
  			var $oneline = $('.commentting-all .input-group');
  			$oneline.find('button[type="submit"]').css("display", "none").removeClass("animated bounceIn delay-3");
  			if ($(this).val().length >= 1) {
  				$oneline.find('button[type="submit"]').css("display", "block").addClass("animated bounceIn delay-3");
  			}
  		});
   });

	 // 게시물 보기 모달에서 댓글이 등록된 이후에 ..
   page_allcomment.find('.commentting-all').on('saved.rb.comment',function(){
     var modal = $(mid)
     var bid = modal.find('[name="bid"]').val()
     var uid = modal.find('[name="uid"]').val()
     var theme = modal.find('[name="theme"]').val()
		 var list_item = $('[data-role="bbs-list"]').find('#item-'+uid)
     var showComment_Ele_1 = page_allcomment.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
     var showComment_Ele_2 = modal.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
	   var showComment_ListEle = list_item.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element

     $('.commentting-all .input-group textarea').removeAttr("style"); //늘어난 댓글 입력창 초기화
     $('.commentting-all .rb-submit').css('display','none')

     $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
          bid : bid,
          uid : uid,
          theme : theme
       },function(response){
          var result = $.parseJSON(response);
          var total_comment=result.total_comment;
					$.notify({message: '댓글이 등록 되었습니다.'},{type: 'default'});
          showComment_Ele_1.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
          showComment_Ele_2.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
					showComment_ListEle.text(total_comment); // 게시물 목록 해당 항목의 최종 댓글수량 합계 업데이트
     });
     page_allcomment.find('.content').animate({ scrollTop: 100000000 }, 600);  // 댓글 타임라인 스크롤 최하단으로 이동
   });

   // 게시물 보기 모달에서 한줄의견이 등록된 이후에..
   page_allcomment.find('.commentting-all').on('saved.rb.oneline',function(){
     var modal = $(mid)
     var bid = modal.find('[name="bid"]').val()
     var uid = modal.find('[name="uid"]').val()
     var theme = modal.find('[name="theme"]').val()
 		 var list_item = $('[data-role="bbs-list"]').find('#item-'+uid)
     var showComment_Ele_1 = page_allcomment.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
     var showComment_Ele_2 = modal.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element

	   var showComment_ListEle = list_item.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
     $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
          bid : bid,
          uid : uid,
          theme : theme
       },function(response){
          var result = $.parseJSON(response);
          var total_comment=result.total_comment;
          $.notify({message: '한줄의견이 등록 되었습니다.'},{type: 'default'});
          showComment_Ele_1.text(total_comment); // 최종 댓글수량 합계 업데이트
          showComment_Ele_2.text(total_comment); // 최종 댓글수량 합계 업데이트
					showComment_ListEle.text(total_comment); // 게시물 목록 해당 항목의 최종 댓글수량 합계 업데이트
     });
   });

   // 댓글이 수정된 후에..
   page_allcomment.find('.commentting-all').on('edited.rb.comment',function(){
     setTimeout(function(){
       $.notify({message: '댓글이 수정 되었습니다.'},{type: 'default'});
     }, 300);
   })

   // 한줄의견이 수정 후에
   page_allcomment.find('.commentting-all').on('edited.rb.oneline',function(){
     setTimeout(function(){
       $.notify({message: '의견이 수정 되었습니다.'},{type: 'default'});
     }, 300);
   })


   //링크 공유 팝업이 열릴때
   popup_linkshare.on('shown.rc.popup', function (event) {
     var ele = $(event.relatedTarget)
     var path = ele.attr('data-url')?ele.attr('data-url'):''
     var host = $(location).attr('origin');
     var sbj = ele.attr('data-subject')?ele.attr('data-subject'):'' // 버튼에서 제목 추출
     var email = ele.attr('data-email')?ele.attr('data-email'):'' // 버튼에서 이메일 추출
     var desc = ele.attr('data-desc')?ele.attr('data-desc'):'' // 버튼에서 요약설명 추출
     var image = ele.attr('data-image')?ele.attr('data-image'):'' // 버튼에서 대표이미지 경로 추출
     var popup = $(this)

     var link = host+path // 게시물 보기 URL
     var enc_link = encodeURIComponent(host+path) // URL 인코딩
     var imageUrl = host+image // 대표이미지 URL
     var enc_sbj = encodeURIComponent(sbj) // 제목 인코딩
     var facebook = 'http://www.facebook.com/sharer.php?u=' + enc_link;
     var twitter = 'https://twitter.com/intent/tweet?url=' + enc_link + '&text=' + sbj;
     var naver = 'http://share.naver.com/web/shareView.nhn?url=' + enc_link + '&title=' + sbj;
     var kakaostory = 'https://story.kakao.com/share?url=' + enc_link + '&title=' + enc_sbj;
     var email = 'mailto:' + email + '?subject=링크공유-' + enc_sbj+'&body='+ enc_link;

     popup.find('[data-role="share"]').val(host+path)
     popup.find('[data-role="share"]').focus(function(){
       $(this).on("mouseup.a keyup.a", function(e){
         $(this).off("mouseup.a keyup.a").select();
       });
     });

     popup.find('[data-role="facebook"]').attr('href',facebook)
     popup.find('[data-role="twitter"]').attr('href',twitter)
     popup.find('[data-role="naver"]').attr('href',naver)
     popup.find('[data-role="kakaostory"]').attr('href',kakaostory)
     popup.find('[data-role="email"]').attr('href',email)

     //카카오 링크
     function sendLink() {
       Kakao.Link.sendDefault({
         objectType: 'feed',
         content: {
           title: sbj,
           description: desc,
           imageUrl: imageUrl,
           link: {
             mobileWebUrl: link,
             webUrl: link
           }
         },
         buttons: [
           {
             title: '바로가기',
             link: {
               mobileWebUrl: link,
               webUrl: link
             }
           },
         ]
       });
     }

     //카카오톡 링크공유
      kakao_link_btn.click(function() {
        sendLink()
      });

  })

};
