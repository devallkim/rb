<section id="page-bbs-view" data-uid="<?php echo $R['uid'] ?>">
	<header class="bar bar-nav bar-dark bg-primary px-0">
		<a class="btn btn-link btn-nav pull-left p-x-1" href="<?php echo RW(0)?>">
	    <span class="icon icon-home"></span>
	  </a>
		<?php if ($my['uid']): ?>
		<a class="icon icon icon-gear pull-right p-x-1" role="button" href="<?php echo RW('mod=settings') ?>" title="개인정보수정"></a>
		<?php else: ?>
		<a class="icon icon-person pull-right p-x-1" role="button" data-toggle="modal" href="#modal-login" data-title="로그인"></a>
		<?php endif; ?>
		<a class="title" href="<?php echo RW(0)?>"><?php echo stripslashes($d['layout']['header_title'])?></a>
	</header>

	<div class="bar bar-standard bar-header-secondary bar-light bg-faded">
		<button class="btn btn-secondary pull-left js-btn-href" data-href="<?php echo $g['bbs_list']?>">
			목록
		</button>
	  <a class="title" href="<?php echo $g['bbs_list']?>"><?php echo $B['name']?$B['name']:($_HM['name']?$_HM['name']:$_HP['name'])?></a>
	</div>

	<main class="content">  <?php echo $R['mobile'] ?>
		<div class="content-padded">
			<span class="badge badge-primary badge-inverted"><?php echo $R['category']?></span>
			<h3 class="rb-article-title"><?php echo $R['subject']?></h3>
			<div class="clearfix">

				<div class="pull-xs-left">

					<div class="media">
						<img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84','') ?>"  width="42">
						<div class="media-body m-l-1">
							<span class="badge badge-default badge-inverted" data-role="regis_name"><?php echo $R[$_HS['nametype']]?></span> <br>
							<span class="badge badge-default badge-inverted" data-role="regis_time"><?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?></span>
							<span class="badge badge-default badge-inverted">조회 <?php echo $R['hit']?></span>
						</div>
					</div>

				</div>

				<div class="pull-xs-right">

					<button type="button" class="btn btn-outline-secondary js-moveComments">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span class="badge badge-primary badge-inverted" data-role="total_comment">
							<?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?>
						</span>
					</button>

					<button type="button" class="btn btn-outline-secondary" data-toggle="popup" data-target="#popup-bbs-view-share">
						<i class="fa fa-share-alt" aria-hidden="true"></i>
					</button>


				</div>

			</div><!-- /.clearfix -->
		</div><!-- /.content-padded -->




		<hr>

		<div class="info">

			<?php if($d['theme']['show_score1']):?><span class="split">|</span> <span class="han">공감</span> <span class="num"><?php echo $R['score1']?></span> <?php endif?>
			<?php if($d['theme']['show_score2']):?><span class="split">|</span> <span class="han">비공감</span> <span class="num"><?php echo $R['score2']?></span> <?php endif?>
		</div>

		<article class="rb-article content-padded">
			<?php echo getContents($R['content'],$R['html'])?>
		</article>

		<div class="nav nav-control content-padded">
		  <a class="nav-link" role="button" href="<?php echo $g['bbs_modify'].$R['uid']?>">수정</a>
		  <?php if($d['theme']['use_reply']):?><a class="nav-link" role="button" href="<?php echo $g['bbs_reply'].$R['uid']?>">답변</a><?php endif?>
		  <a class="nav-link" role="button" href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
		</div>

		<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
		<div class="scorebox">
		<?php if($d['theme']['show_score1']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_1.gif" alt="공감" /></a>
		<?php endif?>
		<?php if($d['theme']['show_score2']):?>
		<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_2.gif" alt="비공감" /></a>
		<?php endif?>
		</div>
		<?php endif?>

		<?php if($R['tag']&&$d['theme']['show_tag']):?>
		<div class="tag">
		<img src="<?php echo $g['img_core']?>/_public/ico_tag.gif" alt="태그" />
		<?php $_tags=explode(',',$R['tag'])?>
		<?php $_tagn=count($_tags)?>
		<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
		<?php $_tagk=trim($_tags[$i])?>
		<a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a><?php if($i < $_tagn-1):?>, <?php endif?>
		<?php endfor?>
		</div>
		<?php endif?>


			<!-- 댓글 인클루드 -->
			<?php if(!$d['bbs']['c_hidden']):?>

		    <?php
		    // 댓글 일반 사항
		    /*
		       1) 댓글 저장 테이블 : rb_s_comment
		       2) 한줄의견 저장 테이블 : rb_s_oneline
		       3) rb_s_comment 의 parent 필드 저장형식 ==> p_modulep_uid
		          예를 들어, 게시판 모듈의 uid = 3 인 글의 댓글은 아래와 같이 저장됩니다.
		          ====> bbs3
		        4) 테마 css 는 테마/css/style.css 이며 댓글박스 가져올때 자동으로 함께 링크를 가져옵니다.
		           이 css 를 삭제하면 안되며 필요없는 경우 공백으로 처리하는 방법으로 하시기 바랍니다.
		           현재, notify 부분에 대한 css 가 있어서 삭제하면 안됩니다.
		    */

		    // 댓글 출력 함수
		    // 함수 호출 방식으로 하면 모달 호출시에도 적용하기 편합니다.
		    /*
		       1) module = 부모모듈 : 댓글의 부모 모듈 id ( ex: bbs, post, forum ...)
		       2) parent_uid = 부모 uid : 댓글의 부모 포스트 uid
		       3) parent_table = 부모 테이블 : p_uid 가 소속된 테이블명 ( ex : rb_bbs_data, rb_blog_data, rb_chanel_data ...)
		                 (댓글, 한줄의견 추가/삭제시 합계 업데이트시 필요)
		    */
		    ?>

		    <div class="mt-4 content-padded" id="anchor-comments">
		      <?php getWidget('_default/comment',array('module'=>'bbs','parent_uid' => $R['uid'],'parent_table'=>'rb_bbs_data','theme' => '_mobile/rc-default'))?>
		    </div>

			<?php endif?>



	</main>
</section>




<!-- 모달,팝업등의 컴포넌트 모음 -->
<?php include_once $g['dir_module_skin'].'_component.php'?>
