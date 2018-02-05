<!-- 사진전용모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','rc-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','rc-photoswipe','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.1.3','js') ?>
<?php getImport('mediaelement','lang/ko','4.1.3','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.1.3','css') ?>


<section class="rb-bbs-view">

	<header>
		<h1 class="h3">
			<?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
		</h1>
		<div class="d-flex justify-content-between align-items-center mb-3">
	 		<ul class="list-inline mb-0">
	 			<li class="list-inline-item"><?php echo $R[$_HS['nametype']]?></li>
	 			<li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?></li>
	 			<li class="list-inline-item">조회 : <?php echo $R['hit']?></li>
	 		</ul>

	 		<div class="btn-group">
	 			<?php if($d['theme']['use_singo']):?>
	 			<a class="btn btn-light" href="<?php echo $g['bbs_action']?>singo&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?');">
					<i class="fa fa-bell-o"></i> 신고
				</a>
	 			<?php endif?>
	 			<?php if($d['theme']['use_print']):?>
				<button class="btn btn-light js-print" type="button"><i class="fa fa-print"></i> 인쇄</button>
	 			<?php endif?>
	 			<?php if($d['theme']['use_scrap']):?>
	 			<a class="btn btn-light"  href="<?php echo $g['bbs_action']?>scrap&amp;uid=<?php echo $R['uid']?>"  target="_action_frame_<?php echo $m?>" onclick="return isLogin2();">
					<i class="fa fa-paperclip"></i> 스크랩
				</a>
	 			<?php endif?>
	 		</div>
	 	</div>
	</header>

	<article class="py-3">
		<?php echo getContents($R['content'],$R['html'])?>
	</article>

	<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
	<div class="text-center">
		<?php if($d['theme']['show_score1']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');" class="btn btn-light">
			<i class="fa fa-thumbs-o-up"></i> 공감 <span class="text-muted"><em><?php echo $R['score1']?></em></span>
		</a>
		<?php endif?>
		<?php if($d['theme']['show_score2']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');" class="btn btn-light">
			<i class="fa fa-thumbs-o-down"></i> 비공감 <span class="text-muted"><em><?php echo $R['score2']?></em></span>
		</a>
		<?php endif?>
	</div>
	<?php endif?>

	<?php if($R['tag']&&$d['theme']['show_tag']):?>
	<div class="">
		<?php $_tags=explode(',',$R['tag'])?>
		<?php $_tagn=count($_tags)?>
		<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
		<?php $_tagk=trim($_tags[$i])?>
		<a class="badge badge-secondary" href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>">
		<?php echo $_tagk?>
		</a>
		<?php endfor?>
	</div>
	<?php endif?>

	<footer class="d-flex justify-content-between align-items-center mt-3">
		<div class="btn-group">
			 <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
				 <a href="<?php echo $g['bbs_modify'].$R['uid']?>" class="btn btn-light">수정</a>
				 <a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-light">삭제</a>
				<?php endif?>
				<?php if($my['admin']&&$d['theme']['use_reply']):?>
						<a href="<?php echo $g['bbs_reply'].$R['uid']?>" class="btn btn-light">답변</a>
				<?php endif?>
		 </div>
		 <a href="<?php echo $g['bbs_list']?>" class="btn btn-light">목록</a>
	</footer>

<?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$attach_file_num>0):?>
<div class="mt-4">
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

<?php if($attach_youtube_num>0):?>
	<?php foreach($youtube_files as $_u):?>
	 <video class="mejs-player mb-4"  style="max-width:100%;" preload="none">
			 <source src="https://www.youtube.com/embed/<?php echo $_u['name']?>" type="video/youtube">
	 </video>
	<?php endforeach?>
<?php endif?>

<?php if($attach_photo_num>0):?>
<h5>사진 (<span class="text-danger"><?php echo $attach_photo_num?></span>)</h5>
<ul class="list-inline mb-3 gallery">
	<?php foreach($img_files as $_u):?>

	<?php
		$img_origin=$_u['url'].$_u['folder'].'/'.$_u['tmpname'];
		$thumb_list=getPreviewResize($img_origin,'q'); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
		$thumb_modal=getPreviewResize($img_origin,'c'); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
	?>
		<figure class="list-inline-item">
			<a href="<?php echo $thumb_modal ?>" data-size="<?php echo $_u['width']?>x<?php echo $_u['width']?>">
        <img src="<?php echo $thumb_list ?>" alt="">
      </a>
      <figcaption itemprop="caption description"><?php echo $_u['name']?></figcaption>
		</figure>
	<?php endforeach?>
</ul>
<?php endif?>

<?php if($attach_down_num>0):?>
<div class="card">
	<div class="card-header">
		파일 (<span class="text-danger"><?php echo $attach_down_num ?></span>)
	</div>
	<ul class="list-group list-group-flush mb-0">
		<?php foreach($down_files as $_u):?>
			<?php
				 $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
				 $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
			 ?>
			 <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="">
            <i class="fa fa-file<?php echo $ext_icon?>-o fa-lg fa-fw"></i>
            <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=mediaset&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>">
                <?php echo $_u['name']?>
            </a>
            <small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small>
            <span title="다운로드 수" data-toggle="tooltip" class="badge badge-light"><?php echo number_format($_u['down'])?></span>
          </div>
			 </li>
		<?php endforeach?>
	</ul>
</div><!-- /.card -->
<?php endif?>

<?php if($attach_audio_num>0):?>
  <h5>오디오 <span class="text-danger"><?php echo $attach_audio_num?></span></h5>
  <?php foreach($audio_files as $_u):?>
  <?php
    $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
    $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
   ?>
  <div class="card">
    <audio controls class="card-img-top mejs-player w-100">
      <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/<?php echo $_u['ext']?>">
    </audio>
    <div class="card-body">
      <h6 class="card-title"><?php echo $_u['name']?></h6>
      <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
    </div><!-- /.card-block -->
  </div><!-- /.card -->
  <?php endforeach?>

<?php endif?>

<?php if($attach_video_num>0):?>
  <h5>비디오 <span class="text-danger"><?php echo $attach_video_num?></span></h5>
  <?php foreach($video_files as $_u):?>
  <?php
     $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
     $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
   ?>
  <div class="card">
    <video width="320" height="240" controls class="card-img-top mejs-player">
      <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="video/<?php echo $_u['ext']?>">
    </video>
    <div class="card-body">
      <h6 class="card-title"><?php echo $_u['name']?></h6>
      <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
    </div><!-- /.card-block -->
  </div><!-- /.card -->
  <?php endforeach?>

<?php endif?>


</div>
<?php endif?>


	<!-- 댓글 인클루드 -->
	<?php if(!$d['bbs']['c_hidden']):?>

    <?php
    // 댓글 일반 사항
    /*
       1) 댓글 저장 테이블 : rb_s_comment
       2) 한줄의견 저장 테이블 : rb_s_oneline
       3) rb_s_comment 의 parent 필드 저장형식 ==> p_modulep_uid
          예를 들어, 게시판 모듈의 uid = 3 인 글의 댓글은 아래와 같이 저장됩니다.
          ====> bbs3
        4) 테마 css 는 테마/css/style.css 이며 댓글박스 가져올때 자동으로 함께 링크를 가져옵니다.
           이 css 를 삭제하면 안되며 필요없는 경우 공백으로 처리하는 방법으로 하시기 바랍니다.
           현재, notify 부분에 대한 css 가 있어서 삭제하면 안됩니다.
    */

    // 댓글 출력 함수
    // 함수 호출 방식으로 하면 모달 호출시에도 적용하기 편합니다.
    /*
       1) module = 부모모듈 : 댓글의 부모 모듈 id ( ex: bbs, post, forum ...)
       2) parent_uid = 부모 uid : 댓글의 부모 포스트 uid
       3) parent_table = 부모 테이블 : p_uid 가 소속된 테이블명 ( ex : rb_bbs_data, rb_blog_data, rb_chanel_data ...)
                 (댓글, 한줄의견 추가/삭제시 합계 업데이트시 필요)
    */
    ?>

    <div class="mt-4">
      <?php getWidget('_default/comment',array('module'=>'bbs','parent_uid' => $uid,'parent_table'=>'rb_bbs_data','theme' => '_desktop/bs4-default'))?>
    </div>



	<?php endif?>

</section>

<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>

<script>
    $('.mejs-player').mediaelementplayer(); // 동영상, 오디오 플레이어 초기화 http://www.mediaelementjs.com/
</script>
