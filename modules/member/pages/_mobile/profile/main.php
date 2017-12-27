<?php
$m='blog';
include_once $g['path_module'].$m.'/lib/tree.func.php';
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['member']['mytab_recnum'];

$_mbrid=getDbData($table['s_mbrid'],"id='".$user."'",'*');
$_mbr=getDbData($table['s_mbrdata'],"memberuid='".$_mbrid['uid']."'",'*');

$blogque = 'mbruid='.$_mbrid['uid'].' and site='.$s.' and step=3';
if ($d_start) $blogque .= ' and d_regis > '.str_replace('/','',$d_start).'000000';
if ($d_finish) $blogque .= ' and d_regis < '.str_replace('/','',$d_finish).'240000';
if ($blog) $blogque .= ' and blog='.$blog;

if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $blogque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $blogque .= " and d_regis like '".$keyword."%'";
	else $blogque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['blogdata'],$blogque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['blogdata'],$blogque);
$TPG = getTotalPage($NUM,$recnum);

$g['pagelink'] = '/?r=home&amp;mod=profile&amp;user='.$user;
// $B=getDbData($table[$m.'list'],"id='news'",'*');

$title_len=$title_len?$title_len:46; // 제목 길이
$review_len=$review_len?$review_len:100; // 요약 길이
?>

<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-left-nav pull-left p-x-1" data-history="back" role="button"></a>
	<a class="icon icon-home pull-right p-x-1" href="/" role="button"></a>
	<h1 class="title">
		kimsQ
	</h1>
</header>

<div class="content">
	<?php include $g['dir_module_skin'].'_cover.php';?>
	<p class="content-padded">
		<span class="badge badge-primary badge-outline"><?php echo sprintf('총 %d건',$NUM)?></span>
	</p>


	   <div class="">
			<ul class="table-view table-view-full">

				<?php while($R=db_fetch_array($RCD)):?>
				<li class="table-view-cell">
					<a class="" href="<?php echo getPostData($R,'link').$R['uid']?>&amp;cat=<?php echo $cat?>">
					<?php if($R['content_format'] == 3):?>

		        <?php
		            $img='';
		            if($R['upload'])
		            {
		                $img=getYoutubeImageSrc($R,130,90); // sys.func.php 파일 참조  가로,세로
		            }
		        ?>
		        <a class="d-flex mr-3 rb-overlay" href="<?php echo getPostData($R,'link').$R['uid']?>&amp;cat=<?php echo $cat?>">
		          <img src="<?php echo $img?>" alt="">
		          <span class="rb-backdrop"></span>
		          <i class="fa fa-play-circle-o center" aria-hidden="true"></i>
		          <span class="rb-time"><?php echo getFeaturedimgMeta($R,'time') ?></span>
		        </a>
		      <?php else: ?>

		        <?php
		            $img='';
		            if($R['upload'])
		            {
		                $img=getUpImageSrc($R); // sys.func.php 파일 참조
		                $img_data=array('src'=>$img,'width'=>'280','height'=>'200','qulity'=>'90','filter'=>'','align'=>'');
		            }
		        ?>

		        <?php if($img):?>
		          <img src="<?php echo getTimThumb($img_data)?>" alt="" class="media-object pull-left" style="width:80px">
		        <?php endif?>
		      <?php endif?>
					<div class="media-body">
						<?php if($R['category']):?><span class="text-danger">[<?php echo $R['category']?>]</span><?php endif?>
						<?php echo getStrCut($R['subject'],$title_len,'...')?>
						<ul class="list-inline km-meta text-muted">
		          <li class="list-inline-item"> <?php echo getPostData($R,'mbr_name')?> <?php if($user !== 'admin'):?>기자<?php endif?></li>
		          <?php if(IsPostCat($B['uid'],$R['uid'])):?>
		          <li class="list-inline-item"> <?php echo getPostCatName($B['uid'],$R['uid']);?></li>
		          <?php endif?>
		          <li class="list-inline-item"> <?php echo getDateFormat($R['d_published'],'Y.m.d') ?></li>
		        </ul>
					</div>
					</a>
				</li>
				<?php endwhile?>

			</ul>
		    <?php if(!$NUM):?>
	          <div class="rb-none text-xs-center">데이타가 없습니다.</div>
	       <?php endif?>
 	 </div>


	<div class="d-flex content-padded">
		<?php echo getPageLink(5,$p,$TPG,'mobile')?>
	</div>

</div>
<!-- 공통 스크립트 -->
<?php include $g['dir_module_skin'].'_common_script.php' ?>

<script>
$(document).attr("title", "<?php echo $_mbr['name'] ?> - 경기방송");
</script>
