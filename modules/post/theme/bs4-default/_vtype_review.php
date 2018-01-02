<div class="rb-viewtype-review">
    <ul class="list-unstyled">
        <?php while($R=db_fetch_array($RCD)):?>
        <?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>

        <li class="media blog-post mb-4">

          <?php if($R['content_format'] == 3):?>

            <?php
                $img='';
                if($R['upload'])
                {
                    $img=getYoutubeImageSrc($R,150,100); // sys.func.php 파일 참조  가로,세로
                }
            ?>
            <a class="d-flex mr-3 rb-overlay" href="<?php echo $g['blog_view'].$R['uid'] ?>">
              <img src="<?php echo $img?>" alt="<?php echo $R['subject']?>">
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
                    $img_data=array('src'=>$img,'width'=>'150','height'=>'100','qulity'=>'90','filter'=>'','align'=>'');
                }
            ?>
            <?php if($img):?>

            <a href="<?php echo $g['blog_view'].$R['uid'] ?>" class="d-flex mr-3">
                <img class="" src="<?php echo getTimThumb($img_data)?>" alt="<?php echo $R['subject']?>">
            </a>
            <?php endif?>
          <?php endif?>


            <div class="media-body">
                <h4 class="mt-0 mb-1">
                    <a class="muted-link" href="<?php echo ($rwcat?$g['blog_home_rw'].'/category/'.$rwcat.'/':$g['blog_view']).$R['uid']?>"><?php echo $R['subject']?></a>
                </h4>
                <p class="mb-1"><?php echo $R['review']?getStrCut(getStripTags($R['review']),$d['blog']['rlength'],'..'):getStrCut(getStripTags($R['content']),$d['blog']['rlength'],'..')?></p>
                <ul class="list-inline f12 text-gray">
                    <li class="list-inline-item" data-toggle="tooltip" title="발행시간"><abbr class="rb-date updated">
                      <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo getTimeagoDate($R['d_published'],'d_published')?></abbr>
                    </li>
                    <li class="list-inline-item" data-toggle="tooltip" title="작성자"><span class="rb-popover rb-help" data-placement="top" data-content="" title=""><i class="fa fa-user" aria-hidden="true"></i> <?php echo $_M[$_HS['nametype']]?></span></li>
                    <?php if(IsPostCat($B['uid'],$R['uid'])):?>
                    <li class="list-inline-item">
                      <a class="muted-link" href="<?php echo getPostCatLink($B['uid'],$R['uid']);?>" class="rb-tooltip" title="분류">
                        <i class="fa fa-folder-o" aria-hidden="true"></i>
                        <?php echo getPostCatName($B['uid'],$R['uid']);?>
                      </a>
                    </li>
                    <?php endif?>
                    <li class="list-inline-item">
                      <a class="muted-link" href="<?php echo $g['blog_view'].$R['uid']?>#comments" data-toggle="tooltip" title="댓글">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                        <?php echo $R['comment']?>
                      </a>
                    </li>
                </ul>
            </div>
        </li>
        <?php endwhile?>
    </ul>
</div>
