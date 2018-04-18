<!-- 게시물 추출 위젯에서 참조하는 파일 입니다. -->
<?php $d['bbs']['c_mskin_modal'] = '_mobile/rc-modal'; ?>

<link href="<?php echo $g['url_module_skin'] ?>/_main.css" rel="stylesheet">
<link href="<?php echo $g['url_root']?>/modules/comment/themes/<?php echo $d['bbs']['c_mskin_modal'] ?>/css/style.css" rel="stylesheet">
<script src="<?php echo $g['url_module_skin'] ?>/js/getPostData.js" ></script>

<script>

  $(function () {

    var settings={
      type    : 'modal', // 호출 컴포넌트 타입(modal,page)
      mid     : '#modal-bbs-view', // 컴포넌트 아이디
      ctheme  : '<?php echo $d['bbs']['c_mskin_modal'] ?>' //모달 댓글테마
    }

    getPostData(settings); // 데이터 출력관련

  })

</script>
