<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="robots" content="NOINDEX,NOFOLLOW">
<title><?php echo $_HS['name']?></title>

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $g['s']?>/_core/images/ico/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo $g['s']?>/_core/images/ico/favicon.ico">

<!-- bootstrap css -->
<?php getImport('bootstrap','css/bootstrap.min','4.0.0-beta.2','css')?>

<!-- jQuery -->
<?php getImport('jquery','jquery.min','3.2.1','js')?>

<?php getImport('popper.js','umd/popper.min','1.12.3','js')?>

<!-- bootstrap js -->
<?php getImport('bootstrap','js/bootstrap.min','4.0.0-beta.2','js')?>

<!-- 시스템 폰트 -->
<?php getImport('font-awesome','css/font-awesome','4.7.0','css')?>
<?php getImport('font-kimsq','css/font-kimsq',false,'css')?>

<!-- global css -->
<link href="<?php echo $g['url_layout']?>/_css/style.css" rel="stylesheet">

<?php
$g['incdir'] = $g['incdir']?$g['incdir']:$g['path_layout'].$d['layout']['dir'].'/_includes/';
$g['wcache'] = $d['admin']['cache_flag']?'?nFlag='.$date[$d['admin']['cache_flag']]:'';
$g['cssset'] = array
(
	$g['dir_module'].'main'=>$g['url_module'].'/main',
	$g['dir_module_comm']=>$g['url_module_comm'],
	$g['dir_module_mode']=>$g['url_module_mode'],
	$g['dir_module_admin']=>$g['url_module_admin'],
);
?>

<script>
var rooturl = '<?php echo $g['url_root']?>';
var rootssl = '<?php echo $g['ssl_root']?>';
var raccount= '<?php echo $r?>';
var moduleid= '<?php echo $m?>';
var memberid= '<?php echo $my['id']?>';
var is_admin= '<?php echo $my['admin']?>';
</script>

<script src="<?php echo $g['s']?>/_core/js/sys.js<?php echo $g['wcache']?>"></script>

<?php foreach ($g['cssset'] as $_key => $_val):?>
<?php if (is_file($_key.'.css')):?>
<link href="<?php echo $_val?>.css<?php echo $g['wcache']?>" rel="stylesheet">
<?php endif?>

<?php if (is_file($_key.'.js')):?>
<script src="<?php echo $_val?>.js<?php echo $g['wcache']?>"></script>
<?php endif?>
<?php endforeach?>

<!-- bootbox -->
<?php getImport('bootbox','bootbox',false,'js')?>
