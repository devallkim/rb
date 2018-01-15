<?php
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$SITEN   = db_num_rows($SITES);

$type	= $type ? $type : 'point';
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;

//사이트선택적용
//$accountQue = $account ? 'a.site='.$account.' and ':'';
$_WHERE ='uid>0';
if ($d_start) $_WHERE .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $_WHERE .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($flag == '+') $_WHERE .= ' and price > 0';
if ($flag == '-') $_WHERE .= ' and price < 0';

if ($where && $keyw)
{
	if ($keyw=='my_mbruid') $_WHERE .= ' and my_mbruid='.$keyw;
	else $_WHERE .= getSearchSql($where,$keyw,$ikeyword,'or');
}
$RCD = getDbArray($table['s_'.$type],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_'.$type],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>

<div class="row no-gutters">

	<div class="col-sm-4 col-md-4 col-xl-3 d-none d-sm-block sidebar sidebar-right">

		<form name="procForm" action="<?php echo $g['s']?>/" method="get" class="card">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $m?>">
			<input type="hidden" name="module" value="<?php echo $module?>">
			<input type="hidden" name="front" value="<?php echo $front?>">
			<input type="hidden" name="type" value="<?php echo $type?>">

			<?php if($SITEN>1):?>
			<div class="border border-primary">
				<select name="account" class="form-control custom-select border-0" onchange="this.form.submit();">
					<option value="">전체사이트</option>
					<?php while($S = db_fetch_array($SITES)):?>
					<option value="<?php echo $S['uid']?>"<?php if($account==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['label']?></option>
					<?php endwhile?>
					<?php if(!db_num_rows($SITES)):?>
					<option value="">등록된 사이트가 없습니다.</option>
					<?php endif?>
				</select>
			</div>
			<?php endif?>

			<div class="card-body">
				<div class="form-group">
			    <label>기간</label>
					<span class="input-daterange" id="datepicker">
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text">시작일</span>
							</div>
						  <input type="text" class="form-control" name="d_start" placeholder="선택" value="<?php echo $d_start?>">
						</div>
						<div class="input-group input-group-sm mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text">종료일</span>
							</div>
						  <input type="text" class="form-control" name="d_finish" placeholder="선택" value="<?php echo $d_finish?>">
						</div>
					</span>

					<button class="btn btn-light btn-block mb-2" type="submit">기간적용</button>
					<div class="btn-group">
						<button class="btn btn-light" onclick="dropDate('2017/12/27','2017/12/27');">어제</button>
						<button class="btn btn-light" onclick="dropDate('2017/12/28','2017/12/28');">오늘</button>
						<button class="btn btn-light" onclick="dropDate('2017/12/21','2017/12/28');">일주</button>
					</div>
					<div class="btn-group">
						<button class="btn btn-light" onclick="dropDate('2017/11/28','2017/12/28');">한달</button>
						<button class="btn btn-light" onclick="dropDate('2017/12/01','2017/12/28');">당월</button>
						<button class="btn btn-light" onclick="dropDate('2017/11/01','2017/11/31');">전월</button>
						<button class="btn btn-light" onclick="dropDate('','');">전체</button>
					</div>
			  </div>

				<hr>

				<div class="form-group mb-3">
			    <label>검색</label>

					<select name="where" class="form-control custom-select mb-2">
						<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>내용</option>
						<option value="my_mbruid"<?php if($where=='my_mbruid'):?> selected="selected"<?php endif?>>회원코드</option>
					</select>

			    <input type="text" class="form-control mb-2" name="keyw" value="<?php echo stripslashes($keyw)?>" placeholder="검색어 입력">
					<button class="btn btn-light btn-block" type="submit">검색</button>
			  </div>

				<hr>


				<div class="form-group">
			    <label>필터</label>
					<select name="flag" class="form-control custom-select" onchange="this.form.submit();">
						<option value="">&nbsp;+ 구분</option>
						<option value="+"<?php if($flag=='+'):?> selected="selected"<?php endif?>>획득</option>
						<option value="-"<?php if($flag=='-'):?> selected="selected"<?php endif?>>사용</option>
					</select>

					<div class="btn-group btn-group-sm btn-group-toggle w-100 mt-2" data-toggle="buttons">
						<label class="btn btn-light w-50<?php if($sort=='uid'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
							<input type="radio" value="uid" name="sort"<?php if($sort=='uid'):?> checked<?php endif?>> 등록일
						</label>
						 <label class="btn btn-light w-50<?php if($sort=='price'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
							<input type="radio" value="price" name="sort"<?php if($sort=='price'):?> checked<?php endif?>>금액
						</label>
					</div>

					<div class="btn-group btn-group-sm btn-group-toggle w-100 mt-2" data-toggle="buttons">
						<label class="btn btn-light w-50<?php if($orderby=='desc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
							<input type="radio" value="desc" name="orderby"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i> 내림차순
						</label>
						<label class="btn btn-light w-50<?php if($orderby=='asc'):?> active<?php endif?>" onclick="btnFormSubmit(this);">
							<input type="radio" value="asc" name="orderby"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i> 오름차순
						</label>
					</div>
			  </div>
			</div><!-- /.card-body -->

			<div class="card-footer">
				<a href="<?php echo $g['adm_href']?>" class="btn btn-light btn-block">검색조건 초기화</a>
			</div>

		</form>




	</div><!-- /.sidebar -->
	<div class="col-sm-8 col-md-8 mr-sm-auto col-xl-9">

		<?php if($NUM):?>
		<form class="card rounded-0 border-0" name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
			<input type="hidden" name="r" value="<?php echo $r?>">
			<input type="hidden" name="m" value="<?php echo $module?>">
			<input type="hidden" name="a" value="">
			<input type="hidden" name="pointType" value="<?php echo $type?>">

			<div class="card-header d-flex justify-content-between align-items-center border-0">
				<span class="pull-left">
					 총<code><?php echo number_format($NUM)?></code>개 (<?php echo $p?>/<?php echo $TPG?>페이지)
				</span>
				<div class="">
					<div class="btn-group">
						 <a href="<?php echo '/?'.$_SERVER['QUERY_STRING']?>&amp;p=<?php echo $p-1?>" class="btn btn-light btn-page" <?php echo $p>1?'':'disabled'?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="이전">
								<i class="fa fa-chevron-left fa-lg"></i>
						 </a>
						 <a href="<?php echo '/?'.$_SERVER['QUERY_STRING']?>&amp;p=<?php echo $p+1?>" class="btn btn-light btn-page" <?php echo $NUM>($p*$recnum)?'':'disabled'?> data-toggle="tooltip" data-placement="bottom" title="" data-original-title="다음">
								<i class="fa fa-chevron-right fa-lg"></i>
							</a>
					</div>
					<div class="btn-group">
						 <div class="btn-group dropup hidden-xs">
								<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" >
									<i class="fa fa-list"></i> <?php echo $recnum?>개씩  <span class="caret"></span>
								 </button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li <?php $recnum=='20'?'class="active"':''?>><a href="<?php echo $g['adm_href']?>&amp;recnum=20">20개 출력</a></li>
									<li <?php $recnum=='35'?'class="active"':''?>> <a href="<?php echo $g['adm_href']?>&amp;recnum=35">35개 출력</a></li>
									<li <?php $recnum=='50'?'class="active"':''?>><a href="<?php echo $g['adm_href']?>&amp;recnum=50">50개 출력</a></li>
									<li <?php $recnum=='75'?'class="active"':''?>><a href="<?php echo $g['adm_href']?>&amp;recnum=75">75개 출력</a></li>
									<li <?php $recnum=='90'?'class="active"':''?>><a href="<?php echo $g['adm_href']?>&amp;recnum=90">90개 출력</a></li>
								</ul>
							</div>
					 </div>
				</div>

			</div>
			<!-- //.card-heade -->

		   <!-- 리스트 테이블 시작-->
		 	<table class="table table-hover">
				<thead>
					<tr>
						<th class="text-center"><input type="checkbox"  class="checkAll-point-member" data-toggle="tooltip" title="전체선택"></th>
						<th class="text-center">번호</th>
						<th class="text-center">획득/사용자</th>
						<th class="text-center">획득/사용액</th>
						<th>지금자</th>
						<th>내용</th>
						<th>날짜</th>
				   </tr>
				</thead>
				<tbody>
					<?php while($R=db_fetch_array($RCD)):?>
		        	<?php $M1=getDbData($table['s_mbrdata'],'memberuid='.$R['my_mbruid'],'*')?>
			     <?php if($R['by_mbruid']){$M2=getDbData($table['s_mbrdata'],'memberuid='.$R['by_mbruid'],'*');}else{$M2=array();}?>
					<tr>	<!-- 라인이 체크된 경우 warning 처리됨  -->
						<td class="text-center"><input type="checkbox" name="point_mbrmembers[]"  onclick="checkboxCheck();" class="rb-poin-member" value="<?php echo $R['uid']?>"></td>
						<td class="text-center"><?php echo ($NUM-((($p-1)*$recnum)+$_recnum++))?></td>
						<td><a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-mbrinfo" onmousedown="mbrIdDrop('<?php echo $M1['uid']?>','point');" data-toggle="tooltip" title="획득/사용내역"><?php echo $M1[$_HS['nametype']]?></a></td><!-- main -->
					   <td><?php echo number_format($R['price'])?></td>
						<td>
							<?php if($M2['memberuid']):?>
							 <a href="#" data-toggle="modal" data-target="#modal_window" class="rb-modal-mbrinfo" onmousedown="mbrIdDrop('<?php echo $M2['uid']?>','point');" data-toggle="tooltip" title="획득/사용내역"><?php echo $M1[$_HS['nametype']]?></a></td><!-- post -->
						   <?php else:?>
						   	시스템
					 		<?php endif?>
		            </td>
		            <td><?php echo strip_tags($R['content'])?></td>
					   <td><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
		         </tr>
		         <?php endwhile?>
				</tbody>
			</table>
			<!-- 리스트 테이블 끝 -->


		   <!--목록에 체크된 항목이 없을 경우  fieldset이 disabled 됨-->
			<div class="card-footer btn-toolbar">
			    <div class="col-sm-12 text-center">
			    	  	<ul class="pagination pagination-sm">
						<script>getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'');</script>
						</ul>
		       </div>
			</div> <!-- // .card-footer-->
		</form><!-- // .card-->
		<?php else:?>
			<div class="text-center text-muted d-flex align-items-center justify-content-center" style="height: calc(100vh - 10rem);">
				 <div><i class="fa fa-exclamation-circle fa-3x mb-3" aria-hidden="true"></i>
					 <p>조건에 해당하는 자료가 없습니다.</p>
					 <a href="<?php echo $g['adm_href']?>" class="btn btn-light btn-block mt-2">
				 	 	검색조건 초기화
				 	 </a>
				 </div>
			 </div>
		<?php endif?>

	</div>
</div><!-- /.row -->

<!-- bootstrap-datepicker,  http://eternicode.github.io/bootstrap-datepicker/  -->
<?php getImport('bootstrap-datepicker','css/datepicker3',false,'css')?>
<?php getImport('bootstrap-datepicker','js/bootstrap-datepicker',false,'js')?>
<?php getImport('bootstrap-datepicker','js/locales/bootstrap-datepicker.kr',false,'js')?>
<!-- basic -->
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
// 툴팁 이벤트
$(document).ready(function() {
    $('[data-toggle=tooltip]').tooltip();
});

// 선택박스 체크 이벤트 핸들러
$(".checkAll-point-member").click(function(){
	$(".rb-poin-member").prop("checked",$(".checkAll-point-member").prop("checked"));
	checkboxCheck();
});
// 선택박스 체크시 액션버튼 활성화 함수
function checkboxCheck()
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true){
          $(l[i]).parent().parent().addClass('warning'); // 선택된 체크박스 tr 강조표시
			j++;
		}else{
			$(l[i]).parent().parent().removeClass('warning');
		}
	}
	// 하단 회원관리 액션 버튼 상태 변경
	if (j) $('#list-bottom-fset').prop("disabled",false);
	else $('#list-bottom-fset').prop("disabled",true);
}

function actQue(flag,ah)
{
	var f = document.listForm;
    var l = document.getElementsByName('mbrmembers[]');
    var n = l.length;
    var i;
	var j=0;

	if (flag == 'admin_delete')
	{
		for	(i = 0; i < n; i++)
		{
			if (l[i].checked == true)
			{
				j++;
			}
		}
		if (!j)
		{
			alert('회원을 선택해주세요.     ');
			return false;
		}

		if (confirm('정말로 실행하시겠습니까?     '))
		{
			getIframeForAction(f);
			f.a.value = flag;
			f.auth.value = ah;
			f.submit();
		}
	}
	return false;
}


// 기간 검색 적용 함수
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.d_start.value = date1;
	f.d_finish.value = date2;
	f.submit();
}

</script>
