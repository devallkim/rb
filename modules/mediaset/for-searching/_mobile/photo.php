<?php
$title_len=$title_len?$title_len:46; // 제목 길이
$sqlque	= 'uid';
$sqlque .= getSearchSql('name|alt|caption',$keyword,'','or'); // 페이지코드와 페이지명 검색
$sqlque .=' and type=2'; // 포토셋만
$orderby = 'desc';		//	(desc 최신순 / asc 오래된순)

if($_iscallpage):
$RCD = getDbArray($table['s_upload'],$sqlque,'*','uid',$orderby,6,$p);
?>


<div itemscope itemtype="http://schema.org/ImageGallery"  data-extension="photoswipe" class="px-2">
	<?php while($_R=db_fetch_array($RCD)):?>

		<?php
      $img='';
			$img=$_R['url'].$_R['folder'].'/'.$_R['tmpname']; // sys.func.php 파일 참조

			$img_data=array('src'=>$img,'width'=>'200','height'=>'200','qulity'=>'100','filter'=>'','align'=>'');
		?>
		<figure class="figure mb-0" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
			<a href="<?php echo $img ?>" itemprop="contentUrl" data-size="<?php echo $_R['width'] ? $_R['width'] : 200; ?>x<?php echo $_R['height'] ? $_R['height'] : 200; ?>">
				<img src="<?php echo getTimThumb($img_data)?>" alt="<?php echo $_R['caption'] ?>" itemprop="thumbnail"  class="img-fluid" style="width: 100px">
			</a>
			<figcaption class="figure-caption d-none" itemprop="caption description"><?php echo $_R['caption'] ?></figcaption>
		</figure>

	<?php endwhile?>
</div>

<?php
endif;
$_ResultArray['num'][$_key] = getDbRows($table['s_upload'],$sqlque);
?>

<script>
	 RC_initPhotoSwipe();
</script>
