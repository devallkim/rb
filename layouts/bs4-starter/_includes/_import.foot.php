<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/foot.engine.php'?>

<!-- 포토모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','default-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','photoswipe.min','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>
<script src="<?php echo $g['url_layout']?>/_js/photoswipe.js"></script>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>

<!-- 소셜공유시 URL 클립보드저장 : clipboard.js  : https://github.com/zenorocha/clipboard.js-->
<?php getImport('clipboard','clipboard.min','1.5.5','js') ?>

<!-- 입력 textarea 자동확장 -->
<?php getImport('autosize','autosize.min','3.0.14','js')?>

<!-- timeago : 상대시간 표기 -->
<?php getImport('jquery-timeago','jquery.timeago',false,'js')?>
<?php getImport('jquery-timeago','locales/jquery.timeago.ko',false,'js')?>

<!-- 자동링크 -->
<script src="<?php echo $g['s']?>/_core/js/jquery.autolink.js"></script>

<!-- 댓글출력시 필요 -->
<script src="<?php echo $g['url_root']?>/modules/comment/lib/Rb.comment.js"></script>

<!-- 레이아웃 공용 스크립트 -->
<script src="<?php echo $g['url_layout']?>/_js/script.js"></script>
