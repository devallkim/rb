
<section class="rb-bbs-list">
  <div class="panel panel-default rb-panel-table">


      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">
          <small>총게시물 : <strong><?php echo number_format($NUM+count($NCD))?></strong> 건  (<?php echo $p?>/<?php echo $TPG?> page) </small>
        </span>
        <!-- 검색창 출력부  -->
        <?php if($d['theme']['search']):?>
        <form class="form-inline" name="bbssearchf" action="<?php echo $g['s']?>/">
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

          <!-- 카테고리 출력부  -->
          <?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
          <select name="category" class="form-control custom-select mr-2" onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
            <option value="">
              <?php echo $_catexp[0]?>
            </option>
            <?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
            <option value="<?php echo $_catexp[$i]?>" <?php if($_catexp[$i]==$cat):?> selected="selected"
            <?php endif?>>
            <?php echo $_catexp[$i]?>
            <?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)
            <?php endif?>
            </option>
            <?php endfor?>
          </select>
          <?php endif?>

          <div class="input-group">
            <select class="custom-select" name="where">
              <option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
              <option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
              <option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
              <option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
              <option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
              <option value="term"<?php if($where=='term'):?> selected="selected"<?php endif?>>등록일</option>
            </select>
            <input type="text" class="form-control" name="keyword" value="<?php echo $_keyword?>" placeholder="검색어를 입력해주세요">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">검색</button>
            </div>
          </div>
        </form>
        <?php endif?>
      </div><!-- /.d-flex -->

    <!-- .panel-body -->
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <colgroup>
          <col width="10%"></col>
          <col></col>
          <col width="13%"></col>
          <col width="15%"></col>
          <col width="10%"></col>
        </colgroup>
        <thead>
          <tr>
            <th>번호</th>
            <th>제목</th>
            <th>글쓴이</th>
            <th>작성일</th>
            <th>조회</th>
          </tr>
        </thead>
        <tbody>
          <!-- 공지사항 출력부  -->
          <?php foreach($NCD as $R):?>
            <?php $R['mobile']=isMobileConnect($R['agent'])?>
              <tr class="active">
                <td>
                  <?php if($R['uid'] != $uid):?>
                    <span class="label label-info">공지</span>
                    <?php else:?>
                      <span class="now">&gt;&gt;</span>
                      <?php endif?>
                </td>
                <td>
                  <?php if($R['mobile']):?><i class="fa fa-mobile fa-lg"></i>
                    <?php endif?>
                      <?php if($R['category']):?><span class="text-danger">[<?php echo $R['category']?>]</span>
                        <?php endif?>
                          <a href="<?php echo $g['bbs_view'].$R['uid']?>">
                            <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                          </a>
                          <?php if(strstr($R['content'],'.jpg')):?><i class="fa fa-image fa-lg"></i>
                            <?php endif?>
                              <?php if($R['upload']):?><i class="glyphicon glyphicon-floppy-disk glyphicon-lg"></i>
                                <?php endif?>
                                  <?php if($R['hidden']):?><i class="fa fa-lock fa-lg"></i>
                                    <?php endif?>
                                      <?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span>
                                        <?php endif?>
                                          <?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span>
                                            <?php endif?>
                                              <?php if(getNew($R['d_regis'],24)):?><span class="label label-danger"><small>New</small></span>
                                                <?php endif?>
                </td>
                <td>
                  <?php echo $R[$_HS['nametype']]?>
                    </a>
                </td>
                <td>
                  <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                </td>
                <td>
                  <?php echo $R['hit']?>
                </td>
              </tr>
              <?php endforeach?>
                <!-- 일반글 출력부 -->
                <?php foreach($RCD as $R):?>
                  <?php $R['mobile']=isMobileConnect($R['agent'])?>
                    <tr>
                      <td>
                        <?php if($R['uid'] != $uid):?>
                          <?php echo $NUM-((($p-1)*$recnum)+$_rec++)?>
                            <?php else:$_rec++?>
                              <span class="now">&gt;&gt;</span>
                              <?php endif?>
                      </td>
                      <td>
                        <?php if($R['mobile']):?><i class="fa fa-mobile fa-lg"></i>
                          <?php endif?>
                            <?php if($R['category']):?><span class="text-danger">[<?php echo $R['category']?>]</span>
                              <?php endif?>
                                <a href="<?php echo $g['bbs_view'].$R['uid']?>">
                                  <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                                </a>
                                <?php if(strstr($R['content'],'.jpg')):?><i class="fa fa-image fa-lg"></i>
                                  <?php endif?>
                                    <?php if($R['upload']):?><i class="glyphicon glyphicon-floppy-disk glyphicon-lg"></i>
                                      <?php endif?>
                                        <?php if($R['hidden']):?><i class="fa fa-lock fa-lg"></i>
                                          <?php endif?>
                                            <?php if($R['comment']):?><span class="badge"><?php echo $R['comment']?><?php echo $R['oneline']?'+'.$R['oneline']:''?></span>
                                              <?php endif?>
                                                <?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span>
                                                  <?php endif?>
                                                    <?php if(getNew($R['d_regis'],24)):?><span class="label label-danger"><small>New</small></span>
                                                      <?php endif?>
                      </td>
                      <td>
                        <?php echo $R[$_HS['nametype']]?>
                          </a>
                      </td>
                      <td>
                        <?php echo getDateFormat($R['d_regis'],'Y.m.d')?>
                      </td>
                      <td>
                        <?php echo $R['hit']?>
                      </td>
                    </tr>
                    <?php endforeach?>
        </tbody>
      </table>
    </div>

    <footer class="d-flex justify-content-between align-items-center mb-3">

      <?php if($my['admin']):?>
      <a class="btn btn-danger" href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;front=skin&amp;theme=<?php echo $d['bbs']['skin']?>">
        <i class="fa fa-cog"></i> 관리
      </a>
      <?php endif?>

      <ul class="pagination mb-0">
        <?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,'')?>
      </ul>

      <a class="btn btn-light" href="<?php echo $g['bbs_write']?>"><i class="fa fa-pencil"></i> 등록</a>

    </footer>



  </div>
  <!-- .panel panel-default rb-panel-table -->
</section>
