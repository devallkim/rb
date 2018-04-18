
<script>
var inputId='attach-file-input'; // 실제 작옹하는 input 엘리먼트 id 값을 옵션으로 지정을 해준다. (커스텀 버튼으로 click 이벤트 바인딩)
var attach_file_saveDir = '<?php echo $g['path_file'].$parent_module?>/';// 파일 업로드 폴더
var attach_module_theme = '<?php echo $attach_module_theme?>';// attach 모듈 테마
$(document).ready(function() {

       // 파일업로드 옵션값 세팅
       var upload_settings = {
            allowedTypes:"<?php echo $d['theme']['allowedTypes'] ?>",// 업로드 가능한 파일 확장자. 여기에 명시하지 않으면 파일 확장자 필터링하지 않음.
            fileName: "files", // <input type="file" name=""> 의 name 값 --> php 에서 파일처리할 때 사용됨.
            multiple: <?php echo $d['theme']['multiple']?'true':'false' ?>, // 멀티업로드를 할 경우 true 로 해준다.
            inputId:inputId, // 실제 작옹하는 input 엘리먼트 id 값을 옵션으로 지정을 해준다. (커스텀 버튼으로 click 이벤트 바인딩)
            formData: {"saveDir":attach_file_saveDir,"theme":attach_module_theme}, // 추가 데이타 세팅
            onSubmit:function(files){
              $(".content").loader({
                position: 'overlay',
      		      text: "업로드중...",
                disableOthers: [
                   $('[data-role="attach-handler-file"]')
                 ]
      		    });
            },
            onSuccess:function(files,data,xhr,pd){
              $(".content").loader("hide")
              $('#pupup-success').popup({
                backdrop: false
              });

            }
       }
       $("#attach-files").RbUploadFile(upload_settings); // 아작스 폼+input=file 엘리먼트 세팅

      // main.js 기본값 세팅
      var attach_settings={
            module : 'attach',
            theme : attach_module_theme,
            handler_photo : '<?php echo $attach_handler_photo?>',
            handler_file : '<?php echo $attach_handler_file?>',
            handler_getModalList : '<?php echo $attach_handler_getModalList?>',
            listModal : '#modal-attach'
      }
      $("#attach-files").RbAttachTheme(attach_settings);


});


// 모달 활성화시에 입력필드 포커스 처리
$('#modal-attach-photo-meta').on('shown.bs.modal', function (event) {
  var modal = $(this)
  modal.find('[data-role="filename"]').focus()
})
$('#modal-attach-file-meta').on('shown.bs.modal', function (event) {
  var modal = $(this)
  modal.find('[data-role="filename"]').focus()
})

</script>
