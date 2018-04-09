<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="theme-color" content="#333">

<!-- Seo -->
<meta name="robots" content="<?php echo strip_tags($g['meta_bot'])?>">
<meta name="title" content="<?php echo strip_tags($g['meta_tit'])?>">
<meta name="keywords" content="<?php echo strip_tags($g['meta_key'])?>">
<meta name="description" content="<?php echo strip_tags($g['meta_des'])?>">
<link rel="image_src" href="<?php echo strip_tags($g['meta_img'])?>">

<title><?php echo $g['browtitle']?></title>

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $g['s']?>/_core/images/ico/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo $g['s']?>/_core/images/ico/favicon.ico">


<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- rc css -->
<?php getImport('rc','css/rc','1.0.0-alpha.4','css')?>
<?php getImport('rc','css/rc-add','1.0.0-alpha.4','css')?>

<!-- jQuery -->
<?php getImport('jquery','jquery.min','1.12.4','js')?>

<!-- rc js -->
<?php getImport('rc','js/rc-custom','1.0.0-alpha.4','js')?>

<!-- 시스템 폰트 -->
<?php getImport('font-awesome','css/font-awesome','4.7.0','css')?>

<?php getImport('autosize','autosize.min','3.0.14','js')?>

<!-- 사진전용모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','rc-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','rc-photoswipe','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.1.3','js') ?>
<?php getImport('mediaelement','lang/ko','4.1.3','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.1.3','css') ?>

<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/cssjs.engine.php' ?>

<!-- global css -->
<link href="<?php echo $g['url_layout']?>/_css/style.css<?php echo $g['wcache']?>" rel="stylesheet">

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<script type="text/javascript">
	Kakao.init('ad801e290f033ce0caadf67ceff84ca2');
</script>
