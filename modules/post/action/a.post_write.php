<?php
if(!defined('__KIMS__')) exit;

if (!$set) getLink('','','포스트셋 아이디가 지정되지 않았습니다.','');
$B = getUidData($table[$m.'list'],$set);
if (!$B['uid']) getLink('','','존재하지 않는 포스트셋입니다.','');
if (!$my['uid'] || ($my['uid']!=$B['mbruid'] && !strpos('_,'.$B['members'].',',','.$my['id'].','))) getLink('','','포스트 등록권한이 없습니다.','');
include $g['dir_module'].'var/var.php';
include $g['dir_module'].'var/var.'.$B['id'].'.php';
include_once $g['dir_module'].'lib/tree.func.php';
include_once $g['dir_module'].'lib/action.func.php';
//마크다운 필터링 클래스 세팅
include_once $g['path_core'].'opensrc/markdown-to-html/Michelf/Markdown.inc.php';
use \Michelf\Markdown;
use \Michelf\MarkdownExtra;

//$uid		=
$set		= $B['uid'];
//$gid		=
//$isreserve=
//$isphoto	=
//$isvod	=
//$cutcomment =
$mbruid		= $author ? $author : $my['uid'];
$tag		= trim($tag);
$subject	= $subject?trim($subject):'(제목 없음)';
$review		= trim($review);
$content	= trim($content);
//Markdown parser 로 본문내용 구조화 적용
$content = MarkdownExtra::defaultTransform($content);
$hit		= 0;
$comment	= 0;
$oneline	= 0;

$d_regis	= $date['totime']; // 최초 등록일
if($uid) $d_modify =$date['totime']; // 수정 등록일
else $d_modify=''; // 최초에는 수정일 없음

// 발행요청일  세팅
if($isreserve) $d_publish=$reserved_time.'000';
else $d_publish=$d_regis;

$d_published='';
if(!$use_auth) $d_published=$date['totime']; // 미승인 포스트셋의 경우, 등록(수정)일을 발행일로 한다.

// step 세팅
if(!$published) $step=0; // 임시보관 - 발행요청 전
else{
	if($use_auth) $step=1; // 발행요청 -  승인대기  ==>  승인된 날을 d_published 로 간주한다.
	else {
	   $step=3; // 발행단계
	   if(!$isreserve)  $d_published=$date['totime']; // 예약이 없는 경우에만 d_published 등록한다.
	}
}


$d_comment	= '';
$sns		= '';
// 본문상입 이미지 파일
$upload = $upfiles;
$s_subject	= trim($s_subject);
$s_title	= trim($s_title);
$s_keywords	= trim($s_keywords);
$s_desc		= trim($s_desc);
$s_class	= trim($s_class);
$s_replyto	= trim($s_replyto);
$s_language	= trim($s_language);
$s_build	= trim($s_build);


if ($uid)
{
	$R = getUidData($table[$m.'data'],$uid);
	if (!$R['uid']) getLink('','','존재하지 않는 포스트입니다.','');
	$log = $my[$_HS['nametype']].'|'.getDateFormat($date['totime'],'Y.m.d H:i').'<s>'.$R['log'];
	$d_regis = $isreserve ? $d_regis : $date['totime'];

	$QVAL1 = "isreserve='$isreserve',isphoto='$isphoto',isvod='$isvod',mbruid='$mbruid',cutcomment='$cutcomment',tag='$tag',subject='$subject',review='$review',content='$content',";
	$QVAL1 .="d_modify='$d_modify',upload='$upload',log='$log',published='$published',step='$step',use_auth='$use_auth',d_published='$d_published',featured_img='$featured_img',content_format='$content_format' ";
	$QVAL2 = "subject='$s_subject',title='$s_title',keywords='$s_keywords',description='$s_desc',classification='$s_class',replyto='$s_replyto',language='$s_language',build='$s_build'";
	getDbUpdate($table[$m.'data'],$QVAL1,'uid='.$R['uid']);
	getDbUpdate($table[$m.'seo'],$QVAL2,'parent='.$R['uid']);


	$_orign_category_members = getDbArray($table[$m.'catidx'],'post='.$R['uid'],'*','uid','asc',0,1);
	while($_ocm=db_fetch_array($_orign_category_members))
	{
		if(!strstr($category_members,'['.$_ocm['category'].']'))
		{
			getDbDelete($table[$m.'catidx'],'uid='.$_ocm['uid']);
			if ($R['isreserve'])
			{
				getDbUpdate($table[$m.'category'],'num_reserve=num_reserve-1','uid='.$_ocm['category']);
			}
			else {
				getDbUpdate($table[$m.'category'],'num_open=num_open-1','uid='.$_ocm['category']);
			}
		}
	}

	$_category_members = array();
	$_category_members = getArrayString($category_members);
	foreach($_category_members['data'] as $_ct1)
	{
		$sql = '';
		$_cats = getArrayString(getMenuCodeToSqlBlog1($table[$m.'category'],$_ct1,$B['uid'],''));
		foreach($_cats['data'] as $_ct2)
		{
		    $_ct2_info=getUidData($table[$m.'category'],$_ct2);
			$_ct2_depth=$_ct2_info['depth'];
			if (!getDbRows($table[$m.'catidx'],'post='.$R['uid'].' and category='.$_ct2))
			{
				getDbInsert($table[$m.'catidx'],'blog,post,category,depth',"'".$B['uid']."','".$R['uid']."','".$_ct2."','".$_ct2_depth."'");
				if ($isreserve)
				{
					getDbUpdate($table[$m.'category'],'num_reserve=num_reserve+1','uid='.$_ct2);
				}
				else {
					getDbUpdate($table[$m.'category'],'num_open=num_open+1','uid='.$_ct2);
				}
			}
			else {
				if ($R['isreserve'])
				{
					if (!$isreserve)
					{
						getDbUpdate($table[$m.'category'],'num_open=num_open+1,num_reserve=num_reserve-1','uid='.$_ct2);
					}
				}
				else {
					if ($isreserve)
					{
						getDbUpdate($table[$m.'category'],'num_open=num_open-1,num_reserve=num_reserve+1','uid='.$_ct2);
					}
				}
			}
		}
	}
}
else
{
	//getLink('','',$isreserve,'');
	$mingid = getDbCnt($table[$m.'data'],'min(gid)','');
	$gid = $mingid ? $mingid-1 : 100000000;
	$log = $my[$_HS['nametype']].'|'.getDateFormat($date['totime'],'Y.m.d H:i').'<s>';

	$QKEY1 = "site,blog,gid,isreserve,isphoto,isvod,cutcomment,mbruid,tag,subject,review,content,";
	$QKEY1.= "hit,comment,oneline,d_regis,d_modify,d_comment,sns,upload,log,published,step,use_auth,d_publish,d_published,featured_img,content_format";
	$QVAL1 = "'$s','".$B['uid']."','$gid','$isreserve','$isphoto','$isvod','$cutcomment','$mbruid','$tag','$subject','$review','$content',";
	$QVAL1.= "'0','0','0','$d_regis','','','','$upload','$log','$published','$step','$use_auth','$d_publish','$d_published','$featured_img','$content_format'";
	getDbInsert($table[$m.'data'],$QKEY1,$QVAL1);
	getDbUpdate($table[$m.'list'],"num_w=num_w+1,d_last='".$d_regis."'",'uid='.$B['uid']);
	if(!getDbRows($table[$m.'day'],"date='".$date['today']."' and blog=".$B['uid'])) getDbInsert($table[$m.'day'],'date,blog,num',"'".$date['today']."','".$B['uid']."','1'");
	else getDbUpdate($table[$m.'day'],'num=num+1',"date='".$date['today']."' and blog=".$B['uid']);
	if(!getDbRows($table[$m.'month'],"date='".$date['month']."' and blog=".$B['uid'])) getDbInsert($table[$m.'month'],'year,date,blog,num',"'".$date['year']."','".$date['month']."','".$B['uid']."','1'");
	else getDbUpdate($table[$m.'month'],'num=num+1',"date='".$date['month']."' and blog='".$B['uid']."' ");

	$LASTUID = getDbCnt($table[$m.'data'],'max(uid)','');
	$QKEY2 = "blog,parent,subject,title,keywords,description,classification,replyto,language,build";
	$QVAL2 = "'".$B['uid']."','".$LASTUID."','$s_subject','$s_title','$s_keywords','$s_desc','$s_class','$s_replyto','$s_language','$s_build'";
	getDbInsert($table[$m.'seo'],$QKEY2,$QVAL2);
	getDbUpdate($table[$m.'members'],'num_w=num_w+1','blog='.$B['uid'].' and mbruid='.$my['uid']);


	$_category_members = array();
	$_category_members = getArrayString($category_members);
	foreach($_category_members['data'] as $_ct1)
	{
		$sql = '';
		$_cats = getArrayString(getMenuCodeToSqlBlog1($table[$m.'category'],$_ct1,$B['uid'],''));
		foreach($_cats['data'] as $_ct2)
		{
			$_ct2_info=getUidData($table[$m.'category'],$_ct2);
			$_ct2_depth=$_ct2_info['depth'];
			if (!getDbRows($table[$m.'catidx'],'post='.$LASTUID.' and category='.$_ct2))
			{
				getDbInsert($table[$m.'catidx'],'blog,post,category,depth',"'".$B['uid']."','".$LASTUID."','".$_ct2."','".$_ct2_depth."'");
				if ($isreserve)
				{
					getDbUpdate($table[$m.'category'],'num_reserve=num_reserve+1','uid='.$_ct2);
				}
				else {
					getDbUpdate($table[$m.'category'],'num_open=num_open+1','uid='.$_ct2);
				}
			}
		}
	}

	if ($gid == 100000000)
	{
		db_query("OPTIMIZE TABLE ".$table[$m.'data'],$DB_CONNECT);
		db_query("OPTIMIZE TABLE ".$table[$m.'day'],$DB_CONNECT);
	}
}

$NOWUID = $LASTUID ? $LASTUID : $R['uid'];

// 뉴스 xml 생성 추가 2017.4.4 by kiere
include $g['dir_module'].'action/a.make_postXML.php';

// 업로드 파일에 대한 parent 값 업데이트
if ($upload)
{
	$_updata = getArrayString($upload);
	foreach ($_updata['data'] as $_ups)
	{
		getDbUpdate($table['s_upload'],"parent='".$m.$NOWUID."'",'uid='.$_ups);
	}
}

// 링크 첨부에 대한 parent 값 업데이트
if($attachLink){
	foreach ($attachLink as $val) {
		getDbUpdate($table['s_link'],"module='".$m."',entry='".$NOWUID."' ",'uid='.$val);
	}
}

// 태그 등록 함수 실행 - lib/action.func.php 참조
if ($tag || $R['tag']) RegisPostTag($tag,$R,$m,$B['uid'],$reply,$NOWUID);

if ($snsCallBack && ($sns_t||$sns_f||$sns_m||$sns_y))
{
	$xcync = "[][][][][][r:".$r.",m:".$m.",set:".$B['id'].",uid:".$NOWUID."]";
	$orignSubject = strip_tags($subject);
	$orignContent = getStrCut($orignSubject,60,'..');
	$orignUrl = 'http://'.$_SERVER['SERVER_NAME'].str_replace('./','/',getCyncUrl($xcync)).'#CMT';

	include_once $g['path_module'].$snsCallBack;

	if ($snsSendResult)
	{
		getDbUpdate($table[$m.'data'],"sns='".$snsSendResult."'",'uid='.$LASTUID);
	}
}

// 포스트 승인요청시 알림/메일 전송
if($step==1){
	$_AUTHORS=explode(',',$B['members']);
	$MNG=getDbData($table['s_mbrid'],"id='".trim($_AUTHORS[0])."'",'*');
	$mnguid=$MNG['uid'];
	$SM=getDbData($table['s_mbrdata'],'memberuid='.$mbruid,'*'); // 필자 정보
	$RM=getDbData($table['s_mbrdata'],'memberuid='.$mnguid,'*'); // 메니져 정보
	$mod='req';
	$set_id=$B['id'];
	putPostNotice($SM,$RM,$set_id,$mod);
}

$_SESSION['bbsback'] = $backtype;

$_link=$g['s'].'/?r='.$r.'&m='.$m.'&set='.$B['id'];

if ($backtype == 'list')
{
	if(!$published) getLink($_link.'&mod=post-draft','parent.','','');
	else{
  	getLink($_link.'&mod=post-all','parent.','','');
	}
}
else if ($backtype == 'view')
{
	 getLink($_link.'&front=view&uid='.$NOWUID,'parent.','','');
}
else {

	if ($uid) {
		getLink('reload','parent.','저장 되었습니다.','');
	} else {
		getLink($_link.'&front=my_draft','parent.','저장 되었습니다.','');
	}

}
?>
