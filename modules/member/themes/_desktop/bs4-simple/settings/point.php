<?php
$vtype	= $vtype ? $vtype : 'point';
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 10;

$sqlque = 'my_mbruid='.$my['uid'];
if ($type == '1') $sqlque .= ' and price > 0';
if ($type == '2') $sqlque .= ' and price < 0';
if ($where && $keyword)
{
	$sqlque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['s_'.$vtype],$sqlque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_'.$vtype],$sqlque);
$TPG = getTotalPage($NUM,$recnum);

$PageLink = './point?';
if ($type) $PageLink .= 'type='.$type.'&amp;';

?>

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<div class="col-9 page-main">

			<div class="Subhead mt-0">
				<h2 class="Subhead-heading">포인트 내역관리</h2>
			</div>


			<div class="d-flex justify-content-between align-items-center mb-2">
				<span>총 <?php echo number_format($NUM)?>건 </span>
				<form class="w-25" name="hideForm" action="./point" method="get">
					<select name="type" class="form-control" onchange="this.form.submit();">
						<option value="">전체</option>
						<option value="1"<?php if($type=='1'):?> selected="selected"<?php endif?>>획득</option>
						<option value="2"<?php if($tpye=='2'):?> selected="selected"<?php endif?>>사용</option>
					</select>
				</form>
			</div>


			<form name="procForm" action="./point" method="post"  onsubmit="return submitCheck(this);">
				<input type="hidden" name="a" value="">
				<input type="hidden" name="pointType" value="<?php echo $vtype?>">

				<div id="pointlist">

					<div class="card">
						<table class="table table-hover mb-0">
							<colgroup>
								<col width="30">
								<col width="80">
								<col>
								<col width="150">
							</colgroup>
							<thead class="thead-light">
							<tr>
								<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" class="hand" alt="" onclick="chkFlag('members[]');" /></th>
								<th scope="col">금액</th>
								<th scope="col">내역</th>
								<th scope="col" class="side2">날짜</th>
							</tr>
							</thead>
							<tbody>

							<?php while($R=db_fetch_array($RCD)):?>
							<tr>
								<td><input type="checkbox" name="members[]" value="<?php echo $R['uid']?>" /></td>
								<td class="cat"><?php echo ($R['price']>0?'+':'').number_format($R['price'])?></td>
								<td class="sbj">
									<?php echo $R['content']?>
									<?php if(getNew($R['d_regis'],24)):?><small class="text-danger">new</small><?php endif?>
								</td>
								<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
							</tr>
							<?php endwhile?>

							<?php if(!$NUM):?>
							<tr>
								<td><input type="checkbox" disabled="disabled" /></td>
								<td class="cat">-</td>
								<td class="sbj1">내역이 없습니다.</td>
								<td><?php echo getDateFormat($date['totime'],'Y.m.d H:i')?></td>
							</tr>
							<?php endif?>

							</tbody>
						</table>
					</div>


					<nav aria-label="Page navigation" class="mt-4">
						<ul class="pagination justify-content-center">
							<?php echo getPageLink(10,$p,$TPG,$PageLink)?>
						</ul>
					</nav>

					<div class="mt-4">
						<button type="button" class="btn btn-light" onclick="actCheck('point_sum');">내역정리</button>
						<button type="button" class="btn btn-light" onclick="actCheck('point_delete');">삭제</button>
					</div>

				</div>

			</form>


		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>

<script type="text/javascript">
//<![CDATA[
function submitCheck(f)
{
	if (f.a.value == '')
	{
		return false;
	}
}
function actCheck(act)
{
	var f = document.procForm;
    var l = document.getElementsByName('members[]');
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
		alert('선택된 내역이 없습니다.      ');
		return false;
	}

	if(confirm('정말로 실행하시겠습니까?    '))
	{
		f.a.value = act;
		f.submit();
	}
}

//]]>
</script>
