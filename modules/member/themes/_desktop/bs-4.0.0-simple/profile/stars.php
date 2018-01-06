<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">

<style media="screen">
	.rb-project-tbody .btn::after {
		content: ''
	}
	.rb-project-tbody .btn.active::after {
		content: ' 취소'
	}
</style>

<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_vcard.php';?>
		</div>

		<div class="col-9 page-main">

			<?php include $g['dir_module_skin'].'_nav.php';?>


							<?php

							$sort	= $sort ? $sort : 'd_regis';
							$orderby= $orderby ? $orderby : 'desc';
							$recnum	= $recnum && $recnum < 201 ? $recnum : 20;

							$sqlque	= 'mbruid='.$_MH['uid'];

							if($where && $keyw) $sqlque .= getSearchSql($where,$keyw,$ikeyword,'or');

							$RCD = getDbArray($table['projectstar'],$sqlque,'*',$sort,$orderby,$recnum,$p);
							$NUM = getDbRows($table['projectstar'],$sqlque);
							$TPG = getTotalPage($NUM,$recnum);
							$viewset = array(''=>'전체 프로젝트','ing'=>'개발중인 프로젝트','end'=>'서비스중인 프로젝트','my'=>'내 프로젝트','manager'=>'내가 매니저인 프로젝트','make'=>'내가 만든 프로젝트');
							?>


							<?php if ($NUM): ?>
							<div class="pb-3 mt-3">
								<form class="d-flex justify-content-start" action="index.html" method="post">
									<div style="width: 350px">
										<input type="search" class="form-control w-100" placeholder="프로젝트 검색">
									</div>
									<div class="pl-2">
										<div class="ml-2 d-inline-block">
											<div class="dropdown">
												<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i>Type:</i>
													All
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item<?php if($type == 'public'):?> active<?php endif?>" href="/<?php echo $mbrid ?>?page=<?php echo $page?>&amp;type=public">공개</a>
													<a class="dropdown-item<?php if($type == 'private'):?> active<?php endif?>" href="/<?php echo $mbrid ?>?page=<?php echo $page?>&amp;type=private">비공개</a>

												</div>
											</div><!-- /.dropdown -->
										</div><!-- /.d-inline-block -->

										<div class="ml-2 d-inline-block">
											<div class="dropdown">
												<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i>정렬:</i>
													최근 별점순
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="#">최근 별점순</a>
													<a class="dropdown-item" href="#">최근 업데이트순</a>
													<a class="dropdown-item" href="#">별점 많은순</a>
												</div>
											</div><!-- /.dropdown -->
										</div><!-- /.d-inline-block -->
									</div><!-- /.d-table-cell -->

								</form>
							</div>
							<?php endif; ?>

							<table class="table">
								<tbody class="rb-project-tbody">
									<?php while($R=db_fetch_array($RCD)):?>
									<?php $_PROJECT = array_merge($R,getDbData($table['projectlist'],'uid='.$R['project'],'uid,id,content1,owner,svc_type,d_update,num_star'))?>
 									<?php $owner=getDbData($table['s_mbrid'],'uid='.$_PROJECT['owner'],'id')?>
									<?php $R['ismbr']=getDbRows($table['projectmember'],'mbruid='.$_MH['uid'].' and project='.$R['project'])?>

									<tr>
									<td>
										<div class="text-left">
											<h3>
												<a href="/<?php echo $owner['id']?>/<?php echo $_PROJECT['id']?>"><?php echo $owner['id']?> / <?php echo $_PROJECT['id']?></a>
												<?php if($_PROJECT['hidden']):?>
												<span class="badge badge-light text-gray f12">Private</span>
												<?php endif?>
											</h3>
											<p class="mb-2"><?php echo $_PROJECT['content1']?></p>
											<p class="mb-2 f12 text-gray">

												<a class="muted-link mr-3" href="/<?php echo $owner['id']?>/<?php echo $_PROJECT['id']?>/stargazers">
										      <i class="fa fa-star" aria-hidden="true"></i>
										      <?php echo $_PROJECT['num_star']?>
										    </a>

												<!-- 서비스 타입구분 -->
												<?php if ($_PROJECT['svc_type'] == 2): ?><span class="svc_type free mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_PROJECT['svc_type'] == 3): ?><span class="svc_type economy mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_PROJECT['svc_type'] == 5): ?><span class="svc_type standard mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($_PROJECT['svc_type'] == 7): ?><span class="svc_type premium mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php else: ?>
												<?php endif; ?>

												<?php if ($_PROJECT['d_update']): ?>
												<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($_PROJECT['d_update'],'c')?>" title="<?php echo  getDateFormat($R['d_update']?$R['d_update']:$R['d_regis'],'Y/m/d H:i')?>"></time> 업데이트
												<?php endif; ?>

											</p>
										</div>
									</td>
									<td class="rb-vertical-middel text-right">
										<?php if ($my['uid']): ?>
											<?php $_isStar = getDbRows($table['projectstar'],'mbruid='.$my['uid'].' and project='.$_PROJECT['uid']); ?>
											<button class="btn btn-light btn-sm<?php echo $_isStar?' active':'' ?>" type="button" data-action="iframe" data-url="<?php echo $g['url_action']?>profile_star&amp;project=<?php echo $_PROJECT['id']?>" data-toggle="button">
												<i class="fa fa-star" aria-hidden="true"></i>
												별점
											</button>
										<?php else: ?>
											<a class="btn btn-light btn-sm" href="/login">
												<i class="fa fa-star" aria-hidden="true"></i>
												별점
											</a>
										<?php endif; ?>




									</td>
									</tr>
									<?php endwhile?>



									<?php if(!$NUM):?>


									<tr>
										<td>


											<div class="blankslate blankslate-spacious blankslate-large wiki mt-3">
											  <i class="fa fa-star fa-2x text-gray-light" aria-hidden="true"></i>
											  <h3 class="mt-2">아직 별표가 있는 프로젝트가 없습니다.</h3>
											  <p>프로젝트에서 <a href="/project">탐색</a> 시에 별표를 지정하면 나중에 여기에 표시됩니다.</p>
											</div>


										</td>
									<tr>


									<?php endif?>



								</tbody>
							</table>

							<?php if($TPG > 1):?>
							<nav aria-label="Page navigation" class="mt-4">
								<ul class="pagination justify-content-center">
									<?php echo getPageLink(10,$p,$TPG,'','','')?>
								</ul>
							</nav>
							<?php endif?>




    </div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->


<!-- timeago -->
<?php getImport('jquery-timeago','jquery.timeago','1.6.1','js')?>
<?php getImport('jquery-timeago','locales/jquery.timeago.ko','1.6.1','js')?>


<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>


<script type="text/javascript">
	document.title = '별점';
	$(".timeago").timeago();
</script>
