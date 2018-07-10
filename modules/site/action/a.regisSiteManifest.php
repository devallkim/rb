<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$tmpname	= $_FILES['site_manifest_icon']['tmp_name'];
$realname	= $_FILES['site_manifest_icon']['name'];

if (is_uploaded_file($tmpname)) {
  $fileExt	= strtolower(getExt($realname));
  $fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
  $iconsURL = $g['s'].'/_core/images/touch/';
  $fileName	= 'homescreen.'.$fileExt;
  $iconsURL = $g['s'].'/_var/site/'.$r.'/';
  $saveFile	= $g['path_var'].'site/'.$r.'/'.$fileName;

  if (!strstr('[gif][jpg][png]',$fileExt)) {
    continue;
  }

  move_uploaded_file($tmpname,$saveFile);
  @chmod($saveFile,0707);

} else {
  if (!$tmpname && $site_manifest_icon_del) {
    unlink( $g['path_var'].'site/'.$r.'/homescreen.jpg');
    unlink( $g['path_var'].'site/'.$r.'/homescreen.png');
    unlink( $g['path_var'].'site/'.$r.'/homescreen.gif');
    $iconsURL = $g['s'].'/_core/images/touch/';
    $fileExt = 'png';
  }
}

//사이트별 매니페스트
$g['manifestForSite'] = $g['path_var'].'site/'.$r.'/manifest.json'; // 사이트 회원모듈 변수파일
$_manifestfile = $g['manifestForSite'] ? $g['manifestForSite'] : $g['path_module'].'site/var/manifest.json';

include $_manifestfile;
$fp = fopen($_manifestfile,'w');

$icons = array(
          array('src'=>$iconsURL.'homescreen-96x96.'.$fileExt,'sizes'=>'96x96','type'=>'image/'.$fileExt),
          array('src'=>$iconsURL.'homescreen-128x128.'.$fileExt,'sizes'=>'128x128','type'=>'image/'.$fileExt),
          array('src'=>$iconsURL.'homescreen-144x144.'.$fileExt,'sizes'=>'144x144','type'=>'image/'.$fileExt),
          array('src'=>$iconsURL.'homescreen-168x168.'.$fileExt,'sizes'=>'168x168','type'=>'image/'.$fileExt),
          array('src'=>$iconsURL.'homescreen-192x192.'.$fileExt,'sizes'=>'192x192','type'=>'image/'.$fileExt)
        );

$myObj->name = $site_manifest_name;
$myObj->short_name = $site_manifest_short_name;
$myObj->icons = $icons;
$myObj->start_url = '/';
$myObj->display = $site_manifest_display;
$myObj->background_color = $site_manifest_background_color;
$myObj->theme_color = $site_manifest_theme_color;
$myObj->display = $site_manifest_display;
if ($site_manifest_orientation) $myObj->orientation = $site_manifest_orientation;
$myObj->gcm_sender_id = '103953800507';  //FCM 자바스크립트 클라이언트에 공통되는 고정된 값입니다.

$manifestJSON = json_encode($myObj,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
$_manifestJSON = str_replace("\/", "/", $manifestJSON);
fwrite($fp, $_manifestJSON );

fclose($fp);
@chmod($_tmpdfile,0707);

getLink('reload','parent.frames._ADMPNL_.','변경되었습니다.','');
?>
