<?php 
if(!defined('__KIMS__')) exit;
$sort = $_GET['sort']; // 정렬 기준 
$orderby = $_GET['orderby']; // 정렬순서 
$recnum = $_GET['recnum']; // 출력갯수 
$page = $_GET['page']; // 처음엔 무조건 1 
$_where = 'uid>0'; // 출력 조건 : 이 부분은 해당 위젯과 맞춰준다. 만약 동적으로 변경되야 하면 파라미터로 넘겨줘야 하다. 

$result=array();
$result['error'] = false;

$RCD = getDbArray($table['bbsdata'],$_where,'*',$sort,$orderby,$recnum,$page);
$NUM = getDbRows($table['bbsdata'],$_where); 
$html='';
while($R = db_fetch_array($RCD)){
   $html.='<li>'.$R['subject'].'-'.$R['uid'].'</li>';
}
$result['content'] = $html;
echo json_encode($result);
exit;
?>