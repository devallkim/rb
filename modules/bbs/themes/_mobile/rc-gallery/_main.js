$(function () {


    //목록에서 photoswipe 연결
    $('[data-toggle="openGallery"]').tap(function(e) {
      var category = $(this).data('category')
      var subject = $(this).data('subject')
      var comment = $(this).data('comment')
      var likes = $(this).data('likes')
      var bid = $(this).data('bid')
      var uid = $(this).data('uid')
      var theme = $(this).data('theme')
      var url = $(this).data('url')
      var pswpElement = document.querySelectorAll('.pswp')[0];
      var modal = $('.pswp')
      var bbs_title = document.title

      modal.find('[name="uid"]').val(uid)
      modal.find('[name="theme"]').val(theme)
      modal.find('[name="bid"]').val(bid)

      modal.find('[data-role="subject"]').text(subject);
      modal.find('[data-role="comment"]').text(comment);
      modal.find('[data-role="likes"]').text(likes);

      // 게시물 가져오기 및 댓글 셋팅
      $.post(rooturl+'/?r='+raccount+'&m=bbs&a=get_postData',{
         bid : bid,
         uid : uid,
         theme : theme,
         AttachListType : 'object'
        },function(response){
         // modal.find('[data-role="article"]').loader("hide");
         var result = $.parseJSON(response);
         var article=result.article;
         var adddata=result.adddata;

         var hidden=result.hidden;
         var mypost=result.mypost;
         var items=result.photo;

         var is_post_liked=result.is_post_liked;
         var is_post_disliked=result.is_post_disliked;
         var is_post_saved=result.is_post_saved;
         var is_post_tag=result.is_post_tag;

         var theme_use_reply=result.theme_use_reply;
         var theme_show_tag=result.theme_show_tag;
         var theme_show_upfile=result.theme_show_upfile;
         var theme_show_like=result.theme_show_like;
         var theme_show_dislike=result.theme_show_dislike;
         var theme_snsping=result.theme_snsping;




         // photosiwpe 초기화

         // define options (if needed)
         var options = {
           // history & focus options are disabled on CodePen
           history: true,
           focus: false,
           closeOnScroll: false,
           closeOnVerticalDrag: false,
           showAnimationDuration: 0,
           hideAnimationDuration: 0,
           timeToIdle: 4000,
           loop: false,
           mainClass: 'pswp-comment'
         };

          if (!items) {
            alert('첨부된 사진이 없습니다.');
            return false
          }
          if (items.length==0) {
            alert('표시할 사진이 없습니다. 이미지 숨김 처리여부를 확인해 주세요.');
            return false
          }

         var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
         gallery.init();
       });
     })


})
