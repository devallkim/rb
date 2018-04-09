<?php
if(!defined('__KIMS__')) exit;
include_once $theme.'main.func.php';
$result=array();
$result['error']=false;

$dataArray=json_decode(stripslashes($data),true);

foreach ($dataArray as $key =>$value) {
    $result[$key]=$value;
}
if($result['videoIframe']){
      $format='video';
      $content=$result['videoIframe'];
}
else $format='page';

$d_regis=$date['totime'];
$mbruid=$my['uid'];
$entry=$uid;
$title=addslashes(str_replace('&nbsp;','',$preTitle));
$url=$result['url'];
$description=str_replace('&nbsp;','',$preDescription);
$featured_img=$result['images'];
if($uid){

      $QVAL2 = "title='$preTitle',description='$preDescription' ";
      getDbUpdate($table['s_link'],$QVAL1,'uid='.$uid);

      $NOWUID=$uid;
}else{
       $QKEY="hidden,mbruid,module,entry,featured_img,format,title,description,content,url,d_regis";
       $QVAL="'$hidden','$mbruid','$module','$entry','$featured_img','$format','$title','$description','$content','$url','$d_regis'";
       getDbInsert($table['s_link'],$QKEY,$QVAL);
       $NOWUID=getDbCnt($table['s_link'],'max(uid)','');
}


$R=getUidData($table['s_link'],$NOWUID);
$result['list']=getAttachLink($R);
$result['table']=$table['s_link'];
$reuslt['last_uid']=$last_uid;
echo json_encode($result,true);
exit;
?>
