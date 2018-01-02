<?php
$bbsque_group	= 'memberuid='.$_MH['uid'].' and bbstype=2';
$bbsque_note	= 'memberuid='.$_MH['uid'].' and bbstype=3';

if ($_IS_ORGMBR) {
  $sqlque	= 'auth=1 and owner='.$_MH['uid'];
} else {
  $sqlque	= 'auth=1 and hidden=0 and owner='.$_MH['uid'];
}



$NUM_GROUP = getDbRows($table['forummembers'],$bbsque_group);
$NUM_NOTE = getDbRows($table['forummembers'],$bbsque_note);

$org_mbr_total_num = $_MH['num_mbr']; // 전체구성원
$org_mbr_hidden_num = getDbRows($table['orgsmember'],'org='.$_MH['uid'].' and hidden=1'); // 숨김처리된 구성원
$org_mbr_public_num = $org_mbr_total_num-$org_mbr_hidden_num; // 공개된 구성원

$_IS_INVITE=getDbRows($table['orgsinvite'],'to_mbruid='.$my['uid'].' and org='.$_MH['uid'].' and accept=0');  // 초대장 발송 여부

$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 201 ? $recnum : 20;


if($dispType == 'ing') $sqlque .= ' and process=0';
if($dispType == 'end') $sqlque .= ' and process=1';
if($dispType == 'manager' ) $sqlque .= ' and manager='.$_MH['uid'];
if($dispType == 'owner' ) $sqlque .= ' and owner='.$_MH['uid'];

if($where && $keyw) $sqlque .= getSearchSql($where,$keyw,$ikeyword,'or');

$RCD = getDbArray($table['projectlist'],$sqlque,'*',$sort,$orderby,$recnum,$p);
$NUM_PROJECT = getDbRows($table['projectlist'],$sqlque);
$TPG = getTotalPage($NUM_PROJECT,$recnum);
$viewset = array(''=>'전체 프로젝트','ing'=>'개발중인 프로젝트','end'=>'서비스중인 프로젝트','my'=>'내 프로젝트','manager'=>'내가 매니저인 프로젝트','make'=>'내가 만든 프로젝트');
?>


<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">

<style media="screen">
.btn-primary:disabled,
.btn-primary.disabled {
	color: rgba(36,41,46,0.4);
	background-color: #eff3f6;
	background-image: none;
	border: 1px solid rgba(27,31,35,0.2);
	border-color: rgba(27,31,35,0.2);
	box-shadow: none;
}
.autocomplete-suggestions .autocomplete-suggestion:last-child {
	display: none
}
.auto-search-group .input-group-btn .btn.disabled {
	display: none
}
.searching .input-group-btn {
	/*display: block*/
}
.auto-search-group {
  position: relative;
}
.auto-search-group .fa {
  position: absolute;
  top: 12px;
  left: 10px;
  color: #999;
	z-index: 99
}
.auto-search-group .fa.fa-spinner {
  top: 11px;
  left: 0;
}
.auto-search-group .form-control {
  padding-left: 35px
}
.auto-search-group .done {
  display: block
}
.auto-search-group .start {
  display: none
}
.auto-search-group.searching .done {
  display: none
}
.auto-search-group.searching .start {
  display: block
}
</style>

<?php if ($_IS_INVITE): ?>
<div class="alert alert-success mb-0" role="alert">
  <div class="container">
    <?php echo $_MH['name'] ?>에서 <?php echo $my['nic'] ?>님에게 구성원 참여를 요청했습니다. 요청을 확인하려면 <a href="/orgs/<?php echo $_MH['id'] ?>/invitation" class="alert-link">여기</a>를 클릭하세요.
  </div>
</div>
<?php endif; ?>

<header class="pagehead">
  <div class="container">
    <div class="media mb-4">
      <img class="d-flex mr-4 rounded avatar" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_MH['photo']?$_MH['photo']:'organ.gif'?>" alt="">
      <div class="media-body py-2">
        <h1 class="h3 mt-0 mb-2 org-name"><?php echo $_MH['name'] ?></h1>
        <p class="my-1"><?php echo $_MH['description'] ?></p>
        <ul class="list-inline">

          <?php if ($_MH['location']): ?>
          <li class="list-inline-item">
            <i class="fa fa-map-marker fa-lg text-gray-light" aria-hidden="true"></i>
            <?php echo $_MH['location'] ?>
          </li>
          <?php endif; ?>

          <?php if ($_MH['url']): ?>
          <li class="list-inline-item ml-2">
            <i class="fa fa-link text-gray-light" aria-hidden="true"></i>
            <a class="text-gray" href="http://<?php echo $_MH['url'] ?>" target="_blank"><?php echo $_MH['url'] ?></a>
          </li>
          <?php endif; ?>

          <li class="list-inline-item ml-2">
            <i class="fa fa-envelope-o text-gray-light" aria-hidden="true"></i>
            <a class="text-gray" href="mailto:<?php echo $_MH['email'] ?>"><?php echo $_MH['email'] ?></a>
          </li>
        </ul>

      </div>
    </div>

  </div><!-- /.container -->

  <div class="container clearfix">
  		<ul class="nav nav-tabs">
  		  <li class="nav-item">
  		    <a class="nav-link active active" href="/<?php echo $mbrid ?>">
  					프로젝트 <span class="badge badge-light"><?php echo $NUM_PROJECT ?></span>
  				</a>
  		  </li>
  			<li class="nav-item">
  				<a class="nav-link" href="/orgs/<?php echo $mbrid ?>/people">
  					구성원 <span class="badge badge-light"><?php echo $_IS_ORGMBR?$org_mbr_total_num:$org_mbr_public_num ?></span>
  				</a>
  			</li>
  			<li class="nav-item">
  				<a class="nav-link" href="">
  					팀 <span class="badge badge-light">준비중</span>
  				</a>
  			</li>
  			<li class="nav-item d-none">
  				<a class="nav-link" href="/orgs/<?php echo $mbrid ?>/groups">
  					그룹
  				</a>
  			</li>
  		  <li class="nav-item d-none">
  		    <a class="nav-link" href="/orgs/<?php echo $mbrid ?>/notes">
  					노트
  					<span class="badge badge-light">33</span>
  				</a>
  		  </li>

        <?php if ($_IS_ORGOWNER): ?>
        <li class="nav-item">
          <a class="nav-link" href="/organizations/<?php echo $mbrid ?>/settings">
            <i class="fa fa-cog text-secondary" aria-hidden="true"></i>
            설정
          </a>
        </li>
        <?php endif; ?>



  		</ul>
  	</div><!-- /.container -->


</header><!-- /.orghead -->



<div class="container">


  <?php if ($NUM_PROJECT): ?>

      <div class="border-bottom border-gray-dark pb-3 mb-3">
        <form class="d-flex justify-content-start" action="index.html" method="post">
          <div style="width: 350px">
            <input type="search" class="form-control w-100"  placeholder="프로젝트 검색">
          </div>
          <div class="pl-2 d-none">
            <div class="ml-2 d-inline-block">
              <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i>Type:</i>
                  All
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">공개</a>
                  <a class="dropdown-item" href="#">비공개</a>
                </div>
              </div><!-- /.dropdown -->
            </div><!-- /.d-inline-block -->

            <div class="ml-2 d-inline-block">
              <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i>Framework:</i>
                  All
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">kimsQ Rb2</a>
                  <a class="dropdown-item" href="#">kimsQ Rb1</a>
                  <a class="dropdown-item" href="#">기타</a>
                </div>
              </div><!-- /.dropdown -->
            </div><!-- /.d-inline-block -->
          </div><!-- /.d-table-cell -->

          <div class="ml-auto">
            <?php if ($_IS_ORGMBR): ?>
              <a class="btn btn-primary" href="/organizations/<?php echo $mbrid ?>/project/new">새 프로젝트 만들기</a>
            <?php endif; ?>
          </div>
        </form>
      </div>


      <?php $R['ismbr']=getDbRows($table['orgsmember'],'mbruid='.$my['uid'].' and parentmbr='.$_MH['memberuid'])?>

  <?php endif; ?>

  <div class="row">
    <div class="col-8">

    <?php if($NUM_PROJECT):?>

      <ul class="list-unstyled project-list">

        <?php while($R=db_fetch_array($RCD)):?>
        <?php $R['ismbr']=getDbRows($table['projectmember'],'mbruid='.$_MH['uid'].' and project='.$R['uid'])?>
        <?php $R['pminfo']=getDbData($table['s_mbrdata'],'memberuid='.$R['manager'],'name,nic')?>
        <?php $R['owinfo']=getDbData($table['s_mbrdata'],'memberuid='.$R['owner'],'name,nic')?>
        <?php $owner=getDbData($table['s_mbrid'],'uid='.$R['owner'],'id')?>

        <li class="py-4 border-bottom public">
          <div class="d-inline-block mb-1">
            <h3>
              <a href="/<?php echo $owner['id']?>/<?php echo $g['url_project'].$R['id']?>" itemprop="name codeRepository">
                <?php echo $R['id']?>
              </a>
              <?php if($R['hidden']):?>
              <span class="badge badge-light text-gray f12">Private</span>
              <?php endif?>
            </h3>
          </div>
          <div class="row">
            <div class="col-9">
              <p class="text-gray">
                <?php echo $R['content1']?>
              </p>
            </div><!-- /.col-9 -->
            <div class="col-3">

            </div><!-- /.col-3 -->
          </div><!-- /.row -->

          <div class="list-inline f12 text-gray">


            <a class="muted-link mr-3" href="/<?php echo $owner['id']?>/<?php echo $R['id']?>/stargazers">
              <i class="fa fa-star" aria-hidden="true"></i>
              <?php echo $R['num_star']?>
            </a>

            <!-- 서비스 타입구분 -->
            <?php if ($R['svc_type'] == 2): ?><span class="svc_type free mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
            <?php elseif ($R['svc_type'] == 3): ?><span class="svc_type economy mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
            <?php elseif ($R['svc_type'] == 5): ?><span class="svc_type standard mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
            <?php elseif ($R['svc_type'] == 7): ?><span class="svc_type premium mr-3"><i class="fa fa-circle" aria-hidden="true"></i></span>
            <?php else: ?>
            <?php endif; ?>

            <?php if ($R['d_update']): ?>
            <time class="timeago" data-toggle="tooltip" datetime="<?php echo getDateFormat($R['d_update'],'c')?>" title="<?php echo  getDateFormat($R['d_update'],'Y/m/d H:i')?>"></time> 업데이트
            <?php endif; ?>

          </div>
        </li>
        <?php endwhile?>
      </ul>


      <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
          <?php echo getPageLink(10,$p,$TPG,'','')?>
        </ul>
      </nav>


    <?php else: ?>


      <div class="blankslate blankslate-spacious blankslate-large text-gray-light">
        <i class="fa fa-code fa-2x" aria-hidden="true"></i>
        <h3 class="mt-2">등록된 프로젝트가 없습니다.</h3>
        <?php if ($_IS_ORGMBR): ?>
        <p>
          <a class="btn btn-primary" href="/organizations/<?php echo $mbrid ?>/project/new">새 프로젝트 만들기</a>
        </p>
        <?php endif; ?>

      </div>



    <?php endif?>









    </div><!-- /.col-8 -->
    <div class="col-4">

      <div class="card">
        <a class="d-flex justify-content-end align-items-center text-gray-dark p-3" href="/orgs/<?php echo $mbrid ?>/people">
          <h4 class="f16 text-normal mb-0">구성원</h4>
          <span class="ml-auto f5 text-gray">
            <?php echo $_IS_ORGMBR?$org_mbr_total_num:$org_mbr_public_num ?> <i class="fa fa-chevron-right" aria-hidden="true"></i>
          </span>
        </a>
        <div class="member-avatar-group px-3 pb-3 clearfix">

          <?php
          if ($_IS_ORGMBR) {
            $_RCD=getDbArray($table['orgsmember'],'org='.$_MH['memberuid'].' and auth=1','*','uid','asc',30,1);
          } else {
            $_RCD=getDbArray($table['orgsmember'],'org='.$_MH['memberuid'].' and auth=1 and hidden=0','*','uid','asc',30,1);
          }
          ?>
          <?php while($_C=db_fetch_array($_RCD)):?>
          <?php $_M=getDbData($table['s_mbrdata'],'memberuid='.$_C['mbruid'],'*')?>
          <?php $_MI=getDbData($table['s_mbrid'],'uid='.$_C['mbruid'],'id')?>
          <?php $_MP=getDbData($table['s_mbrid'],'uid='.$_C['org'],'*')?>

          <a class="member-avatar" href="/<?php echo $_MI['id'] ?>" data-toggle="tooltip" title="<?php echo $_M['name']?>">
            <img class="rounded" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?$_M['photo']:'0.gif'?>" alt="" width="48" height="48">
          </a>
        <?php endwhile?>
        <?php if(!db_num_rows($_RCD)):?>
        <div class="p-2 text-center text-gray-light">정보가 없습니다.</div>
        <?php endif?>



        </div>
        <?php if ($_IS_ORGOWNER): ?>
        <div class="card-footer p-3 text-muted">
          <button class="btn btn-light btn-sm" type="button" data-toggle="modal" data-target="#invite_member" data-title="<?php echo $_MH['name'] ?>" data-backdrop="static">
            구성원 초대
          </button>
        </div>
        <?php endif; ?>

      </div>


    </div><!-- /.col-4 -->
  </div><!-- /.row -->


</div>

<div class="modal fade" tabindex="-1" role="dialog" id="invite_member">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center p-3">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <i class="fa fa-envelope-o fa-3x text-gray-light mb-2" aria-hidden="true"></i>
        <h1 class="h3 mb-3"><span class="js-title"></span> 구성원으로 초대합니다.</h1>

        <form action="<?php echo $g['s']?>/" method="post" id="inlineSearch">
					<input type="hidden" name="r" value="<?php echo $r?>">
					<input type="hidden" name="m" value="orgs">
					<input type="hidden" name="a" value="member_add">
					<input type="hidden" name="org" value="<?php echo $_MH['memberuid'] ?>">
          <input type="hidden" name="org_id" value="<?php echo $_MH['id'] ?>">
					<input type="hidden" name="nic" value="">

          <div class="input-group auto-search-group ">
            <input type="text" name="nic" class="form-control bg-white" placeholder="닉네임을 입력하세요." data-act="userSearch" autocomplete="off">
						<i class="fa fa-user fa-lg text-gray-light done" aria-hidden="true"></i>
	          <i class="fa-li fa fa-spinner fa-spin fa-lg start"></i>
            <span class="input-group-btn">
              <button class="btn btn-primary js-mbr-add disabled" type="button" >
                <span class="not-loading">추가</span>
                <span class="is-loading">추가중..</span>
              </button>
            </span>
          </div><!-- /.input-group -->

        </form>


      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	document.title = '<?php echo $_MH['name'] ?>';

  var modal = $('#invite_member')
  var f = document.querySelector("#inlineSearch");
  var form = $('#inlineSearch');
  var invite_accept_result = Cookies.get('invite_accept_result')  // 결과 가져오기


  if (invite_accept_result == 'success') {
    setTimeout(function(){
      $.notify('<?php echo $_MH['name'] ?>에 정상적으로 추가 되었습니다.');
    }, 500);
  }
  Cookies.remove('invite_accept_result');  // 결과 초기화

  modal.on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var title = button.data('title')
    var modal = $(this)
    modal.find('.js-title').text(title)
  })
  modal.on('shown.bs.modal', function () {
    modal.find('.form-control').trigger('focus')
  })
  modal.on('hidden.bs.modal', function () {
    modal.find('.form-control').val('')
    modal.find('.btn').attr("disabled",false);
    modal.find('.form-control').attr("disabled",false);
  })

	$('[data-act="userSearch"]').focus(function() {
		$('.js-mbr-add').addClass('disabled')
	});
	$('[data-act="userSearch"]').keydown(function() {
		$('.js-mbr-add').addClass('disabled')
	});

  // jQuery-Autocomplete : https://github.com/devbridge/jQuery-Autocomplete
  $('[data-act="userSearch"]').autocomplete({
    lookup: function (query, done) {
         $.getJSON(rooturl+"/?m=member&a=search_member", {nic: query}, function(res){
             var sg_mbr = [];
             var data_arr = res.mbrlist.split(',');//console.log(data.usernames);
             $.each(data_arr,function(key,tag){
                 var mbrData = tag.split('|');
                 var nic = mbrData[0];
                 var photo = mbrData[1];
                 sg_mbr.push({"value":nic,"data":photo});
             });
             var result = {
                 suggestions: sg_mbr
             };
              done(result);
         });
     },
     formatResult: function (suggestion,currentValue) {
        return '<div class="media" role="button"><img class="mr-2 avatar align-self-center" src="/_var/avatar/' + suggestion.data+'" width="32" height="32"><div class="media-body pt-1">'  + $.Autocomplete.formatResult(suggestion, currentValue) + '</div></div>';
      },
      onSelect: function (suggestion) {
        // $( "#search-form" ).submit();
        $('.js-mbr-add').removeClass('disabled').attr('data-nic',suggestion.value)

        // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
      },
      onSearchStart: function(){
         console.log('start search');
         form.find('.input-group').addClass('searching')
       },
       onSearchComplete:function(){
         console.log('search done');
         form.find('.input-group').removeClass('searching')
       },
  });

  $('.js-mbr-add').click(function() {
    var nic = $(this).attr('data-nic')
    form.find('[name="nic"]').val(nic)
    $(this).attr("disabled",true);
    modal.find('.form-control').attr("disabled",true);
    setTimeout("_submitCheck();",500);
  });

  function _submitCheck() {
    getIframeForAction(f);
    form.submit();
  }

</script>
