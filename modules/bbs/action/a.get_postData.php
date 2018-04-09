<?php
if(!defined('__KIMS__')) exit;

require_once $g['path_core'].'function/sys.class.php';
include_once $g['dir_module'].'lib/action.func.php';

include_once $g['dir_module'].'var/var.'.$bid.'.php';
include_once $g['dir_module'].'themes/'.$theme.'/_var.php';

$result=array();
$result['error']=false;

$uid = $_POST['uid'];

$R = getUidData($table['bbsdata'],$uid);
$B = getUidData($table['bbslist'],$R['bbs']);

$mbruid = $my['uid'];

$check_like_qry    = "mbruid='".$mbruid."' and module='".$m."' and entry='".$uid."' and opinion='like'";
$check_dislike_qry = "mbruid='".$mbruid."' and module='".$m."' and entry='".$uid."' and opinion='dislike'";
$check_saved_qry   = "mbruid='".$mbruid."' and module='".$m."' and entry='".$uid."'";

$is_liked    = getDbRows($table['s_opinion'],$check_like_qry);
$is_disliked = getDbRows($table['s_opinion'],$check_dislike_qry);
$is_saved    = getDbRows($table['s_saved'],$check_saved_qry);

$TMPL['s']=$rooturl;
$TMPL['r']=$raccount;
$TMPL['m']=$m;
$TMPL['bid']=$B['id'];
$TMPL['uid']=$uid;
$TMPL['subject'] = $R['subject'];
$TMPL['article'] = getContents($R['content'],$R['html']);
$TMPL['date'] = getDateFormat($R['d_regis'],'Y.m.d');
$TMPL['avatar'] = getAavatarSrc($R['mbruid'],'84');
$TMPL['name'] = $R[$_HS['nametype']];
$TMPL['comment'] = $R['comment'];
$TMPL['hit'] = $R['hit'];
$TMPL['likes'] = $R['likes'];
$TMPL['dislikes'] = $R['dislikes'];
$TMPL['tag'] = getPostTag($R['tag'],$bid);
$result['total_comment'] = $R['comment'];  // 댓글,한줄의견 등록시 현재댓글수를 내려주기 위함

if ($is_liked) $result['is_liked'] = 1;
if ($is_disliked) $result['is_disliked'] = 1;
if ($is_saved) $result['is_saved'] = 1;
if ($R['tag']) $result['is_tag'] = 1;

if($R['upload']) {

  if ($AttachListType == 'object') {
    $result['photo'] = getAttachObjectArray($R,'photo');
  } else {
    $result['attachNum'] = getAttachNum($R['upload'],'view');
    $result['file'] = getAttachFileList($R,'view','file');
    $result['photo'] = getAttachFileList($R,'view','photo');
    $result['video'] = getAttachFileList($R,'view','video');
    $result['audio'] = getAttachFileList($R,'view','audio');
    $result['doc'] = getAttachFileList($R,'view','doc');
    $result['zip'] = getAttachFileList($R,'view','zip');
    $result['youtube'] = getAttachPlatformList($R,'view','default');
  }
}

if($my['admin'] || $my['uid']==$R['mbruid']) {  // 수정,삭제 버튼 출력여부를 위한 참조
  $result['mypost'] = 1;
}

// 테마설정
$result['theme_use_reply'] = $d['theme']['use_reply'];
$result['theme_show_tag'] = $d['theme']['show_tag'];
$result['theme_show_upfile'] = $d['theme']['show_upfile'] ;
$result['theme_show_like'] = $d['theme']['show_like'];
$result['theme_show_dislike'] = $d['theme']['show_dislike'];
$result['theme_snsping'] = $d['theme']['snsping'];

$markup_file = 'view'; // 기본 마크업 페이지 전달 (테마 내부 _html/view.html)

if ($R['hidden']) {  // 비밀글의 경우
  if ($my['uid'] != $R['mbruid'] && $my['uid'] != $R['pw'] && !$my['admin']) {
    $markup_file = 'lock'; //잠김페이지 전달 (테마 내부 _html/lock.html)
    $result['hidden'] = 1;
  }
}

$d['bbs']['isperm'] = true;

if ($d['bbs']['isperm'] && ($d['bbs']['hitcount'] || !strpos('_'.$_SESSION['module_'.$m.'_view'],'['.$uid.']')))
{
	if ($R['point2'])
	{
		// $g['main'] = $g['dir_module'].'mod/_pointcheck.php';
    $markup_file = 'pointcheck';
		$d['bbs']['isperm'] = false;
	}
	else {
		getDbUpdate($table[$m.'data'],'hit=hit+1','uid='.$uid);
		$_SESSION['module_'.$m.'_view'] .= '['.$uid.']';
	}
}

// 최종 결과값 추출 (sys.class.php)
$skin=new skin($markup_file);
$result['article']=$skin->make();

echo json_encode($result);
exit;
?>
