<?php
if(!defined('__KIMS__')) exit;

$data = array();

$Tags=getDbArray($table['s_tag'],"keyword like '%".$q."%'",'keyword,hit','hit','desc','',1);
$tagData = '';
while($R=db_fetch_array($Tags)){
    $tagData .= $R['keyword'].'|'.$R['hit'].',';
}
$data['taglist'] = $tagData;

echo json_encode($data);
exit;
?>
