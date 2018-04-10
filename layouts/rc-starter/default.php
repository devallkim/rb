<!DOCTYPE html>
<html lang="ko">
<head>

<?php include $g['dir_layout'].'/_includes/_import.head.php' ?>

<!-- snap 서랍형 사이드메뉴 -->
<?php getImport('snap','rc-snap','1.9.3','css')?>
<?php getImport('snap','rc-snap','1.9.3','js')?>

</head>
<body class="rb-layout-default">

	<div class="snap-drawers">
		<div class="snap-drawer snap-drawer-left" id="drawer-left">
			<?php include $g['dir_layout'].'/_includes/drawer-left.php' ?>
		</div>
		<div class="snap-drawer snap-drawer-right bg-faded" id="drawer-right">
			<?php include $g['dir_layout'].'/_includes/drawer-right.php' ?>
		</div>
	</div>

	<div class="snap-content" data-extension="drawer">

		<?php include $g['dir_layout'].'/_includes/header.php' ?>

		<?php if ($c): ?>
		<div class="bar bar-standard bar-header-secondary bar-light bg-white animated fadeIn delay-1" data-snap-ignore="true">
		 <h1 class="title"><?php echo $_HM['name']?></h1>
		</div>
		<?php endif; ?>

		<main role="main" class="content" data-snap-ignore="true">

			<article class="content-padded animated fadeIn delay-1 markdown-body" style="min-height:250px" role="article">
				<?php include __KIMS_CONTENT__ ?>
			</article>
			<?php include $g['dir_layout'].'/_includes/footer.php' ?>
		</main>

		<?php include $g['dir_layout'].'/_includes/footer.php' ?>
	</div><!-- /.snap-content -->

	<?php include $g['dir_layout'].'/_includes/component.php' ?>

	<?php include $g['dir_layout'].'/_includes/_import.foot.php' ?>

	<script>
		$(function() {
			RC_initDrawer();  // 드로어 플러그인 초기화
		});
	</script>

</body>
</html>
