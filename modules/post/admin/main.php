<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 30;
$setque	= 'uid';

if ($settype) $setque .= ' and settype='.$settype;
if ($where && $keyw)
{
	if (strstr('[id]',$where)) $setque .= " and ".$where."='".$keyw."'";
	else $setque .= getSearchSql($where,$keyw,$ikeyword,'or');
}

$RCD = getDbArray($table[$module.'list'],$setque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'list'],$setque);
$TPG = getTotalPage($NUM,$recnum);
?>
<!-- 2.0 시작-->

<div class="row">
	<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar sidebar-right">

		<div class="rb-heading well well-sm">
			<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="form-horizontal">
				 <input type="hidden" name="r" value="<?php echo $r?>" />
				 <input type="hidden" name="m" value="<?php echo $m?>" />
				 <input type="hidden" name="module" value="<?php echo $module?>" />
				 <input type="hidden" name="front" value="<?php echo $front?>" />
				 <input type="hidden" name="settype" value="<?php echo $settype?>" />
					<div class="form-group hidden-xs">
					 <label class="col-sm-1 control-label">정렬</label>
					 <div class="col-sm-10">
						 <div class="btn-toolbar">
							 <div class="btn-group btn-group-sm" data-toggle="buttons">
								<label class="btn btn-default<?php if($sort=='gid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="gid" name="sort"<?php if($sort=='gid'):?> checked<?php endif?>> 지정순서
								</label>
								<label class="btn btn-default<?php if($sort=='uid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="uid" name="sort"<?php if($sort=='uid'):?> checked<?php endif?>> 개설일
								</label>
								<label class="btn btn-default<?php if($sort=='num_r'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="num_w" name="sort"<?php if($sort=='num_w'):?> checked<?php endif?>> 포스트수
								</label>
								<label class="btn btn-default<?php if($sort=='num_r'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="num_c" name="sort"<?php if($sort=='num_c'):?> checked<?php endif?>> 댓글수
								</label>
								<label class="btn btn-default<?php if($sort=='num_r'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="num_o" name="sort"<?php if($sort=='num_o'):?> checked<?php endif?>> 의견수
								</label>
								<label class="btn btn-default<?php if($sort=='d_last'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="d_last" name="sort"<?php if($sort=='d_last'):?> checked<?php endif?>> 최근게시
								</label>
							 </div>
							 <div class="btn-group btn-group-sm" data-toggle="buttons">
								<label class="btn btn-default<?php if($orderby=='desc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="desc" name="orderby"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i> 정순
								</label>
								<label class="btn btn-default<?php if($orderby=='asc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="asc" name="orderby"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i> 역순
								</label>
							 </div>
						 </div>
					 </div> <!-- .col-sm-10 -->
					</div> <!-- .form-group -->
				 <!-- 고급검색 시작 -->
				 <div id="search-more" class="collapse<?php if($_SESSION['sh_mediaset']):?> in<?php endif?>">
						 <div class="form-group">
						 <label class="col-sm-1 control-label">필터</label>
						 <div class="col-sm-10">
							 <div class="row">
								<div class="col-sm-3">
									<select name="settype" onchange="this.form.submit();" class="form-control input-sm">
										<option value=""<?php if($settype==''):?> selected="selected"<?php endif?>>전체(<?php echo getDbRows($table[$module.'list'],'')?>)</option>
										<option value="1"<?php if($settype==1):?> selected="selected"<?php endif?>>개인블로그(<?php echo getDbRows($table[$module.'list'],'settype=1')?>)</option>
										<option value="2"<?php if($settype==2):?> selected="selected"<?php endif?>>팀블로그(<?php echo getDbRows($table[$module.'list'],'settype=2')?>)</option>
									</select>
								</div>
								 <div class="col-sm-3">
									 <select name="recnum" onchange="this.form.submit();" class="form-control input-sm">
										<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20 개</option>
										<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35 개</option>
										<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50 개</option>
										<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75 개</option>
										<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90 개</option>
										</select>
									</div>
								</div>
						 </div>
						</div> <!-- .form-group -->
						 <div class="form-group">
						 <label class="col-sm-1 control-label">검색</label>
						 <div class="col-sm-10">
							 <div class="input-group input-group-sm">
								<span class="input-group-btn hidden-xs" style="width:165px">
									<select name="where" class="form-control btn btn-default">
										<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>블로그 명</option>
													 <option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
									</select>
								</span>
								<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="form-control">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="submit">검색</button>
								</span>
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" onclick="location.href='<?php echo $g['adm_href']?>';">리셋</button>
								</span>
							 </div>
						</div>
						</div> <!-- .form-group -->
				 </div>
				 <!-- 고급검색 끝 -->

				 <div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<button type="button" class="btn btn-link rb-advance<?php if(!$_SESSION['sh_mediaset']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#search-more" onclick="sessionSetting('sh_mediaset','1','','1');">고급검색 <small></small></button>
							<a href="<?php echo $g['adm_href']?>" class="btn btn-link">초기화</a>
						</div>
				</div>
			</form>
		</div>  <!-- .rb-heading well well-sm : 검색영역 회색 박스  -->



	</div><!-- /.sidebar -->
	<div class="col-sm-8 col-md-8 mr-sm-auto col-xl-9 pt-3">

		<h4>채널  리스트
			<a href="#" data-toggle="modal" data-target="#modal_window" onmousedown="setUidSet('<?php echo $R['uid']?>','makeset');" class="pull-right btn btn-link rb-modal-set">
				<i class="fa fa-plus"></i> 새 채널  만들기
			</a>
		</h4>

		<!-- 리스트 시작  -->
		<div class="">
			<small>개 ( <?php echo $p?>/<?php echo $TPG.($TPG>1?' pages':' page')?> )</small>
		</div>
		<form name="listForm" action="<?php echo $g['s']?>/" method="post">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $module?>">
				<input type="hidden" name="a" value="">
				<div class="table-responsive">
					<table class="table table-striped">
						<tr>
							<th><label data-tooltip="tooltip" title="선택"><input type="checkbox" class="checkAll-list-td"></label></th>
							<th>번호</th>
							<th>형식</th>
							<th>아이디</th>
							<th>채널 명</th>
							<th>포스트</th>
							<th>댓글</th>
							<th>의견</th>
							<th>개설자</th>
							<th>레이아웃</th>
							<th>개설일</th>
							<th>최근등록</th>
							<th>관리</th>
						</tr>
						<?php while($R=db_fetch_array($RCD)):?>
						<?php $L=getOverTime($date['totime'],$R['d_last'])?>
						<?php $M = getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*');?>
						<?php $d=array();include $g['path_module'].$module.'/var/var.'.$R['id'].'.php';?>
						<tr>
							<td><input type="checkbox" name="set_members[]" value="<?php echo $R['uid']?>" class="rb-list-td" onclick="checkboxCheck();"/></td>
							<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
							<td><?php echo $R['settype']==1?'개인':'팀'?></td>
							 <td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;pset=<?php echo $R['id']?>" target="_blank"><?php echo $R['id']?></a></td>
							<td>
								<input type="text" name="name_<?php echo $R['uid']?>" value="<?php echo $R['name']?>" />
							</td>
							<td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=post&amp;pset=<?php echo $R['uid']?>"><?php echo number_format($R['num_w'])?></a></td>
							<td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=comment&amp;pset=<?php echo $R['uid']?>"><?php echo number_format($R['num_c'])?></a></td>
							<td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=comment&amp;pset=<?php echo $R['uid']?>&amp;oneline=1"><?php echo number_format($R['num_o'])?></a></td>
							<td><?php echo $M['name']?></td>
							<td><?php echo $d['set']['iframe']?'<b>전용</b>':'사이트'?></td>
							<td><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
							<td><?php if($R['d_last']<$date['totime']):?><?php echo $L[1]<3?$L[0].$lang['sys']['time'][$L[1]].'전':getDateFormat($R['d_last'],'Y.m.d')?><?php if(getNew($R['d_last'],24)):?> <u>new</u><?php endif?><?php endif?></td>
							<td>
								<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=_admin/deleteset&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'삭제하시면 모든 포스트가 지워지며 복구할 수 없습니다.\n정말로 삭제하시겠습니까?');" class="del">삭제</a>
								<a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-set" onmousedown="setUidSet('<?php echo $R['uid']?>','makeset');">설정</a>
								<a href="<?php echo $g['adm_href']?>&amp;front=makecategory&amp;pset=<?php echo $R['uid']?>">분류</a>
							</td>
							 </tr>
						<?php endwhile?>
					</table>
				</div>
				<?php if(!$NUM):?>
				<div class="rb-none" style="padding-bottom:20px;">데이타가 존재하지 않습니다. </div>
				<?php endif?>
				<div class="rb-footer clearfix">
					<div class="pull-right">
						<ul class="pagination">
						<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
						<?php //echo getPageLink(5,$p,$TPG,'')?>
						</ul>
					</div>
					<div>
						<button type="button" onclick="chkFlag('set_members[]');checkboxCheck();" class="btn btn-default btn-sm">선택/해제</button>
						<button type="button" onclick="actCheck('multi_config');" class="btn btn-default btn-sm" id="rb-action-btn">수정</button>
					</div>
				</div> <!-- .rb-footer -->
		</form>



	</div>
</div><!-- /.row -->





<script type="text/javascript">
//<![CDATA[
// 블로그 uid  & front 세팅
var _setUid;
var _setFront;
function setUidSet(uid,front)
{
	_setUid = uid;
	_setFront=front;
}

// 블로그 생성/수정 modal 호출하는 함수 : 위에서 지정한 블로그 uid  로 호출
$('.rb-modal-set').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=post&amp;front=modal.set&amp;uid=')?>'+_setUid+'&amp;_front='+_setFront);
});

$(".checkAll-list-td").click(function(){
	$(".rb-list-td").prop("checked",$(".checkAll-list-td").prop("checked"));
	checkboxCheck();
});
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('set_members[]');
    var n = l.length;
    var i;
	var j=0;
	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true) j++;
	}
	if (j) getId('rb-action-btn').disabled = false;
	else getId('rb-action-btn').disabled = true;
}
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.d_start.value = date1;
	f.d_finish.value = date2;
	f.submit();
}
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('set_members[]');
    var n = l.length;
	var j = 0;
    var i;
    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
		}
	}
	if (!j)
	{
		alert('선택된 게시판이 없습니다.     ');
		return false;
	}
	if (act == 'multi_config')
	{
		if (confirm('정말로 실행하시겠습니까?       '))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.submit();
		}
	}
	return false;
}
//]]>
</script>
