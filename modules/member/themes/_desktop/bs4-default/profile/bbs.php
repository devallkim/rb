<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 15;
$bbsque = 'mbruid='.$_MP['uid'].' and site='.$s;
if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $bbsque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $bbsque .= " and d_regis like '".$keyword."%'";
	else $bbsque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['bbsdata'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['bbsdata'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);

$m = 'bbs';
if ($c) $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'c='.$c,array($skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
else $g['bbs_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').'m='.$m,array($bid?'bid':'',$skin?'skin':'',$iframe?'iframe':'',$cat?'cat':''));
$g['bbs_list']	= $g['bbs_reset'].getLinkFilter('',array($p>1?'p':'',$sort!='gid'?'sort':'',$orderby!='asc'?'orderby':'',$recnum!=$d['bbs']['recnum']?'recnum':'',$type?'type':'',$where?'where':'',$keyword?'keyword':''));
$g['pagelink']	= $g['bbs_list'];
$g['bbs_view']	= $g['bbs_list'].'&amp;uid=';

?>

<div class="page-wrapper row">
	<div class="col-3 page-nav">

		<?php include $g['dir_module_skin'].'_vcard.php';?>
	</div>

	<div class="col-9 page-main">
		<?php include $g['dir_module_skin'].'_nav.php';?>

		<section>

			<header class="d-flex justify-content-between mt-4 mb-2">
				<div>
					<?php echo number_format($NUM)?>개 <small class="text-muted">(<?php echo $p?>/<?php echo $TPG?>페이지)</small>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=bbs&amp;mbruid=<?php echo $_MP['uid']?>&amp;mod=rss" target="_blank" class="ml-2 muted-link">
		        <i class="fa fa-rss-square" aria-hidden="true"></i> RSS
		      </a>
				</div>
			</header>

			<table class="table text-center">

				<colgroup>
					<col width="50">
					<col>
					<col width="70">
					<col width="100">
				</colgroup>
				<thead class="thead-light">
					<tr>
						<th scope="col" class="side1">번호</th>
						<th scope="col">제목</th>
						<th scope="col">조회</th>
						<th scope="col">날짜</th>
					</tr>
				</thead>
				<tbody>

				<?php while($R=db_fetch_array($RCD)):?>
				<?php $R['mobile']=isMobileConnect($R['agent'])?>
				<?php $R['sbjlink']=getPostLink($R)?>
				<tr>
					<td>
						<?php if($R['uid'] != $uid):?>
						<?php echo $NUM-((($p-1)*$recnum)+$_rec++)?>
						<?php else:$_rec++?>
						<span class="now">&gt;&gt;</span>
						<?php endif?>
					</td>
					<td class="text-left">
						<?php if($R['mobile']):?><i class="fa fa-mobile fa-lg"></i><?php endif?>
            <?php if($R['category']):?>
            <span class="badge badge-secondary"><?php echo $R['category']?></span>
            <?php endif?>
            <a href="<?php echo $g['bbs_view'].$R['uid']?>" class="muted-link" target="_blank">
              <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
            </a>
            <?php if(strstr($R['content'],'.jpg') || strstr($R['content'],'.png')):?>
            <span class="badge badge-light" data-toggle="tooltip" title="사진">
              <i class="fa fa-camera-retro fa-lg"></i>
            </span>
            <?php endif?>
            <?php if($R['upload']):?>
            <span class="badge badge-light" data-toggle="tooltip" title="첨부파일">
              <i class="fa fa-paperclip fa-lg"></i>
            </span>
            <?php endif?>
            <?php if($R['hidden']):?><span class="badge badge-light" data-toggle="tooltip" title="비밀글"><i class="fa fa-lock fa-lg"></i></span><?php endif?>
            <?php if($R['comment']):?><span class="badge badge-light"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span><?php endif?>
            <?php if(getNew($R['d_regis'],24)):?><small class="text-danger"><small>New</small></span><?php endif?>
					</td>
					<td class="small"><?php echo $R['hit']?></td>
					<td>
						<time class="small text-muted"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></time>
					</td>
					</tr>
					<?php endwhile?>


					<?php if(!$NUM):?>
					<tr>
						<td colspan="4" class="py-5 text-muted">
							게시물이 없습니다.
						</td>
					</tr>
				<?php endif?>

				</tbody>
			</table>

			<footer class="d-flex justify-content-between align-items-center my-4">
		    <ul class="pagination mb-0">
					<?php $_N =  '/@'.$mbrid.'?page='.$page.'&' ?>
	        <?php echo getPageLink(10,$p,$TPG,$_N)?>
		    </ul>

				<form name="bbssearchf" action="<?php echo $g['s']?>/" class="form-inline">
					<input type="hidden" name="r" value="<?php echo $r?>" />
					<?php if($_mod):?>
					<input type="hidden" name="mod" value="<?php echo $_mod?>" />
					<?php else:?>
					<input type="hidden" name="m" value="<?php echo $m?>" />
					<input type="hidden" name="front" value="<?php echo $front?>" />
					<?php endif?>
					<input type="hidden" name="page" value="<?php echo $page?>" />
					<input type="hidden" name="sort" value="<?php echo $sort?>" />
					<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
					<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
					<input type="hidden" name="type" value="<?php echo $type?>" />
					<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
					<input type="hidden" name="skin" value="<?php echo $skin?>" />

					<select name="where" class="form-control">
						<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
						<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
					</select>

					<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="form-control ml-2">
					<button class="btn btn-light ml-2" type="submit" name="button">검색</button>
				</form>

		  </footer>

		</section>

	</div><!-- /.page-main -->
</div><!-- /.page-wrapper -->
