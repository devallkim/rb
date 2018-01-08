<?php

$c_recnum = 4; // 한 열에 출력할 카드 갯수
$totalCardDeck=ceil($NUM/$c_recnum); // card-deck 갯수 ($NUM 은 해당 데이타의 총 card 갯수 getDbRows 이용)
$total_card_num = $totalCardDeck*$c_recnum;// 총 출력되야 할 card 갯수(빈카드 포함)
$print_card_num = 0; // 실제 출력된 카드 숫자 (아래 card 출력될 때마다 1 씩 증가)
$lack_card_num = $total_card_num;


 ?>

<div class="rb-viewtype-review card-deck-wrapper">
    <div class="card-deck mb-4">
        <?php $i=0;while($R=db_fetch_array($RCD)):$i++?>

        <?php
            $img='';
            if($R['upload'])
            {
                $img=getUpImageSrc($R); // sys.func.php 파일 참조
                $img_data=array('src'=>$img,'width'=>'300','height'=>'200','qulity'=>'100','filter'=>'','align'=>'top');
            }
        ?>

          <div class="card">
            <?php if($img):?>
            <a href="<?php echo ($rwcat?$g['blog_home_rw'].'/category/'.$rwcat.'/':$g['blog_view']).$R['uid']?>">
              <img class="card-img-top img-fluid" src="<?php echo getTimThumb($img_data)?>" alt="<?php echo $R['subject']?>">
            </a>
            <?php endif?>
            <div class="card-block">
              <h4 class="card-title"><a href="<?php echo ($rwcat?$g['blog_home_rw'].'/category/'.$rwcat.'/':$g['blog_view']).$R['uid']?>"><?php echo $R['subject']?></a></h4>
              <ul class="rb-meta list-inline">
                  <li class="list-inline-item" data-toggle="tooltip" title="발행시간"><abbr class="rb-date updated"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo getDateFormat($R['d_published'],'Y.m.d') ?></abbr></li>
                  <?php if(IsPostCat($B['uid'],$R['uid'])):?>
                  <li class="list-inline-item"><a href="<?php echo getPostCatLink($B['uid'],$R['uid']);?>" class="rb-tooltip" title="분류"><i class="fa fa-folder-o" aria-hidden="true"></i> <?php echo getPostCatName($B['uid'],$R['uid']);?></a></li>
                  <?php endif?>
                  <li class="list-inline-item"><a href="<?php echo $g['blog_view'].$R['uid']?>#comment" data-toggle="tooltip" title="댓글"><i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo $R['comment']?></a></li>
              </ul>
            </div>
          </div><!-- /.card -->

          <?php
            $print_card_num++; // 카드 출력될 때마 1씩 증가
            $lack_card_num = $total_card_num - $print_card_num;
           ?>

           <?php if(!($i%$c_recnum)):?></div><div class="card-deck  mb-4"><?php endif?>
           <?php endwhile?>
           <?php if($lack_card_num ):?>
             <?php for($j=0;$j<$lack_card_num;$j++):?>
              <div class="card border-0"></div>
             <?php endfor?>
           <?php endif?>
    </div><!-- /.card-deck -->
</div><!-- /.card-deck-wrapper -->
