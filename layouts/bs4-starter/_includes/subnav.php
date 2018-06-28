dfdf

<?php if($d['layout']['dsp_side_menu']):?>
<?php if($d['layout']['dsp_topmenu']):?>

<?php $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.(int)$g['nowFMemnu'].' and hidden=0 and depth=2 order by gid asc','*')?>
<?php $_MENUSN=db_num_rows($_MENUS2)?>
<?php if($_MENUN || (!$d['layout']['dsp_side_menuhide']&&$_CA[0])):?>
<ul class="submenu">
<?php $_i=0;while($_M2=db_fetch_array($_MENUS2)):$_i++?>
<li class="<?php if($_M2['id']==$_CA[0]):$g['nowSMemnu']=$_M2['uid']?>open<?php endif?><?php if($_MENUSN==$_i):?> _last<?php endif?>"><a href="<?php echo RW('c='.$_CA[0].'/'.$_M2['id'])?>" target="<?php echo $_M2['target']?>"<?php if($_M2['id']==$_CA[1]):?> class="on"<?php endif?>><?php echo $_M2['name']?></a>
<?php if(($_HM['uid']==$_M2['uid']||$_HM['parent']==$_M2['uid'])&&$_M2['isson']):?>
<ul>
<?php $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and hidden=0 and depth=3 order by gid asc','*')?>
<?php while($_M3=db_fetch_array($_MENUS3)):?>
<li><a href="<?php echo RW('c='.$_CA[0].'/'.$_CA[1].'/'.$_M3['id'])?>" target="<?php echo $_M3['target']?>"<?php if($_M3['uid']==$_HM['uid']):?> class="on"<?php endif?>><?php echo $_M3['name']?></a></li>
<?php endwhile?>
</ul>
<?php endif?>
</li>
<?php endwhile?>
<?php if(!$_MENUSN):?>
<li class="_last none">서브메뉴가 없습니다.</li>
<?php endif?>
</ul>
<?php endif?>
<?php else:?>

<?php $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 order by gid asc','*')?>
<?php $_MENUSN=db_num_rows($_MENUS2)?>
<ul class="submenu">
<?php $_i=0;while($_M2=db_fetch_array($_MENUS2)):$_i++?>
<li class="<?php if($_M2['id']==$_CA[0]):$g['nowSMemnu']=$_M2['uid']?>open<?php endif?><?php if($_MENUSN==$_i):?> _last<?php endif?>"><a href="<?php echo RW('c='.$_M2['id'])?>" target="<?php echo $_M2['target']?>"<?php if($_M2['id']==$_CA[0]):?> class="on"<?php endif?>><?php echo $_M2['name']?></a>
<?php if(($_HM['uid']==$_M2['uid']||$_HM['parent']==$_M2['uid'])&&$_M2['isson']):?>
<ul>
<?php $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and hidden=0 and depth=2 order by gid asc','*')?>
<?php while($_M3=db_fetch_array($_MENUS3)):?>
<li><a href="<?php echo RW('c='.$_CA[0].'/'.$_M3['id'])?>" target="<?php echo $_M3['target']?>"<?php if($_M3['uid']==$_HM['uid']):?> class="on"<?php endif?>><?php echo $_M3['name']?></a></li>
<?php endwhile?>
</ul>
<?php endif?>
</li>
<?php endwhile?>
<?php if(!$_MENUSN):?>
<li class="_last none">메뉴가 등록되지 않았습니다.</li>
<?php endif?>
</ul>
<?php endif?>
<?php endif?>
