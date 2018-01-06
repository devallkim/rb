<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_vcard.php';?>
		</div>

		<div class="col-9 page-main">

			<?php include $g['dir_module_skin'].'_nav.php';?>



			<div class="pb-3 mt-3">
		    <form class="d-flex justify-content-start" action="index.html" method="post">
		      <div style="width: 350px">
		        <input type="search" class="form-control w-100" placeholder="프로젝트 검색">
		      </div>
		      <div class="pl-2">
		        <div class="ml-2 d-inline-block">
		          <div class="dropdown">
		            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		              <i>타입:</i>
		              전체
		            </button>
		            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		              <a class="dropdown-item<?php if($type == 'public'):?> active<?php endif?>" href="/<?php echo $mbrid ?>?page=<?php echo $page?>&amp;type=public">공개</a>
		              <a class="dropdown-item<?php if($type == 'private'):?> active<?php endif?>" href="/<?php echo $mbrid ?>?page=<?php echo $page?>&amp;type=private">비공개</a>

		            </div>
		          </div><!-- /.dropdown -->
		        </div><!-- /.d-inline-block -->

		      </div><!-- /.d-table-cell -->

		      <div class="ml-auto">
		        <a class="btn btn-primary" href="/new">새 프로젝트</a>
		      </div>
		    </form>
		  </div>

							<?php
							$sort	= $sort ? $sort : 'uid';
							$orderby= $orderby ? $orderby : 'desc';
							$recnum	= $recnum && $recnum < 201 ? $recnum : 20;

							if ($my['uid'] == $_MH['uid'] ) {
								$sqlque	= 'auth=1 and (owner='.$_MH['uid'].' or manager='.$_MH['uid'].')';
							} else {
								$sqlque	= 'auth=1 and hidden=0 and (owner='.$_MH['uid'].' or manager='.$_MH['uid'].')';
							}

							if($dispType == 'ing') $sqlque .= ' and process=0';
							if($dispType == 'end') $sqlque .= ' and process=1';
							if($dispType == 'manager' ) $sqlque .= ' and manager='.$_MH['uid'];
							if($dispType == 'owner' ) $sqlque .= ' and owner='.$_MH['uid'];

							if($where && $keyw) $sqlque .= getSearchSql($where,$keyw,$ikeyword,'or');

							$RCD = getDbArray($table['projectlist'],$sqlque,'*',$sort,$orderby,$recnum,$p);
							$NUM = getDbRows($table['projectlist'],$sqlque);
							$TPG = getTotalPage($NUM,$recnum);
							$viewset = array(''=>'전체 프로젝트','ing'=>'개발중인 프로젝트','end'=>'서비스중인 프로젝트','my'=>'내 프로젝트','manager'=>'내가 매니저인 프로젝트','make'=>'내가 만든 프로젝트');
							?>

							<table class="table">
								<tbody class="rb-project-tbody">
									<?php while($R=db_fetch_array($RCD)):?>
									<?php $R['ismbr']=getDbRows($table['projectmember'],'mbruid='.$_MH['uid'].' and project='.$R['uid'])?>
									<?php $R['pminfo']=getDbData($table['s_mbrdata'],'memberuid='.$R['manager'],'name,nic')?>
									<?php $R['owinfo']=getDbData($table['s_mbrdata'],'memberuid='.$R['owner'],'name,nic')?>
									<?php $owner=getDbData($table['s_mbrid'],'uid='.$R['owner'],'id')?>
									<tr>
									<td>
										<div class="text-left">
											<h3>
												<a href="/<?php echo $owner['id']?>/<?php echo $g['url_project'].$R['id']?>"><?php echo $R['id']?></a>
												<?php if($R['hidden']):?>
												<span class="badge badge-light text-gray f12">Private</span>
												<?php endif?>
											</h3>
											<p class="mb-2"><?php echo $R['content1']?></p>
											<p class="mb-2 f12 text-gray">


												<a class="muted-link mr-3" href="/<?php echo $owner['id']?>/<?php echo $R['id']?>/stargazers">
													<i class="fa fa-star" aria-hidden="true"></i>
													<?php echo $R['num_star']?>
												</a>

												<!-- 서비스 타입구분 -->
												<?php if ($R['svc_type'] == 2): ?><span class="svc_type free mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($R['svc_type'] == 3): ?><span class="svc_type economy mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($R['svc_type'] == 5): ?><span class="svc_type standard mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php elseif ($R['svc_type'] == 7): ?><span class="svc_type premium mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php else: ?>
												<?php endif; ?>

												<?php if ($R['d_update']): ?>
												<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_update'],'c')?>" title="<?php echo  getDateFormat($R['d_update'],'Y/m/d H:i')?>"></time> 업데이트
												<?php endif; ?>

											</p>
										</div>
									</td>
									<td class="rb-vertical-middel text-right">
										<button class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal_window" data-href="<?php echo $g['url_project'].$R['id']?>&amp;owner=modal&amp;sCall=modal.projectmember">
											정보보기
										</button>
									</td>
									</tr>
									<?php endwhile?>
									<?php if(!$NUM):?>
									<tr>
									<td>



										<div class="blankslate blankslate-spacious blankslate-large wiki mt-3">
											<h4 class="h6 text-gray mb-0"><?php echo $mbrid ?> 에는 공개 프로젝트가 없습니다.</h4>
										</div>



									</td>
									<tr>
									<?php endif?>
								</tbody>
							</table>

							<nav aria-label="Page navigation" class="mt-4">
								<ul class="pagination justify-content-center">
									<?php echo getPageLink(10,$p,$TPG,'','','')?>
								</ul>
							</nav>





















    </div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- timeago -->
<?php getImport('jquery-timeago','jquery.timeago','1.6.1','js')?>
<?php getImport('jquery-timeago','locales/jquery.timeago.ko','1.6.1','js')?>


<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>

<script type="text/javascript">
	document.title = '프로젝트';
	$(".timeago").timeago();
</script>
