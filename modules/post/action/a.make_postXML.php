<?php
if(!defined('__KIMS__')) exit;
// a.post_write.php 에서 include 된 파일이므로 해당 페이지의 변수값을 참조한다.
$LR = getUidData($table[$m.'data'],$NOWUID);// $NOWUID 는 a.post_write.php 에서 넘어온 값

// 기자 정보
$LM = getDbData($table['s_mbrdata'],'memberuid='.$LR['mbruid'],'name,nic');
$w_name = $LM['name']; // 기자명
$w_email = $LM['email']; // 기자 이메일

// 저장 directory 지정
$saveDir = $g['path_var'].'xml/news/'.$NOWUID.'/';

// 다음기사 채널명 추출 --------------------------------------------------------------------------------
$CI = getDbData($table[$m.'catidx'],'post='.$NOWUID,'category');
$CT = getDbData($table[$m.'category'],'uid='.$CI['category'],'daum_cat');
$daum_cat = $CT['daum_cat']; // 다음기사 채널명

// xml 생성날짜 : 수정한 경우는 수정한 날짜로 지정
// view.php 에서는 d_modify 값이 있는지 체크하여 xml 값을 지정한다.
$last_xml_date = $d_modify?$d_modify:$d_regis;

// 대표 이미지 추출
if($LR['featured_img']){
   $FI=getUidData($table['s_upload'],$LR['featured_img']);
   $featured_img=getDynamicResizeImg($FI['tmpname'],'q'); // 동적 사이즈 조정
   $article_img =$g['url_host'].$FI['url'].$FI['folder'].'/'.$featured_img;
}

// 원문주소
$blog_view = $g['blog_view']?$g['blog_view']:$g['s'].'/?r='.$r.'&m=blog&blog='.$LR['blog'].'&uid=';
$article_url = $g['url_host'].'/?r='.$r.'&m=blog&blog='.$LR['blog'].'&uid='.$LR['uid'];

// 다음송고채널이 있는 경우에만 생성
if($daum_cat){

	// 업로드 디렉토리 없는 경우 추가
	if(!is_dir($saveDir)){
	   mkdir($saveDir,0707);
		@chmod($saveDir,0707);
	}

	$filename = 'news_'.$last_xml_date.'.xml'; //
	$filepath = $saveDir.$filename;

	$fp = fopen($filepath,'w');
	$xml="";
	$xml.="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	$xml.="<!DOCTYPE NEWS PUBLIC \"-//view.daum.net//DTD NewsML 1.1//EN\" \"http://cp.news.search.daum.net/resources/dtd/newsxml-1.1.dtd\">\n";
	$xml.="	<NEWS ver=\"1.0\" orgid =\"102269\" act=\"C\">\n";
	$xml.="		<DATETIME>".$last_xml_date."</DATETIME>\n";
	$xml.="		<WRITER_LIST>\n";
	$xml.="			<WRITER>\n";
	$xml.="				 <NAME><![CDATA[".$w_name."]]></NAME>\n";
	$xml.="				<EMAIL>".$w_email."</EMAIL>\n";
	$xml.="			</WRITER>\n";
	$xml.="		</WRITER_LIST>\n";
	$xml.="		<CATEGORY_LIST>\n";
	$xml.="			 <CODE>".$daum_cat."</CODE>\n";
	$xml.="		</CATEGORY_LIST>\n";
	$xml.="		<TITLE><![CDATA[".$LR['subject']."]]></TITLE>\n";
	$xml.="		<SUB_TITLE><![CDATA[".($LR['review']?$LR['review']:getStrCut($LR['content'],200,'...'))."]]></SUB_TITLE>\n";
	$xml.="		<TEXT><![CDATA[".$LR['content']."]]></TEXT>\n";
if($LR['featured_img']){
    $xml.="		<IMG_LIST>\n";
    $xml.="			<IMG>\n";
	$xml.="				<URL>\n";
	$xml.="				<![CDATA[".$article_img."]]>\n";
	$xml.="				</URL>\n";
	$xml.="			</IMG>\n";
	$xml.="		</IMG_LIST>\n";
}
	$xml.="     <EXT>\n";
	$xml.="	        <OUTLINK><![CDATA[".$article_url."]]></OUTLINK>\n";
	$xml.="	        <COPYRIGHT><![CDATA[저작권자 ⓒ 경기방송(www.kfm.co.kr). 무단전재 및 재배포 금지]]></COPYRIGHT>\n";
	$xml.="    </EXT>\n";
	$xml.="	</NEWS>\n";


	fwrite($fp,$xml);
	fclose($fp);
	@chmod($filepath,0707);

	// $filesize = filesize($filepath);

	// header("Content-Type: application/octet-stream");
	// header("Content-Length: " .$filesize);
	// header('Content-Disposition: attachment; filename="'.$filename.'"');
	// header("Cache-Control: private, must-revalidate");
	// header("Pragma: no-cache");
	// header("Expires: 0");
	// header("Content-Type: application/xml");

	$fp = fopen($filepath, 'rb');
	if (!fpassthru($fp)) fclose($fp);
}

?>
