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

<!-- 파비콘 -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $g['img_layout']?>/icon/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo $g['img_layout']?>/icon/icon.png">


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

<!-- swiper : http://idangero.us/swiper/ -->
<?php getImport('swiper','css/swiper','4.2.2','css')?>
<?php getImport('swiper','js/swiper.min','4.2.2','js')?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.2.8','js') ?>
<?php getImport('mediaelement','lang/ko','4.2.8','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.2.8','css') ?>

<!-- 사이트 헤드 코드 -->
<?php echo $_HS['headercode']?>

<!-- 엔진코드:삭제하지마세요 -->
<?php include $g['path_core'].'engine/cssjs.engine.php' ?>

<!-- global css -->
<link href="<?php echo $g['url_layout']?>/_css/style.css<?php echo $g['wcache']?>" rel="stylesheet">

<!-- 카카오 -->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript">
	Kakao.init('<?php echo $d['connect']['jskey_k'] ?>');  // 카카오 앱의 JavaScript 키를 설정해 주세요.
</script>
