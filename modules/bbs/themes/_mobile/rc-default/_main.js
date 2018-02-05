var doBbsList = function(){
  //  게시물보기 모달이 보여질때 : 게시물 본문영역 셋팅
  $('#modal-bbs-view').on('show.rc.modal', function(event) {
    var ele = $(event.relatedTarget) // 모달을 호출한 아이템 정의
    var bid = $(ele).attr('data-bid')?$(ele).attr('data-bid'):''; // 게시판 아이디
    var uid = $(ele).attr('data-uid')?$(ele).attr('data-uid'):''; // 대상 PK
    var theme = $(ele).attr('data-theme')?$(ele).attr('data-theme'):''; // 테마
    var subject = $(ele).attr('data-subject')?$(ele).attr('data-subject'):''; // 테마
    var item = ele.closest('.table-view-cell')
    item.attr('tabindex','-1').focus();  // 모달을 호출한 아이템을 포커싱 처리함 (css로 배경색 적용)
    var modal = $(this)
    modal.find('[data-role="article"]').loader({  //  로더 출력
      position:   "inside"
    });
    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
       bid : bid,
       uid : uid,
       theme : theme
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
       var mypost=result.mypost;

			 modal.find('[name="uid"]').val(uid)
       modal.find('[name="theme"]').val(theme)
       modal.find('[data-role="subject"]').text(subject)
       modal.find('[data-role="article"]').html(article);

       if (photo) {  // 첨부 이미지가 있을 경우
         modal.find('[data-role="attach-photo"]').removeClass('hidden').html(photo)
         RC_initPhotoSwipe(); // photoswipe 초기화
       }

       if (video) {  // 첨부 비디오가 있을 경우
         modal.find('[data-role="attach-video"]').removeClass('hidden').html(video)
         modal.find('.mejs-player').mediaelementplayer(); // http://www.mediaelementjs.com/
         modal.find('.mejs__overlay-button').css('margin','0') //mejs-player 플레이버튼 위치재조정
       }

       if (audio) {  // 첨부 오디오가 있을 경우
         modal.find('[data-role="attach-audio"]').removeClass('hidden').html(audio)
         modal.find('.mejs-player').mediaelementplayer(); // http://www.mediaelementjs.com/
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
         modal.find('.mejs-player').mediaelementplayer(); // http://www.mediaelementjs.com/
       }

       // 댓글 출력 함수 정의
       var get_Rb_Comment = function(p_module,p_table,p_uid,theme){
         modal.find('.commentting-container').Rb_comment({
          moduleName : 'comment', // 댓글 모듈명 지정 (수정금지)
          parent : p_module+'-'+p_uid, // rb_s_comment parent 필드에 저장되는 형태가 p_modulep_uid 형태임 참조.(- 는 저장시 제거됨)
          parent_table : p_table, // 부모 uid 가 저장된 테이블 (게시판인 경우 rb_bbs_data : 댓글, 한줄의견 추가/삭제시 전체 합계 업데이트용)
          theme_name : theme, // 댓글 테마
          containerClass :'rb-commentting', // 본 엘리먼트(#commentting-container)에 추가되는 class
          recnum: 5, // 출력갯수
          commentPlaceHolder : '비방 및 욕설이 들어간 댓글은 별다른 고지 없이 삭제 될 수 있습니다.',
          noMoreCommentMsg : '댓글 없음 ',
          commentLength : 200, // 댓글 입력 글자 수 제한
         });
       }

       // 댓글 출력 함수 실행
       var p_module = 'bbs';
       var p_table = 'rb_bbs_data';
       var p_uid = uid; // 게시물 고유번호 적용
       var theme = '_mobile/rc-default';

       if (!hidden) {
         get_Rb_Comment(p_module,p_table,p_uid,theme);
       }

       if (!mypost) {  // 내글이 아니거나 관리자가 아닐때
        modal.find('[data-role="toolbar"]').remove()  // 수정,삭제가 포함된 툴바,첨부파일,댓글을 제거함
       }

       if (hidden && !mypost) {  // 비밀글 일때
        modal.find('[data-role="attach-photo"]').empty()
        modal.find('[data-role="attach-video"]').empty()
        modal.find('[data-role="attach-audio"]').empty()
        modal.find('[data-role="attach-file"]').empty()
       }

       setTimeout(function(){ // 첨부된 이미지들이 전부 로드되어야 정확안 높이를 구할수 있음. 로드시간 확보를 위한 대기시간
         var post_height = modal.find('[data-role="post"]').height(); // 게시물 영역의 높이
         modal.find('[data-role="post"]').attr('height',post_height)
       }, 500);

    });
  })

  //  게시물보기 모달이 보여진 후에 : 댓글 영역 셋팅
   $('#modal-bbs-view').on('shown.rc.modal', function(event) {
    var ele = $(event.relatedTarget) // element that triggered the modal
    var uid = ele.data('uid') // 게시물 고유번호 추출
    var modal = $(this);

		// 댓글 바로가기 버튼
		modal.on('tap click','.js-moveComments',function(){ // 댓글 컨테이너로 이동
      var post_height = modal.find('[data-role="post"]').attr('height')
      modal.find('.content').animate({scrollTop : post_height}, 200);
		});

    // 폰의 키보드가 올라왔을때, 댓글 입력창 위치 재조정
    var _originalSize = $(window).width() + $(window).height()
    $(window).resize(function(){
      if($(window).width() + $(window).height() != _originalSize){
        console.log("키보드 올라옴");
        var post_height = modal.find('[data-role="post"]').attr('height')
        modal.find('.content').animate({scrollTop : post_height}, 100);
  			return true;
      }else{
        console.log("키보드 내려감");
  			return false;
      }
    });

   });

   //게시물보기 모달이 닫혔을 때
   $('#modal-bbs-view').on('hidden.rc.modal', function() {
      var modal = $(this);
      var uid = modal.find('[name="uid"]').val()
      var list_parent =  $('[data-role="bbs-list"]').find('#item-'+uid)
      list_parent.attr('tabindex','-1').focus();  // 모달을 호출한 아이템을 포커싱 처리함 (css로 배경색 적용)
      modal.find('[data-role="article"]').html(''); // 본문영역 내용 비우기
      modal.find('.commentting-container').html(''); // 댓글영역 내용 비우기

      modal.find('[data-role="attach-photo"]').addClass('hidden').empty() // 사진 영역 초기화
      modal.find('[data-role="attach-video"]').addClass('hidden').empty() // 비디오 영역 초기화
      modal.find('[data-role="attach-youtube"]').addClass('hidden').empty() // 유튜브 영역 초기화
      modal.find('[data-role="attach-audio"]').addClass('hidden').empty() // 오디오 영역 초기화
      modal.find('[data-role="attach-file"]').addClass('hidden').empty() // 기타파일 영역 초기화
   });

	 // 게시물 보기 모달에서 댓글이 등록된 이후에 댓글 수량 업데이트
   $('#modal-bbs-view').find('.commentting-container').on('saved.rb.comment',function(){
     var modal = $('#modal-bbs-view')
     var uid = modal.find('[name="uid"]').val()
     var theme = modal.find('[name="theme"]').val()
		 var list_item = $('#page-bbs-list').find('#item-'+uid)
     var showComment_Ele = modal.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
	   var showComment_ListEle = list_item.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element

     $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
          uid : uid,
          theme : theme
       },function(response){
          var result = $.parseJSON(response);
          var total_comment=result.total_comment;
					$.notify({message: '댓글이 등록 되었습니다.'},{type: 'default'});
          showComment_Ele.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
					showComment_ListEle.text(total_comment); // 게시물 목록 해당 항목의 최종 댓글수량 합계 업데이트
					console.log(total_comment)
     });
   });

   // 게시물 보기 모달에서 한줄의견이 등록된 이후에 댓글 수량 업데이트
   $('#modal-bbs-view').find('.commentting-container').on('saved.rb.oneline',function(){
     var modal = $('#modal-bbs-view')
     var uid = modal.find('[name="uid"]').val()
     var theme = modal.find('[name="theme"]').val()
 		 var list_item = $('#page-bbs-list').find('#item-'+uid)
     var showComment_Ele = modal.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
	   var showComment_ListEle = list_item.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
     $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
          uid : uid,
          theme : theme
       },function(response){
          var result = $.parseJSON(response);
          var total_comment=result.total_comment;
          $.notify({message: '한줄의견이 등록 되었습니다.'},{type: 'default'});
          showComment_Ele.text(total_comment); // 최종 댓글수량 합계 업데이트
					showComment_ListEle.text(total_comment); // 게시물 목록 해당 항목의 최종 댓글수량 합계 업데이트
     });
   });

};


$(function() {

  //게시물 링크 공유 팝업이 열릴때
  $('#popup-bbs-view-share').on('show.rc.popup', function (event) {
    console.log('팝업이 열렸어요')
    var ele = $(event.relatedTarget) // 팝업을 호출한 아이템 정의
    var link = $(location).attr('href')
    var popup = $(this)
    popup.find('[data-role="share"]').val(link)
    popup.find('[data-role="share"]').focus(function(){
      $(this).on("mouseup.a keyup.a", function(e){
        $(this).off("mouseup.a keyup.a").select();
      });
    });
  })

	$("[data-action='iframe']").click(function() {
		getIframeForAction('');
		frames.__iframe_for_action__.location.href = $(this).attr("data-url");
	});

	$(".js-btn-href").click(function() {
		location.href = $(this).attr("data-href");
	});


  // 게시물 보기 페이지에서 댓글이 등록된 이후에 댓글 수량 업데이트
  $('#page-bbs-view').find('#commentting-container').on('saved.rb.comment',function(){
    var page = $('#page-bbs-view')
    var uid = page.data('uid')
    var showComment_Ele = page.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element

    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         uid : uid
      },function(response){
         var result = $.parseJSON(response);
         var total_comment=result.total_comment;
         $.notify({message: '댓글이 등록 되었습니다.'},{type: 'default'});
         showComment_Ele.text(total_comment); // 모달 상단 최종 댓글수량 합계 업데이트
         console.log(total_comment)
    });
  });

  // 게시물 보기 페이지에서 한줄의견이 등록된 이후에 댓글 수량 업데이트
  $('#page-bbs-view').find('#commentting-container').on('saved.rb.oneline',function(){
    var page = $('#page-bbs-view')
    var uid = page.data('uid')
    var showComment_Ele = page.find('[data-role="total_comment"]'); // 댓글 숫자 출력 element
    $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         uid : uid
      },function(response){
         var result = $.parseJSON(response);
         var total_comment=result.total_comment;
         $.notify({message: '한줄의견이 등록 되었습니다.'},{type: 'default'});
         showComment_Ele.text(total_comment); // 최종 댓글수량 합계 업데이트
    });
  });


});
