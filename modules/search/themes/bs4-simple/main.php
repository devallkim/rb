<div id="rb-search-body" class="mb-4">

	<form name="RbSearchForm" action="<?php echo $g['s']?>/" class="pt-5 pb-4 d-flex justify-content-center" role="form">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="where" value="<?php echo $where?>">
		<input type="hidden" name="swhere" value="<?php echo $swhere?>">
		<input type="hidden" name="sort" value="<?php echo $sort?>">
		<input type="hidden" name="orderby" value="<?php echo $orderby?>">

		<div class="input-group input-group-lg w-75">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-search"></i> 통합검색</span>
			</div>
			<input type="text" name="keyword" class="form-control" value="<?php echo $_keyword?>">
			<div class="input-group-append">
				<button class="btn btn-light" type="submit">검색</button>
				<?php if($keyword):?><a class="btn btn-light" href="<?php echo $g['url_reset']?>">리셋</a><?php endif?>
			</div>
		</div>
	</form>

	<hr>

	<div class="row">
		<div class="col-sm-3">
			<div class="list-group">
				<a href="<?php echo $g['url_where']?>all" class="list-group-item<?php if($swhere=='all'):?> active<?php endif?>">전체</a>
				<?php $_ResultArray['spage']=0;foreach($d['search_order'] as $_key => $_val):if(!strstr($_val[1],'['.$r.']'))continue?>
				<a href="<?php echo $g['url_where'].$_key?>" class="list-group-item<?php if($swhere==$_key):?> active<?php endif?>">
					<?php echo $_val[0]?>
					<span id="rb_sresult_num_bg_<?php echo $_key?>" class="badge pull-right">0</span>
				</a>
				<?php $_ResultArray['spage']++;endforeach?>
			</div>

		</div>
		<div class="col-sm-9">

			<?php if($keyword):?>
			<div class="d-flex justify-content-between align-items-center mb-2">
				<div><strong>총 <span id="rb_sresult_num_all">0</span>건</strong>이 검색 되었습니다.</div>
				<div class="">
					<select class="form-control custom-select" data-header="정열방식" onchange="searchSortChange(this);">
						<option value="desc"<?php if($orderby=='desc'):?> selected<?php endif?>>최신순</option>
						<option value="asc"<?php if($orderby=='asc'):?> selected<?php endif?>>과거순</option>
					</select>
				</div>
			</div>
			<?php endif?>

			<?php $_ResultArray['num']=array()?>
			<?php if($keyword):?>
			<?php foreach($d['search_order'] as $_key => $_val):if(!strstr($_val[1],'['.$r.']'))continue?>
				<?php $_iscallpage=($swhere == 'all' || $swhere == $_key)?>
				<?php if($_iscallpage):?>
					<?php if(is_file($_val[2].'.css')) echo '<link href="'.$_val[2].'.css" rel="stylesheet">'?>
			<div id="rb_search_panel_<?php echo $_key?>" class="card mb-3">
				<div class="card-header">
					<?php echo $_val[0]?>
					<span class="badge badge-secondary" id="rb_sresult_num_tt_<?php echo $_key?>">0</span>
				</div>
				<?php endif?>

				<!-- 검색결과 -->
				<div class="card-body">
				<?php include $_val[2].'.php' ?>
				</div>
				<!-- @검색결과 -->

				<?php if($_iscallpage):?>
					<?php if($swhere==$_key):?>
				<div class="card-footer">
					<ul class="pagination">
						<script>getPageLink(5,<?php echo $p?>,<?php echo getTotalPage($_ResultArray['num'][$_key],$d['search']['num2'])?>,'');</script>
					</ul>
				</div>
					<?php else:?>
						<?php if($_ResultArray['num'][$_key] > $d['search']['num1']):?>
				<div class="card-footer">
					<div class="rb-more-search">
						<a href="<?php echo $g['url_where'].$_key?>">더보기 <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
						<?php endif?>
					<?php endif?>
			</div>
				<?php endif?>
			<?php endforeach?>
			<?php else:?>
			<div id="rb-searchresult-none">
				<h3>검색어를 입력해 주세요.</h3>
			</div>
			<?php endif?>
			<div id="rb-searchpage-none" class="d-none">
				<h3>검색 페이지가 설정되어 있지 않습니다.</h3>
			</div>
		</div>
	</div>
</div>



<!-- bootstrap-select -->
<?php getImport('bootstrap-select','bootstrap-select',false,'css')?>
<?php getImport('bootstrap-select','bootstrap-select',false,'js')?>

<script>
function searchSortChange(obj)
{
	var f = document.RbSearchForm;
	f.orderby.value = obj.value;
	f.submit();
}
$('select').selectpicker();

<?php $total = 0?>
<?php foreach($_ResultArray['num'] as $_key => $_val):$total+=$_val?>
if(getId('rb_sresult_num_tt_<?php echo $_key?>')) getId('rb_sresult_num_tt_<?php echo $_key?>').innerHTML = '<?php echo $_val?>';
if(getId('rb_sresult_num_bg_<?php echo $_key?>')) getId('rb_sresult_num_bg_<?php echo $_key?>').innerHTML = '<?php echo $_val?>';
<?php if(!$_val):?>getId('rb_search_panel_<?php echo $_key?>').className = 'd-none';<?php endif?>
<?php endforeach?>
if(getId('rb_sresult_num_all')) getId('rb_sresult_num_all').innerHTML = '<?php echo $swhere=='all'?$total:$_ResultArray['num'][$swhere]?>';
<?php if(!$_ResultArray['spage']):?>
if(getId('rb-searchresult-none')) getId('rb-searchresult-none').className = 'd-none';
if(getId('rb-sortbar')) getId('rb-sortbar').className = 'd-none';
getId('rb-searchpage-none').className = '';
<?php endif?>
</script>
