
<header class="bar bar-nav bar-dark bg-primary p-x-0">
	<a class="icon icon-left-nav pull-left p-x-1" role="button" data-history="back"></a>
	<h1 class="title">
		비밀번호 변경
	</h1>
</header>
<section class="content bg-faded">

	<form name="procForm" class="content-padded" role="form" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" id="pages-pw">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="front" value="<?php echo $front?>" />
	<input type="hidden" name="a" value="pw_update" />

	<div class="pw_txt_box">
		<p>6개월 이내 비밀번호를 변경하지 않은 경우
		비밀번호를 다시 한번 점검해 주세요.</p>
		<p>현재 비밀번호는 <code><?php echo getDateFormat($my['last_pw'],'Y.m.d')?></code>에 변경(등록)되었으며 <code>
		<?php echo -getRemainDate($my['last_pw'])?>일</code>이 경과되었습니다.</p>
	</div>


	<div class="form-group">
		<label>현재 비밀번호</label>
		<input type="password" class="form-control form-control-lg" name="pw" id="pw" placeholder="현재 비밀번호를 입력해주세요." autocomplete="off">
	</div>
	<div class="form-group">
		<label>변경할 비밀번호</label>
		<input type="password" class="form-control form-control-lg" name="pw1" id="pw1" placeholder="8자이상 영문과 숫자만 사용가능" autocomplete="off">
	</div>
	<div class="form-group">
		<input type="password" class="form-control form-control-lg" name="pw2" id="pw2" placeholder="한번 더 입력하세요" autocomplete="off">
	</div>

	<div class="member_btm">
		<button type="submit" class="btn btn-primary btn-block">비밀번호 변경</button>
	</div>


 </form>


</section>

<?php getImport('bootstrap-validator','css/bootstrapValidator',false,'css') ?>
<?php getImport('bootstrap-validator','js/bootstrapValidator',false,'js') ?>


<script type="text/javascript">
//<![CDATA[

$('#pages-pw').bootstrapValidator({
    message: 'This value is not valid',
    icon: {
      valid: 'fa fa-check',
      invalid: 'fa fa-times',
      validating: 'fa fa-refresh'
    },
    fields: {
				pw: {
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
        pw1: {
            message: 'The username is not valid',
            validators: {
                notEmpty: {
                    message: '반드시 입력해야 합니다.'
                },
                stringLength: {
                    min: 8,
                    message: '8자 이상 입력해 주세요.'
                },
                different: {
                    field: 'pw',
                    message: '현재 패스워드와 변경할 패스워드가 같습니다.'
                }
            }
        },
        pw2: {
          validators: {
              notEmpty: {
                  message: '변경할 패스워드를 한번더 입력해 주세요.'
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

    }
});


//]]>
</script>
