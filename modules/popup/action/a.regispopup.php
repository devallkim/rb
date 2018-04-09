<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$term1 = $year1.$month1.$day1.$hour1.$min1.'00';
$term2 = $year2.$month2.$day2.$hour2.$min2.'00';
$name = trim(strip_tags($name));

if ($uid) {
	$QVAL = "hidden='".$hidden."',term0='".$term0."',term1='".$term1."',term2='".$term2."',name='".$name."',content='".$source."',html='".$html."',upload='".$upload."',center='".$center."',";
	$QVAL.= "ptop='".$ptop."',pleft='".$pleft."',width='".$width."',height='".$height."',scroll='".$scroll."',type='".$type."',dispage='".$dispage."',theme='".$theme."'";

	getDbUpdate($table['s_popup'],$QVAL,'uid='.$uid);
	setrawcookie('result_popup_main', rawurlencode('팝업내용이 수정되었습니다.|success'));  // 처리여부 cookie 저장
	getLink('reload','parent.','','');

} else {

	$QKEY = "hidden,term0,term1,term2,name,content,html,upload,center,ptop,pleft,width,height,scroll,type,dispage,theme";
	$QVAL = "'$hidden','$term0','$term1','$term2','$name','$source','$html','$upload','$center','$ptop','$pleft','$width','$height','$scroll','$type','$dispage','$theme'";

	getDbInsert($table['s_popup'],$QKEY,$QVAL);
	$lastpopup = getDbCnt($table['s_popup'],'max(uid)','');

	setrawcookie('result_popup_main', rawurlencode('팝업이 신규 생성되었습니다.|success'));  // 처리여부 cookie 저장
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&uid='.$lastpopup,'parent.','','');
}
?>
