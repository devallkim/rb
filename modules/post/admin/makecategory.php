<?php
include $g['path_module'].$module.'/lib/tree.func.php';
$BLOGS = getDbArray($table[$module.'list'],'','*','gid','asc',0,$p);
$Minblog=getDbCnt($table[$module.'list'],'min(uid)','');
$blog=$blog?$blog:$Minblog;
$ISCAT = getDbRows($table[$module.'category'],'blog='.$blog);

if($cat)
{
	$CINFO = getUidData($table[$module.'category'],$cat);
	$ctarr = getMenuCodeToPathBlog($table[$module.'category'],$cat,0);
	$ctnum = count($ctarr);
	$CINFO['code'] = '';

	for ($i = 0; $i < $ctnum; $i++)
	{
		$CXA[] = $ctarr[$i]['uid'];
		$CINFO['code'] .= $ctarr[$i]['id'].($i < $ctnum-1 ? '/' : '');
		$_code .= $ctarr[$i]['uid'].($i < $ctnum-1 ? '/' : '');
	}
	$code = $code ? $code : $_code;

	for ($i = 0; $i < $ctnum; $i++) $CXA[] = $ctarr[$i]['uid'];
}

$catcode = '';
$is_fcategory =  $CINFO['uid'] && $vtype != 'sub';
$is_regismode = !$CINFO['uid'] || $vtype == 'sub';
if ($is_regismode)
{
	$CINFO['name']	   = '';
	$CINFO['mobile']   = '';
	$CINFO['hidden']   = '';
	$CINFO['metaurl']   = '';
	$CINFO['metause']   = '';
	$CINFO['recnum'] = 20;
}
?>

<div class="container-fluid">
	<div id="catebody" class="row">
		<div id="category" class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar">
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading rb-icon">
						<div class="icon">
							<i class="fa fa-sitemap fa-2x"></i>
						</div>
						<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapmetane">카테고리 내역</a></h4>
					</div>
					<div class="panel-collapse collapse in" id="collapmetane">
						<div class="panel-body rb-panel-form">
							<select class="form-control" onchange="goHref('<?php echo $g['adm_href']?>&amp;blog='+this.value);">
							<?php while($S = db_fetch_array($BLOGS)):?>
							<option value="<?php echo $S['uid']?>"<?php if($blog==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
							<?php endwhile?>
							<?php if(!db_num_rows($BLOGS)):?>
							<option value="">등록된 블로그가 없습니다.</option>
							<?php endif?>
							</select>
						</div>

						<div class="panel-body">
							<div style="min-height:300px;">
								<link href="<?php echo $g['s']?>/_core/css/tree.css" rel="stylesheet">
								<?php $_treeOptions=array('table'=>$table[$module.'category'],'blog'=>$blog,'dispNum'=>true,'dispHidden'=>false,'dispCheckbox'=>false,'allOpen'=>false,'bookmark'=>'blog-category-info')?>
								<?php $_treeOptions['link'] = $g['adm_href'].'&amp;blog='.$blog.'&amp;cat='?>
								<?php echo getTreeCategory($_treeOptions,$code,0,0,'')?>
							</div>
						</div>
					</div>
				</div>

				<?php if($g['device']):?><a name="site-menu-info"></a><?php endif?>
				<div class="panel panel-default">
					<div class="panel-heading rb-icon">
						<div class="icon">
							<i class="fa fa-retweet fa-2x"></i>
						</div>
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapseTwo">순서조정</a>
						</h4>
					</div>

					<div class="panel-collapse collapse" id="collapseTwo">
						<?php if($CINFO['isson']||(!$cat&&$ISCAT)):?>
						<form role="form" action="<?php echo $g['s']?>/" method="post">
						<input type="hidden" name="r" value="<?php echo $r?>">
						<input type="hidden" name="m" value="<?php echo $module?>">
						<input type="hidden" name="a" value="_admin/modifycategorygid">
							<div class="panel-body" style="border-top:1px solid #DEDEDE;">
								<div class="dd" id="nestable-menu">
									<ol class="dd-list">
									<?php $_MENUS=getDbSelect($table[$module.'category'],'blog='.$blog.' and parent='.intval($CINFO['uid']).' and depth='.($CINFO['depth']+1).' order by gid asc','*')?>
									<?php $_i=1;while($_M=db_fetch_array($_MENUS)):?>
									<li class="dd-item" data-id="<?php echo $_i?>">
									<input type="checkbox" name="categorymembers[]" value="<?php echo $_M['uid']?>" checked class="hidden">
									<div class="dd-handle"><i class="fa fa-arrows fa-fw"></i> <?php echo $_M['name']?></div>
									</li>
									<?php $_i++;endwhile?>
									</ol>
								</div>
							</div>
						</form>
						<!-- nestable : https://github.com/dbushell/Nestable -->
						<?php getImport('nestable','jquery.nestable',false,'js') ?>
						<script>
						$('#nestable-menu').nestable();
						$('.dd').on('change', function() {
							var f = document.forms[0];
							getIframeForAction(f);
							f.submit();
						});
						</script>
						<?php else:?>
						<div class="panel-body rb-blank">
							<?php if($cat):?>
							<?php echo sprintf('[%s] 하위에 등록된 카테고리가 없습니다.',$CINFO['name'])?>
							<?php else:?>
							<?php echo '등록된 카테고리가 없습니다.'?>
							<?php endif?>
						</div>
						<?php endif?>
					</div>
				</div>
			</div>
		</div>
		<div id="catinfo" class="col-sm-8 col-md-8 ml-sm-auto col-xl-9 pt-3">
			<form class="form-horizontal rb-form" name="procForm" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="_admin/regiscategory">
			<input type="hidden" name="blog" value="<?php echo $blog?>" />
			<input type="hidden" name="cat" value="<?php echo $CINFO['uid']?>" />
			<input type="hidden" name="vtype" value="<?php echo $vtype?>" />
			<input type="hidden" name="depth" value="<?php echo intval($CINFO['depth'])?>" />
			<input type="hidden" name="parent" value="<?php echo intval($CINFO['uid'])?>" />
			<div class="page-header">
				<h4>
					<?php if($is_regismode):?>
					    <?php if($vtype == 'sub'):?>서브 카테고리 만들기<?php else:?>최상위 카테고리 만들기<?php endif?>
					<?php else:?>
					  카테고리 등록정보
					  <div class="pull-right rb-top-btnbox hidden-xs">
						<a href="<?php echo $g['adm_href']?>" class="btn btn-default"><i class="fa fa-plus"></i> 최상위 카테고리 만들기</a>
					  </div>
					<?php endif?>
				</h4>
			</div>
			<?php if($vtype == 'sub'):?>
			<div class="form-group">
				<label class="col-md-3 control-label">상위 카테고리</label>
				<div class="col-md-9">
					<ol class="breadcrumb">
					<?php for ($i = 0; $i < $ctnum; $i++):?>
					<li><a href="<?php echo $g['adm_href']?>&amp;blog=<?php echo $blog?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a></li>
					<?php $catcode .= $ctarr[$i]['id'].'/';endfor?>
					</ol>
				</div>
			</div>
			<?php else:?>
				<?php if($cat):?>
				 <div class="form-group">
					<label class="col-md-3 control-label">상위 카테고리</label>
					<div class="col-md-9">
						<ol class="breadcrumb">
						<?php for ($i = 0; $i < $ctnum-1; $i++):?>
						<li><a href="<?php echo $g['adm_href']?>&amp;blog=<?php echo $blog?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a></li>
						<?php $delparent=$ctarr[$i]['uid'];$catcode .= $ctarr[$i]['id'].'/';endfor?>
						<?php if(!$delparent):?>최상위 카테고리<?php endif?>
						</ol>
					</div>
				</div>
				<?php endif?>
			<?php endif?>
			<div class="form-group rb-outside">
				<label class="col-md-3 control-label">카테고리 명칭  <?php if(!$is_fcategory):?><a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#guide_name"><i class="fa fa-question-circle fa-fw"></i></a><?php endif?></label>
				<div class="col-md-9">
					<?php if($is_fcategory):?>
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $CINFO['name']?>"<?php if(!$cat && !$g['device']):?> autofocus<?php endif?>>
						<span class="input-group-btn">
							<a href="<?php echo $g['adm_href']?>&amp;blog=<?php echo $blog?>&amp;cat=<?php echo $cat?>&amp;vtype=sub" class="btn btn-default" data-tooltip="tooltip" title="서브카테고리 등록">
								<i class="fa fa-share fa-rotate-90 fa-lg"></i>
							</a>
							<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=_admin/deletecategory&amp;blog=<?php echo $blog?>&amp;cat=<?php echo $cat?>&amp;parent=<?php echo $delparent?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');" class="btn btn-default" data-tooltip="tooltip" title="카테고리 삭제">
								<i class="fa fa-trash-o fa-lg"></i>
							</a>
						</span>
					</div>
					<?php else:?>
					<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $CINFO['name']?>"<?php if(!$g['device']):?> autofocus<?php endif?>>
					<div id="guide_name" class="collapse help-block alert alert-warning">
						<small>
							복수의 카테고리를 한번에 등록하시려면 카테고리명을 콤마(,)로 구분해 주세요.<br />
							보기)회사소개,커뮤니티,고객센터<br />
							카테고리코드를 같이 등록하시려면 다음과 같은 형식으로 등록해 주세요.<br />
							보기)회사소개=company,커뮤니티=community,고객센터=center<br />
							카테고리코드는 미등록시 자동생성됩니다.
						</small>
					</div>
					<?php endif?>
				</div>
			</div>
			<?php if($CINFO['uid']&&!$vtype):?>
			<div class="form-group rb-outside">
				<label class="col-md-3 control-label">카테고리 코드 <a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#guide_code"><i class="fa fa-question-circle fa-fw"></i></a></label>
				<div class="col-md-9">
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="id" value="<?php echo $CINFO['id']?>"<?php if(!$cat && !$g['device']):?> autofocus<?php endif?>>
						<span class="input-group-addon">
	                      고유키=<?php echo sprintf('%05d',$CINFO['uid'])?>
						</span>
					</div>
					<div id="guide_code" class="collapse help-block alert alert-warning">
					   <small>
					   	  	이 카테고리를 잘 표현할 수 있는 단어로 입력해 주세요.<br />
						영문대소문자/숫자/_/- 조합으로 등록할 수 있으며 중복될 수는 없습니다.<br />
						 </small>
					</div>
				</div>
			</div>
		   <?php endif?>
		   	<div class="form-group rb-outside">
				<label class="col-md-3 control-label">카테고리 옵션 <a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#guide_option"><i class="fa fa-question-circle fa-fw"></i></a></label>
				<div class="col-md-9">
					<div class="row">
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input  type="checkbox" name="mobile" value="1"  <?php if($CINFO['mobile']):?> checked="checked"<?php endif?>  class="form-control">
										<i></i>모바일 출력
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input  type="checkbox" name="hidden" value="1"<?php if($CINFO['hidden']):?> checked<?php endif?>   class="form-control">
										<i></i>카테고리 숨김
									</label>
								</div>
							</div>
				    </div>
					<div id="guide_option" class="collapse help-block alert alert-warning">
					   <small>
					   	  	<strong>모바일출력 : </strong>모바일 레이아웃 사용시 이 카테고리를 출력합니다.<br />
						    <strong>카테고리숨김 : </strong>카테고리를 출력하지 않습니다.(링크접근가능)<br />
						 </small>
					</div>
				 </div>
		    </div>
		    <div class="form-group rb-outside">
				<label class="col-md-3 control-label">포스트 진열</label>
				<div class="col-md-9">
					<div class="row">
							<div class="col-md-4">
								<select name="vtype1" class="form-control">
									<option value="review"<?php if($CINFO['vtype']=='review'):?> selected="selected"<?php endif?>>리뷰형</option>
									<option value="list"<?php if($CINFO['vtype']=='list'):?> selected="selected"<?php endif?>>리스트형</option>
									<option value="gall"<?php if($CINFO['vtype']=='gall'):?> selected="selected"<?php endif?>>이미지형</option>
								</select>
							</div>
							<div class="col-md-4">
								<select name="recnum" class="form-control">
									<?php for($i=10;$i<51;$i=$i+5):?>
									<option value="<?php echo $i?>"<?php if($CINFO['recnum']==$i):?> selected="selected"<?php endif?>><?php echo $i?>개씩 보기</option>
									<?php endfor?>
								 </select>
							</div>
							<div class="col-md-4">
								<div class="checkbox">
									<label>
										<input  type="checkbox" name="vopen" value="1"<?php if($CINFO['vopen']):?> checked<?php endif?>   class="form-control">
										<i></i>1개씩 펼쳐보기
									</label>
								</div>
							</div>
				    </div>
				 </div>
		    </div>

				<div class="form-group rb-outside">
					<label class="col-md-3 control-label">소속메뉴</label>
					<div class="col-md-6">
						<select class="col-md-12 form-control" name="linkedmenu">
						<option value="">사용안함</option>
						<?php include $g['path_core'].'function/menu1.func.php' ?>
						<?php $cat=$CINFO['linkedmenu']?>
						<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
						</select>
					</div>
				</div>

		    <div class="form-group rb-outside">
				<label class="col-md-3 control-label">포스트 수집 <a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#guide_rss"><i class="fa fa-question-circle fa-fw"></i></a></label>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-8">
							<input class="form-control" placeholder="" type="text" name="metaurl" value="<?php echo $CINFO['metaurl']?>">
					 	</div>
					 	<div class="col-md-4">
				 		   <div class="checkbox">
								<label>
									<input  type="checkbox" name="metause" value="1"<?php if($CINFO['metause']):?> checked<?php endif?>   class="form-control">
									<i></i> 작동
								</label>
							</div>
					 	</div>
					</div>
					<div id="guide_rss" class="collapse help-block alert alert-warning">
					   <small>
					   	  	RSS를 지원하는 블로그나 웹페이지의 URL을 등록하면 해당<br />
						사이트의 포스트를 간편하게 자동으로 수집할 수 있습니다.<br />
						http://를 포함하여 입력해 주세요.<br />
						 </small>
					</div>
				</div>
			</div>


			<div class="form-group rb-outside">
				<label class="col-md-3 control-label">Daum 뉴스채널<a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#guide_daum"><i class="fa fa-question-circle fa-fw"></i></a></label>
				<div class="col-md-9">
					<input class="form-control" placeholder="" type="text" name="daum_cat" value="<?php echo $CINFO['daum_cat']?>">


					<div id="guide_daum" class="collapse help-block alert alert-warning">
						   <small>
						   	Daum 에 뉴스기사 송고시 매칭되는 영문 <code>송고채널</code>명입니다.<br />
							아래의 페이지에서 안내하는 <code>송고채널</code> 중 하나를 입력해주세요.<br />
							<a href="http://cp.news.search.daum.net/partner/guide_tech" target="_blank" >http://cp.news.search.daum.net/partner/guide_tech</a><br />
							(예: 정치--> politics, 사회-->society, 건강-->health )
							 </small>
					</div>
				</div>
			</div>
		    <div class="form-group">
			   <div class="col-md-12 col-lg-12">
				   <button class="btn btn-primary btn-block btn-lg" id="rb-submit-button" type="submit"><i class="fa fa-check fa-lg"></i> <?php echo $is_fcategory?'카테고리속성 변경':'신규카테고리 등록'?></button>
			   </div>
		    </div>
		</form>
		</div>
	</div><!-- /.row -->
</div><!-- /.container-fluid -->



<script>
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('카테고리 명칭을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}
	if (f.id)
	{
		if (f.id.value == '')
		{
			alert('카테고리 코드를 입력해 주세요.      ');
			f.id.focus();
			return false;
		}
		if (!chkFnameValue(f.id.value))
		{
			alert('카테고리 코드는 영문대소문자/숫자/_/- 만 사용할 수 있습니다.      ');
			f.id.focus();
			return false;
		}
	}
	if(confirm('정말로 실행하시겠습니까?         '))
	 {
			getIframeForAction(f);
			f.submit();
	}
}

</script>
