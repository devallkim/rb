<?php
$sqlque	= 'uid';
$sqlque .= getSearchSql('name|caption|description',$keyword,'','or'); // 페이지코드와 페이지명 검색
$sqlque .=' and hidden=0'; // 노출파일만
$sqlque .=' and (type=0 or type=5 or type=8)'; // 기타파일
$orderby = 'desc';		//	(desc 최신순 / asc 오래된순)

$c_recnum = 3; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;

if($_iscallpage):
$RCD = getDbArray($table['s_upload'],$sqlque,'*','uid',$orderby,$d['search']['num'.($swhere=='all'?1:2)],$p);
?>

<div id="rb-search-search-video">
	<div class="card-deck">
		<?php while($_R=db_fetch_array($RCD)):?>

    <?php
      $src='';
      $src=$_R['url'].$_R['folder'].'/'.$_R['tmpname'];
    ?>

    <?php if ($_R['type']==5): ?>

      <div class="card">
        <video width="220" height="240" controls>
          <source src="<?php echo $src ?>" type="video/<?php echo $_R['ext'] ?>">
        </video>
      </div>

    <?php elseif ($_R['type']==8): ?>

      <?php
      $width=600;
      $height=250;
      $img_data='/files/youtube/'.$_R['name'].'/thumb_'.$width.'x'.$height.'.jpg';
      ?>
      <div class="card mb-0" role="button" data-toggle="modal" data-target="#modal-vod" data-backdrop="static" data-vid="<?php echo $_R['name']?>" data-uid="<?php echo $_R['uid']?>" data-title="<?php echo $_R['caption']?>" data-regis="<?php echo getDateFormat($_R['d_regis'],'Y.m.d')?>">
          <img class="card-img-top img-fluid" src="<?php echo $img_data?>" alt="">
					<div class="card-img-overlay mejs__overlay">
						<span class="mejs__overlay-button"></span>
						<p class="card-text mb-0"><?php echo $_R['caption']?></p>
						<span class="rb-time"><?php echo $_R['time']?></span>
					</div>
      </div>


    <?php else: ?>

      <div class="card" data-toggle="modal" data-target="#modal-vod" data-vid="<?php echo $_R['name']?>" data-title="<?php echo $_R['caption']?>" data-role="button">
  			<img class="card-img-top img-fluid" src="/files/youtube/<?php echo $_R['name']?>/thumb_500x250.jpg" alt="" >
  			<div class="card-icon-overlay">
  				<span class="rb-backdrop"></span>
  				<!-- <i class="fa fa-play-circle-o" aria-hidden="true"></i> -->
				<img src="/layouts/bs4-kfm/_images/btn_play_media_news.png" alt="동영상 재생 버튼" class="btn_media_play">
  				<span class="rb-time"><?php echo getFeaturedimgMeta($R,'time') ?></span>
  			</div>
			<div class="txt">
				<p class="card-text mb-0"><?php echo $_R['caption']?></p>
				<p class="card-text mb-0"><?php echo $_R['description']?></p>
			</div>
  		</div><!-- /.card -->

    <?php endif; ?>


		<?php endwhile?>
	</div>

</div>


<script>

$(function() {

	// 현재 클릭한 카드에 focus 상태를 적용함
	$('.card[role="button"]').click(function(){
	  $(this).attr('tabindex','-1').focus();
	});

	$('#modal-vod').on('shown.rc.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var title = button.data('title') // Extract info from data-* attributes
	  var vid = button.data('vid')
	  var modal = $(this)
	  modal.find('.content').html('<video class="mejs-player" style="max-width:100%;" preload="none"><source src="https://www.youtube.com/embed/' + vid + '" type="video/youtube"></video>');
	  modal.find('.mejs-player').mediaelementplayer();
	})

	$('#modal-vod').on('hidden.rc.modal', function (event) {
	  var modal = $(this)
	  modal.find('.content').html('');
	})

});
</script>

<hr>

<?php
endif;
$_ResultArray['num'][$_key] = getDbRows($table['s_upload'],$sqlque);
?>
