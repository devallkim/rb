<?php
$sqlque	= 'uid';
$sqlque .= getSearchSql('name|alt|caption',$keyword,'','or'); // 페이지코드와 페이지명 검색
$sqlque .=' and hidden=0'; // 노출파일만
$sqlque .=' and (type=6 or type=1)'; // 문서파일
$orderby = 'desc';		//	(desc 최신순 / asc 오래된순)

if($_iscallpage):
$RCD = getDbArray($table['s_upload'],$sqlque,'*','uid',$orderby,$d['search']['num'.($swhere=='all'?1:2)],$p);
?>


<div id="rb-search-search-file">
	<ul class="table-view table-view-full">
		<?php while($_R=db_fetch_array($RCD)):?>
		<li class="table-view-cell">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=<?php echo $_R['id']?>"><?php echo $_R['name']?></a>
		</li>
		<?php endwhile?>
	</ul>
</div>

<?php
endif;
$_ResultArray['num'][$_key] = getDbRows($table['s_upload'],$sqlque);
?>
