<?php
if($uid)
{
   if($R['upload'])
   {
       $d['upload']=getArrayString($R['upload']);
       $hidden_file_num=0;// hidden 값이 1 인 첨부파일(이미지) 수량 체크
       foreach($d['upload']['data'] as $_val)
       {
            $U = getUidData($table[$m.'upload'],$_val);
            if($U['hidden']==1) $hidden_file_num++;
       }
   }
   $last_attach=$d['upload']['count']-$hidden_file_num;
   $M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*');
   $M2=getDbData($table['s_mbrid'],'uid='.$R['mbruid'],'*');

    // 아바타 사진 url 세팅
    if($M['photo']) $avatar_src=$g['url_root'].'/_var/avatar/'.$M['photo'];
    else  $avatar_src=$g['url_root'].'/_var/avatar/180.0.gif';
}
?>

<!-- 헤더 코드가 있을 경우 -->
<?php if (is_file($g['add_header_inc'])):?>
<?php include $g['add_header_inc']; ?>
<?php endif?>


<?php if($uid):?>
<!-- view 페이지 보여주기 -->
<?php include $g['dir_module_skin'].'view.php';?>
<?php else:?>

<section class="rb-module-post">

  <div class="pagehead">
    <div class="container d-flex justify-content-start align-items-center">

      <h1>
        <a class="blog-title" href="<?php echo $g['blog_home'] ?>">
          <?php echo $B['name']?>
        </a>
        <?php if($cat):?>
        <?php include $g['dir_module_skin'].'cat-top.php';?>
        <?php endif?>
        <?php if($where && $keyword):?>
        <?php include $g['dir_module_skin'].'keyword-top.php';?>  <!-- 키워드검색 Top 영역 -->
        <?php endif?>
      </h1>

      <form class="form-inline ml-auto" name="ListForm" action="<?php echo $g['s']?>/" method="get">
        <input type="hidden" name="r" value="<?php echo $r?>">
        <input type="hidden" name="m" value="<?php echo $m?>">
        <input type="hidden" name="set" value="<?php echo $set?>">
        <input type="hidden" name="cat" value="<?php echo $cat?>">
        <input type="hidden" name="recnum" value="<?php echo $recnum?>">
        <div class="form-group">
          <label class="sr-only" for="">검색조건</label>
          <select class="form-control custom-select" id="" style="width: 120px" name="where">
            <option value="subject"<?php if($where=='subject'):?> selected="selected"<?php endif?>>제목</option>
            <option value="review"<?php if($where=='review'):?> selected="selected"<?php endif?>>요약</option>
            <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
          </select>
        </div>
        <div class="form-group pl-1">
          <label class="sr-only" for="">검색어</label>
          <input type="text" name="keyword" class="form-control" id="" placeholder="검색어 입력" value="<?php if($where !== 'mbruid'):?><?php echo $_keyword?><?php endif?>">
        </div>
        <button type="submit" class="btn btn-secondary d-none" role="button">검색</button>
        <?php if($keyword):?><button class="btn btn-secondary ml-1" type="button" role="button" onclick="this.form.keyword.value='';this.form.submit();">리셋</button><?php endif?>

      </form>

    </div><!-- /.container -->
  </div><!-- /.pagehead -->

  <div class="container clearfix">

    <div class="blog-aside">

      <?php include $g['dir_module_skin'].'_aside.php';?>

    </div><!-- /.blog-aside -->

    <div class="blog-content">

      <?php if($where=='term' && $_date):?>
      <ol class="breadcrumb">
         <li><i class="fa fa-archive"></i> <a href="<?php echo $g['blog_front'].'archive'?>">아카이브</a></li>
         <li><a href="<?php echo $g['blog_front']?>list&amp;where=term&amp;_date=<?php echo $_date?>"><?php echo substr($_date,0,4 )?>년</a></li>
         <li class="active"><?php echo substr($_date,4,2)?>월</li>
       </ol>
      <?php endif?>

      <!-- posts -->
      <div class="posts">
        <?php include $g['dir_module_skin'].'_vtype_'.$vtype.'.php' ?>
        <?php if(!$NUM && ($vtype=='review' || $vtype=='gallery')): ?>
        <div class="blankslate blankslate-spacious blankslate-large text-gray-light">
           <i class="fa fa-exclamation-circle fa-4x"></i>
           <h3>등록된 포스트가 없습니다.</h3>
           <?php if($my['admin'] || $d['blog']['writeperm']):?>
           <p>
             새 포스트를 등록해 주세요.
             <a href="<?php echo $g['blog_front']?>write">새 포스트 쓰기</a>
           </p>
           <?php endif?>
        </div>
        <?php endif?>
      </div>
      <!-- / .posts-->

      <?php if ($NUM): ?>
        <nav class="my-4">
          <ul class="pagination justify-content-center" class="m-0">
            <?php echo getPageLink(5,$p,$TPG,'','')?>
          </ul>
        </nav>
      <?php endif; ?>

      <article class="">
        <!-- 오디오 -->
        <?php if($attach_audio_num>0):?>
        <div class="mt-2 mb-4">
          <ul class="list-group mb-2 px-0">
            <?php foreach($audio_files as $_u):?>
            <?php if($_u['hidden']) continue?>
            <li class="list-group-item justify-content-between bg-faded">
              <audio controls class="align-middle">
                <source src="<?php echo $_u['url']?><?php echo $_u['folder']?>/<?php echo $_u['tmpname']?>" type="audio/<?php echo $_u['ext']?>">
              </audio>
            <span class="badge badge-secondary badge-pill"><?php echo $_u['name']?></span>
            </li>
            <?php endforeach?>
          </ul>
        </div>
        <?php endif?>

        <?php if ($R['review']): ?>
          <blockquote>
            <?php echo $R['review'] ?>
          </blockquote>
        <?php endif; ?>

        <!-- 사진 -->
        <?php if($attach_photo_num>0):?>

          <ul class="list-inline float-right">
            <?php foreach($img_files as $_u):?>
            <?php
              $img_origin=$_u['tmpname'];
              $thumb_list=getPreviewResize($img_origin,''); // 미리보기 사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
              $thumb_modal=getPreviewResize($img_origin,''); // 정보수정 모달용  사이즈 조정 (이미지 업로드시 썸네일을 만들 필요 없다.)
            ?>
              <li class="list-inline-item">
                <img src="<?php echo $_u['url'] ?><?php echo$_u['folder'] ?>/<?php echo $_u['tmpname'] ?>" alt="">
              </li>
            <?php endforeach?>
          </ul>
        <?php endif?>

         <?php echo getContents($R['content'],'HTML')?>

      </article>


    </div><!-- /.blog-content -->
  </div><!-- /.container -->

</section>
<?php endif?>

<!-- 풋터 코드가 있을 경우 -->
<?php if (is_file($g['add_footer_inc'])):?>
<?php include $g['add_footer_inc']; ?>
<?php endif?>
