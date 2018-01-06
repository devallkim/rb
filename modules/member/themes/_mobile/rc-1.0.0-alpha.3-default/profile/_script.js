// .pageTitle값을 추출하여 페이지 타이틀 적용
var pageTitle = $(".pageTitle").text()
document.title = pageTitle;


$("[data-action='iframe']").click(function() {

  if (memberid != '') {
    getIframeForAction('');
    frames.__iframe_for_action__.location.href = $(this).attr("data-url");
  } else {
    location.href="/login";
  }

});
