
<?php
if($front=='write') $checkbox = true;

// _box_que 는 main.php 에서 지정
$all_num=getDbRows($table[$m.'data'],$all_box_que);
$draft_num=getDbRows($table[$m.'data'],$draft_box_que);
$auth_num=getDbRows($table[$m.'data'],$req_box_que);

?>
<link href="<?php echo $g['url_module_skin']?>/_main.css" rel="stylesheet">
<!-- 문서 타이틀  -->
<script>

<?php if ($uid): ?>
  document.title = '<?php echo $R['subject'] ?>|<?php echo $_HS['name'] ?>';
<?php endif; ?>

</script>

<?php include $g['dir_module_mode'].'.php';?>
