<?php
if(!defined('__KIMS__')) exit;

if (!$_SESSION['upsescode']) $_SESSION['upsescode'] = str_replace('.','',$g['time_start']);
$sescode = $_SESSION['upsescode'];
$sess_Code =$sescode.'_'.$my['uid']; // 코드- 회원 uid

// 업로드 디렉토리 없는 경우 추가
if(!is_dir($saveDir)){
   mkdir($saveDir,0707);
 @chmod($saveDir,0707);
}

include $g['path_module'].'mediaset/themes/'.$theme.'/main.func.php';
include $g['path_module'].'mediaset/themes/'.$theme.'/_var.php';
include $g['path_module'].'mediaset/var/var.php';
include $g['path_core'].'function/thumb.func.php';

$sessArr  = explode('_',$sess_Code);
$tmpcode  = $sessArr[0];
$mbruid   = $sessArr[1];
$fserver  = $d['mediaset']['up_use_fileserver'];
$url    = $fserver ? $d['mediaset']['ftp_urlpath'] : str_replace('.','',$saveDir);
$name   = strtolower($_FILES['files']['name']);
$size   = $_FILES['files']['size'];
$width    = 0;
$height   = 0;
$caption  = trim($caption);
$down   = 0;
$d_regis  = $date['totime'];
$d_update = '';
$fileExt  = getExt($name);
$fileExt  = $fileExt == 'jpeg' ? 'jpg' : $fileExt;
$type   = getFileType($fileExt);
$tmpname  = md5($name).substr($date['totime'],8,14);

if ($type == 2 || $type == 4 || $type == 5 ) {
  $tmpname = $tmpname.'.'.$fileExt;
}

$hidden   = 0;
if ($d['theme']['hidden_photo'] == 1 && $type == 2) {
  $hidden  = 1;
}


if ($d['mediaset']['up_ext_cut'] && strstr($d['mediaset']['up_ext_cut'],$fileExt))
{
 $code='200';
 $msg='정상적인 접근이 아닙니다.';
 $result=array($code,$msg);
 echo json_encode($result);
 exit;
}

$savePath1  = $saveDir.substr($date['today'],0,4);
$savePath2  = $savePath1.'/'.substr($date['today'],4,2);
$savePath3  = $savePath2.'/'.substr($date['today'],6,2);
$folder   = substr($date['today'],0,4).'/'.substr($date['today'],4,2).'/'.substr($date['today'],6,2);
if(isset($_FILES["files"]))
{
       if ($fserver)
      {
            $FTP_CONNECT = ftp_connect($d['mediaset']['ftp_host'],$d['mediaset']['ftp_port']);
            $FTP_CRESULT = ftp_login($FTP_CONNECT,$d['mediaset']['ftp_user'],$d['mediaset']['ftp_pass']);
            if ($d['mediaset']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);
            if (!$FTP_CONNECT) exit;
            if (!$FTP_CRESULT) exit;

            ftp_chdir($FTP_CONNECT,$d['mediaset']['ftp_folder']);

            for ($i = 1; $i < 4; $i++)
            {
                  ftp_mkdir($FTP_CONNECT,$d['mediaset']['ftp_folder'].str_replace('./files/','',${'savePath'.$i}));
            }

            if ($Overwrite == 'true' || !is_file($saveFile))
            {
                  if ($type == 2)
                  {
                       ResizeWidth($_FILES['files']['tmp_name'],$_FILES['files']['tmp_name'],$d['mediaset']['thumbsize']);
                       @chmod($_FILES['files']['tmp_name'],0707);
                       $IM = getimagesize($_FILES['files']['tmp_name']);
                       $width = $IM[0];
                       $height= $IM[1];
                  }
            }
            ftp_put($FTP_CONNECT,$d['mediaset']['ftp_folder'].$folder.'/'.$tmpname,$_FILES['files']['tmp_name'],FTP_BINARY);
            ftp_close($FTP_CONNECT);
      }
      else{

            for ($i = 1; $i < 4; $i++)
            {
                  if (!is_dir(${'savePath'.$i}))
                 {
                       mkdir(${'savePath'.$i},0707);
                       @chmod(${'savePath'.$i},0707);
                 }
            }

            $saveFile = $savePath3.'/'.$tmpname;

            if ($Overwrite == 'true' || !is_file($saveFile))
            {
                move_uploaded_file($_FILES['files']['tmp_name'], $saveFile);
                if ($type == 2)
                {
                  exifRotate($saveFile); //가로세로 교정

                  $IM = getimagesize($saveFile);

                  if ($IM[0] >= $IM[1]) {
                    ResizeWidth($saveFile,$saveFile,$d['mediaset']['thumbsize']);
                  } else {
                    ResizeHeight($saveFile,$saveFile,$d['mediaset']['thumbsize']);
                  }

                  $_IM = getimagesize($saveFile);  // 리사이징된 크기 다시 측정
                  $width = $_IM[0];
                  $height= $_IM[1];
                }
               @chmod($saveFile,0707);
            }

    }
    // DB 저장
    $mingid = getDbCnt($table['s_upload'],'min(gid)','');
    $gid = $mingid ? $mingid - 1 : 100000000;

    $QKEY = "gid,pid,parent,hidden,tmpcode,mbruid,fileonly,type,ext,fserver,url,folder,name,tmpname,thumbname,size,width,height,caption,down,d_regis,d_update";
    $QVAL = "'$gid','$gid','$parent','$hidden','$tmpcode','$mbruid','1','$type','$fileExt','$fserver','$url','$folder','$name','$tmpname','$thumbname','$size','$width','$height','$caption','$down','$d_regis','$d_update'";
    getDbInsert($table['s_upload'],$QKEY,$QVAL);

    if ($gid == 100000000) db_query("OPTIMIZE TABLE ".$table['s_upload'],$DB_CONNECT);

    $lastuid= getDbCnt($table['s_upload'],'max(uid)','');
    $R=getUidData($table['s_upload'],$lastuid);

    $result=array();
    // main.func.php 파일 getAttachFile 함수 참조

    if ($type==4) {
      $preview_default=getAttachFile($R,'upload','',$editor); // 빈값은 대표이미지 uid 이다. (최초 등록시에는 없다.)
      $preview_modal=getAttachFile($R,'modal','');
    } elseif($type==5) {
      $preview_default=getAttachVideo($R,'upload','',$editor); // 빈값은 대표이미지 uid 이다. (최초 등록시에는 없다.)
      $preview_modal=getAttachVideo($R,'modal','');
    } else {
      $preview_default=getAttachFile($R,'upload','',$editor); // 빈값은 대표이미지 uid 이다. (최초 등록시에는 없다.)
      // $preview_modal=getAttachFile($R,'modal','');
    }

    $result['preview_default']=$preview_default;
    $result['preview_modal']=$preview_modal; // 모달 리스트 출력용 (소스복사외 다른 메뉴는 없다.)

    if ($type==2) {
      $result['type']='photo';
    } else if($type==4) {
      $result['type']='audio';
    } else if($type==5) {
      $result['type']='video';
    } else {
      $result['type']='file';
    }

    echo json_encode($result,true);
}
exit;
?>
