<link href="<?php echo $g['url_module_skin']?>/_main.css" rel="stylesheet">

<!-- 헤더 코드가 있을 경우 -->
<?php if (is_file($g['add_header_inc'])):?>
<?php include $g['add_header_inc']; ?>
<?php endif?>

<section class="rb-bbs rb-bbs-list">

    <div class="rb-bbs-heading d-flex align-items-center">

        <h1 class="my-0"><i class="fa fa-circle-o text-primary align-middle" aria-hidden="true"></i> <?php echo $B['name']?></h1>

        <div class="ml-auto" role="toolbar" aria-label="...">

            <!-- 카테고리 출력부  -->
            <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
            <select class="rb-category selectpicker" onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
                <option value=""><?php echo $_catexp[0]?></option>
                <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
                <option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
                <?php endfor?>
            </select>
            <?php endif?>

            <form class="form-inline" name="bbssearchf" action="/<?php echo $g['s']?>">
              <input type="hidden" name="r" value="<?php echo $r?>">
              <input type="hidden" name="c" value="<?php echo $c?>">
              <input type="hidden" name="m" value="<?php echo $m?>">
              <input type="hidden" name="bid" value="<?php echo $bid?>">
              <input type="hidden" name="cat" value="<?php echo $cat?>">
              <input type="hidden" name="sort" value="<?php echo $sort?>">
              <input type="hidden" name="orderby" value="<?php echo $orderby?>">
              <input type="hidden" name="recnum" value="<?php echo $recnum?>">
              <input type="hidden" name="type" value="<?php echo $type?>">
              <input type="hidden" name="iframe" value="<?php echo $iframe?>">
              <input type="hidden" name="skin" value="<?php echo $skin?>">
              <div class="form-group">
                <label class="sr-only" for="">검색조건</label>
                <select class="form-control custom-select" id="" style="width: 120px"  name="where">
                  <option value="subject"<?php if($where=='subject'):?> selected="selected"<?php endif?>>제목</option>
                  <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
                  <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
                  <option value="term"<?php if($where=='term'):?> selected="selected"<?php endif?>>등록일</option>
                  <option data-divider="true"></option>
                  <option>전체</option>
                </select>
              </div>
              <div class="form-group pl-1">
                <label class="sr-only" for="">검색어</label>
                <input type="text" name="keyword" class="form-control" id="" placeholder="검색어 입력" value="<?php echo $_keyword?>">
              </div>
              <button type="submit" class="btn btn-secondary ml-1" role="button">검색</button>
              <?php if($keyword):?><button class="btn btn-secondary ml-1" type="button" onclick="this.form.keyword.value='';this.form.submit();">리셋</button><?php endif?>
            </form>
        </div>
    </div>
    <div class="rb-bbs-body">
        <table class="table">
          <colgroup>
            <col width="60">
            <col width="30">
            <col>
            <col width="80">
            <col width="150">
            <col width="70">
          </colgroup>
          <thead>
            <tr>
              <th class="rb-num">번호</th>
              <th class="rb-title" colspan="2">제목</th>
              <th class="rb-user">작성자</th>
              <th class="rb-time">작성일</th>
              <th class="rb-hit">조회</th>
            </tr>
          </thead>
            <tbody>
               <!-- 공지사항 출력부  -->
              <?php foreach($NCD as $R):?>
              <?php $R['mobile']=isMobileConnect($R['agent'])?>
              <tr class="rb-notice">
                  <th class="rb-num" scope="row"><span class="label">공지</span></th>
                  <td>
                    <?php if($R['upload']):?><span class="label" data-toggle="tooltip" title="첨부파일"><img src="<?php echo $g['img_module_skin']?>/ico_attach.png" alt="첨부파일"></span><?php endif?>
                  </td>
                  <td class="rb-title">
                      <?php if($R['category']):?><span class="rb-category"><?php echo $R['category']?></span><?php endif?>
                      <a href="<?php echo $g['bbs_view'].$R['uid']?>"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?><?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span><?php endif?></a>
                      <?php if(strstr($R['content'],'.jpg')):?><span class="label" data-toggle="tooltip" title="사진"><i class="fa fa-camera-retro fa-lg"></i></span><?php endif?>
                      <?php if($R['mobile']):?><span class="label" data-toggle="tooltip" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다"><i class="fa fa-mobile fa-lg"></i></span><?php endif?>
                      <?php if(getNew($R['d_regis'],24)):?><span class="rb-new"></span><?php endif?>
                      <?php if($R['comment']):?><code>[<?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?>]</code><?php endif?>
                  </td>
                  <td class="rb-user">
                      <?php echo $R[$_HS['nametype']]?>
                  </td>
                  <td class="rb-time"><?php echo getDateFormat($R['d_regis'],'Y-m-d')?></td>
                  <td class="rb-hit"><?php echo $R['hit']?></td>
              </tr>
             <?php endforeach?>

              <!-- 일반글 출력부 -->
              <?php foreach($RCD as $R):?>
              <?php $R['mobile']=isMobileConnect($R['agent'])?>
              <tr>
                  <th class="rb-num" scope="row">
                      <?php if($R['uid'] != $uid):?>
                      <?php echo $NUM-((($p-1)*$recnum)+$_rec++)?>
                      <?php else:$_rec++?>
                      <i class="fa fa-angle-double-right"></i>
                      <?php endif?>
                  </th>
                  <td>
                    <?php if($R['upload']):?><span class="label" data-toggle="tooltip" title="첨부파일"><img src="<?php echo $g['img_module_skin']?>/ico_attach.png" alt="첨부파일"></span><?php endif?>
                  </td>
                  <td class="rb-title<?php if($R['depth']):?> rb-reply-<?php echo $R['depth']?><?php endif?>">
                      <?php if($R['depth']):?><span><i class="fa fa-level-up fa-rotate-90"></i></span><?php endif?>
                      <?php if($R['category']):?><span class="rb-category"><?php echo $R['category']?></span><?php endif?>
                      <a href="<?php echo $g['bbs_view'].$R['uid']?>"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?><?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span><?php endif?></a>
                      <?php if(strstr($R['content'],'.jpg')):?><span class="label" data-toggle="tooltip" title="사진"><i class="fa fa-camera-retro fa-lg"></i></span><?php endif?>
                      <?php if($R['mobile']):?><span class="label" data-toggle="tooltip" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다"><i class="fa fa-mobile fa-lg"></i></span><?php endif?>
                      <?php if(getNew($R['d_regis'],24)):?><span class="rb-new"></span><?php endif?>
                      <?php if($R['comment']):?><code>[<?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?>]</code><?php endif?>
                  </td>
                  <td class="rb-user">
                    <?php echo $R[$_HS['nametype']]?>
                  </td>
                  <td class="rb-time"><?php echo getDateFormat($R['d_regis'],'Y-m-d')?></td>
                  <td class="rb-hit"><?php echo $R['hit']?></td>
              </tr>
              <?php endforeach?>
            </tbody>
        </table>
    </div>
    <div class="rb-bbs-footer d-flex justify-content-between py-3">
      <div>

      </div>
      <nav class="rb-pagination">
          <ul class="pagination">
              <?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,'')?>
          </ul>
      </nav>
      <div class="rb-buttons">
          <a href="<?php echo $g['bbs_write']?>" class="btn btn-secondary">글쓰기</a>
      </div><!-- /.d-flex -->

    </div>
</section>



<!-- theme js -->
<script src="<?php echo $g['url_module_skin']?>/_main.js"></script>
