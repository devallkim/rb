<!-- markjs js : https://github.com/julmot/mark.js -->
<?php getImport('markjs','jquery.mark.min','8.11.1','js')?>

<header class="bar bar-nav bar-dark bg-primary pl-0">
	<form name="RbSearchForm" action="<?php echo $g['s']?>/" class="input-group" role="form" id="search-form" style="top: 0;">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="where" value="<?php echo $where?>">
		<input type="hidden" name="swhere" value="all">
		<input type="hidden" name="term" value="<?php echo $term?>">
		<input type="hidden" name="orderby" value="<?php echo $orderby?>">
		<span class="input-group-btn" data-role="return-result">
			<a class="icon icon-left-nav pull-left px-2" role="button" href="<?php  echo RW(0) ?>"></a>
    </span>
	  <input type="search" class="form-control border-0" placeholder="검색어를 입력하세요." value="<?php echo $_keyword?>" name="keyword" id="search-input" autocomplete="off">
		<span class="input-group-btn hidden" data-role="reset-keyword">
      <button class="btn btn-secondary px-3" type="button" data-act="keyword-reset" tabindex="-1">
        <i class="fa fa-times-circle fa-lg" aria-hidden="true"></i>
      </button>
    </span>
	</form>
</header>

<!-- Block button in standard bar fixed below top bar -->
<div class="bar bar-standard bar-header-secondary bar-light bg-white">
	<nav class="nav nav-inline">
		<a id="nav_search_all" class="nav-link<?php if($swhere=='all'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>all" data-control="push" data-transition="fade" data-act="moreResult">전체</a>
		<a id="nav_search_menu" class="nav-link<?php if($swhere=='search_menu'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>search_menu" data-control="push" data-transition="fade" data-act="moreResult">메뉴</a>
		<a id="nav_search_page" class="nav-link<?php if($swhere=='search_page'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>search_page" data-control="push" data-transition="fade" data-act="moreResult">페이지</a>
		<a id="nav_search_bbs" class="nav-link<?php if($swhere=='search_bbs'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>search_radio-post" data-control="push" data-transition="fade" data-act="moreResult">게시물</a>
		<a id="nav_search_photo" class="nav-link<?php if($swhere=='search_photo'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>search_photo" data-control="push" data-transition="fade" data-act="moreResult">사진</a>
		<a id="nav_search_video" class="nav-link<?php if($swhere=='search_video'):?> active<?php endif?>" href="<?php echo $g['url_where'] ?>search_video" data-control="push" data-transition="fade" data-act="moreResult">동영상</a>
	</nav>
</div>
<div class="bar bar-standard bar-footer bar-light bg-faded hidden" id="search-footer">
  <button class="btn btn-secondary btn-block" id="search-form-submit">검색</button>
</div>

<div class="content bg-faded" data-role="panal-result">
	<main class="rb-main">

		<?php if($keyword && $swhere == 'all'):?>
		<div id="rb-sortbar" class="card p-a-1 bg-white">
			총 <span id="rb_sresult_num_all" class="badge badge-primary badge-outline">0</span> 건이 검색 되었습니다.
		</div>

		<div id="search_no_result" class="hidden content-padded">
			<div class="alert alert-info text-xs-center"><strong>&lsquo;<span><?php echo $keyword;?></span>&rsquo;에 대한 검색결과가 없습니다.</strong></div>
			<ul class="list-unstyled">
				<li>&middot; 검색어의 철자를 정확하게 입력했는지 확인해 보세요.</li>
				<li>&middot;  연관된 다른 검색어나 비슷한 의미의 일반적인 단어를 입력하여 찾아 보세요.</li>
			</ul>
			<p>
				<a href="<?php  echo RW(0) ?>" class="btn btn-secondary btn-block">홈으로</a>
			</p>
		</div>

		<?php endif?>


		<?php $_ResultArray['num']=array()?>
		<?php if($keyword):?>
		<?php foreach($d['search_order'] as $_key => $_val):if(!strstr($_val[1],'['.$r.']'))continue?>
			<?php $_iscallpage=($swhere == 'all' || $swhere == $_key)?>
			<?php if($_iscallpage):?>
				<?php if(is_file($_val[2].'.css')) echo '<link href="'.$_val[2].'.css" rel="stylesheet">'?>
				<div id="rb_search_panel_<?php echo $_key?>" class="card">
					<div class="card-header bg-white">
						<?php echo $_val[0]?>
						<small><span id="rb_sresult_num_tt_<?php echo $_key?>" class="text-danger">0</span>건</small>
					</div>
					<?php endif?>

					<!-- 검색결과 -->
					<div class="">
					<?php include $_val[2].'.php' ?>
					</div>
					<!-- @검색결과 -->
					<?php if($_iscallpage): ?>
						<?php if($swhere==$_key): ?>
					<div class="card-footer bg-white p-2">
						<div class="d-flex align-items-center">
							<?php echo getPageLink(3,$p,getTotalPage($_ResultArray['num'][$_key],$d['search']['num2']),'mobile')?>
						</div>
					</div>
						<?php else:?>
							<?php if($_ResultArray['num'][$_key] > $d['search']['num1']):?>
					<div class="card-footer text-xs-right bg-white p-2">
						<div class="rb-more-search">
							<a href="<?php echo $g['url_where'].$_key ?>" class="btn btn-link text-muted" data-control="push" data-transition="fade" data-act="moreResult"><?php echo $_val[0]?> 더보기 <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i></a>
						</div>
					</div>
							<?php endif ?>
						<?php endif?>
				</div>

			<?php endif?>

		<?php endforeach?>

		<?php else:?>
		<div id="rb-searchresult-none" class="content-padded">
			<p>검색어를 입력해 주세요.</p>
		</div>
		<?php endif?>
	</main>
</div><!-- /.content -->

<script>

// 통합검색 입력창
var doSearchInput = function(){

	$('#search-input').focus(function(){
		//$("#search-input").attr('placeholder','검색어를 입력해 주세요.')
		$('#modal-search').modal('show')



	});
};


// 검색탭 이동시 로더 출력
var doLoader = function(){


	$('[data-act="moreResult"]').tap(function() {
		$(".content").loader({
			text:       "로딩중...",
			position:   "overlay"
		});
	});

	$('[data-control="push"]').tap(function() {
		$(".content").loader({
			text:       "로딩중...",
			position:   "overlay"
		});
	});

};
var removeLoader = function(){
	$(".content").loader("hide");
};


var doSearchResult  = function(){

	function searchSortChange(obj)
	{
		var f = document.RbSearchForm;
		f.orderby.value = obj.value;
		f.submit();
	}
	function searchTermChange(obj)
	{
		var f = document.RbSearchForm;
		f.term.value = obj.value;
		f.submit();
	}
	function searchWhereChange(obj)
	{
		var f = document.RbSearchForm;
		f.where.value = obj.value;
		f.submit();
	}

	// marks.js
	$(".rb-main").mark("<?php echo $keyword ?>");

	<?php $total = 0?>

	<?php foreach($_ResultArray['num'] as $_key => $_val):$total+=$_val?>

	  if ($('#rb_sresult_num_tt_<?php echo $_key?>')) {
			$('#rb_sresult_num_tt_<?php echo $_key?>').text('<?php echo $_val?>')
		}

		<?php if(!$_val):?>
		$('#rb_search_panel_<?php echo $_key?>').addClass('card hidden')
		$('#nav_<?php echo $_key?>').addClass('hidden')
		<?php endif?>

	<?php endforeach?>

	var search_result_total = <?php echo $swhere=='all'?$total:$_ResultArray['num'][$swhere]?>;
	if(search_result_total==0){
		$("#search_no_result").removeClass("hidden");
		$('.bar-header-secondary').remove()
	}
	$('#rb_sresult_num_all').text(search_result_total)

	<?php if(!$_ResultArray['spage']):?>
	if(getId('rb-sortbar')) getId('rb-sortbar').className = 'hidden';
	<?php endif?>

};

// 검색관련 스크립트 실행
doSearchInput();
doSearchResult();
doLoader();


// push 컨트롤 바인드 : http://rc.kimsq.com/controls/push/#push-bind
window.addEventListener('push', doSearchInput);
window.addEventListener('push', doSearchResult);
window.addEventListener('push', doLoader);


</script>
