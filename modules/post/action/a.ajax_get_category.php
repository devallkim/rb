<?php
if(!defined('__KIMS__')) exit;
$blog=$_GET['blog'];
$depth=$_GET['depth'];
$n_depth=$depth+1;
$layer_num=$depth+2;
$uid=$_GET['uid'];
$CT=getUidData($table[$m.'category'],$uid);
?>
[RESULT:
<?php if($CT['isson']):?>
<select name="category[]" id="cat_<?php echo $n_depth?>" class="form-control" onchange="getCate(this.value,<?php echo $n_depth?>,'#cat-wrap-<?php echo $layer_num?>');">
   <?php $C=getDbSelect($table[$m.'category'],'blog='.$blog.' and parent='.$uid.' and depth='.$n_depth,'*')?>
       <option value=""><?php echo $n_depth?>차 카테고리</option>
   <?php while($_C=db_fetch_array($C)):?>
       <option value="<?php echo $_C['uid']?>" ><?php echo $_C['name']?> </option>
    <?php endwhile?>
</select>
<?php endif?>
:RESULT]
<?php exit;?>
	
