<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_vcard.php';?>
		</div>

		<div class="col-9 page-main">

			<?php include $g['dir_module_skin'].'_nav.php';?>

      <div id="pagegroup" class="mt-3">

				<div class="subnav clearfix my-3">
					<div class="subnav-links">
						<a class="subnav-item selected" onclick="catFlag('');">구독노트 <small>694</small></a>
						<a class="subnav-item" onclick="catFlag('1');">작성노트 <small>508</small></a>
						<a class="subnav-item" onclick="catFlag('2');">개설노트 <small>186</small></a>
						<a class="subnav-item" onclick="catFlag('2');">추천노트 <small>186</small></a>
					</div>
				</div>

      	<?php
      	$sort	= 'uid';
      	$orderby= 'asc';
      	$recnum	= 15;
      	$bbsque	= 'memberuid='.$_MH['uid'].' and bbstype=3';
      	if ($where && $keyword) $bbsque .= getSearchSql($where,$keyword,$ikeyword,'or');
      	$RCD = getDbArray($table['forummembers'],$bbsque,'*',$sort,$orderby,$recnum,$p);
      	$NUM = getDbRows($table['forummembers'],$bbsque);
      	$TPG = getTotalPage($NUM,$recnum);
      	?>


      	<div class="info">

      		<div class="article">
      			<?php echo $NUM?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
      		</div>

      		<div class="category">

      		</div>
      		<div class="clear"></div>
      	</div>


      	<table class="list">
      	<?php while($_C=db_fetch_array($RCD)):?>
      	<?php $R=getUidData($table['forumlist'],$_C['parentbbs'])?>
      	<?php $M=getDbData($table['s_mbrdata'],'memberuid='.$R['maker'],'*')?>
      	<?php $D=getOverTime($date['totime'],$R['d_regis'])?>
      	<?php $L=getOverTime($date['totime'],$R['d_last'])?>
      	<?php $R['ismember']=$my['uid']?getDbRows($table['forummembers'],'parentbbs='.$R['uid'].' and memberuid='.$my['uid']):0?>
      	<tr>
      	<td class="l1"><a href="<?php echo $g['s']?>/note/<?php echo $R['id']?>"><img src="<?php if($R['imgsymbol']):?><?php echo $g['s']?>/modules/forum/var/files/<?php echo $R['imgsymbol']?><?php else:?><?php echo $g['img_layout']?>/no_note.gif<?php endif?>" width="50" height="50" alt="" /></a></td>
      	<td class="l2">
      		<a href="<?php echo $g['s']?>/note/<?php echo $R['id']?>" class="sbj"><?php echo $R['name']?></a>
      		<span class="ment"><?php echo $R['intro'] ? getStrCut(strip_tags($R['intro']),120,'..') : '아직 소개글이 등록되지 않았습니다.'?></span>
      		<span class="info">
      		개설/최근 <?php echo $D[1]<4?$D[0].$lang['sys']['time'][$D[1]].'전':getDateFormat($R['d_regis'],'Y/m/d')?>/<?php echo $L[0]?($L[1]<4?$L[0].$lang['sys']['time'][$L[1]].'전':getDateFormat($R['d_last'],'Y/m/d')):'없음'?>
      		ㆍ개설자 <?php echo $M['nic']?>
      		<img src="<?php echo $g['img_layout']?>/ico_arr_04.gif" alt="" /><span class="num"><?php echo $R['num_m']?>명</span>
      		<img src="<?php echo $g['img_layout']?>/ico_arr_05.gif" alt="" /><span class="num"><?php echo $R['num_r']?>개</span>
      		<span class="cat"><?php echo $R['cat1']?>/<?php echo $R['cat2']?></span>
      		</span>
      	</td>
      	<td class="l3">
      		<?php if($R['ismember']):?>
      		<img src="<?php echo $g['img_layout']?>/btn_note_joing.gif" alt="구독중" onclick="alert('이미 구독하셨습니다.     ');" />
      		<?php else:?>
      		<?php if($my['uid']):?>
      		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;bid=<?php echo $R['id']?>&amp;mod=join"><img src="<?php echo $g['img_layout']?>/btn_note_join.gif" alt="구독하기" /></a>
      		<?php else:?>
      		<img src="<?php echo $g['img_layout']?>/btn_note_join1.gif" alt="구독하기" onclick="alert('로그인 후 구독하실 수 있습니다.     ');" />
      		<?php endif?>
      		<?php endif?>
      	</td>
      	</tr>
      	<?php endwhile?>
      	</table>


      	<?php if(!$NUM):?>
      	<div class="none">해당되는 노트북이 없습니다.</div>
      	<?php endif?>

      	<div class="pagebox01">
      	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
      	</div>

      	<div class="searchform">
      		<form name="bbssearchf" action="<?php echo $g['s']?>/">
      		<input type="hidden" name="r" value="<?php echo $r?>" />
      		<input type="hidden" name="m" value="<?php echo $m?>" />
      		<input type="hidden" name="mod" value="<?php echo $mod?>" />
      		<input type="hidden" name="page" value="<?php echo $page?>" />
      		<input type="hidden" name="mbrid" value="<?php echo $mbrid?>" />
      		<input type="hidden" name="mbruid" value="<?php echo $mbruid?>" />

      		<select name="where">
      		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>노트북제목</option>
      		<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>노트북코드</option>
      		</select>

      		<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="input" />
      		<input type="submit" value=" 검색 " class="btngray" />
      		<input type="button" value=" 리셋 " class="btngray" onclick="this.form.keyword.value='';this.form.submit();" />
      		</form>
      	</div>


      </div>



















    </div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>
