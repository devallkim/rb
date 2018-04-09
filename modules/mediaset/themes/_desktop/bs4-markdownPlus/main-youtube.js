/**
 * Copyright (c) 2015 redblock inc.
 * Author kiere@kismq.com
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
(function ($) {
    $.fn.RbAttachYoutube= function (settings) {

        var defaults = {};
        var opts = jQuery.extend(defaults, settings);

        var module=opts.module; // 모듈명
        var theme=opts.theme; // 테마 패스
        var container=$('body');

        // 업로드 리스트 showhide 값 reset 함수
        var updateShowHide=function(uid,showhide){
              if(showhide=='show'){
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').attr('data-content','hide'); // data-content 값 수정
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').text('숨기기'); // 메뉴명 변경
                    $('[data-role="attachList-label-hidden-'+uid+'"]').addClass('hidden'); // 숨김 라벨 숨기기
              }else{
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').attr('data-content','show'); // data-content 값 수정
                    $('[data-role="attachList-menu-showhide-'+uid+'"]').text('보이기'); // 메뉴명 변경
                    $('[data-role="attachList-label-hidden-'+uid+'"]').removeClass('hidden'); // 숨김 라벨 노출
              }
        }

        // 이벤트 바인딩 및 세팅
        $(container).on('click','[data-attach-act]',function(e){
              e.preventDefault();
              var act=$(this).data('attach-act');
              var uid=$(this).attr('data-id');
              var type=$(this).attr('data-type'); // file or photo

              //액션 실행
              if(act=='delete'){
                $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=deletePlatform',{
                   uid : uid
                 },function(response){
                      var previewUl_default=$('[data-role="attach-preview-'+type+'"]'); // 파일 리스트 엘리먼트 class
                      var previewUl_modal=$('[data-role="modal-attach-preview-'+type+'"]'); // 파일 리스트 엘리먼트 class
                      var delEl_default=$(previewUl_default).find('[data-id="'+uid+'"]'); // 삭제 이벤트 진행된 엘리먼트
                      var delEl_modal=$(previewUl_modal).find('[data-id="'+uid+'"]'); // 삭제 이벤트 진행된 엘리먼트
                      delEl_default.remove();// 삭제 이벤트 진행시 해당 li 엘리먼트 remove
                      delEl_modal.remove();// 삭제 이벤트 진행시 해당 li 엘리먼트 remove
                });
              }else if(act=='showhide'){
                   var showhide=$(this).attr('data-content'); // data('content') 로 할 경우, ajax 로 변경된 값이 인식되지 않는다.
                   $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit_youtube',{
                      act : act,
                      uid : uid,
                      showhide : showhide
                    },function(response){
                         var result=$.parseJSON(response);
                         if(!result.error){
                               updateShowHide(uid,showhide);
                         }
                   });
               }else if(act=='editYoutube'){
                 var modal=$(this).data('target');
                 var videoType=$(modal).find('[data-role="eventHandler"]').attr('data-type'); // youtube
                 var videoSrc=$(modal).find('[data-role="src"]').attr('src'); // youtube
                 var videoCaption=$(modal).find('[data-role="caption"]').val(); // 입력된 캡션명
                 var videoDescription=$(modal).find('[data-role="description"]').val(); // 입력된 description
                 var videoTime=$(modal).find('[data-role="time"]').val(); // 입력된 description

                //  alert(videoDescription);

                 $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit',{
                   act : act,
                   uid : uid,
                   videoType : videoType,
                   videoSrc : videoSrc,
                   videoCaption : videoCaption,
                   videoDescription : videoDescription,
                   videoTime : videoTime
                 },function(response){
                      var result=$.parseJSON(response);

                      // alert(response);

                      if(!result.error){
                            var new_videoSrc=result.videoSrc;
                            var new_videoCaption=result.videoCaption;
                            var new_videoType=result.videoType;
                            var new_videoDescription=result.videoDescription;
                            var new_videoTime=result.videoTime;
                            var insertTexts;
                            if(new_videoType=='photo') insertTexts='!['+new_filecaption+']('+rooturl+new_filesrc+')';
                            else insertTexts='<video class="mejs-player"  style="max-width:100%;" preload="none"><source src="' +new_videoSrc + '" type="video/youtube"></video>';

                            // 리스트 값 수정
                            $('[data-role="attachList-menu-edit-'+uid+'"]').attr('data-caption',new_videoCaption); // 'edit' 메뉴 캡션 업데이트
                            $('[data-role="attachList-list-name-'+uid+'"]').text(new_videoCaption);
                            $('[data-role="attachList-list-time-'+uid+'"]').text(new_videoTime);  // 비디오
                            $('[data-role="attachList-menu-edit-'+uid+'"]').attr('data-description',new_videoDescription); // 'edit' 메뉴 캡션 업데이트
                            $('[data-role="attachList-menu-insert-'+uid+'"]').attr('data-caption',new_videoCaption); // 'insert' 메뉴 캡션내용 수정
                            $('[data-role="attachList-menu-copy-'+uid+'"]').attr('data-clipboard-text',insertTexts); // copy 내용 수정


                            // 모달 닫기
                            $(modal).modal('hide');


                      }
                });

              }else if(act=='featured-img'){ // 대표이미지 설정
                   // write.php 페이지 <input name="featured_img" value > 값에 적용
                   $('input[name="featured_img"]').val(uid);

                   // 삭제 메뉴에 대표이미지 표시
                   $('[data-role="attachList-menu-delete-'+uid+'"]').attr('data-featured',1);

                   // 대표 이미지 라벨 업데이트
                   $('[data-role="attachList-label-featured"]').each(function(){
                         $(this).addClass('hidden');
                         if($(this).data('id')==uid) $(this).removeClass('hidden');
                   });

             }else if(act=='saveYoutube'){
                     var data=$(this).attr('data-linkdata');

                     $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=savePlatform',{
                        data : data,
                        theme : theme
                     },function(response){
                           var result=$.parseJSON(response);
                           if(!result.error){
                               $(container).find('[data-role="attach-preview-youtube"]').append(result.list);
                           }
                     });
             }

        });

    };
})(jQuery);
