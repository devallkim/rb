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

<?php include_once $g['dir_module_skin'].'_header.php'?>

<div class="page-wrapper row">
	<div class="col-3 page-nav">
		<?php include_once $g['dir_module_skin'].'_menu.php'?>
	</div>

	<div class="col-9 page-main">

		<div class="subhead mt-0">
			<h2 class="subhead-heading">
				포인트 내역관리
				<span class="badge badge-pill badge-dark align-top"><?php echo number_format($my['point'])?> P</span>
			</h2>
		</div>

	  <?php if (!getloginExpired($my['last_log'],$d['member']['settings_expire'])): //로그인 후 경과시간 비교(분 ?>
		<?php include_once $g['dir_module_skin'].'_pwConfirm.php'?>
		<?php else: ?>

		<div class="d-flex justify-content-between align-items-end mb-2">
			<div class="">
				<span>총 <?php echo number_format($NUM)?>건</span>
			</div>
			<form class="w-25" name="hideForm" action="<?php echo $g['s']?>/" method="get">
				<input type="hidden" name="r" value="<?php echo $r?>">
				<input type="hidden" name="m" value="<?php echo $m?>">
				<input type="hidden" name="front" value="<?php echo $front?>">
				<input type="hidden" name="page" value="<?php echo $page?>">
				<select name="type" class="form-control" onchange="this.form.submit();">
					<option value="">전체</option>
					<option value="1"<?php if($type=='1'):?> selected="selected"<?php endif?>>획득</option>
					<option value="2"<?php if($type=='2'):?> selected="selected"<?php endif?>>사용</option>
				</select>
			</form>
		</div>

		<form name="procForm" action="<?php echo $g['s']?>/" method="post"  onsubmit="return submitCheck(this);">
			<input type="hidden" name="m" value="<?php echo $m?>">
			<input type="hidden" name="a" value="">
			<input type="hidden" name="pointType" value="<?php echo $vtype?>">

			<table class="table table-hover mb-0 text-center">
				<colgroup>
					<col width="50">
					<col width="80">
					<col>
					<col width="150">
				</colgroup>
				<thead class="thead-light">
				<tr>
					<th scope="col" class="side1">
						<i class="fa fa-check-square-o fa-lg" aria-hidden="true"  onclick="chkFlag('members[]');" role="button" data-toggle="tooltip" title="전체선택"></i>
					</th>
					<th scope="col">금액</th>
					<th scope="col">내역</th>
					<th scope="col" class="side2">날짜</th>
				</tr>
				</thead>
				<tbody>

				<?php while($R=db_fetch_array($RCD)):?>
				<tr>
					<td><input type="checkbox" name="members[]" value="<?php echo $R['uid']?>" /></td>
					<td><?php echo ($R['price']>0?'+':'').number_format($R['price'])?></td>
					<td class="text-left">
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

			<nav aria-label="Page navigation" class="d-flex justify-content-between my-4">
				<ul class="pagination">
					<?php echo getPageLink(10,$p,$TPG,$PageLink)?>
				</ul>

				<div>
					<button type="button" class="btn btn-light" onclick="actCheck('point_sum');">내역정리</button>
					<button type="button" class="btn btn-light" onclick="actCheck('point_delete');">삭제</button>
				</div>

			</nav>

		</form>

		<?php endif; ?>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->

<?php include_once $g['dir_module_skin'].'_footer.php'?>

<script type="text/javascript">
//<![CDATA[

putCookieAlert('member_settings_result') // 실행결과 알림 메시지 출력

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

    for (i = 0; i < n; i++) {
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
	if(confirm('정말로 실행하시겠습니까?    ')){
		f.a.value = act;
		getIframeForAction(f);
		f.submit();
	}
}

putCookieAlert('member_point_result') // 실행결과 알림 메시지 출력

//]]>
</script>
