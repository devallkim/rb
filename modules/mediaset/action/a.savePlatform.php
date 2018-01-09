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

$name= $result['title'];
$src=$result['src'];
$thumbname=$result['thumb'];
$type = 8;

if($type = 8){
  $url = 'https://youtu.be';
}

if($uid){

      $QVAL1 = "caption='$caption',description='$description' ";
      getDbUpdate($table['s_upload'],$QVAL1,'uid='.$uid);

      $NOWUID=$uid;
}else{


  $QKEY = "gid,pid,parent,hidden,tmpcode,mbruid,fileonly,type,ext,fserver,url,folder,name,tmpname,thumbname,size,width,height,caption,src,down,d_regis,d_update";
  $QVAL = "'$gid','$gid','$parent','$hidden','$tmpcode','$mbruid','0','$type','$fileExt','$fserver','$url','$folder','$name','$tmpname','$thumbname','$size','$width','$height','$caption','$src','$down','$d_regis','$d_update'";
       getDbInsert($table['s_upload'],$QKEY,$QVAL);
       $NOWUID=getDbCnt($table['s_upload'],'max(uid)','');
}


$R=getUidData($table['s_upload'],$NOWUID);
$result['list']=getAttachPlatform($R);
$result['table']=$table['s_upload'];
$reuslt['last_uid']=$last_uid;
echo json_encode($result,true);
exit;
?>
