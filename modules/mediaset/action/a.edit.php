<?php
if(!defined('__KIMS__')) exit;

$result=array();
$result['error']=false;

// 보이기 숨기기
if($act=='showhide'){
    if($showhide=='show') getDbUpdate($table['s_upload'],'hidden=0','uid='.$uid);
    else getDbUpdate($table['s_upload'],'hidden=1','uid='.$uid);

}else if($act=='insert'){
    getDbUpdate($table['s_upload'],'hidden=1','uid='.$uid);

}else if($act=='save-photo'||$act=='save-file'||$act=='save'){
    $name=$filename.'.'.$fileext;
    $name=trim($name);
    $filecaption=trim($filecaption);

    $QVAL="name='$name',caption='$filecaption'";
    getDbUpdate($table['s_upload'],$QVAL,'uid='.$uid);

    $result['filename']=$filename;
    $result['fileext']=$fileext;
    $result['filetype']=$filetype;
    $result['filecaption']=$filecaption;
    $result['filesrc']=$filesrc;
}else if($act=='editYoutube'){

    $videoCaption=trim($videoCaption);
    $videoDescription=trim($videoDescription);
    $videoTime=trim($videoTime);

    $QVAL="caption='$videoCaption',description='$videoDescription',time='$videoTime'";
    getDbUpdate($table['s_upload'],$QVAL,'uid='.$uid);

    $result['videoType']=$videoType;
    $result['videoSrc']=$videoSrc;
    $result['videoCaption']=$videoCaption;
    $result['videoDescription']=$videoDescription;
    $result['videoTime']=$videoTime;
}
echo json_encode($result,true);

exit;
?>
