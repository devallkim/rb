<?php
//게시물 링크
function getPostLink($arr)
 {
    return RW('m=bbs&bid='.$arr['bbsid'].'&uid='.$arr['uid'].($GLOBALS['s']!=$arr['site']?'&s='.$arr['site']:''));
 }
 //동기화URL
function getCyncUrl($cync)
{
	if (!$cync) return $GLOBALS['g']['r'];
	$_r = getArrayString($cync);
	$_r = $_r['data'][5];
	if ($GLOBALS['_HS']['rewrite']&&strpos('_'.$_r,'m:bbs,bid:'))
	{
		$_r = str_replace('m:bbs','b',$_r);
		$_r = str_replace(',bid:','/',$_r);
		$_r = str_replace(',uid:','/',$_r);
		$_r = str_replace(',CMT:','/',$_r);
		$_r = str_replace(',s:','/s',$_r);
		return $GLOBALS['g']['r'].'/'.$_r;
	}
	else return $GLOBALS['g']['s'].'/?'.($GLOBALS['_HS']['usescode']?'r='.$GLOBALS['_HS']['id'].'&amp;':'').str_replace(':','=',str_replace(',','&amp;',$_r));
}
$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$levelname= getDbData($table['s_mbrlevel'],'uid='.$my['level'],'*');
$sosokname= getDbData($table['s_mbrgroup'],'uid='.$my['sosok'],'*');
$joinsite = getDbData($table['s_site'],'uid='.$my['site'],'*');
$lastlogdate = -getRemainDate($my['last_log']);
$my_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/'.$my['id'].'.jpg';
$sample_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/cover_sample.jpg';
$cover_img=is_file($my_cimg)?$my_cimg:$sample_cimg;

?>
<div class="panel panel-default cover-container">
	<form name="imgForm" class="form-horizontal" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>">
		<input type="hidden" name="m" value="<?php echo $m?>">
		<input type="hidden" name="a" value="change_mbr_img">
		<input type="hidden" name="img_module_skin" value="<?php echo $g['img_module_skin']?>">
		<input type="file" name="avatar" class="hidden" id="mbr-avatar" onchange="this.form.submit();" accept="image/jpg">
		<input type="file" name="cover" class="hidden" id="mbr-cover" onchange="this.form.submit();" accept="image/jpg">

  	<a href="#" class="profile-thumb">
  	    <img src="<?php echo $g['s']?>/_var/avatar/<?php echo $my['photo']?'180.'.$my['photo']:'180.0.gif'?>" class="img-thumbnail media-object cover-avatar" alt="<?php echo $my['name']?> 프로필 사진">
  	</a>

 </form>
</div>
