
<?php getImport('calendar-heatmap','calendar-heatmap','0.4.1','css')?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js" charset="utf-8"></script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<!-- calendar-heatmap : https://github.com/DKirwan/calendar-heatmap -->
<?php getImport('calendar-heatmap','calendar-heatmap','0.4.1','js')?>

<!-- .pageTitle값을 추출하여 페이지 타이틀 적용 -->
<div class="pageTitle d-none"> <?php echo $mbrid ?> (<?php echo $_MH['nic'] ?>) </div>

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_vcard.php';?>
		</div>

		<div class="col-9 page-main">

			<?php include $g['dir_module_skin'].'_nav.php';?>

			<h2 class="f16 font-weight-normal mt-4 mb-2">
				최신 프로젝트
			</h2>

			<?php if (!$NUM_PROJECT): ?>
			<div class="blankslate blankslate-spacious blankslate-large wiki mb-3">
				<h4 class="h6 text-gray mb-0"><?php echo $mbrid ?> 에는 공개 프로젝트가 없습니다.</h4>
			</div>
			<?php else: ?>

							<ol class="pinned-repos-list mb-4 js-pinned-repos-reorder-list">

									<?php $_RCD=getDbArray($table['projectlist'],'(owner='.$_MH['uid'].' or manager='.$_MH['uid'].') and hidden=0 and auth=1','*','d_update','desc',4,1)?>
									<?php while($_R=db_fetch_array($_RCD)):?>
									<?php $owner=getDbData($table['s_mbrid'],'uid='.$_R['owner'],'id')?>

							    <li class="pinned-repo-item  p-3 mb-3 border border-gray-dark rounded-1 js-pinned-repo-list-item public source  sortable-button-item">
							      <div class="pinned-repo-item-content">
							        <span class="d-block position-relative">
						            <a href="/<?php echo $owner['id']?>/<?php echo $_R['id'] ?>" class="text-bold">
							          	<span class="repo js-repo" title="<?php echo $_R['id'] ?>"><?php echo $_R['id'] ?> </span>
							          </a>
							        </span>

							        <p class="pinned-repo-desc text-gray text-small d-block mt-2 mb-3"><?php echo $_R['content1'] ?></p>

							        <p class="mb-0 f12 text-gray">

												<!-- 서비스 타입구분 -->
												<?php if ($_R['svc_type'] == 2): ?><span class="svc_type free mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_R['svc_type'] == 3): ?><span class="svc_type economy mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_R['svc_type'] == 5): ?><span class="svc_type standard mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_R['svc_type'] == 7): ?><span class="svc_type premium mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php else: ?>
												<?php endif; ?>

							            <a href="/<?php echo $owner['id']?>/<?php echo $_R['id'] ?>/stargazers" class="pinned-repo-meta muted-link">
							              <i class="fa fa-star" aria-hidden="true"></i>
							              <?php echo $_R['num_star'] ?>
							            </a>
							        </p>
							      </div>
							    </li>
									<?php endwhile?>

							</ol>


			<?php endif; ?>






			<h2 class="f16 font-weight-normal mt-4 mb-2 d-flex justify-content-start align-items-center">
      	최근 1년간 <mark>0000</mark>회 참여
				<div class="subnav clearfix ml-auto">
					<div class="subnav-links subnav-sm f12">
						<a class="subnav-item selected" onclick="catFlag('1');">프로젝트</a>
						<a class="subnav-item" onclick="catFlag('2');">포럼</a>
					</div>
				</div>

			</h2>
			<div class="card">
				<div id="calendar-heatmap"></div>

				<div class="">
					<div class="contrib-column contrib-column-first table-column">
						<span class="text-muted">지난 1년간 참여</span>
						<span class="contrib-number">000 total</span>
						<span class="text-muted">Nov 8, 2016 – Nov 8, 2017</span>
					</div>
					<div class="contrib-column table-column">
						<span class="text-muted">지난 1년간 참여</span>
						<span class="contrib-number">000 total</span>
						<span class="text-muted">Nov 8, 2016 – Nov 8, 2017</span>
					</div>
					<div class="contrib-column table-column">
						<span class="text-muted">지난 1년간 참여</span>
						<span class="contrib-number">000 total</span>
						<span class="text-muted">Nov 8, 2016 – Nov 8, 2017</span>
					</div>
				</div>


			</div>


			<h3 class="f16 font-weight-normal mt-4 mb-2">최근 프로젝트 활동</h3>





		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>


<script type="text/javascript">
	var now = moment().endOf('day').toDate();
	var yearAgo = moment().startOf('day').subtract(1, 'year').toDate();
	var chartData = d3.time.days(yearAgo, now).map(function (dateElement) {
		return {
			date: dateElement,
			count: (dateElement.getDay() !== 0 && dateElement.getDay() !== 6) ? Math.floor(Math.random() * 60) : Math.floor(Math.random() * 10)
		};
	});

	var heatmap = calendarHeatmap()
		.data(chartData)
		.selector('#calendar-heatmap')
		.tooltipEnabled(true)
		.colorRange(['#eee', '#239a3b'])
		.onClick(function (data) {
			console.log('data', data);
		});
	heatmap();  // render the chart
</script>
