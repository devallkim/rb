<?php
if (!function_exists('getMenuWidgetTree'))
{
	function getMenuWidgetTree($site,$table,$is_child,$parent,$depth,$id,$w,$_C)
	{
		global $_CA;

		if ($depth < $w['limit'])
		{
			$CD=getDbSelect($table,($site?'site='.$site.' and ':'').'hidden=0 and parent='.$parent.' and depth='.($depth+1).($w['mobile']?' and mobile=1':'').' order by gid asc','*');
			echo "\n";
			for ($i=0;$i<$depth;$i++) echo "\t";
			if($is_child)
			{
				echo "<ul".($w['dropdown']?' class="dropdown-menu" role="menu" aria-labelledby="dLabel"':'').">\n";
				if ($w['dropdown'] && $w['dispfmenu'])
				{
					echo $_C['link'];
					echo '<div class="dropdown-divider"></div>'."\n";
				}
			}
			while($C=db_fetch_array($CD))
			{
				$_newTree	= ($id?$id.'/':'').$C['id'];
				$_href		= $w['link']=='bookmark'?' data-scroll href="#'.($C['is_child']&&$w['limit']>1&&!$parent&&$w['dropdown']?'':str_replace('/','-',$_newTree)).'"' : ' href="'.RW('c='.$_newTree).'"';
				$_dropdown	= $w['dropdown']&&$C['is_child']&&$C['depth']==($w['depth']+1)&&$w['olimit']>1?' class="nav-link dropdown-toggle" data-toggle="dropdown"':'';
				$_name		= $C['name'];
				$_target	= $C['target']=='_blank'?' target="_blank"':'';
				$_addattr	= $C['addattr']?' '.$C['addattr']:'';

				for ($i=0;$i<$C['depth'];$i++) echo "\t";

				if ($_dropdown) echo '<li class="nav-item dropdown'.(in_array($C['id'],$_CA)?' active':'').'"><a class="nav-link dropdown-toggle"'.$_addattr.$_href.$_dropdown.$_target.'>'.$_name.'</a>';

				else {
					if ($is_child) {
						echo '<a class="dropdown-item'.(in_array($C['id'],$_CA)?' active':'').'"'.$_addattr.$_href.$_dropdown.$_target.'>'.$_name.'</a>';
					} else {
						echo '<li'.(in_array($C['id'],$_CA)?' class="nav-item active"':' class="nav-item"').'><a class="nav-link"'.$_addattr.$_href.$_dropdown.$_target.'>'.$_name.'</a>';
					}
				}

				if ($C['is_child'])
				{
					$C['link'] = '<a class="dropdown-item"'.$_addattr.$_href.$_target.'>'.$C['name'].'</a>';
					getMenuWidgetTree($site,$table,$C['is_child'],$C['uid'],$C['depth'],$_newTree,$w,$C);
				}
				echo "</li>\n";
			}
			for ($i=0;$i<$depth;$i++) echo "\t";
			if($is_child) echo "</ul>\n";
			for ($i=0;$i<$depth;$i++) echo "\t";
		}
	}
}
$d['layout']['navbar']['limit'] = $d['layout']['navbar']['limit'] < 6 ? $d['layout']['navbar']['limit'] : 5;
if ($d['layout']['navbar']['smenu'] < 0)
{
	if (strstr($c,'/'))
	{
		$d['layout']['navbar']['mnarr'] = explode('/',$c);
		$d['layout']['navbar']['count'] = (- $d['layout']['navbar']['smenu']) - 1;
		for ($j = 0; $j <= $d['layout']['navbar']['count']; $j++) $d['layout']['navbar']['sid'] .= $d['layout']['navbar']['mnarr'][$j].'/';
		$d['layout']['navbar']['sid'] = $d['layout']['navbar']['sid'] ? substr($d['layout']['navbar']['sid'],0,strlen($d['layout']['navbar']['sid'])-1): '';
		$d['layout']['navbar']['path'] = getDbData($table['s_menu'],"id='".d['layout']['mnarr'][$d['layout']['navbar']['count']]."'",'uid,depth');
		$d['layout']['navbar']['smenu'] = $d['layout']['navbar']['path']['uid'];
		$d['layout']['navbar']['depth'] = $d['layout']['navbar']['path']['depth'];
	}
	else {
		$d['layout']['navbar']['sid'] = $c;
		$d['layout']['navbar']['smenu'] = $_HM['uid'];
		$d['layout']['navbar']['depth'] = $_HM['depth'];
	}
}
else if ($d['layout']['navbar']['smenu'])
{
	$d['layout']['navbar']['mnarr'] = explode('/',$d['layout']['navbar']['smenu']);
	$d['layout']['navbar']['count'] = count($d['layout']['navbar']['mnarr']);
	for ($j = 0; $j < $d['layout']['navbar']['count']; $j++)
	{
		$d['layout']['navbar']['depth'] = getDbData($table['s_menu'],'uid='.(int)$d['layout']['navbar']['mnarr'][$j],'uid,id,depth');
		$d['layout']['navbar']['sid'] .= $d['layout']['navbar']['depth']['id'].'/';
		$d['layout']['navbar']['smenu'] = $d['layout']['navbar']['depth']['uid'];
		$d['layout']['navbar']['depth'] = $d['layout']['navbar']['depth']['depth'];
	}
	$d['layout']['navbar']['sid'] = $d['layout']['navbar']['sid'] ? substr($d['layout']['navbar']['sid'],0,strlen($d['layout']['navbar']['sid'])-1): '';
}
else {
	$d['layout']['navbar']['depth'] = 0;
}
$d['layout']['navbar']['olimit']= $d['layout']['navbar']['limit'];
$d['layout']['navbar']['limit'] = $d['layout']['navbar']['limit'] + $d['layout']['navbar']['depth'];
getMenuWidgetTree($s,$table['s_menu'],0,$d['layout']['navbar']['smenu'],$d['layout']['navbar']['depth'],$d['layout']['navbar']['sid'],$d['layout']['navbar'],array());
?>
