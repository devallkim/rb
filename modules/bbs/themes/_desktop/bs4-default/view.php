<section class="rb-bbs-view">

	<header>
		<h1 class="h3">
			<?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
		</h1>
		<div class="d-flex justify-content-between align-items-center mb-3">
	 		<ul class="list-inline mb-0">
	 			<li class="list-inline-item"><?php echo $R[$_HS['nametype']]?></li>
	 			<li class="list-inline-item"><?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?></li>
	 			<li class="list-inline-item">조회 : <?php echo $R['hit']?></li>
	 		</ul>

	 		<div class="btn-group">
	 			<?php if($d['theme']['use_singo']):?>
	 			<a class="btn btn-light" href="<?php echo $g['bbs_action']?>singo&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?');">
					<i class="fa fa-bell-o"></i> 신고
				</a>
	 			<?php endif?>
	 			<?php if($d['theme']['use_print']):?>
	 			<a class="btn btn-light"  href="javascript:printWindow('<?php echo $g['bbs_print'].$R['uid']?>');" >
					<i class="fa fa-print"></i> 인쇄
				</a>
	 			<?php endif?>
	 			<?php if($d['theme']['use_scrap']):?>
	 			<a class="btn btn-light"  href="<?php echo $g['bbs_action']?>scrap&amp;uid=<?php echo $R['uid']?>"  target="_action_frame_<?php echo $m?>" onclick="return isLogin2();">
					<i class="fa fa-paperclip"></i> 스크랩
				</a>
	 			<?php endif?>
	 		</div>
	 	</div>
	</header>

	<article class="py-3">
		<?php echo getContents($R['content'],$R['html'])?>
	</article>

	<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
	<div class="text-center">
		<?php if($d['theme']['show_score1']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');" class="btn btn-light">
			<i class="fa fa-thumbs-o-up"></i> 공감 <span class="text-muted"><em><?php echo $R['score1']?></em></span>
		</a>
		<?php endif?>
		<?php if($d['theme']['show_score2']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');" class="btn btn-light">
			<i class="fa fa-thumbs-o-down"></i> 비공감 <span class="text-muted"><em><?php echo $R['score2']?></em></span>
		</a>
		<?php endif?>
	</div>
	<?php endif?>


	<?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$att_file_num>0):?>

	<?php endif?>

	<?php if($R['tag']&&$d['theme']['show_tag']):?>
	<div class="">
		<?php $_tags=explode(',',$R['tag'])?>
		<?php $_tagn=count($_tags)?>
		<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
		<?php $_tagk=trim($_tags[$i])?>
		<a class="badge badge-secondary" href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>">
		<?php echo $_tagk?>
		</a>
		<?php endfor?>
	</div>
	<?php endif?>

	<footer class="d-flex justify-content-between align-items-center mt-3">
		<div class="btn-group">
			 <?php if($my['admin'] || $my['uid']==$R['mbruid']):?>
				 <a href="<?php echo $g['bbs_modify'].$R['uid']?>" class="btn btn-light">수정</a>
				 <a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" class="btn btn-light">삭제</a>
				<?php endif?>
				<?php if($my['admin']&&$d['theme']['use_reply']):?>
						<a href="<?php echo $g['bbs_reply'].$R['uid']?>" class="btn btn-light">답변</a>
				<?php endif?>
		 </div>
		 <a href="<?php echo $g['bbs_list']?>" class="btn btn-light">목록</a>
	</footer>

	<!-- 댓글 인클루드 -->
	<?php if(!$d['bbs']['c_hidden']):?>
	<?php endif?>

</section>

<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>
