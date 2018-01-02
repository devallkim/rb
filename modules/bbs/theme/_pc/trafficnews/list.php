
<link href="<?php echo $g['url_module_skin']?>/_main.css" rel="stylesheet">
<section class="rb-bbs rb-bbs-list mt-3">

  <p>경기지역 유일의 민영라디오 방송인 KFM99.9는 수도권 전역의 교통난을 해소시키고자 경기도와 손잡고 다채로운 교통방송을 실시합니다. 매시 27분, 57분 교통정보 제공은 물론이고 아침, 저녁 출퇴근 시간대에 교통방송 프로그램을 편성해 실시간 교통상황과 함께 다양한 교통정보도 제공해 드리고 있습니다.</p>
  <p>06:00~08:00 굿모닝 코리아, 18:00~20:00 유연채의 시사999</p>
  <p>토,일 주말에는 주5일제에 따른 나들이 차량을 위한 온종일&nbsp;교통생방송프로그램으로 실시간 교통정보를 전해드리고&nbsp;아울러 설,추석 명절 때는&nbsp;연휴 내내 24시간 특집 교통 생방송으로 청취자 여러분의 안전한 귀성, 귀경길이 되도록 최선을 다하고 있습니다.</p>


  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#today" role="tab">2017년 1월 3일&nbsp;화요일</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#all" role="tab">전체 교통정보</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="today" role="tabpanel">

      <table class="table">
        <colgroup>
          <col width="20%">
          <col width="10%">
          <col>
          <col width="10%">
        </colgroup>
        <thead>
          <tr>
            <th>시간</th>
            <th>정보</th>
            <th>구간</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-muted">09:38</th>
            <td><span class="tag tag-warning">서행</span></td>
            <td class="text-xs-left">서울 외곽 순환도로 구리-판교-일산방향 청계 터널부근 (4차로) 버스 관련 고장차 처리중</td>
          </tr>

        </tbody>
      </table>


    </div><!-- /.tab-pane -->
    <div class="tab-pane" id="all" role="tabpanel">

      <table class="table" summary="번호,제목,작성일,조회수,첨부 항목을 포함한 목록">
          <colgroup>
              <col width="20%"></col>
              <col width="10%"></col>
              <col></col>
              <col width="15%"></col>
          </colgroup>
          <thead>
              <tr class="active">
                  <th class="text-center">시간</th>
                  <th class="text-center">정보</th>
                  <th class="text-center">구간</th>
                  <?php if($my['admin']):?><th class="text-center">리포터</th><?php endif?>
              </tr>
          </thead>
          <tbody>

           <!-- 공지사항 출력부  -->
          <?php foreach($NCD as $R):?>
          <?php $R['mobile']=isMobileConnect($R['agent'])?>
          <tr class="active">
              <td class="text-center">
                  <?php if($R['uid'] != $uid):?>
                     <span class="label label-info">공지</span>
                  <?php else:?>
                     <span class="now">&gt;&gt;</span>
                  <?php endif?>
              </td>
              <td><?php if($R['category']):?><span class="text-danger">[<?php echo $R['category']?>]</span><?php endif?></td>
              <td>
                  <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                   <?php if(getNew($R['d_regis'],24)):?><span class="label label-danger"><small>New</small></span><?php endif?>
              </td>
              <td class="text-center"><?php echo $R[$_HS['nametype']]?></a></td>
              <td class="text-center"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
          </tr>
         <?php endforeach?>

          <!-- 일반글 출력부 -->
          <?php foreach($RCD as $R):?>
          <?php $R['mobile']=isMobileConnect($R['agent'])?>
          <tr>
              <td class="text-center">
                  <?php if($R['uid'] != $uid):?>
                      <?php echo getDateFormat($R['d_regis'],'Y.m.d H:i') ?>
                 <?php else:$_rec++?>
                     <span class="now">&gt;&gt;</span>
                  <?php endif?>
              </td>
              <td><?php if($R['category']):?>
                <span class="tag
                <?php if($R['category'] == '원할'):?> tag-success
                <?php elseif($R['category'] == '서행'):?>tag-warning
                <?php elseif($R['category'] == '정체'):?>tag-danger
                <?php elseif($R['category'] == '사고'):?>tag-danger
                <?php else:?> tag-default<?php endif?>"><?php echo $R['category']?></span><?php endif?></td>
              <td class="text-xs-left">
                <?php if($my['admin']):?>
                <a href="<?php echo $g['bbs_view'].$R['uid']?>"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?></a>
                <?php else:?>
                <?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?>
                <?php endif?>
                <?php if(getNew($R['d_regis'],24)):?><span class="text-danger"><small>New</small></span><?php endif?>
              </td>
              <?php if($my['admin']):?>
              <td class="text-center"><?php echo $R[$_HS['nametype']]?></a></td>
              <?php endif?>
          </tr>
         <?php endforeach?>
        </tbody>
      </table>


      <div class="row">
        <div class="col-xs-8 offset-xs-2 text-xs-center">
          <span class="pagination pagination-sm"><?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,'')?></span>
        </div>
        <div class="col-xs-2 text-xs-right">

        </div>
      </div>

    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->

  <p class="text-xs-right"><a class="btn btn-secondary" href="<?php echo $g['bbs_write']?>"><i class="fa fa-pencil"></i> 등록</a></p>





</section>
