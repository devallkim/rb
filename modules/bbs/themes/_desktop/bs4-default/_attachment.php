<!-- 첨부파일 접근권한 -->
<?php if ($d['bbs']['perm_l_down'] <= $my['level'] && (strpos($d['bbs']['perm_g_down'],'['.$my['mygroup'].']') === false)): ?>

	<?php
		 $img_files = array();
		 $audio_files = array();
		 $video_files = array();
		 $youtube_files = array();
		 $down_files = array();
		 foreach($d['upload']['data'] as $_u){
				if($_u['type']==2 and $_u['hidden']==0) array_push($img_files,$_u);
				else if($_u['type']==4 and $_u['hidden']==0) array_push($audio_files,$_u);
				else if($_u['type']==5 and $_u['hidden']==0) array_push($video_files,$_u);
				else if($_u['type']==8 and $_u['hidden']==0) array_push($youtube_files,$_u);
				else if($_u['type']==1 || $_u['type']==6 || $_u['type']==7 and $_u['hidden']==0) array_push($down_files,$_u);
		 }
		 $attach_photo_num = count ($img_files);
		 $attach_video_num = count ($video_files);
		 $attach_audio_num = count ($audio_files);
		 $attach_youtube_num = count ($youtube_files);
		 $attach_down_num = count ($down_files);
	?>

	<?php if($attach_down_num>0):?>
	<ul class="list-group mb-0">
		<?php foreach($down_files as $_u):?>
			<?php
				 $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
				 $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
			 ?>
			 <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>
            <i class="fa fa-file<?php echo $ext_icon?>-o fa-lg fa-fw"></i>
            <a class="muted-link" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=mediaset&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>">
                <?php echo $_u['name']?>
            </a>
					</span>
					 <span>
            <small class="badge badge-light"><?php echo getSizeFormat($_u['size'],1)?></small>
            <span title="다운로드 수" data-toggle="tooltip" class="badge badge-light">
							<i class="fa fa-download" aria-hidden="true"></i>
							<?php echo number_format($_u['down'])?>
						</span>
          </span>
			 </li>
		<?php endforeach?>
	</ul>
	<?php endif?>


	<?php if($attach_youtube_num>0):?>
		<?php foreach($youtube_files as $_u):?>
		 <video class="mejs-player mb-4"  style="max-width:100%;" preload="none">
				 <source src="https://www.youtube.com/embed/<?php echo $_u['name']?>" type="video/youtube">
		 </video>
		<?php endforeach?>
	<?php endif?>

	<?php if($attach_photo_num>0):?>
	<h5>사진 <span class="badge badge-light"><?php echo $attach_photo_num?></span></h5>
	<ul class="list-inline mb-3 gallery" data-plugin="photoswipe">
		<?php foreach($img_files as $_u):?>

		<?php
			$img_origin=$_u['url'].$_u['folder'].'/'.$_u['tmpname'];
			$thumb_list=getPreviewResize($img_origin,'q'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
			$thumb_modal=getPreviewResize($img_origin,'c'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
		?>
			<figure class="list-inline-item">
				<a href="<?php echo $img_origin ?>" data-size="<?php echo $_u['width']?>x<?php echo $_u['height']?>" title="<?php echo $_u['name']?>">
	        <img src="<?php echo $thumb_list ?>" alt="" class="border">
	      </a>
	      <figcaption itemprop="caption description" hidden><?php echo $_u['name']?></figcaption>
			</figure>
		<?php endforeach?>
	</ul>
	<?php endif?>


	<?php if($attach_video_num>0):?>
	<h5 class="mt-5">비디오 <span class="text-danger"><?php echo $attach_video_num?></span></h5>
	<div class="card-deck">
		<?php foreach($video_files as $_u):?>
	  <?php
	     $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
	     $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
	   ?>
	  <div class="card">
	    <video width="320" height="240" controls data-plugin="mediaelement" class="card-img-top">
	      <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="video/<?php echo $_u['ext']?>">
	    </video>
	    <div class="card-body">
	      <h6 class="card-title"><?php echo $_u['name']?></h6>
	      <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
	    </div><!-- /.card-block -->
	  </div><!-- /.card -->
	  <?php endforeach?>
	</div><!-- /.card-deck -->
	<?php endif?>


	<?php if($attach_audio_num>0):?>
	  <h5 class="mt-5">오디오 <span class="text-danger"><?php echo $attach_audio_num?></span></h5>
	  <?php foreach($audio_files as $_u):?>
	  <?php
	    $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
	    $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
	   ?>
	  <div class="card">
	    <audio controls data-plugin="mediaelement" class="card-img-top w-100">
	      <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/mp3">
	    </audio>
	    <div class="card-body">
	      <h6 class="card-title"><?php echo $_u['name']?></h6>
	      <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
	    </div><!-- /.card-block -->
	  </div><!-- /.card -->
	  <?php endforeach?>

	<?php endif?>

<?php endif; ?>
