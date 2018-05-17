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

<?php if($attach_youtube_num>0):?>
<?php foreach($youtube_files as $_u):?>
 <video class="mejs-player mb-4" style="max-width:100%;" preload="none">
     <source src="https://www.youtube.com/embed/<?php echo $_u['name']?>" type="video/youtube">
 </video>
<?php endforeach?>
<?php endif?>

<?php if($attach_photo_num>0):?>
<div class="content-padded">
  <h5>사진 <span class="text-danger"><?php echo $attach_photo_num?></span></h5>
  <div class="list-inline mb-3" data-plugin="photoswipe">
  <?php foreach($img_files as $_u):?>

  <?php
    $img_origin=$_u['url'].$_u['folder'].'/'.$_u['tmpname'];
    $thumb_list=getPreviewResize($img_origin,'q'); // 미리보기 사이즈 조정
    $thumb_modal=getPreviewResize($img_origin,'c'); // 정보수정 모달용  사이즈 조정
    $img_origin_size=$_u['width'].'x'.$_u['height'];
  ?>
    <figure class="figure ">
      <a href="<?php echo $thumb_modal ?>" data-size="<?php echo $img_origin_size ?>">
        <img src="<?php echo $thumb_list ?>" alt="" width="75">
      </a>
      <figcaption class="figure-caption" hidden><?php echo $_u['name'] ?></figcaption>
    </figure>
  <?php endforeach?>
  </div>
</div>
<?php endif?>

<?php if($attach_down_num>0):?>
<ul class="table-view">
  <li class="table-view-cell table-view-divider">
    첨부파일 <small class="pl-2"><?php echo $attach_down_num ?></small>
  </li>
  <?php foreach($down_files as $_u):?>
    <?php
       $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
       $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
     ?>
     <li class="table-view-cell">
       <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=mediaset&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>">
        <i class="media-object pull-left pt-1 fa fa-file<?php echo $ext_icon?>-o fa-lg fa-fw"></i>
        <div class="media-body">
        <?php echo $_u['name']?>
        <span class="badge badge-default badge-inverted ml-2"><?php echo getSizeFormat($_u['size'],1)?></span>
        </div>
        <span class="badge badge-default badge-outline"><i class="fa fa-download" aria-hidden="true"></i> <?php echo number_format($_u['down'])?></span>
        </a>
     </li>
  <?php endforeach?>
</ul>
<?php endif?>

<?php if($attach_audio_num>0):?>
<h5 class="content-padded">오디오 <span class="text-danger"><?php echo $attach_audio_num?></span></h5>
<?php foreach($audio_files as $_u):?>
<?php
  $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
  $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
 ?>
<div class="card">
  <audio controls data-plugin="mediaelement" class="card-img-top img-fluid">
    <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/mp3">
  </audio>
  <div class="card-block">
    <h6 class="card-title"><?php echo $_u['name']?></h6>
    <p class="card-text mb-0"><span class="badge badge-default badge-inverted"><?php echo getSizeFormat($_u['size'],1)?></span></p>
  </div><!-- /.card-block -->
</div><!-- /.card -->
<?php endforeach?>

<?php endif?>

<?php if($attach_video_num>0):?>
<h5 class="content-padded">비디오 <span class="text-danger"><?php echo $attach_video_num?></span></h5>
<?php foreach($video_files as $_u):?>
<div class="card">
  <video  controls data-plugin="mediaelement" class="card-img-top" style="max-width:100%;" preload="none">
    <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="video/<?php echo $_u['ext']?>">
  </video>
  <div class="card-block">
    <h6 class="card-title"><?php echo $_u['name']?></h6>
    <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
  </div><!-- /.card-block -->
</div><!-- /.card -->
<?php endforeach?>

<?php endif?>

<?php endif; ?>
