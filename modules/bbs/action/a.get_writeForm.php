<?php
// 파라미터 세팅
$theme=$_GET['theme']; // 게시판 테마
$bid=$_GET['bid']; // 게시판 아이디

// json 리턴
include $g['dir_module'].'theme/_mobile/'.$theme.'/write.php';
exit;

?>
