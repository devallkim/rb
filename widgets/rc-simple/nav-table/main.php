<?php
$_MENUQ1=getDbData($table['s_menu'],'site='.$s." and id='".$wdgvar['startmenu']."'",'uid');
$_MENUQ2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_MENUQ1['uid'].' and hidden=0 and depth=2 order by gid asc','*');
$_MENUQN=db_num_rows($_MENUQ2)
?>

<div class="nav-table-row">
  <?php $_i=0;while($_M2=db_fetch_array($_MENUQ2)):$_i++?>
  <a  class="nav-table-cell" href="<?php echo RW('c='.$wdgvar['startmenu'].'/'.$_M2['id'])?>" target="<?php echo $_M2['target']?>" role="button">
    <?php echo $_M2['name']?>
  </a>
<?php if(!($_i%$wdgvar['row'])):?></div><div class="nav-table-row"><?php endif?>
<?php endwhile?>

  <?php if(!$_MENUQN):?>
  <div>퀵메뉴가 없습니다.</div>
  <?php endif?>

</div>
