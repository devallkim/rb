<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['member']['mytab_recnum'];

$bbsque = 'mbruid='.$my['uid'].' and site='.$s;
if ($d_start) $bbsque .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $bbsque .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($bbs) $bbsque .= ' and bbs='.$bbs;

if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $bbsque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $bbsque .= " and d_regis like '".$keyword."%'";
	else $bbsque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['bbsdata'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['bbsdata'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>


<div id="page-profile">
	<?php include $g['dir_module_skin'].'_cover.php';?>
	<p>
		<small><?php echo sprintf('총 %d건',$NUM)?>  (<?php echo $p?>/<?php echo $TPG?> page<?php if($TPG>1):?>s<?php endif?>)</small>
	</p>

	<form name="searchForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?php echo $r?>">
		<?php if($_mod):?>
		<input type="hidden" name="mod" value="<?php echo $_mod?>" />
		<?php else:?>
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<?php endif?>
		<input type="hidden" name="page" value="<?php echo $page?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />


	   <div class="well well-sm">
	   	<div class="form-group">
	   		 <label class="col-sm-1 control-label">필터</label>
				 <div class="col-sm-11">
						<div class="col-sm-4">
							<select name="bbs" class="form-control input-sm" onchange="this.form.submit();">
							<option value="">게시판</option>
							<?php $_BBSLIST = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
							<?php while($_B=db_fetch_array($_BBSLIST)):?>
							<option value="<?php echo $_B['uid']?>"<?php if($_B['uid']==$bid):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?>)</option>
							<?php endwhile?>
							<?php if(!db_num_rows($_BBSLIST)):?>
							<option value="">등록된 게시판이 없습니다.</option>
							<?php endif?>
							</select>
						</div>
						<div class="col-sm-5">
							<div class="input-daterange input-group input-group-sm" id="datepicker">
								<input type="text" class="form-control" name="d_start" placeholder="시작일" value="<?php echo $d_start?>">
								<span class="input-group-addon">~</span>
								<input type="text" class="form-control" name="d_finish" placeholder="종료일" value="<?php echo $d_finish?>">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#search-more-bbs" onclick="sessionSetting2('my_post','1','','1');"><small>키워드 검색</small></button>
						</div>
				 </div> <!-- .col-sm-11 -->
			 </div><!-- .form-group -->
			 <div id="search-more-bbs" class="collapse<?php if($_SESSION['sh_bbslist']):?> in<?php endif?>">
                <div class="form-group">
                     <label class="col-sm-1 control-label">검색</label>
			            <div class="col-sm-11">
			            	<div class="col-sm-11">
									 <div class="input-group input-group-sm">
											<span class="input-group-btn">
												<select name="where" class="btn btn-default">
													<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
                                       <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
												</select>
											 </span>
											 <input type="text" name="keyw" class="form-control" placeholder="검색어를 입력해주세요." value="<?php echo $keyw?>">
											 <span class="input-group-btn" style="margin-bottom:0;">
											  	 <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>검색</button>
											 	 <button class="btn btn-default hidden-xs" type="button" onclick="this.form.keyw.value='';this.form.submit();">리셋</button>
											 </span>
									 </div>
							   </div>
							</div>
					</div> <!-- .form-group -->
			  </div> 	<!-- .고급검색  -->
		</div> <!-- .row -->
   </form>
	<form name="adm_list_form" class="form-horizontal" action="<?php echo $g['s']?>/" method="post">
	<input type="hidden" name="r" value="<?php echo $r?>">
   <input type="hidden" name="module" value="<?php echo $module?>">
	<input type="hidden" name="front" value="<?php echo $front?>">
	<input type="hidden" name="page" value="<?php echo $page?>">
	<input type="hidden" name="p" value="<?php echo $p?>">
	<input type="hidden" name="iframe" value="<?php echo $iframe?>">
	<input type="hidden" name="m" value=""> <!-- 액션파일이 있는 모듈명  -->
	<input type="hidden" name="a" value=""> <!-- 액션명  -->
	   <div class="table-responsive">
			<table class="table table-hover link-table" style="border-bottom:#ccc solid 1px;">
				<thead>
					<tr class="hidden-xs">
				      <th><input type="checkbox"  class="checkAll-act-list" data-toggle="tooltip" title="전체선택"></th>
						<th>번호</th>
						<th>게시판</th>
						<th>제목</th>
						<th>조회</th>
						<th>날짜</th>
					</tr>
				</thead>
				<tbody>
					<?php while($R=db_fetch_array($RCD)):?>
				    <?php $R['mobile']=isMobileConnect($R['agent'])?>
					<tr>
						<td class="hidden-xs"><input type="checkbox" name="post_members[]"  onclick="checkboxCheck();" class="mbr-act-list" value="<?php echo $R['uid']?>"></td>
						<td class="hidden-xs"><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
						<td class="hidden-xs"><?php echo $R['bbsid']?></td>
						<td class="sbj">
							 <a href="<?php echo getPostLink($R)?>" target="_blank" class="link_txt">
							  <?php if($R['mobile']):?><i class="fa fa-mobile fa-lg"></i><?php endif?>
                       <?php if($R['category']):?><span class="text-danger">[<?php echo $R['category']?>]</span><?php endif?>
                       <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                       <?php if(strstr($R['content'],'.jpg')):?><i class="fa fa-image fa-lg"></i><?php endif?>
                       <?php if($R['upload']):?><i class="glyphicon glyphicon-floppy-disk glyphicon-lg"></i><?php endif?>
                       <?php if($R['hidden']):?><i class="fa fa-lock fa-lg"></i><?php endif?>
                       <?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span><?php endif?>
                       <?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span><?php endif?>
                        <?php if(getNew($R['d_regis'],24)):?><span class="label label-danger"><small>New</small></span><?php endif?>
                      </a>
						</td>
						<td class="hidden-xs"><?php echo $R['hit']?></td>
						<td class="rb-update hidden-xs">
							<time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_regis'],'c')?>" data-tooltip="tooltip" title="<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>"></time>
						</td>
					</tr>
					<?php endwhile?>
				</tbody>
			</table>
		    <?php if(!$NUM):?>
	          <div class="rb-none">데이타가 없습니다.</div>
	       <?php endif?>
	 </div>
	 <div class="text-center">
	    <ul class="pagination pagination-sm" style="padding:0;margin:0">
	       <script type="text/javascript">getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
	     </ul>
	 </div>
	</form>
</div>
<!-- 공통 스크립트 -->
<?php include $g['dir_module_skin'].'_common_script.php'?>