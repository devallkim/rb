$(function () {

  $('[data-toggle="avatar"]').click(function() {
     $("#rb-upfile-avatar").click();
  });
  $("#rb-upfile-avatar").change(function() {
    var f = document.MbrPhotoForm;
    getIframeForAction(f);
    f.submit();
  });

  //본인확인을 위한 로그인
  $('#page-confirmPW').submit(function(e){
    e.preventDefault();
    e.stopPropagation();
    var form = $(this)
    siteLogin(form)
  });

})
