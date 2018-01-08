<style>
.rb-viewtype-review .card {
  position: relative;
}
.rb-viewtype-review .card img {
  height: 134px
}

.rb-viewtype-review .card:focus{
  outline: thin dotted;
  outline: 5px auto -webkit-focus-ring-color;
  outline-offset: -2px;
  -webkit-box-shadow: 0 0 0 4px rgba(2,117,216,.55);
  box-shadow: 0 0 0 4px rgba(2,117,216,.55);
}

.rb-viewtype-review .card-icon-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 134px;
  padding-top: 18px;
  text-align: center;
  font-size: 70px;
  color: #fff;

}
.rb-backdrop {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom:0;
  /*height: 134px;*/
  background-color: rgba(0, 0, 0, 0.2);
}


.rb-viewtype-review .card-icon-overlay .rb-time {
  position: absolute;
  right: 0;
  bottom: 0;
  padding: 2px 5px;
  background-color: #222;
  color: #fff;
  font-size: 12px
}

.rb-viewtype-review .card-icon-overlay .fa {
  position: absolute;
  top: 30px;
  left: 0;
  right: 0;
  opacity: .9;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
}
.rb-viewtype-review .card-icon-overlay .fa:hover {
  opacity: 1
}

.rb-viewtype-review .card-img-overlay {
  top: auto;
  width: 100%;
  padding: 0;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.7);
}
.rb-viewtype-review .card-img-overlay .card-block {
  padding: 1rem;
  background-color: transparent;
}
.rb-viewtype-review .card-img-overlay .card-title a {
  color: #fff;
  line-height: 1.3
}
.rb-viewtype-review .tag-default {
  background-color: #eee;
  color: #004283
}
.rb-viewtype-review .tag-default strong {
  font-weight: normal;
  color: #00abeb
}

.rb-viewtype-review .card .badge {
  font-size: 11px;
  font-family: NanumBarunGothic;
  font-weight: normal;
  padding: 3px 6px
}

.rb-viewtype-review .card .badge::before,
.rb-viewtype-review .card .badge::after {
  content: none
}

.rb-viewtype-review .card .badge-default {
  background-color: #fff;
  color: #004283
}
.rb-viewtype-review .card .badge-default i {
  color: #00abeb;
  font-style: normal;
}
.rb-viewtype-review .card .badge-danger {
  background-color: #f51a1a;
  color: #fff
}
</style>

<?php

$c_recnum = 3; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;
?>

<!-- http://www.mediaelementjs.com/ -->
<?php getImport('mediaelement','build/mediaelementplayer','3.0.3','css') ?>

<?php getImport('mediaelement','build/mediaelement-and-player.min','3.0.3','js') ?>
<?php getImport('mediaelement','build/lang/ko','3.0.3','js') ?>


<h3 class="text-primary h4 mb-4">동영상 뉴스</h3>

<div class="rb-viewtype-review card-deck-wrapper mb-3">
    <div class="card-deck mb-4">
        <?php $i=0;while($R=db_fetch_array($RCD)):$i++?>

        <?php
            $img='';
            if($R['upload'])
            {
                $img=getYoutubeImageSrc($R,500,250); // sys.func.php 파일 참조  가로,세로
            }
        ?>

          <div class="card">

            <img class="card-img-top img-fluid" src="<?php echo $img?>" alt="<?php echo $R['subject']?>">
            <div class="card-icon-overlay" role="button" data-toggle="modal" data-target="#modal-video" data-vid="<?php echo getFeaturedimgMeta($R,'name') ?>" data-title="<?php echo $R['subject']?>"  data-uid="<?php echo $R['uid']?>" data-regis="<?php echo $R['d_regis']?>"  data-markup="news-modalView" data-register="관리자" >
              <span class="rb-backdrop"></span>
              <i class="fa fa-play-circle-o" aria-hidden="true"></i>
              <span class="rb-time"><?php echo getFeaturedimgMeta($R,'time') ?></span>
            </div>

            <div class="card-block">
              <h4 class="card-title">
                <a href="<?php echo ($rwcat?$g['blog_home_rw'].'/category/'.$rwcat.'/':$g['blog_view']).$R['uid']?>"><?php echo $R['subject']?></a></h4>
              <p class="card-text">
                <span class="badge badge-pill badge-default">KFM <strong>99.9</strong></span>
                <span class="badge badge-pill badge-danger">Youtube</span>
              </p>
            </div>


          </div><!-- /.card -->

          <?php
            $print_card_num++; // 카드 출력될 때마 1씩 증가
            $lack_card_num = $total_card_num - $print_card_num;
           ?>

           <?php if(!($i%$c_recnum)):?></div><div class="card-deck mb-3"><?php endif?>
           <?php endwhile?>
           <?php if($lack_card_num ):?>
             <?php for($j=0;$j<$lack_card_num;$j++):?>
              <div class="card border-0"></div>
             <?php endfor?>
           <?php endif?>
    </div><!-- /.card-deck -->
</div><!-- /.card-deck-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">동영상 뉴스</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
        <header class="p-3 mb-4">
          <ul class="list-unstyled mb-0">
            <li><strong><span data-role="title"></span></strong></li>
            <li>등록일 : <span data-role="d_regis"></span></li>
          </ul>
        </header>
        <article class="km-video"></article>
        <article data-role="content"></article>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" role="button">닫기</button>
      </div>
    </div>
  </div>
</div>


<script>

// 현재 클릭한 카드에 focus 상태를 적용함
$('.card[role="button"]').click(function(){
  $(this).attr('tabindex','-1').focus();
});


  $('#modal-video').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var title = button.data('title') // Extract info from data-* attributes
    var vid = button.data('vid')
    var d_regis = button.data('regis')
    var register = button.data('register')
    var markup = button.data('markup')
    var uid = button.data('uid')
    var modal = $(this)
    modal.find('.modal-body [data-role="title"]').text(title)
    modal.find('[data-role="d_regis"]').text(d_regis)
    modal.find('.modal-body .km-video').html('<video autoplay class="mejs-player"  style="max-width:100%;" preload="none"><source src="https://www.youtube.com/embed/' + vid + '" type="video/youtube"></video>');
    modal.find('.mejs-player').mediaelementplayer();

    $.post('/?r=<?php echo $r ?>&m=<?php echo $m ?>&layoutPage=ajax/a.get_Component_Page',{
     uid : uid,
     markup : markup,
     register : register
    },function(response){
       var result = $.parseJSON(response);
       var content=result.content;
       modal.find('[data-role="content"]').html(content);
    });


  })

  $('#modal-video').on('hidden.bs.modal', function (event) {
    var modal = $(this)
    modal.find('.modal-body [data-role="title"]').text('')
    modal.find('[data-role="d_regis"]').text('')
    modal.find('.modal-body article').html('');
  })
</script>
