

<!-- 공통 스크립트  -->
<script>


/*
  클립보드 기능 초기화 : clipboard.js 플러그인 참조
   data-clipboard-text="" 값이 복사된다.  data-feedback-msg="" 값이 메세지로 출력
*/
var clipboard = new Clipboard('[data-plugin="clipboard"]');

$('.container').tooltip({
   selector : '[data-attach-act="insert"]',
   container: 'body',
   trigger: 'hover',
   title : '본문삽입'
});

$('body').on('click','[data-attach-act="insert"]',function(){
 $(this).attr('data-original-title', '본문삽입 되었습니다.')
 $(this).tooltip('show');
 $(this).attr('data-original-title', '본문삽입')
});



</script>
