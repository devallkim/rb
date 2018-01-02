<!-- global css -->
<link href="/layouts/default/_css/_style.css" rel="stylesheet">

<style>
/*submit button loading*/
.btn .not-loading {
  display: block;
}
.btn:disabled .not-loading {
  display: none;
}
.btn .is-loading {
  display: none;
}
.btn:disabled .is-loading {
  display: block;
}

</style>

<div class="alert alert-warning" role="alert">
  아이디 변경시, 프로필 페이지의 URL이 변경되어 프로젝트의 URL 또한 변경됩니다.
</div>

<dl class="row">
  <dt class="col-3 text-center">현재</dt>
  <dd class="col-9">https://kimsq.com/<code><?php echo $my['id'] ?></code></dd>
</dl>


<form action="<?php echo $g['s']?>/" method="post" name="FormConfirmPassword" id="FormConfirmPassword">
  <input type="hidden" name="r" value="<?php echo $r?>">
  <input type="hidden" name="m" value="<?php echo $m?>">
  <input type="hidden" name="a" value="confirm_password">
  <input type="hidden" name="owner" value="<?php echo $owner?>">
  <input type="hidden" name="id" value="<?php echo $my['id']?>">
  <input type="hidden" name="type" value="changeID">

  <div class="alert alert-danger d-none">
    <span id="passwordErrorBlock"></span>
  </div>

  <div class="form-group">
    <div class="input-group">
       <input type="password" class="form-control" name="pw" required id="password" placeholder="본인확인을 위해 비밀번호를 입력하세요." autofocus>
       <span class="input-group-btn">
         <button class="btn btn-light" type="submit" name="button" id="rb-submit">확인</button>
       </span>
     </div>
   </div>

</form>

<hr>

<form action="<?php echo $g['s']?>/" method="post" name="signupForm" id="FormChangeID" class="d-none" novalidate autocomplete="off" target="_action_frame_<?php echo $m?>">
  <p>아이디는 중복되지 않을 경우 변경등록이 가능합니다.</p>
  <fieldset disabled>
    <input type="hidden" name="r" value="<?php echo $r?>">
    <input type="hidden" name="m" value="<?php echo $m?>">
    <input type="hidden" name="a" value="">
    <input type="hidden" name="act" value="id">
    <input type="hidden" name="check_id" value="<?php echo $check_id?$check_id:0 ?>">

    <div class="form-group row">
      <label for="" class="col-3 col-form-label text-center">아이디</label>
      <div class="col-9">
        <input type="text" class="form-control js-focus" name="id" value="<?php echo $id ?>" placeholder="변경할 아이디를 입력하세요." size="13" maxlength="13" onblur="sameCheck(this,'id-feedback');" autocapitalize="off" required>
        <div class="invalid-feedback" id="id-feedback"></div>
        <small id="" class="form-text text-muted">4~13자 이내에서 영문 대소문자,숫자,_ 만 사용할 수 있습니다.</small>
      </div>
    </div>

    <button class="btn btn-light btn-lg btn-block mt-3" type="submit" id="rb-submit">
      <span class="not-loading">변경하기</span>
      <span class="is-loading"><i class="fa fa-spinner fa-lg fa-spin fa-fw"></i> 아이디 변경중 ...</span>
    </button>

  </fieldset>
</form>





  <!-- @부모레이어를 제어할 수 있도록 모달의 헤더와 풋터를 부모레이어에 출력시킴 -->

  <div class="_modal_header d-none">
    <h5 class="modal-title">아이디를 변경하시겠습니까?</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="_modal_footer d-none">
  </div>


<script>

  var form_pw = document.getElementById('FormConfirmPassword');
  var form_id = document.getElementById('FormChangeID');

  function _modalSetting()
  {
    var modal = parent.$('#<?php echo $mid ?>')
    var _modal_header = $('._modal_header').html()
    var _modal_footer = $('._modal_footer').html()

    modal.find('iframe').attr('style','height:320px');
    modal.find('.modal-header').html(_modal_header);
    modal.find('.modal-footer').addClass('d-none');
  }
    _modalSetting();

    document.body.onresize = document.body.onload = function()
    {
    	setTimeout("document.FormConfirmPassword.pw.focus();",500);
    }

  // 본인확인을 위한 패스워드 확인
  form_pw.addEventListener('submit', function(event) {
    getIframeForAction(form_pw); // 액션을 동적 iframe 으로 보냄
  }, false);


  function sameCheck(obj,layer)
  {
  	if (!obj.value)
  	{
  		eval('form_id.check_'+obj.name).value = '0';
  		form_id.classList.remove('was-validated');
  		obj.classList.remove('is-invalid','is-valid');
  		getId(layer).innerHTML = '';
  	}
  	else
  	{
  		if (obj.name == 'id')
  		{
  			if (obj.value.length < 4 || obj.value.length > 12 || !chkIdValue(obj.value))
  			{
  				form_id.check_id.value = '0';
  				setTimeout(function() {
  	        obj.focus();
  		    }, 0);
  				form_id.classList.remove('was-validated');
  				obj.classList.add('is-invalid');
  				obj.classList.remove('is-valid');
  				getId(layer).innerHTML = '사용할 수 없는 아이디 입니다.';
  				return false;
  			}
  		}
  		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
  	}
  }

  (function() {
    'use strict';

    window.addEventListener('load', function() {
      form_id.addEventListener('submit', function(event) {
        if (form_id.checkValidity() === false) {
  				$('.form-control').removeClass('is-invalid'); // 폼유용성 검사상태 초기화
  				$("#id-feedback").html("아이디를 입력하세요.");
          event.preventDefault();
          event.stopPropagation();
        } else {

  				if (form_id.check_id.value == '0') {
  					event.preventDefault();
  					event.stopPropagation();
  				} else {
  					$('#rb-submit').attr("disabled",true);
  					setTimeout("_submitCheck();",500);
  				}
        }

        form_id.classList.add('was-validated');

      }, false);
    }, false);
  })();

  function _submitCheck()
  {
  	form_id.submit();
  }

</script>
