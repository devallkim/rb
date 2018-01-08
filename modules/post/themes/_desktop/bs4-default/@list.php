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
      
    // 아바타 사진 url 세팅
    if($M['photo']) $avatar_src=$g['url_root'].'/_var/avatar/'.$M['photo'];
    else  $avatar_src=$g['url_root'].'/_var/avatar/180.0.gif';
}
echo $blogque;
?>
<?php if($uid):?>
<!-- view 페이지 보여주기 -->
<?php include $g['dir_module_skin'].'view.php';?>
<?php endif?>
<section class="rb-blog rb-blog-list">
    <form name="ListForm" action="<?php echo $g['s']?>/" method="get">
        <input type="hidden" name="r" value="<?php echo $r?>" />
        <input type="hidden" name="m" value="<?php echo $m?>" />
        <input type="hidden" name="blog" value="<?php echo $blog?>" />
        <input type="hidden" name="cat" value="<?php echo $cat?>" />
        <input type="hidden" name="recnum" value="<?php echo $recnum?>" />
        <div class="rb-blog-heading">
            <?php if($cat):?>
                 <?php include $g['dir_module_skin'].'cat-top.php';?>  <!-- 카테고리 Top 영역 -->       
            <?php endif?>
            <?php if($where && $keyword):?>
                <?php include $g['dir_module_skin'].'search-top.php';?>  <!-- 검색 Top 영역 -->                            
            <?php endif?>
            <?php if($where=='term' && $_date):?>
            <ol class="breadcrumb">
               <li><i class="fa fa-archive"></i> <a href="<?php echo $g['blog_front'].'archive'?>">아카이브</a></li>
               <li><a href="<?php echo $g['blog_front']?>list&amp;where=term&amp;_date=<?php echo $_date?>"><?php echo substr($_date,0,4 )?>년</a></li>
               <li class="active"><?php echo substr($_date,4,2)?>월</li>
             </ol>                         
            <?php endif?>
            <div class="btn-toolbar">
                <div class="btn-group btn-group-sm rb-sort" data-toggle="buttons">
                    <label class="btn btn-default<?php echo $sort=='d_published'?' active':''?>" onclick="btnFormSubmit(this);">
                        <input type="radio" name="sort" value="d_published"<?php if($sort=='d_published'):?> checked<?php endif?> id="d_published" autocomplete="off"> 발행순
                    </label>
                    <label class="btn btn-default<?php echo $sort=='hit'?' active':''?>" onclick="btnFormSubmit(this);">
                        <input type="radio" name="sort" value="hit"<?php if($sort=='hit'):?> checked<?php endif?> id="hit" autocomplete="off" > 조회순
                    </label>
                    <label class="btn btn-default<?php echo $sort=='comment'?' active':''?>" onclick="btnFormSubmit(this);">
                        <input type="radio" name="sort" value="comment"<?php if($sort=='comment'):?> checked<?php endif?> id="comment" autocomplete="off" > 댓글순
                    </label>
                </div>
                <div class="btn-group btn-group-sm rb-sort" data-toggle="buttons">
                    <label class="btn btn-default<?php if($orderby=='asc'):?> active<?php endif?>" data-toggle="tooltip" title="오름차순" onclick="btnFormSubmit(this);">
                        <input type="radio" name="orderby" value="asc"<?php if($orderby=='asc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-asc"></i> 정순
                    </label>
                    <label class="btn btn-default<?php if($orderby=='desc'):?> active<?php endif?>" data-toggle="tooltip" title="내림차순" onclick="btnFormSubmit(this);">
                        <input type="radio" name="orderby" value="desc"<?php if($orderby=='desc'):?> checked<?php endif?>> <i class="fa fa-sort-amount-desc"></i> 역순
                    </label>
                </div>
                <div class="btn-group btn-group-sm rb-viewtype" data-toggle="buttons">
                    <label class="btn btn-default <?php echo $vtype=='review'?'active':''?>" data-toggle="tooltip" title="미디어형" onclick="btnFormSubmit(this);">
                        <input type="radio" id="review" autocomplete="off" name="vtype" value="review"<?php if($vtype=='review'):?> checked<?php endif?> > <i class="fa fa-th-list fa-lg"></i>
                    </label>
                    <label class="btn btn-default <?php echo $vtype=='box'?'active':''?>" data-toggle="tooltip" title="박스형" onclick="btnFormSubmit(this);">
                        <input type="radio" id="box" autocomplete="off" name="vtype" value="box"<?php if($vtype=='box'):?> checked<?php endif?>> <i class="fa fa-th fa-lg"></i>
                    </label>
                    <label class="btn btn-default <?php echo $vtype=='list'?'active':''?>" data-toggle="tooltip" title="리스트형" onclick="btnFormSubmit(this);">
                        <input type="radio" id="list" autocomplete="off" name="vtype" value="list"<?php if($vtype=='list'):?> checked<?php endif?>> <i class="fa fa-bars fa-lg"></i>
                    </label>
                    <label class="btn btn-default hidden <?php echo $vtype=='gallery'?'active':''?>" data-toggle="tooltip" title="갤러리형" onclick="btnFormSubmit(this);">
                        <input type="radio" id="gallery" autocomplete="off" name="vtype" value="gallery"<?php if($vtype=='gallery'):?> checked<?php endif?>> <i class="fa fa-picture-o fa-lg"></i>
                    </label>
                    <label class="hidden btn btn-default <?php echo $vtype=='map'?'active':''?>" data-toggle="tooltip" title="지도형" onclick="btnFormSubmit(this);">
                        <input type="radio" id="map" autocomplete="off" name="vtype" value="map"<?php if($vtype=='map'):?> checked<?php endif?>> <i class="fa fa-map-marker fa-lg"></i>
                    </label>
                </div>
            </div>
        </div>
        <!-- blog-body -->
        <div class="rb-blog-body">
            <?php include $g['dir_module_skin'].'_vtype_'.$vtype.'.php'?>
            <?php if(!$NUM && ($vtype=='review' || $vtype=='gallery')):?>
            <div class="rb-nopost">
                 <h2 class=""><i class="fa fa-exclamation-circle fa-4x"></i></h2>
                 <p>등록된 자료가 없습니다.</p>
            </div>
            <?php endif?>
        </div>
        <!-- / blog-body -->
        <div class="rb-blog-footer">
            <nav>
                <ul class="pagination" style="margin: 0">
                  <?php echo getPageLink(5,$p,$TPG,'')?>                    
               </ul>
            </nav>

            <div class="rb-buttons">
                <div class="rb-left">
                    <div class="btn-group dropup">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-folder-o fa-fw"></i> 보관함 <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $g['blog_front']?>my_confirm"><i class="fa fa-folder-o fa-fw"></i> 승인함</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $g['blog_front']?>my_all"><i class="fa fa-folder-o fa-fw"></i> 전체 보관함</a></li>
                            <li><a href="<?php echo $g['blog_front']?>my_draft"><i class="fa fa-folder-o fa-fw"></i> 임시 보관함</a></li>
                        </ul>
                    </div>
                </div>
                <div class="rb-right">
                    <div class="btn-group">
                        <a class="btn btn-default" href="<?php echo $g['blog_front']?>write">
                            <i class="fa fa-pencil fa-fw"></i> 포스트 쓰기
                        </a>
                    </div>
                </div>              
            </div>

            <div class="rb-search">
                <hr>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="input-group">
                            <div class="input-group-btn search-panel dropup">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                  <span id="search_concept">검색조건</span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#01">제목+본문</a></li>
                                    <li><a href="#02">제목</a></li>
                                    <li><a href="#03">등록자 이름</a></li>
                                    <li><a href="#04">요약정보</a></li>
                                    <li><a href="#05">태그</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#all">전체</a></li>
                                </ul>
                            </div>
                            <input type="hidden" name="search_param" value="all" id="search_param">         
                            <input type="text" class="form-control" name="x" placeholder="검색어를 입력해 주세요">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function(e){
                            $('.search-panel .dropdown-menu').find('a').click(function(e) {
                            e.preventDefault();
                            var param = $(this).attr("href").replace("#","");
                            var concept = $(this).text();
                            $('.search-panel span#search_concept').text(concept);
                            $('.input-group #search_param').val(param);
                          });
                        });
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </form>
</section>


