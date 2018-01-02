<?php
//게시물 링크
function getPostLink($arr)
 {
    return RW('m=blog&blog='.$arr['BLOGID'].'&uid='.$arr['uid'].($GLOBALS['s']!=$arr['site']?'&s='.$arr['site']:''));
 }
 //동기화URL
function getCyncUrl($cync)
{
	if (!$cync) return $GLOBALS['g']['r'];
	$_r = getArrayString($cync);
	$_r = $_r['data'][5];
	if ($GLOBALS['_HS']['rewrite']&&strpos('_'.$_r,'m:blog,bid:'))
	{
		$_r = str_replace('m:blog','blog',$_r);
		$_r = str_replace(',bid:','/',$_r);
		$_r = str_replace(',uid:','/',$_r);
		$_r = str_replace(',CMT:','/',$_r);
		$_r = str_replace(',s:','/s',$_r);
		return $GLOBALS['g']['r'].'/'.$_r;
	}
	else return $GLOBALS['g']['s'].'/?'.($GLOBALS['_HS']['usescode']?'r='.$GLOBALS['_HS']['id'].'&amp;':'').str_replace(':','=',str_replace(',','&amp;',$_r));
}

$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$levelname= getDbData($table['s_mbrlevel'],'uid='.$_mbr['level'],'*');
$sosokname= getDbData($table['s_mbrgroup'],'uid='.$_mbr['sosok'],'*');
$joinsite = getDbData($table['s_site'],'uid='.$_mbr['site'],'*');
$lastlogdate = -getRemainDate($_mbr['last_log']);
$my_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/'.$_mbr['id'].'.jpg';
$sample_cimg=$g['path_module'].$m.'/pages/mypage/image/cover/cover_sample.jpg';
$cover_img=is_file($my_cimg)?$my_cimg:$sample_cimg;

?>

<div class="media content-padded">
  <span class="media-left">
    <img class="media-object" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_mbr['photo']?'180.'.$_mbr['photo']:'180.0.gif'?>" alt="" style="width: 48px">
  </span>
  <div class="media-body">
    <h5 class="media-heading"><?php echo $_mbr['name']?$_mbr['name']:'회원명'?> 기자</h5>
    <?php echo $_mbr['email']?>
  </div>
</div>


<div class="media my-4 km-cover hidden">
  <img src="<?php echo $g['s']?>/_var/avatar/<?php echo $_mbr['photo']?'180.'.$_mbr['photo']:'180.0.gif'?>" class="rounded-circle d-flex mr-4 cover-avatar" alt="<?php echo $_mbr['name']?> 프로필 사진">
	<div class="media-body">
		<h3 class="mt-3"><?php echo $_mbr['name']?$_mbr['name']:'회원명'?> 기자 </h3>
    <?php echo $_mbr['email']?>

    <?php $sns=explode('|',$_mbr['home'])?>
    <ul class="list-inline mt-2">
      <?php if($sns[0]):?>
      <li class="list-inline-item">
        <a href="<?php echo $sns[0]?>" target="_blank">
          <img src="/modules/member/pages/settings/image/share-facebook.png" alt="" class="rounded-circle"  data-toggle="tooltip" title="페이스북">
        </a>
      </li>
      <?php endif?>
      <?php if($sns[1]):?>
      <li class="list-inline-item">
        <a href="<?php echo $sns[1]?>" target="_blank">
          <img src="/modules/member/pages/settings/image/share-kakaostory.png" alt="" class="rounded-circle"  data-toggle="tooltip" title="카카오스토리">
        </a>
      </li>
      <?php endif?>
      <?php if($sns[2]):?>
      <li class="list-inline-item">
        <a href="<?php echo $sns[2]?>" target="_blank">
          <img src="/modules/member/pages/settings/image/share-naver.png" alt="" class="rounded-circle"  data-toggle="tooltip" title="네이버블로그">
        </a>
      </li>
      <?php endif?>
      <?php if($sns[3]):?>
      <li class="list-inline-item">
        <a href="<?php echo $sns[3]?>" target="_blank">
          <img src="/modules/member/pages/settings/image/share-twitter.png" alt="" class="rounded-circle"  data-toggle="tooltip" title="트위터">
        </a>
      </li>
      <?php endif?>
      <?php if($sns[4]):?>
      <li class="list-inline-item">
        <a href="<?php echo $sns[4]?>" target="_blank">
          <img src="/modules/member/pages/settings/image/share-youtube.png" alt="" class="rounded-circle"  data-toggle="tooltip" title="유튜브">
        </a>
      </li>
      <?php endif?>
    </ul>

	</div>
</div>

<hr>
