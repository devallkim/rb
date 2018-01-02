<?php
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 30;
$hidden=$hidden?$hidden:0;
$bbsque	= 'hidden='.$hidden;

if ($d_start) $bbsque .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $bbsque .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($blog) $bbsque .= ' and blog='.$blog;
if ($parent) $bbsque .= ' and parent='.$parent;
if ($where && $keyw)
{
	$bbsque .= getSearchSql($where,$keyw,$ikeyword,'or');	
}

$RCD = getDbArray($table[$module.'comment'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'comment'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>
<div class="page-header">
 <h4>댓글 리스트  </h4>
</div>
<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="form-horizontal rb-form">
	 <input type="hidden" name="r" value="<?php echo $r?>" />
	 <input type="hidden" name="m" value="<?php echo $m?>" />
	 <input type="hidden" name="module" value="<?php echo $module?>" />
	 <input type="hidden" name="front" value="<?php echo $front?>" />
	<input type="hidden" name="parent" value="<?php echo $parent?>" />
	<input type="hidden" name="comment" value="<?php echo $comment?>" />

	 <div class="rb-heading well well-sm">
	 	 <div class="form-group">
	 	 	  <label class="col-sm-1 control-label">필터 </label>
	 	 	  <div class="col-sm-10">
	 	 	  	  <div class="row">
	 	 	  	  	   <div class="col-sm-3">
                           <select name="blog" class="form-control input-sm" onchange="this.form.submit();">
									<option value="">전체 블로그</option>
									<option value="">--------------------</option>
									<?php $_BBSLIST = getDbArray($table[$module.'list'],'','*','gid','asc',0,1)?>
									<?php while($_B=db_fetch_array($_BBSLIST)):?>
									<option value="<?php echo $_B['uid']?>"<?php if($_B['uid']==$blog):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?> - <?php echo number_format($_B['num_r'])?>)</option>
									<?php endwhile?>
									<?php if(!db_num_rows($_BBSLIST)):?>
									<option value="">등록된 블로그가 없습니다.</option>
									<?php endif?>
								</select>
	 	 	  	  	   </div>
	 	 	  	  	   <div class="col-sm-3">
	 	 	  	  	   	 		<select name="recnum" onchange="this.form.submit();" class="form-control input-sm">
	 	 	  	  	   	 			<option value="">출력</option>
									<option value="">--------------------</option>
									<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20</option>
									<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35</option>
									<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50</option>
									<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75</option>
									<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90</option>
								</select>
					  </div>
					   <div class="col-sm-3">
						    <label class="checkbox" style="margin-top:0">
							    <input  type="checkbox"  name="oneline" value="1"<?php if($oneline):?> checked="checked"<?php endif?>onclick="this.form.submit();"  class="form-control"> <i></i>한줄의견 보기
							</label>
					   </div>   
		  	  	 </div> <!-- .row -->
	 	  	 </div> <!-- .col-sm-10 -->
	 	 </div> <!-- .form-group -->
        <div class="form-group">
	 	      <label class="col-sm-1 control-label">옵션 </label>
	 	 	  <div class="col-sm-10">
	 	 	  	  <div class="row">
	 	 	  	  	    	 <div class="col-sm-2">
						    	  <label class="radio-inline">
							        <input  type="radio"  name="hidden" value="0"<?php if($hidden==0):?> checked="checked"<?php endif?>onclick="this.form.submit();"  style="position:relative;left:0;"> 승인 (<?php echo getDbRows($table[$module.'comment'],'hidden=0')?>)
							     </label>
							 </div>   
						    <div class="col-sm-2">
						 	    <label class="radio-inline">
						          <input  type="radio" name="hidden" value="1"<?php if($hidden==1):?> checked<?php endif?> onclick="this.form.submit();"  style="position:relative;left:0;"> 보류 (<?php echo getDbRows($table[$module.'comment'],'hidden=1')?>)		
						       </label>
						    </div>
						    <div class="col-sm-2">
						 	    <label class="radio-inline">
						          <input  type="radio" name="hidden" value="2"<?php if($hidden==2):?> checked<?php endif?> onclick="this.form.submit();"  style="position:relative;left:0;"> 스팸 (<?php echo getDbRows($table[$module.'comment'],'hidden=2')?>)	
						       </label>
						    </div>
						    <div class="col-sm-3">
						 	    <label class="radio-inline">
						          <input  type="radio" name="hidden" value="3"<?php if($hidden==3):?> checked<?php endif?> onclick="this.form.submit();"  style="position:relative;left:0;"> 휴지통 (<?php echo getDbRows($table[$module.'comment'],'hidden=3')?>)	
						       </label>
						    </div> 
	 	 	  	  	 </div> <!-- .row -->
	 	 	  	 </div> <!-- .col-sm-10 -->
	 	 	 </div> <!-- .form-group -->
	 	 	 <!-- 고급검색 시작 -->
	 	 	 <div id="search-more" class="collapse<?php if($_SESSION['sh_bbspost']):?> in<?php endif?>">
    			<div class="form-group">
					<label class="col-sm-1 control-label">기간</label>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-sm-5">
								<div class="input-daterange input-group input-group-sm" id="datepicker">
									<input type="text" class="form-control" name="d_start" placeholder="시작일 선택" value="<?php echo $d_start?>">
									<span class="input-group-addon">~</span>
									<input type="text" class="form-control" name="d_finish" placeholder="종료일 선택" value="<?php echo $d_finish?>">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">기간적용</button>
									</span>
								</div>
							</div>
							<div class="col-sm-3 hidden-xs">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>','<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>');">어제</button>
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo getDateFormat($date['today'],'Y/m/d')?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">오늘</button>
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">일주</button>
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo date('Y/m/d',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">한달</button>
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo getDateFormat(substr($date['today'],0,6).'01','Y/m/d')?>','<?php echo getDateFormat($date['today'],'Y/m/d')?>');">당월</button>
									<button class="btn btn-default" type="button" onclick="dropDate('<?php echo date('Y/m/',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>01','<?php echo date('Y/m/',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>31');">전월</button>
									<button class="btn btn-default" type="button" onclick="dropDate('','');">전체</button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group hidden-xs">
					<label class="col-sm-1 control-label">정렬</label>
					<div class="col-sm-10">
						<div class="btn-toolbar">
							<div class="btn-group btn-group-sm" data-toggle="buttons">
								<label class="btn btn-default<?php if($sort=='gid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="gid" name="sort"<?php if($sort=='gid'):?> checked<?php endif?>> 등록일
								</label>
								<label class="btn btn-default<?php if($sort=='oneline'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="oneline" name="sort"<?php if($sort=='oneline'):?> checked<?php endif?>> 한줄의견
								</label>
							</div>
							<div class="btn-group btn-group-sm" data-toggle="buttons">
								<label class="btn btn-default<?php if($orderby=='desc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="desc" name="orderby"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i>역순
								</label>
								<label class="btn btn-default<?php if($orderby=='asc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
									<input type="radio" value="asc" name="orderby"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i>정순
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label">검색</label>
					<div class="col-sm-10">
						<div class="input-group input-group-sm">
							<span class="input-group-btn hidden-xs" style="width:165px">
								<select name="where" class="form-control btn btn-default">
								   <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>내용</option>
								</select>
							</span>
							<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">검색</button>
							</span>
						</div>
					</div>
				</div>		
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<button type="button" class="btn btn-link rb-advance<?php if(!$_SESSION['sh_bbspost']):?> collapsed<?php endif?>" data-toggle="collapse" data-target="#search-more" onclick="sessionSetting('sh_bbspost','1','','1');">고급검색<small></small></button>
					<a href="<?php echo $g['adm_href']?>" class="btn btn-link">초기화</a>
				</div>
			</div>
		</div>
	</form>
<div class="page-header">
	<h4>
		<small><?php echo number_format($NUM)?> 개 ( <?php echo $p?>/<?php echo $TPG.($TPG>1?'pages':'page')?> )</small>
	</h4>
</div>
<form name="listForm" action="<?php echo $g['s']?>/" method="post">
	<input type="hidden" name="r" value="<?php echo $r?>">
	<input type="hidden" name="m" value="<?php echo $module?>">
	<input type="hidden" name="a" value="">
	<div class="table-responsive">
		<table class="table table-striped">          
			<thead>
				<tr>
					<th><label data-tooltip="tooltip" title="선택"><input type="checkbox" class="checkAll-post-user"></label></th>
					<th>번호</th>
					<th></th>
					<th>작성자</th>
					<th>내용</th>
					<th>한줄의견</th>
					<th>등록일시</th>
				</tr>
			</thead>
	     <tbody>
			<?php while($R=db_fetch_array($RCD)):?>
			<?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>
			<?php $_B=getUidData($table[$module.'list'],$R['blog'])?>
			<?php $_R=getUidData($table[$module.'data'],$R['parent'])?>
			<?php $L1=getOverTime($date['totime'],$R['d_regis'])?>
			<tr>
				<td><input type="checkbox" name="comment_members[]" value="<?php echo $R['uid']?>" class="rb-post-user" onclick="checkboxCheck();"/></td>
				<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
				<td>
					 <?php if($_M['photo']):?>
					   	<img src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?>" alt="" width="35" height="35" align="left" />
					 <?php else:?>
						<img src="<?php echo $g['s']?>/_var/avatar/1.gif" alt="" width="35" height="35" align="left" />			
					 <?php endif?>
				</td>
		       <td><?php echo $_M['memberuid']?$_M[$_HS['nametype']]:$R['name']?></td>
		       <td class="sbj">
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;blog=<?php echo $_B['id']?>&amp;front=list&amp;uid=<?php echo $_R['uid']?>&amp;comment=<?php echo $R['uid']?>" target="_blank"><?php echo $_R['subject']?></a>
					<div class="cmt">
					<?php echo getStrCut($R['content'],100,'..')?>
					</div>
					<?php if($comment==$R['uid']||$oneline):?>
						<?php $_OTCD = getDbArray($table[$module.'oneline'],'parent='.$R['uid'],'*','uid','desc',20,1)?>
						<?php while($O=db_fetch_array($_OTCD)):?>
						<?php $_M1=getDbData($table['s_mbrdata'],'memberuid='.$O['mbruid'],'*')?>
						<div class="oneline">
							<div class="ico">
								<?php if($_M1['photo']):?>
								<img src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M1['photo']?>" alt="" width="35" height="35" />
								<?php else:?>
								<img src="<?php echo $g['s']?>/_var/avatar/1.gif" alt="" width="35" height="35" />			
								<?php endif?>
							</div>
							<div class="cont">
								<?php echo getStrCut($O['content'],90,'..')?><br />
								<?php echo $_M1[$_HS['nametype']]?> , <?php echo getDateFormat($O['d_regis'],'Y.m.d H:i')?>
								<?php if(getNew($O['d_regis'],24)):?><small class="label label-danger">new</small><?php endif?>
							</div>
						</div>
						<?php endwhile?>
					<?php endif?>
				</td>
				<td class="ck">
					<?php if($R['oneline']):?>
					<a href="#." onclick="onelineClick('<?php echo $R['uid']?>');"><?php echo $R['oneline']?></a>
					<?php else:?>
					-
					<?php endif?>
				</td>
				<td class="lst"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
			</tr> 
	     <?php endwhile?> 
	</tbody>
	</table>
    <?php if(!$NUM):?>
    	<div class="rb-none" style="padding-bottom:20px">댓글이 없습니다.</div>
	<?php endif?>
		<div class="rb-footer clearfix">
			<div class="pull-right">
				<ul class="pagination">
				<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
				<?php //echo getPageLink(5,$p,$TPG,'')?>
				</ul>
			</div>	
			<div>
				<button type="button" onclick="chkFlag('comment_members[]');checkboxCheck();" class="btn btn-default btn-sm">선택/해제 </button>
				<button type="button" onclick="actCheck('admin/multi_post_delete');" class="btn btn-default btn-sm rb-action-btn" disabled>삭제</button>
			</div>
		</div>
	</form>
</div>
<!-- bootstrap-popover-x 플로그인 호출 -->
<?php getImport('bootstrap-popover-x','css/bootstrap-popover-x.min',false,'css')?>
<?php getImport('bootstrap-popover-x','js/bootstrap-popover-x.min',false,'js')?>

<!-- bootstrap-datepicker,  http://eternicode.github.io/bootstrap-datepicker/  -->
<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
<style type="text/css">
.datepicker {z-index: 1151 !important;}
</style>
<script>
$('.input-daterange').datepicker({
	format: "yyyy/mm/dd",
	todayBtn: "linked",
	language: "kr",
	calendarWeeks: true,
	todayHighlight: true,
	autoclose: true
});
</script>

<script type="text/javascript">
//<![CDATA[
function onelineClick(uid)
{
	var f = document.procForm;
	f.comment.value = uid;
	f.submit();
}
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('comment_members[]');
    var n = l.length;
	var j = 0;
    var i;
	var s = '';

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
			s += '['+l[i].value+']';
		}
	}
	if (!j)
	{
		alert('선택된 포스트가 없습니다.      ');
		return false;
	}
	
	if (act == 'admin/multi_comment_delete')
	{
		if(confirm('정말로 삭제하시겠습니까?    '))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.submit();
		}
	}
	if (act == 'admin/multi_comment_move')
	{
		if(confirm('정말로 옮기시겠습니까?    '))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.submit();
		}
	}	

	return false;
}

// #####################   2.0 부분  ######################################
// 포스트 uid  세팅  
var _postUid;
var _blogFront;
function postUidSet(uid,front)
{
	_postUid = uid;
	_blogFront=front;
}

// 포스트 seo 모달 출력 
$('.rb-modal-seo').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=blog&amp;front=modal.blog&amp;uid=')?>'+_postUid+'&_front='+_blogFront);
});

// 선택박스 체크 이벤트 핸들러
$(".checkAll-post-user").click(function(){
	$(".rb-post-user").prop("checked",$(".checkAll-post-user").prop("checked"));
	checkboxCheck();
});
// 선택박스 체크시 액션버튼 활성화 함수
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('comment_members[]');
    var n = l.length;
    var i;
	var j=0;
	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true) j++;
	}
	if (j) $('.rb-action-btn').prop("disabled",false);
	else $('.rb-action-btn').prop("disabled",true);
}
// 기간 검색 적용 함수
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.d_start.value = date1;
	f.d_finish.value = date2;
	f.submit();
}
//]]>
</script>

