<?php
function getPostLink($arr){
	return RW('m=bbs&bid='.$arr['bbsid'].'&uid='.$arr['uid'].($GLOBALS['s']!=$arr['site']?'&s='.$arr['site']:''));
}
//동기화URL
function getSyncUrl($sync){
	if (!$sync) return $GLOBALS['g']['r'];
	$_r = getArrayString($sync);
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

?>

<div class="user-profile-nav">
  <nav class="nav underline-nav">
    <a class="nav-link f16<?php if ($page=='main'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>">요약</a>
    <a class="nav-link f16<?php if ($page=='bbs'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>?page=bbs">
      게시물
    </a>
    <a class="nav-link f16<?php if ($page=='comment'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>?page=comment">
      댓글
    </a>
    <a class="nav-link f16<?php if ($page=='oneline'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>?page=oneline">
      한줄의견
    </a>
    <a class="nav-link f16<?php if ($page=='follower'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>?page=follower">
      팔로워
      <span class="badge badge-pill badge-light"> <?php echo getDbRows($table['s_friend'],'by_mbruid='.$_MP['uid'])?></span>
    </a>
    <a class="nav-link f16<?php if ($page=='following'): ?> active<?php endif; ?>" href="/@<?php echo $mbrid ?>?page=following">
      팔로잉
      <span class="badge badge-pill badge-light"> <?php echo getDbRows($table['s_friend'],'my_mbruid='.$_MP['uid'])?></span>
    </a>

  </nav>
</div>
