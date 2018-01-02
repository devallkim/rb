<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 20;

$blogque ='uid>0';
// 키원드 검색 추가
if ($keyw)
{
	$blogque .= " and (id like '%".$keyw."%' or name like '%".$keyw."%')";
}

$RCD = getDbArray($table[$module.'list'],$blogque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'list'],$blogque);
$TPG = getTotalPage($NUM,$recnum);

if ($uid)
{
	$R = getUidData($table[$module.'list'],$uid);
	$M = getUidData($table['s_mbrid'],$R['mbruid']);
	if ($R['uid'])
	{
		include_once $g['path_module'].$module.'/var/var.'.$R['id'].'.php';
	}
}
$_referer=$g['adm_href'].'&iframe=Y&_front='.$_front.'&recnum='.$recnum.'&p='.$p.'&uid='.$uid;
?>
<link rel="stylesheet" href="<?php echo $g['path_module'].'blog/admin/makeblog.css'?>">
<div class="row">
   <div class="col-sm-4 col-lg-3">
   	<div class="panel panel-default">  <!-- 메뉴 리스트 패털 시작 -->

   		<!-- 메뉴 패널 헤더 : 아이콘 & 제목 -->
			<div class="panel-heading rb-icon">
				<div class="icon">
					<i class="fa fa-file-text-o fa-2x"></i>
				</div>
				<h4 class="panel-title">
					포스트셋 리스트
					<span class="pull-right">
						<button type="button" class="btn btn-default btn-xs<?php if(!$_SESSION['sh_site_blog_search']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#panel-search" data-tooltip="tooltip" title="검색필터" onclick="sessionSetting('sh_site_blog_search','1','','1');getSearchFocus();"><i class="glyphicon glyphicon-search"></i></button>
					</span>
				</h4>
			</div>
			<div id="panel-search" class="collapse<?php if($_SESSION['sh_site_blog_search']):?> in<?php endif?>">
				<form role="form" action="<?php echo $g['s']?>/" method="get">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="module" value="<?php echo $module?>">
				<input type="hidden" name="front" value="<?php echo $front?>">
					<div class="panel-heading rb-search-box">
						<div class="input-group">
							<div class="input-group-addon"><small>출력수</small></div>
							<div class="input-group-btn">
								<select class="form-control" name="recnum" onchange="this.form.submit();">
								<option value="15"<?php if($recnum==15):?> selected<?php endif?>>15</option>
								<option value="30"<?php if($recnum==30):?> selected<?php endif?>>30</option>
								<option value="60"<?php if($recnum==60):?> selected<?php endif?>>60</option>
								<option value="100"<?php if($recnum==100):?> selected<?php endif?>>100</option>
								</select>
							</div>
						</div>
					</div>
					<div class="rb-keyword-search input-group input-group-sm">
						<input type="text" name="keyw" class="form-control" value="<?php echo $keyw?>" placeholder="아이디 or 이름">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="submit">검색</button>
						</span>
					</div>
				</form>
			</div>
			<div class="panel-body" style="border-top:1px solid #DEDEDE;">
				<?php if($NUM):?>
				<form name="blogform" role="form" action="<?php echo $g['s']?>/" method="post" target="_orderframe_">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="m" value="<?php echo $module?>" />
				<input type="hidden" name="a" value="admin/order_update" />
				<div class="dd" id="nestable-menu">
					<ul class="dd-list list-unstyled">
					<?php $_i=1;while($BR = db_fetch_array($RCD)):?>
					<li class="dd-item" data-id="<?php echo $_i?>">
						<input type="checkbox" name="blogmembers[]" value="<?php echo $BR['uid']?>" checked class="hidden"/>
						<span class="dd-handle <?php if($BR['uid']==$R['uid']):?>alert alert-info<?php endif?>" ><i class="fa fa-arrows fa-fw"></i>
						   <?php echo $BR['name']?>(<?php echo $BR['id']?>)
						</span>
						<span title="<?php echo number_format($BR['num_r'])?>개" data-tootip="tooltip">
							<a href="<?php echo $g['adm_href']?>&amp;iframe=Y&amp;_front=<?php echo $_front?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;uid=<?php echo $BR['uid']?>" data-tooltip="tooltip" title="수정하기">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
						</span>
					</li>
					<?php $_i++;endwhile?>
					</ul>
				</div>
				</form>
				<!-- nestable : https://github.com/dbushell/Nestable -->
				<?php getImport('nestable','jquery.nestable',false,'js') ?>
				<script>
					$('#nestable-menu').nestable();
					$('.dd').on('change', function() {
						var f = document.blogform;
						getIframeForAction(f);
						f.submit();
					});
				</script>

				<?php else:?>
				<div class="none">등록된 포스트셋이 없습니다.</div>
				<?php endif?>

         </div>
        	<div class="panel-footer rb-panel-footer">
				<ul class="pagination">
				<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
				<?php //echo getPageLink(5,$p,$TPG,'')?>
				</ul>
			</div>
		</div> <!-- 좌측 패널 끝 -->

   </div><!-- 좌측  내용 끝 -->

   <!-- 우측 내용 시작 -->
   <div id="tab-content-view" class="col-sm-8 col-lg-9">
		<form name="procForm" class="form-horizontal rb-form" role="form" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="_admin/makePostSet" />
		<input type="hidden" name="blog" value="<?php echo $R['uid']?>" />
		<input type="hidden" name="_referer" value="<?php echo $_referer?>" />

		    <div class="form-group">
				<label class="col-sm-3 control-label">포스트셋 제목</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="name" value="<?php echo $R['name']?>"<?php if(!$R['uid'] && !$g['device']):?> autofocus<?php endif?>>
						<span class="input-group-btn">
							<button class="btn btn-default rb-help-btn" type="button" data-toggle="collapse" data-target="#blog_name-guide" data-tooltip="tooltip" title="도움말"><i class="fa fa-question-circle fa-lg"></i></button>
						</span>
						<?php if($R['id']):?>
						<span class="input-group-btn">
							<a href="<?php echo RW('m='.$module.'&blog='.$R['id'])?>" target="_blank" class="btn btn-default" data-tooltip="tooltip" title="포스트셋 보기">
							<i class="fa fa-link fa-lg"></i>
							</a>
						</span>
						<?php endif?>
					</div>
					<p class="help-block collapse alert alert-warning" id="blog_name-guide">
						<small> 포스트셋 제목에 해당되며 한글,영문등 자유롭게 등록할 수 있습니다.</small>
			      </p>
				</div>
		 </div>
		 <div class="form-group">
				<label class="col-sm-3 control-label">포스트셋 아이디</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="id" value="<?php echo $R['id']?>" <?php if($R['uid']):?>disabled<?php endif?>>
						<span class="input-group-btn">
							<button class="btn btn-default rb-help-btn" type="button" data-toggle="collapse" data-target="#blog_id-guide" data-tooltip="tooltip" title="도움말"><i class="fa fa-question-circle fa-lg"></i></button>
						</span>
						<?php if($R['uid']):?>
						<input type="hidden" name="id" value="<?php echo $R['id']?>" />
						<span class="input-group-btn">
							<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=admin/deleteblog&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'삭제하시면 모든 게시물이 지워지며 복구할 수 없습니다.\n정말로 삭제하시겠습니까?');"  class="btn btn-default" data-tooltip="tooltip" title="삭제하기">
							<i class="fa fa-trash-o fa-lg"></i>
							</a>
						</span>
						<?php endif?>
					</div>
					<p class="help-block collapse alert alert-warning" id="blog_id-guide">
						<small> 영문 대소문자+숫자+_ 조합으로 만듭니다.</small>
			      </p>
				</div>
		 </div>
		 <div class="form-group">
				<label class="col-sm-3 control-label">개설회원 ID</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="mbrid" value="<?php echo $R['mbruid']?$M['id']:$my['id']?>">
					</div>
				</div>
		 </div>
		 <div class="form-group">
				<label class="col-sm-3 control-label">포스트셋 형식</label>
				<div class="col-sm-9">
					<label class="radio-inline" >
	  		          <input type="radio" name="blogtype" value="1"<?php if(!$R['blogtype']||$R['blogtype']==1):?> checked="checked"<?php endif?> /> 개인포스트셋
 				   </label>
                 <label class="radio-inline">
 	                	<input type="radio" name="blogtype" value="2"<?php if($R['blogtype']==2):?> checked="checked"<?php endif?> /> 팀포스트셋
   	             </label>
				</div>
		 </div>
		 <div class="form-group">
				<label class="col-sm-3 control-label">승인 시스템 <small><a data-toggle="collapse" data-tooltip="tooltip" title="도움말" href="#use_auth-guide"><i class="fa fa-question-circle fa-fw"></i></a></small></label>
				<div class="col-sm-9">
					<div class="input-group">
						<label class="radio-inline" >
		  		          <input type="radio" name="use_auth" value="0"<?php if(!$R['use_auth']):?> checked="checked"<?php endif?> /> 사용 안함
	 				   </label>
	                 <label class="radio-inline">
	 	                	<input type="radio" name="use_auth" value="1"<?php if($R['use_auth']):?> checked="checked"<?php endif?> /> 사용함
	   	             </label>
	   	           </div>
	   	            <p class="help-block collapse alert alert-warning" id="use_auth-guide">
						<small>
							<span class="text-danger">'사용함'</span> 을 선택할 경우, 등록된 포스트는 포스트셋의 <span class="text-danger">팀장</span>에 의해 <br />
							<span class="text-danger"> 승인과정을 거친 후 발행</span>이 됩니다.<br />
							단, 포스트 <span class="text-danger">작성자가 승인을 거부하면 즉시 발행</span>됩니다.<br />
		              </small>
			      </p>
				</div>
		  </div>

			<div class="form-group">
				<label class="col-sm-3 control-label">승인자 아이디</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="managers" rows="2"><?php echo $R['managers']?></textarea>
					<p class="help-block">
						<small>
						승인자 아이디를 콤마(,)로 구분해서 등록해 주세요.<br>
						포스트 <strong class="text-danger">'승인' 권한</strong>이 주어집니다.
						</small>
		      </p>
				</div>
		 </div>


		  <div class="form-group">
				<label class="col-sm-3 control-label">작성자 아이디</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="members" rows="4"><?php echo $R['members']?></textarea>
					<p class="help-block">
						<small>
						작성자 아이디를 콤마(,)로 구분해서 등록해 주세요.<br>
						추가된 팀원은 포스트 공동작성/삭제권한이 부여됩니다.<br>
						</small>
					</p>
				</div>
		 </div>




       <div class="form-group">
				<label class="col-sm-3 control-label">레이아웃</label>
				<div class="col-sm-5">
			   	   <select name="layout" class="form-control">
					 	<option value="">사이트 대표레이아웃</option>
						<option value="">--------------------------------</option>
							<?php $dirs = opendir($g['path_layout'])?>
							<?php while(false !== ($tpl = readdir($dirs))):?>
							<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
							<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
							<option value="">--------------------------------</option>
							<?php while(false !== ($tpl1 = readdir($dirs1))):?>
							<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
							<option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['blog']['layout']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo str_replace('.php','',$tpl1)?>)</option>
							<?php endwhile?>
							<?php closedir($dirs1)?>
							<?php endwhile?>
							<?php closedir($dirs)?>
					</select>
				</div>
				<div class="col-sm-4">
					<label class="text-danger" data-tooltip="tooltip" title="여기를 체크하시면 선택된 레이아웃이 적용되지 않습니다. ">
						<input type="checkbox" name="iframe" value="Y"<?php if(!$R['uid']||$d['blog']['iframe']=='Y'):?> checked="checked"<?php endif?> /> 전용 레이아웃 사용
					</label>
				</div>
		 </div>
		 <div class="form-group">
		 <label class="col-sm-3 control-label">(모바일)</label>
		 <div class="col-sm-5">
					<select name="m_layout" class="form-control">
				 <option value="">사이트 대표레이아웃</option>
				 <option value="">--------------------------------</option>
					 <?php $dirs = opendir($g['path_layout'])?>
					 <?php while(false !== ($tpl = readdir($dirs))):?>
					 <?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
					 <?php $dirs1 = opendir($g['path_layout'].$tpl)?>
					 <option value="">--------------------------------</option>
					 <?php while(false !== ($tpl1 = readdir($dirs1))):?>
					 <?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
					 <option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['blog']['m_layout']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>><?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo str_replace('.php','',$tpl1)?>)</option>
					 <?php endwhile?>
					 <?php closedir($dirs1)?>
					 <?php endwhile?>
					 <?php closedir($dirs)?>
			 </select>
		 </div>
		 <div class="col-sm-4">

		 </div>
	</div>
		 <div class="form-group">
		  	  <label class="col-sm-3 control-label">포스트셋 테마 </label>
		     <div class="col-sm-9">
 			  		    <select name="theme_pc" class="form-control">
						<option value="">포스트셋 대표테마</option>
						<option value="">--------------------------------</option>
						<?php $tdir = $g['path_module'].$module.'/theme/'?>
						<?php $dirs = opendir($tdir)?>
						<?php while(false !== ($skin = readdir($dirs))):?>
						<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
						<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['blog']['theme_pc']==$skin):?> selected="selected"<?php endif?>><?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
						<?php endwhile?>
						<?php closedir($dirs)?>
					</select>
				</div> <!-- .col-sm-9  -->
		</div> <!-- .form-group  -->
		<div class="form-group">
		  	  <label class="col-sm-3 control-label text-muted">(모바일 접속)</label>
		     <div class="col-sm-9">
 			  		<select name="theme_mobile" class="form-control">
						<option value="">모바일 대표테마</option>
						<option value="">--------------------------------</option>
						<?php $tdir = $g['path_module'].$module.'/theme/'?>
						<?php $dirs = opendir($tdir)?>
						<?php while(false !== ($skin = readdir($dirs))):?>
						<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
						<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['blog']['theme_mobile']==$skin):?> selected="selected"<?php endif?>><?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
						<?php endwhile?>
						<?php closedir($dirs)?>
					</select>
				</div> <!-- .col-sm-9  -->
		</div> <!-- .form-group  -->
      <div class="form-group">
				<label class="col-sm-3 control-label">연결메뉴</label>
				<div class="col-sm-9">
					<div class="input-group">
					   	 <select name="sosokmenu" class="form-control">
							 	<option value="">사용 안함</option>
								<option value="">----------------------</option>
							   <?php include_once $g['path_core'].'function/menu1.func.php'?>
							   <?php $cat=$d['blog']['sosokmenu']?>
							   <?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-default rb-help-btn" type="button" data-toggle="collapse" data-target="#sosok_menu-guide" data-tooltip="tooltip" title="도움말"><i class="fa fa-question-circle fa-lg"></i></button>
							</span>
				   </div>
				   <p class="help-block collapse alert alert-warning" id="sosok_menu-guide">
						<small>
							이 포스트셋를  메뉴에 연결하였을 경우 해당메뉴를 지정해 주세요.<br />
					     연결메뉴를 지정하면 게시물수,로케이션이 동기화됩니다.<br />
					   </small>
			      </p>
				</div>
		 </div>
		 <div class="form-group">
		      <label class="col-sm-3 control-label">소셜연동</label>
				<div class="col-sm-9">
					<div class="input-group">
					   	 <select name="snsconnect" class="form-control">
								<option value="0">연동안함</option>
								<option value="0">--------------------------------</option>
								<?php $tdir = $g['path_module'].'social/inc/'?>
								<?php if(is_dir($tdir)):?>
								<?php $dirs = opendir($tdir)?>
								<?php while(false !== ($skin = readdir($dirs))):?>
								<?php if($skin=='.' || $skin == '..')continue?>
								<option value="social/inc/<?php echo $skin?>"<?php if($d['blog']['snsconnect']=='social/inc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo str_replace('.php','',$skin)?></option>
								<?php endwhile?>
								<?php closedir($dirs)?>
								<?php endif?>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-default rb-help-btn" type="button" data-toggle="collapse" data-target="#sns_connect-guide" data-tooltip="tooltip" title="도움말"><i class="fa fa-question-circle fa-lg"></i></button>
							</span>
				   </div>
				   <p class="help-block collapse alert alert-warning" id="sns_connect-guide">
						<small>
							포스트  등록시 SNS에 동시등록을 가능하게 합니다.<br />
					      이 서비스를 위해서는 소셜연동 모듈을 설치해야 합니다.<br />
					   </small>
			      </p>
				</div>
		 </div>
		 <div class="form-group">
		  	  <label class="col-sm-3 control-label text-muted">포스트 진열</label>
		     <div class="col-sm-3">
 					<select name="vtype" class="form-control">
					   <option value="review"<?php if($d['blog']['vtype']=='review'):?> selected="selected"<?php endif?>>리뷰형</option>
					   <option value="list"<?php if($d['blog']['vtype']=='list'):?> selected="selected"<?php endif?>>리스트형</option>
					   <option value="gall"<?php if($d['blog']['vtype']=='gall'):?> selected="selected"<?php endif?>>이미지형</option>
					</select>
			  </div> <!-- .col-sm-3  -->
			  <div class="col-sm-3">
 					<select name="recnum" class="form-control">
				    <?php $d['blog']['recnum']=$d['blog']['recnum']?$d['blog']['recnum']:20?>
				    <?php for($i=10;$i<51;$i=$i+5):?>
					     <option value="<?php echo $i?>"<?php if($d['blog']['recnum']==$i):?> selected="selected"<?php endif?>><?php echo $i?>개씩 보기</option>
					<?php endfor?>
					</select>
			  </div> <!-- .col-sm-3  -->
			  <div class="col-sm-3">
	     	     <input type="checkbox" name="vopen" id="vopen" value="1"<?php if($d['blog']['vopen']):?> checked="checked"<?php endif?> /><label for="vopen">&nbsp;1개씩 보기</label>
		      </div>
		</div> <!-- .form-group  -->
		<div class="form-group">
				<label class="col-sm-3 control-label">리뷰 글자수</label>
				<div class="col-sm-9">
					<div class="input-group">
						<input class="form-control" placeholder="" type="text" name="rlength" value="<?php echo $d['blog']['rlength']?$d['blog']['rlength']:200?>">
						<span class="input-group-addon">자</span>
					</div>
				</div>
		 </div>


		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-check fa-lg"></i> <?php echo $R['uid']?'포스트셋 수정하기':'새 포스트셋 만들기'?></button>
			</div>
		</div>

	</form>

  </div> <!-- 우측내용 끝 -->
</div> <!-- .row 전체 box -->
<iframe name="_orderframe_" class="hide"></iframe>

<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
    if (f.name.value == '')
	{
		alert('포스트셋 이름을 입력해 주세요.     ');
		f.name.focus();
		return false;
	}
	if (f.bid.value == '')
	{
		if (f.id.value == '')
		{
			alert('포스트셋 아이디를 입력해 주세요.      ');
			f.id.focus();
			return false;
		}
		if (!chkFnameValue(f.id.value))
		{
			alert('포스트셋 아이디는 영문 대소문자/숫자/_ 만 사용가능합니다.      ');
			f.id.value = '';
			f.id.focus();
			return false;
		}
	}
   if (confirm('정말로 실행하시겠습니까?         '))
		{
			getIframeForAction(f);
			f.submit();
		}

}

//]]>
</script>
