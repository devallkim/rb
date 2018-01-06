<?php
$inbox = $inbox ? $inbox : 1;
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 30;
$bbsque	= 'uid';

if ($set) $bbsque .= ' and set='.$set;
if ($parent) $bbsque .= ' and parent='.$parent;
if ($notuse) $bbsque .= ' and parent=0';
if ($mbruid) $bbsque .= ' and mbruid='.$mbruid;
if ($inbox==2) $bbsque .= ' and type=2';
if ($inbox==3) $bbsque .= ' and type<>2';
if ($ext) $bbsque .= " and ext='".$ext."'";
if ($d_start) $bbsque .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $bbsque .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';

if ($where && $keyw)
{
	$bbsque .= getSearchSql($where,$keyw,$ikeyword,'or');	
}

$RCD = getDbArray($table[$module.'upload'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'upload'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>
<div class="page-header">
 <h4>첨부파일 리스트  </h4>
</div>
<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="form-horizontal rb-form">
	 <input type="hidden" name="r" value="<?php echo $r?>" />
	 <input type="hidden" name="m" value="<?php echo $m?>" />
	 <input type="hidden" name="module" value="<?php echo $module?>" />
	 <input type="hidden" name="front" value="<?php echo $front?>" />
	<input type="hidden" name="inbox" value="<?php echo $inbox?>" />
	<input type="hidden" name="mbruid" value="<?php echo $mbruid?>" />
	<input type="hidden" name="ext" value="<?php echo $ext?>" />

	 <div class="rb-heading well well-sm">
	 	 <div class="form-group">
	 	 	  <label class="col-sm-1 control-label">필터 </label>
	 	 	  <div class="col-sm-10">
	 	 	  	  <div class="row">
	 	 	  	  	   <div class="col-sm-3">
                           <select name="set" class="form-control input-sm" onchange="this.form.submit();">
									<option value="">전체 블로그</option>
									<option value="">--------------------</option>
									<?php $_BBSLIST = getDbArray($table[$module.'list'],'','*','gid','asc',0,1)?>
									<?php while($_B=db_fetch_array($_BBSLIST)):?>
									<option value="<?php echo $_B['uid']?>"<?php if($_B['uid']==$set):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?> - <?php echo number_format($_B['num_r'])?>)</option>
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
							    <input  type="checkbox"  name="notuse" value="1"<?php if($notuse):?> checked="checked"<?php endif?>onclick="this.form.submit();"  class="form-control"> <i></i>미사용파일
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
						        <input  type="radio"  name="inbox" value="1"<?php if($inbox==1):?> checked="checked"<?php endif?>onclick="this.form.submit();"  style="position:relative;left:0;"> 전체 (<?php echo getDbRows($table[$module.'upload'],'')?>)
						     </label>
						 </div>
						 <div class="col-sm-2">
					    	  <label class="radio-inline">
						        <input  type="radio"  name="inbox" value="1"<?php if($inbox==2):?> checked="checked"<?php endif?>onclick="this.form.submit();"  style="position:relative;left:0;"> 이미지 (<?php echo getDbRows($table[$module.'upload'],'type=2')?>)
						     </label>
						 </div>
						 <div class="col-sm-2">
					    	  <label class="radio-inline">
						        <input  type="radio"  name="inbox" value="2"<?php if($inbox==3):?> checked="checked"<?php endif?>onclick="this.form.submit();"  style="position:relative;left:0;"> 파일 (<?php echo getDbRows($table[$module.'upload'],'type<>2')?>)
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
				<div class="form-group">
					<label class="col-sm-1 control-label">검색</label>
					<div class="col-sm-10">
						<div class="input-group input-group-sm">
							<span class="input-group-btn hidden-xs" style="width:165px">
								<select name="where" class="form-control btn btn-default">
								   <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>파일명</option>
								   <option value="caption"<?php if($where=='caption'):?> selected="selected"<?php endif?>>캡션</option>
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
					<th>형식</th>
					<th>파일명</th>
					<th>폴더</th>
					<th>다운</th>
					<th>용량</th>
					<th>소유자</th>
					<th>사용처</th>
					<th>등록일시</th>
				</tr>
			</thead>
	     <tbody>
			<?php while($R=db_fetch_array($RCD)):?>
			<?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>
			<?php $_B=getUidData($table[$module.'list'],$R['set'])?>
			<?php $L1=getOverTime($date['totime'],$R['d_regis'])?>
			<tr>
				<td><input type="checkbox" name="upfile_members[]" value="<?php echo $R['uid']?>" class="rb-post-user" onclick="checkboxCheck();"/></td>
				<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
				<td><a href="#." onclick="extDrop('<?php echo getExt($R['name'])?>');"><?php echo getExt($R['name'])?></a></td>
				<td class="sbj">
					<?php if($R['type']==2):?>
					<img src="<?php echo $R['url'].'/'.$R['folder'].'/'.$R['thumbname']?>" align="left" class="hand" onclick="imgOrignWin('<?php echo $R['url'].'/'.$R['folder'].'/'.$R['tmpname']?>');" alt="" />
					<?php endif?>
					<?php echo $R['name']?>
					<?php if($R['width']&&$R['height']):?>
					<div>(<?php echo $R['width']?> * <?php echo $R['height']?> px)</div><?php endif?>
				</td>
				<td><?php echo $R['folder']?></td>
				<td><?php echo $R['down']?></td>
				<td><?php echo getSizeFormat($R['size'],1)?></td>
				<td><a href="#" onclick="userDrop('<?php echo $R['mbruid']?>');"><?php echo $_M[$_HS['nametype']]?></a></td>
				<td>
					<?php if($R['parent']):?>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;set=<?php echo $_B['id']?>&amp;front=list&amp;uid=<?php echo $R['parent']?>" target="_blank">보기</a>
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
				<button type="button" onclick="chkFlag('upfile_members[]');checkboxCheck();" class="btn btn-default btn-sm">선택/해제 </button>
				<button type="button" onclick="actCheck('admin/multi_file_delete');" class="btn btn-default btn-sm rb-action-btn" disabled>삭제</button>
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
function inboxSelect(n)
{
	var f = document.procForm;
	f.inbox.value = n;
	f.submit();
}
function userDrop(user)
{
	var f = document.procForm;
	f.mbruid.value = user;
	f.submit();
}
function extDrop(xext)
{
	var f = document.procForm;
	f.ext.value = xext;
	f.submit();
}
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('upfile_members[]');
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
		alert('선택된 첨부파일이 없습니다.      ');
		return false;
	}
	
	if (act == 'admin/multi_file_delete')
	{
		if(confirm('정말로 삭제하시겠습니까?    '))
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
var _setFront;
function postUidSet(uid,front)
{
	_postUid = uid;
	_setFront=front;
}

// 포스트 seo 모달 출력 
$('.rb-modal-seo').on('click',function() {
	modalSetting('modal_window','<?php echo getModalLink('&amp;m=admin&amp;module=set&amp;front=modal.set&amp;uid=')?>'+_postUid+'&_front='+_setFront);
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
    var l = document.getElementsByName('upfile_members[]');
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

