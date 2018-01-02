<style media="screen">
/*hd-ageement*/
.card.hd-ageement {
padding-top: .325rem
}
.card.hd-ageement .card-header,
.card.hd-ageement .card-block {
padding: .625rem
}
.card.hd-ageement .card-header {
background-color: inherit;
border-bottom: none;
padding-bottom: .425rem
}
.card.hd-ageement .card-title {
margin-bottom: 0;
font-size: 1rem;
font-weight: 700;
padding-top: .525rem;
padding-left: 5px
}
.card.hd-ageement .card-block p {
margin-bottom: .325rem
}
.card.hd-ageement .card-block h4 {
margin-bottom: .9375rem;
padding-bottom: .55rem;
font-size: 1rem;
border-bottom: .0625rem solid #d8dce2;
font-weight: bold;
}
.card.hd-ageement .hd-image-uploader img.img-fluid,
.card.hd-ageement .hd-image-uploader .hd-add {
max-height: 6.9375rem !important;
min-height: 6.9375rem !important;
}
.card.hd-ageement  .table-view-cell .icon-up-nav {
color: #999fb1
}
.card.hd-ageement  .table-view-cell .collapsed .icon-up-nav::before {
content: "\e902";
}
.card.hd-ageement .table-view-cell ul,
.card.hd-ageement .table-view-cell p {
margin-bottom: 0;
font-size: 1rem;
color: #626470;
}
.card.hd-ageement .table-view-cell p::before {
content: "* "
}
.card.hd-ageement .table-view-cell.hd-full {
padding: 15px 15px  15px 50px
}
.card.hd-ageement .table-view-cell ul {
padding-left: 16px
}

.hd-policy {
	height: 120px;
	margin-bottom: 1rem;
	padding: 0.5rem 0.75rem;
	font-size: .9rem;
	border: 0.0625rem solid rgba(0, 0, 0, 0.15);
	overflow-y: auto;
}

.modal h2,
.modal h3,
.hd-policy h2,
.hd-policy h3 {
	margin-top: 1rem;
	font-size: 1rem;
	font-weight: bold;
}
.modal ul,
.hd-policy ul,
.modal ol,
.hd-policy ol {
	padding-left: 1rem
}
</style>

<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
	<h1 class="title">
		회원탈퇴
	</h1>
</header>
<div class="bar bar-standard bar-footer bar-light bg-faded">
	<div class="row">
	    <div class="col-xs-6">
	      <a href="/customer/c/user/profile" class="btn btn-secondary btn-block">취소</a>
	    </div>
	    <div class="col-xs-6 p-l-0">
	      <button type="button" class="btn btn-secondary btn-block" disabled="true" id="pages-leaveId-submit">탈퇴하기</button>
	    </div>
	  </div>
</div>
<section class="content bg-faded">

	<div class="card card-full hd-ageement mb-2">
		<div class="card-header clearfix">
			<h4 class="card-title h5 pull-xs-left">탈퇴안내</h4>
			<a href="#modal-docs" class="btn btn-secondary pull-xs-right" data-toggle="modal" data-title="탈퇴안내" data-type="agreement">
				자세히보기
			</a>
		</div>
		<div class="card-block p-t-0">
			<div id="agreement" class="hd-policy">

				<p>
				사용하고 계신 아이디(<code><?php echo $my['id']?></code>)는 탈퇴할 경우 재사용 및 복구가 불가능합니다.<br>
				탈퇴한 아이디는 본인과 타인 모두 재사용 및 복구가 불가하오니 신중하게 선택하시기 바랍니다.</p>

				<p>
				탈퇴 후 회원정보 및 개인형 서비스 이용기록은 모두 삭제됩니다.<br>
				회원정보 및 개인형 서비스 이용기록은 모두 삭제되며, 삭제된 데이터는 복구되지 않습니다.<br>
				삭제되는 내용을 확인하시고 필요한 데이터는 미리 백업을 해주세요.</p>

				<p>
				탈퇴 후에는 아이디 (<code><?php echo $my['id']?></code>)로 다시 가입할 수 없으며 아이디와 데이터는 복구할 수 없습니다.<br>
				게시판형 서비스에 남아 있는 게시글과 댓글은 탈퇴 후 삭제할 수 없습니다.</p>

				<p class="mb-0">
				회원탈퇴를 원하시면 비밀번호를 입력하신 후 &lsquo;탈퇴하기&rsquo; 버튼을 클릭해 주세요.
				</p>
			</div>

			<div class="form-group mb-1">
				<label class="custom-control custom-checkbox checkbox">
					<input type="checkbox" class="custom-control-input" name="agreement[]" id="checkbox-agreement">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">위 내용을 모두 확인하였습니다.</span>
				</label>
			</div>

		</div>
	</div>



	<article id="pages-signup" class="card card-full">
		<form name="procForm" class="form-horizontal" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" id="pages-leaveId">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="front" value="<?php echo $front?>" />
			<input type="hidden" name="a" value="out" />
			<div class="card-block">
				<fieldset disabled>

				 <div class="form-group row mb-0">
		 		   <label class="col-xs-3 col-form-label">아이디</label>
		 		   <div class="col-xs-9">
		 				 <p class="form-control-static"><?php echo $my['id']?></p>
		 		   </div>
		 		 </div>

				 <div class="form-group row mb-1">
					 <label class="col-xs-3 col-form-label">이름</label>
					 <div class="col-xs-9">
						 <p class="form-control-static"><?php echo $my['name']?></p>
					 </div>
				 </div>

				 <!-- 사이트 회원계정일때만 비밀번호 입력항목 출력 -->
				 <?php if($my['join_type'] == 'kimsq'):?>
				 <div class="form-group">
					 <input type="password" class="form-control" name="pw1" id="pw1" autocomplete="off"  placeholder="비밀번호 입력">
					 <small class="form-text text-muted"></small>
				 </div>
				 <div class="form-group">
					 <input type="password" class="form-control" name="pw2" id="pw2" autocomplete="off" placeholder="다시 한번 입력">
					 <small class="form-text text-muted"></small>
				 </div>
				 <?php endif?>

				</fieldset>
			</div>

	   </form>
	</article>
</section>


<!-- Modal : 자세히보기 -->
<div id="modal-docs" class="modal">
	<header class="bar bar-nav bar-light bg-faded">
		<a class="icon icon-close pull-right" data-history="back" role="button"></a>
		<h1 class="title" data-role="title">문서제목</h1>
	</header>
	<div class="bar bar-standard bar-footer bar-light bg-faded">
		<button class="btn btn-secondary btn-block" data-history="back">닫기</button>
	</div>
	<div class="content">
		<p class="content-padded" data-role="docs">
		</p>
	</div>
</div>

<?php getImport('bootstrap-validator','css/bootstrapValidator',false,'css') ?>
<?php getImport('bootstrap-validator','js/bootstrapValidator',false,'js') ?>

<script type="text/javascript">
//<![CDATA[

// 자세히 보기 모달
var agreement_docs = $('#agreement').html()

$('#modal-docs').on('shown.rc.modal', function (event) {
	var button = $(event.relatedTarget)
	$(this).find('.content').scrollTop(0);
	$(this).find('[data-role="docs"]').html(agreement_docs)

})

//  체크해야 폼과 버튼이 활성화 됨
$("#checkbox-agreement").change(function(e) {
	var button =  $("#pages-leaveId-submit")
	var form = $("#pages-leaveId")

	if ($(this).prop('checked')){
		button.removeClass('btn-secondary').addClass('btn-danger').attr('disabled',false) // 버튼활성화 처리하고
		button.click(function() { $('#procForm').submit(); });  //  버튼을 클릭하면 탈퇴처리함
		form.find('fieldset').attr('disabled',false)
	} else {
		button.addClass('btn-secondary').removeClass('btn-danger').attr('disabled',true) // 체크되지 않으면 탈퇴버튼을 비활성 처리함
		form.find('fieldset').attr('disabled',true)
	}
});

$('#pages-leaveId').bootstrapValidator({
    message: 'This value is not valid',
    icon: {
      valid: 'fa fa-check',
      invalid: 'fa fa-times',
      validating: 'fa fa-refresh'
    },
    fields: {
				'agreement[]': {
						validators: {
								notEmpty: {
										message: '회원탈퇴 안내문에 체크를 해주세요'
								}
						}
					},

				<?php if($my['join_type'] == 'kimsq'):?>
        pw1: {
            message: 'The username is not valid',
            validators: {
                notEmpty: {
                    message: '반드시 입력해야 합니다.'
                },
                stringLength: {
                    min: 8,
                    message: '8자 이상 입력해 주세요.'
                }
            }
        },
        pw2: {
          validators: {
              notEmpty: {
                  message: '패스워드를 한번더 입력해 주세요.'
              },
							stringLength: {
									min: 8,
									message: '8자 이상 입력해 주세요.'
							},
              identical: {
                  field: 'pw1',
                  message: '비밀번호가 같지 않습니다.'
              }
          }
    	}
			<?php endif?>

  	}
});



//]]>
</script>
