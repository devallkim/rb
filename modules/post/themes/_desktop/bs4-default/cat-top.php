<?php
$CLC=array();
for ($i = 0; $i < $ctnum; $i++) $CLC[] = $ctarr[$i]['name'];
$clcnum=count($CLC);
$CLC['location']='';
for ($_i = 0; $_i < $clcnum; $_i++)
{
    $CLC['location'] .='<li>'.$CLC[$_i].'</li>';
 }
?>

<script>
  // 브라우저 타이틀 지정
  document.title = '<?php echo $C['name'] ?> | <?php echo $_HS['name'] ?>';
</script>

<span class="path-divider text-gray-light">	&gt;</span>
<a class="blog-title" href="<?php echo $g['blog_cat'] ?><?php echo $cat ?>">
  <?php echo $C['name']?>
</a>
