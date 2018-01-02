<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_vcard.php';?>
		</div>

		<div class="col-9 page-main">

			<?php include $g['dir_module_skin'].'_nav.php';?>

			<div class="subnav clearfix my-3">
				<div class="subnav-links">
					<a class="subnav-item selected" onclick="catFlag('');">질문 <small>694</small></a>
					<a class="subnav-item" onclick="catFlag('1');">답변 <small>508</small></a>
				</div>
			</div>

    </div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>
