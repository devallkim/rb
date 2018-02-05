<?php
if(!defined('__KIMS__')) exit;
require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';
include_once $g['dir_module'].'mod/_view.php';

$result=array();
$result['error']=false;

$uid = $_POST['uid'];

$R = getUidData($table['bbsdata'],$uid);
$B = getUidData($table['bbslist'],$R['bbs']);

$TMPL['s']=$rooturl;
$TMPL['r']=$raccount;
$TMPL['m']=$m;
$TMPL['bid']=$B['id'];
$TMPL['uid']=$uid;
$TMPL['article'] = getContents($R['content'],$R['html']);
$TMPL['date'] = getDateFormat($R['d_regis'],'Y.m.d');
$TMPL['avatar'] = getAavatarSrc($R['mbruid'],'84');
$TMPL['name'] = $R[$_HS['nametype']];
$TMPL['comment'] = $R['comment'];
$TMPL['hit'] = $R['hit'];
$TMPL['like'] = $R['score1'];
$TMPL['tag'] = getPostTag($R['tag']);
$result['total_comment'] = $R['comment'];  // 댓글,한줄의견 등록시 현재댓글수를 내려주기 위함

if($R['upload']) {
  $result['attachNum'] = getAttachNum($R['upload'],'view');
  $result['file'] = getAttachFileList($R,'view','file');
  $result['photo'] = getAttachFileList($R,'view','photo');
  $result['video'] = getAttachFileList($R,'view','video');
  $result['audio'] = getAttachFileList($R,'view','audio');
  $result['doc'] = getAttachFileList($R,'view','doc');
  $result['zip'] = getAttachFileList($R,'view','zip');
  $result['youtube'] = getAttachPlatformList($R,'view','default');
}

if($my['admin'] || $my['uid']==$R['mbruid']) {  // 수정,삭제 버튼 출력여부를 위한 참조
  $result['mypost'] = 1;
}

$markup_file = 'view'; // 기본 마크업 페이지 전달 (테마 내부 _html/view.html)

if ($R['hidden']) {  // 비밀글의 경우
  if ($my['uid'] != $R['mbruid'] && $my['uid'] != $R['pw'] && !$my['admin']) {
    $markup_file = 'lock'; //잠김페이지 전달 (테마 내부 _html/lock.html)
    $result['hidden'] = 1;
  }
} else {
  //게시물 조회수 증가 처리
  getDbUpdate($table['bbsdata'],'hit=hit+1','uid='.$uid);
}

// 최종 결과값 추출 (sys.class.php)
$skin=new skin($markup_file);
$result['article']=$skin->make();

echo json_encode($result);
exit;
?>
