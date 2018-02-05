<!-- 사진전용모달 : photoswipe http://photoswipe.com/documentation/getting-started.html -->
<?php getImport('photoswipe','photoswipe','4.1.1','css') ?>
<?php getImport('photoswipe','rc-skin/default-skin','4.1.1','css') ?>
<?php getImport('photoswipe','rc-photoswipe','4.1.1','js') ?>
<?php getImport('photoswipe','photoswipe-ui-default.min','4.1.1','js') ?>

<!-- 동영상,유튜브,오디오 player : http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','mediaelement-and-player.min','4.1.3','js') ?>
<?php getImport('mediaelement','lang/ko','4.1.3','js') ?>
<?php getImport('mediaelement','mediaelementplayer','4.1.3','css') ?>


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

	<main class="content">
		<div class="mb-3" data-role="post">
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
			<div class="tag content-padded  mt-4">
        <h5><i class="fa fa-tag" aria-hidden="true"></i> 태그</h5>
  			<?php $_tags=explode(',',$R['tag'])?>
  			<?php $_tagn=count($_tags)?>
  			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
  			<?php $_tagk=trim($_tags[$i])?>
  			<a class="badge badge-primary badge-outline" href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
  			<?php endfor?>
			</div>
			<?php endif?>


			<!-- 첨부파일 -->
			<?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$attach_file_num>0):?>
			<div class="mt-4 content-padded">
			<?php
				 $img_files = array();
				 $audio_files = array();
				 $video_files = array();
				 $youtube_files = array();
				 $down_files = array();
				 foreach($d['upload']['data'] as $_u){
						if($_u['type']==2 and $_u['hidden']==0) array_push($img_files,$_u);
						else if($_u['type']==4 and $_u['hidden']==0) array_push($audio_files,$_u);
						else if($_u['type']==5 and $_u['hidden']==0) array_push($video_files,$_u);
						else if($_u['type']==8 and $_u['hidden']==0) array_push($youtube_files,$_u);
						else if($_u['type']==1 || $_u['type']==6 || $_u['type']==7 and $_u['hidden']==0) array_push($down_files,$_u);
				 }
				 $attach_photo_num = count ($img_files);
				 $attach_video_num = count ($video_files);
				 $attach_audio_num = count ($audio_files);
				 $attach_youtube_num = count ($youtube_files);
				 $attach_down_num = count ($down_files);
			?>

			<?php if($attach_youtube_num>0):?>
				<?php foreach($youtube_files as $_u):?>
				 <video class="mejs-player mb-4"  style="max-width:100%;" preload="none">
						 <source src="https://www.youtube.com/embed/<?php echo $_u['name']?>" type="video/youtube">
				 </video>
				<?php endforeach?>
			<?php endif?>

			<?php if($attach_photo_num>0):?>
			<h5>사진 <span class="text-danger"><?php echo $attach_photo_num?></span></h5>
			<div class="list-inline mb-3" data-extension="photoswipe">
				<?php foreach($img_files as $_u):?>

				<?php
					$img_origin=$_u['url'].$_u['folder'].'/'.$_u['tmpname'];
					$thumb_list=getPreviewResize($img_origin,'q'); // 미리보기 사이즈 조정
					$thumb_modal=getPreviewResize($img_origin,'c'); // 정보수정 모달용  사이즈 조정
          $img_origin_size=$_u['width'].'x'.$_u['height'];
				?>
					<figure class="figure ">
						<a href="<?php echo $thumb_modal ?>" data-size="<?php echo $img_origin_size ?>">
              <img src="<?php echo $thumb_list ?>" alt="" width="75">
            </a>
            <figcaption class="figure-caption" hidden><?php echo $_u['name'] ?></figcaption>
					</figure>
				<?php endforeach?>
			</div>
			<?php endif?>

			<?php if($attach_down_num>0):?>
      <h5>첨부파일 <span class="text-danger"><?php echo $attach_down_num ?></span></h5>
				<ul class="table-view">
					<?php foreach($down_files as $_u):?>
						<?php
							 $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
							 $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
						 ?>
						 <li class="table-view-cell">
               <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=mediaset&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>">
		            <i class="media-object pull-left fa fa-file<?php echo $ext_icon?>-o fa-lg fa-fw"></i>
                <?php echo $_u['name']?>
		            <small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small>
		            <span class="badge badge-pill"><?php echo number_format($_u['down'])?></span>
                </a>
						 </li>
					<?php endforeach?>
				</ul>
			<?php endif?>

      <?php if($attach_audio_num>0):?>
        <h5>오디오 <span class="text-danger"><?php echo $attach_audio_num?></span></h5>
        <?php foreach($audio_files as $_u):?>
        <?php
          $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
          $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
         ?>
        <div class="card">
          <audio controls class="card-img-top mejs-player img-fluid">
            <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/<?php echo $_u['ext']?>">
          </audio>
          <div class="card-block">
            <h6 class="card-title"><?php echo $_u['name']?></h6>
            <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
          </div><!-- /.card-block -->
        </div><!-- /.card -->
        <?php endforeach?>

      <?php endif?>

      <?php if($attach_video_num>0):?>
        <h5>비디오 <span class="text-danger"><?php echo $attach_video_num?></span></h5>
        <?php foreach($video_files as $_u):?>
        <?php
           $ext_to_fa=array('xls'=>'excel','xlsx'=>'excel','ppt'=>'powerpoint','pptx'=>'powerpoint','txt'=>'text','pdf'=>'pdf','zip'=>'archive','doc'=>'word');
           $ext_icon=in_array($_u['ext'],array_keys($ext_to_fa))?'-'.$ext_to_fa[$_u['ext']]:'';
         ?>
        <div class="card">
          <video width="320" height="240" controls class="card-img-top mejs-player">
            <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="video/<?php echo $_u['ext']?>">
          </video>
          <div class="card-block">
            <h6 class="card-title"><?php echo $_u['name']?></h6>
            <p class="card-text"><small class="text-muted">(<?php echo getSizeFormat($_u['size'],1)?>)</small></p>
          </div><!-- /.card-block -->
        </div><!-- /.card -->
        <?php endforeach?>

      <?php endif?>
			</div>
			<?php endif?>
			<!-- /첨부파일-->




		</div>








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

		    <div class="mt-2 content-padded" id="anchor-comments">
		      <?php getWidget('_default/comment',array('module'=>'bbs','parent_uid' => $R['uid'],'parent_table'=>'rb_bbs_data','theme' => '_mobile/rc-default'))?>
		    </div>

			<?php endif?>



	</main>
</section>


<!-- 모달,팝업등의 컴포넌트 모음 -->
<?php include_once $g['dir_module_skin'].'_component.php'?>


<script type="text/javascript">

var post_area = $('[data-role="post"]')

$(function() {

	var post_height = post_area.height(); // 게시물 영역의 높이
	post_area.attr('height',post_height)

  //게시물 본문에 삽입된 이미지를 본문에 맞추는 클래스 추가
  $('.rb-article').find('img').addClass('img-fluid')

	// 게시물 보기(랜딩) 댓글 바로가기 버튼
	$('#page-bbs-view').find(".js-moveComments").click(function() { // 댓글 컨테이너로 이동
		$('.content').animate({scrollTop : post_height}, 200);
	});

	// 폰의 키보드가 올라왔을때, 댓글 입력창 위치 재조정
	var _originalSize = $(window).width() + $(window).height()

	$(window).resize(function(){
		if($(window).width() + $(window).height() != _originalSize){
			console.log("키보드 올라옴");
			$('.content').animate({scrollTop : post_height}, 100);
			return true;
		}else{
			console.log("키보드 내려감");
			return false;
		}
	});

  $('.mejs-player').mediaelementplayer(); // 동영상, 오디오 플레이어 초기화 http://www.mediaelementjs.com/
  RC_initPhotoSwipe(); // photoswipe 초기화

});
</script>
