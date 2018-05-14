<section class="rb-bbs-view" data-uid="<?php echo $R['uid'] ?>" data-bid="<?php echo $B['id'] ?>">
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
							<img class="media-object pull-left rb-avatar img-circle bg-faded" src="<?php echo getAavatarSrc($R['mbruid'],'84','') ?>"  width="42" height="42">
							<div class="media-body m-l-1 rb-meta">
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
						<button type="button" class="btn btn-outline-secondary"
				      data-toggle="popup"
				      data-target="#popup-link-share"
				      data-role="linkShare"
				      data-subject="<?php echo $R['subject']?>"
							data-url="<?php echo $g['bbs_view'] ?><?php echo $R['uid']?>"
							data-likes="<?php echo $R['likes']?>"
							data-image="<?php echo getPreviewResize(getUpImageSrc($R),'c') ?>"
							data-desc="<?php echo $g['browtitle']?>"
				      data-title="게시물 공유">
				      <i class="fa fa-share-alt" aria-hidden="true"></i>
				    </button>
					</div>

				</div><!-- /.clearfix -->
			</div><!-- /.content-padded -->

			<hr>

			<article class="rb-article content-padded">
				<?php echo getContents($R['content'],$R['html'])?>
			</article>

			<!-- 좋아요 or 싫어요 -->
			<div class="content-padded text-xs-center my-4" >

				<?php if($d['theme']['show_like']):?>
				<button type="button" class="btn btn-secondary btn-lg<?php if($is_liked):?> active<?php endif?>"
					data-act="opinion"
					data-url="<?php echo $g['bbs_action']?>opinion&amp;opinion=like&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
					data-role="btn_like">
					<i class="fa fa fa-heart-o fa-fw" aria-hidden="true"></i> <strong></strong>
					<span data-role='likes_<?php echo $R['uid']?>' class="badge badge-inverted"><?php echo $R['likes']?></span>
				</button>
				<?php endif?>

				<?php if($d['theme']['show_dislike']):?>
				<button type="button" class="btn btn btn-secondary btn-lg<?php if($is_disliked):?> active<?php endif?>"
					data-act="opinion"
					data-url="<?php echo $g['bbs_action']?>opinion&amp;opinion=dislike&amp;uid=<?php echo $R['uid']?>&amp;effect=heartbeat"
					data-role="btn_dislike">
					<i class="fa fa-thumbs-o-down fa-fw" aria-hidden="true"></i> <strong></strong>
					<span data-role='dislikes_<?php echo $R['uid']?>' class="badge badge-inverted"><?php echo $R['dislikes']?></span>
				</button>
				<?php endif?>

			</div>

			<!-- 태그 -->
			<?php if($R['tag']&&$d['theme']['show_tag']):?>
			<div class="tag content-padded  mt-4">
  			<?php $_tags=explode(',',$R['tag'])?>
  			<?php $_tagn=count($_tags)?>
  			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
  			<?php $_tagk=trim($_tags[$i])?>
  			<a class="badge badge-primary badge-outline" href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a>
  			<?php endfor?>
			</div>
			<?php endif?>

			<!-- 첨부파일 인클루드 -->
			<?php if($d['upload']['data']&&$d['theme']['show_upfile']&&$attach_file_num>0):?>
			<aside class="mt-4 content-padded">
				<?php include $g['dir_module_skin'].'_attachment.php'?>
			</aside>
			<?php endif?>

		</div>

		<div class="nav nav-control content-padded my-4">
			<a class="nav-link" role="button" href="<?php echo $g['bbs_modify'].$R['uid']?>">수정</a>
			<?php if($d['theme']['use_reply']):?><a class="nav-link" role="button" href="<?php echo $g['bbs_reply'].$R['uid']?>">답변</a><?php endif?>
			<a class="nav-link" role="button" href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">삭제</a>
		</div>


		<!-- 댓글 인클루드 -->
		<?php if(!$d['bbs']['c_hidden']):?>
		<aside class="mt-2 content-padded" id="anchor-comments">
			<?php include $g['dir_module_skin'].'_comment.php'?>
		</aside>
		<?php endif?>


	</main>
</section>


<script type="text/javascript">

$(function() {

	var post_area = $('[data-role="post"]')
	var popup_linkshare = $('#popup-link-share')  //링크공유 팝업
  var kakao_link_btn = $('#kakao-link-btn')  //카카오톡 링크공유 버튼

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


	//링크 공유 팝업이 열릴때
	popup_linkshare.on('shown.rc.popup', function (event) {
	  var ele = $(event.relatedTarget)
	  var path = ele.attr('data-url')?ele.attr('data-url'):''
	  var host = $(location).attr('origin');
	  var sbj = ele.attr('data-subject')?ele.attr('data-subject'):'' // 버튼에서 제목 추출
	  var email = ele.attr('data-email')?ele.attr('data-email'):'' // 버튼에서 이메일 추출
	  var desc = ele.attr('data-desc')?ele.attr('data-desc'):'' // 버튼에서 요약설명 추출
	  var image = ele.attr('data-image')?ele.attr('data-image'):'' // 버튼에서 대표이미지 경로 추출
	  var likes = ele.attr('data-likes')?ele.attr('data-likes'):'' // 버튼에서 좋아요 수 추출
	  var comment = ele.attr('data-comment')?ele.attr('data-comment'):'' // 버튼에서 댓글수 추출
	  var popup = $(this)

	  var link = host+path // 게시물 보기 URL
	  var imageUrl = host+image // 대표이미지 URL
	  var enc_link = encodeURIComponent(host+path) // URL 인코딩
	  var enc_sbj = encodeURIComponent(sbj) // 제목 인코딩
	  var facebook = 'http://www.facebook.com/sharer.php?u=' + enc_link;
	  var twitter = 'https://twitter.com/intent/tweet?url=' + enc_link + '&text=' + sbj;
	  var naver = 'http://share.naver.com/web/shareView.nhn?url=' + enc_link + '&title=' + sbj;
	  var kakaostory = 'https://story.kakao.com/share?url=' + enc_link + '&title=' + enc_sbj;
	  var email = 'mailto:' + email + '?subject=링크공유-' + enc_sbj+'&body='+ enc_link;

	  popup.find('[data-role="share"]').val(host+path)
	  popup.find('[data-role="share"]').focus(function(){
	    $(this).on("mouseup.a keyup.a", function(e){
	      $(this).off("mouseup.a keyup.a").select();
	    });
	  });

	  popup.find('[data-role="facebook"]').attr('href',facebook)
	  popup.find('[data-role="twitter"]').attr('href',twitter)
	  popup.find('[data-role="naver"]').attr('href',naver)
	  popup.find('[data-role="kakaostory"]').attr('href',kakaostory)
	  popup.find('[data-role="email"]').attr('href',email)

		//카카오 링크
		function sendLink() {
			Kakao.Link.sendDefault({
				objectType: 'feed',
				content: {
					title: sbj,
					description: desc,
					imageUrl: imageUrl,
					link: {
						mobileWebUrl: link,
						webUrl: link
					}
				},
				buttons: [
					{
						title: '바로가기',
						link: {
							mobileWebUrl: link,
							webUrl: link
						}
					},
				]
			});
		}

		//카카오톡 링크공유
		kakao_link_btn.click(function() {
			 sendLink()
		 });

	})


});
</script>
