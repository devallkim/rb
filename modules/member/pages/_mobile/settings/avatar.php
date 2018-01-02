<?php
$my_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/'.$my['id'].'.jpg';
$sample_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/cover_sample.jpg';
$cover_img=is_file($my_cimg)?$my_cimg:$sample_cimg;

$thumb =  $g['s'].'/_var/avatar/300.'.$my['photo'];
$img_data=array('src'=>$thumb,'width'=>'90','height'=>'90');

 ?>

<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="m" value="<?php echo $m?>" />
<input type="hidden" name="front" value="<?php echo $front?>" />
<input type="hidden" name="a" value="simbol" />


<?php if($my['photo']):?>
	<div class="media">
	  <img class="d-flex mr-3 rounded-circle" src="<?php echo getTimThumb($img_data)?>" alt="<?php echo $my['name']?>" style="width: 64px">
	  <div class="media-body">
			회원님을 알릴 수 있는 사진을 등록해 주세요.<br />
			등록된 사진은 회원님의 채팅대화 또는 게시물과  댓글에 사용됩니다.
			<p><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=simbol_delete" title="<?php echo $my['photo']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?    ');" class="btn btn-link">현재사진 삭제</a></p>
	  </div>
	</div>
	<?php else: ?>
<div class="media">
  <img class="d-flex mr-3 rounded-circle" src="/_var/avatar/180.0.gif" alt="아바타" style="width: 64px">
  <div class="media-body">
		회원님을 알릴 수 있는 사진을 등록해 주세요.<br />
		등록된 사진은 회원님의 채팅대화 또는 게시물과  댓글에 사용됩니다.
  </div>
</div>
<?php endif?>

<hr>

<div class="form-inline">
  <div class="form-group">
    <input type="file" class="form-control-file"  name="upfile">
		 <button type="submit" class="btn btn-primary" role="button">사진등록</button>
    <small class="pl-3 text-muted">
      gif / jpg / png - 50 * 50 픽셀
    </small>
  </div>
</div>



</form>


<script type="text/javascript">


//<![CDATA[
function saveCheck(f)
{
	if (f.upfile.value == '')
	{
		alert('사진파일을 선택해 주세요.');
		f.upfile.focus();
		return false;
	}
	var extarr = f.upfile.value.split('.');
	var filext = extarr[extarr.length-1].toLowerCase();
	var permxt = '[gif][jpg][jpeg][png]';
	if (permxt.indexOf(filext) == -1)
	{
		alert('gif/jpg/png 파일만 등록할 수 있습니다.    ');
		f.upfile.focus();
		return false;
	}
	return confirm('정말로 등록하시겠습니까?       ');
}
//]]>
</script>
