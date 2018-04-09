<!DOCTYPE html>
<html lang="ko">
<head>
<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>
</head>
<body class="rb-layout-default">

	<?php include $g['dir_layout'].'/_includes/header.php' ?>

	<main role="main" class="content">

		<div class="content-padded">
			<?php if ($c) getWidget('rc-simple/nav-sub',array('smenu'=>'0','limit'=>'1','dropdown'=>'1','dispfmenu'=>'1'))?>
			<?php include __KIMS_CONTENT__ ?>
		</div>
		<?php include $g['dir_layout'].'/_includes/footer.php' ?>
	</main>

	<?php include $g['dir_layout'].'/_includes/footer.php' ?>
	<?php include $g['dir_layout'].'/_includes/component.php' ?>
	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

</body>
</html>
