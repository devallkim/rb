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
      getDbUpdate($table['s_upload'],$QVAL1,'uid='.$uid);

      $NOWUID=$uid;
}else{
  $QKEY = "gid,pid,parent,hidden,tmpcode,mbruid,fileonly,type,ext,fserver,url,folder,name,tmpname,thumbname,size,width,height,caption,down,d_regis,d_update";
  $QVAL = "'$gid','$gid','$parent','$hidden','$tmpcode','$mbruid','1','$type','$fileExt','$fserver','$url','$folder','$name','$tmpname','$thumbname','$size','$width','$height','$caption','$down','$d_regis','$d_update'";
       getDbInsert($table['s_upload'],$QKEY,$QVAL);
       $NOWUID=getDbCnt($table['s_upload'],'max(uid)','');
}


$R=getUidData($table['s_upload'],$NOWUID);
$result['list']=getAttachLink($R);
$result['table']=$table['s_upload'];
$reuslt['last_uid']=$last_uid;
echo json_encode($result,true);
exit;
?>
