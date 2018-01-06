
<header class="navbar navbar-expand fixed-top navbar-dark bg-dark" role="navigation" data-scroll-header>

		<?php if($g['device'] && $module == 'dashboard'):?>
		<a class="navbar-brand" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.shortcut" style="margin-left:0;">
			<i class="kf kf-bi-01 fa-lg" style="color:#000;"></i>
		</a>
		<?php else:?>
		<a class="navbar-brand" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard<?php if($g['mobile']&&$_SESSION['pcmode']!='Y'):?>&amp;front=mobile.shortcut<?php endif?>">
			<span class="badge badge-light"><?php echo $MD['name']?></span>
		</a>
		<?php if($module == 'dashboard' && ($front == 'main' || $front == 'mobile.dashboard')):?>
		<i class="glyphicon glyphicon-cog rb-modal-dashboard js-tooltip" title="대시보드 꾸미기" data-toggle="modal" data-target="#modal_window"></i>
		<?php endif?>
		<?php endif?>

		<div class="navbar-collapse collapse">
			<?php if($g['device']&&$module=='dashboard'):?>
			<ul class="navbar-nav mr-auto">
				<li<?php if($front=='mobile.shortcut'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.shortcut">바로가기</a></li>
				<li<?php if($front=='mobile.dashboard'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.dashboard">대시보드</a></li>
				<li<?php if($front=='mobile.site'):?> class="active"<?php endif?>><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=dashboard&amp;front=mobile.site">사이트</a></li>
			</ul>
			<?php else:?>
			<ul class="navbar-nav mr-auto" id="rb-admin-ul-tabs">
				<?php $_front =explode('_' , $front); ?>
				<?php $_menuCount=count($d['amenu']);if(!$nosite&&$_menuCount):?>

				<?php if($_i<=10):?>
				<?php $_i=1;foreach($d['amenu'] as $_k => $_v):?>
				<li id="rb-more-tab-<?php echo $_i?>" class="nav-item">
					<a class="nav-link<?php if($_front[0] == $_k):?> active<?php endif?>" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_k ?>">
						<?php echo $_v ?>
					</a>
				</li>
				<?php $_i++;endforeach?>
				<?php endif?>

				<?php if($_i>10):?>
				<li class="nav-item dropdown rb-more-tabs">
					<a class="nav-link dropdown-toggle" href="#." data-toggle="dropdown">더보기</a>
					<div class="dropdown-menu dropdown-menu-right">
						<?php $_i=1;foreach($d['amenu'] as $_k => $_v):?>
						<a id="rb-more-tabs-<?php echo $_i?>" class="dropdown-item<?php if($front == $_k):?> active<?php endif?>" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=<?php echo $_k?>">
							<?php echo $_v?>
						</a>
						<?php $_i++;endforeach?>
					</div>
				</li>
				<?php endif?>
				<?php endif?>

			</ul>
			<?php endif?>



			<ul class="navbar-nav my-0">

        <?php if($module!='dashboard'):?>
        <li class="nav-item">
					<a class="nav-link<?php if($front == '_info'):?> active<?php endif?>" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=_info">
						<i class="fa fa-question-circle fa-lg"></i> 안내
					</a>
				</li>
				<?php endif?>

				<?php $exists_bookmark=getDbRows($table['s_admpage'],'memberuid='.$my['uid']." and url='".$g['s'].'/?r='.$r.'&m='.$m.'&module='.$module.'&front='.$front."'")?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
						<i id="_bookmark_star_" class="fa fa-lg fa-star<?php if($exists_bookmark):?> rb-star-fill<?php else:?>-o<?php endif?>"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right p-0">
						<div class="card border-0 mb-0" style="width: 300px">
							<div class="card-header d-flex justify-content-between align-items-center p-2">
								북마크
								<div>
									<div id="_bookmark_notyet_" class="btn-group btn-group-sm dropdown<?php if($exists_bookmark):?> d-none<?php endif?>">

										<button type="button" class="btn btn-light rb-bookmark-add">북마크에 추가</button>
										<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div id="rb-bookmark-dropdown1" class="dropdown-menu">
											<a href="#." class="dropdown-item  rb-bookmark-add">북마크에 추가</a>
											<div class="dropdown-divider"></div>
											<a href="#." data-toggle="modal" data-target="#modal_window" class="dropdown-item  rb-modal-bookmark">북마크 관리</a>
										</div>
									</div>
									<div id="_bookmark_already_" class="btn-group btn-group-sm dropdown<?php if(!$exists_bookmark):?> d-none<?php endif?>">
										<button type="button" class="btn btn-light disabled">추가됨</button>
										<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div id="rb-bookmark-dropdown2" class="dropdown-menu">
											<a class="dropdown-itemr b-bookmark-del" href="#">북마크에서 삭제</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item rb-modal-bookmark" href="#" data-toggle="modal" data-target="#modal_window">북마크 관리</a>
										</div>
									</div>
								</div>
							</div>
							<div id="_add_bookmark_" class="list-group list-group-flush rb-scrollbar">
								<?php $ADMPAGE = getDbArray($table['s_admpage'],'memberuid='.$my['uid'],'*','gid','asc',0,1)?>
								<?php while($R=db_fetch_array($ADMPAGE)):?>
								<a href="<?php echo $R['url']?>" class="list-group-item list-group-item-action" id="_now_bookmark_<?php echo $R['uid']?>"><i class="fa fa-fw fa-file-text-o"></i><?php echo $R['name']?></a>
								<?php endwhile?>
								<?php if(!db_num_rows($ADMPAGE)):?><a class="list-group-item"><i class="fa fa-fw fa-file-text-o"></i>등록된 북마크가 없습니다</a><?php endif?>
							</div>
							<div class="card-footer p-0 border-top-0">
								<a href="#." data-toggle="modal" data-target="#modal_window" class="rb-modal-bookmark btn btn-link btn-block">북마크 관리</a>
							</div>
						</div>
					</div>
				</li>


			</ul>

		</div><!-- /.navbar-collapse -->

</header>



<main id="rb-admin-page-content">
<?php include $g['adm_module'] ?>
</main>

<script>
$(document).ready(function()
{
	document.body.onload = tabSetting;
	document.body.onresize = tabSetting;

	<?php if($g['device']):?>
	$('#bs-example-navbar-collapse-1').on('show.bs.collapse', function () {
		$("#_navbar_header_").addClass('rb-header-bottom-line');
	});
	$('#bs-example-navbar-collapse-1').on('hide.bs.collapse', function () {
		$("#_navbar_header_").removeClass('rb-header-bottom-line');
	});
	getId('_add_bookmark_').style.maxHeight = '205px';
	<?php endif?>
	$('#bs-example-navbar-collapse-1 [data-toggle=dropdown]').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$(this).parent().siblings().removeClass('open');
		$(this).parent().toggleClass('open');
	});
	$(".rb-help-btn").click(function(){
		$(this).button('toggle');
	});
	$('.rb-modal-bookmark').on('click',function() {
		modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=admin&amp;front=modal.bookmark')?>');
	});
	$('.rb-bookmark-add').on('click',function() {
		frames._action_frame_admin.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=bookmark&_addmodule=<?php echo $module?>&_addfront=<?php echo $front?>';
	});
	$('.rb-bookmark-del').on('click',function() {
		frames._action_frame_admin.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=bookmark_delete&deltype=hidden&_addmodule=<?php echo $module?>&_addfront=<?php echo $front?>';
	});
});
function tabSetting()
{
	<?php if($g['device']):?>
	$('#bs-example-navbar-collapse-1').removeClass('navbar-collapse');
	if(document.body.scrollWidth > 750) $('#bs-example-navbar-collapse-1').addClass('navbar-collapse');
	else $('#bs-example-navbar-collapse-1').removeClass('navbar-collapse');
	<?php endif?>

	var i;
	var bodyWidth = document.body.scrollWidth;
	var allTabnum = <?php echo (int)$_menuCount?>;
	var showTabnum = allTabnum;
	var showTabMore = false;

	if (allTabnum > 3)
	{
		if (bodyWidth >= 0 && bodyWidth < 360)
		{
			showTabnum = 2;
			showTabMore = true;
		}
		else if (bodyWidth >= 360 && bodyWidth < 523)
		{
			showTabnum = 3;
			showTabMore = true;
		}
		else if (bodyWidth >= 523 && bodyWidth < 640)
		{
			showTabnum = 4;
			showTabMore = true;
		}
		else if (bodyWidth >= 640 && bodyWidth < 750)
		{
			showTabnum = 5;
			showTabMore = true;
		}
		else if (bodyWidth >= 750 && bodyWidth < 1100)
		{
			showTabnum = 8;
			showTabMore = true;
		}
		else if (bodyWidth >= 1100 && bodyWidth < 1400)
		{
			showTabnum = 10;
			showTabMore = false;
		}
		else if (bodyWidth >= 1400)
		{
			showTabnum = allTabnum;
			showTabMore = false;
		}
	}
	for (i = 1; i <= allTabnum; i++)
	{
		$('#rb-more-tab-'+i).removeClass('d-none');
		$('#rb-more-tabs-'+i).removeClass('d-none');
	}
	for (i = showTabnum+1; i <= allTabnum; i++) $('#rb-more-tab-'+i).addClass('d-none');
	for (i = 0; i <= showTabnum; i++) $('#rb-more-tabs-'+i).addClass('d-none');
	if (showTabMore == true) $('.rb-more-tabs').removeClass('d-none');
	else $('.rb-more-tabs').addClass('d-none');
}
</script>
