/**
 * Copyright (c) 2015 redblock inc.
 * Author kiere@kismq.com
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
(function ($) {
    $.fn.RbAttachLink= function (settings) {

        var defaults = {};
        var opts = jQuery.extend(defaults, settings);

        var module=opts.module; // 모듈명
        var theme=opts.theme; // 테마 패스
        var handler_photo=opts.handler_photo; // 사진첨부 실행 엘리먼트
        var handler_file=opts.handler_file; // 파일첨부 실행 엘리먼트
        var container=$('body');
        var linkSelector=opts.linkSelector;


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
              var uid=$(this).data('id');
              var type=$(this).data('type'); // file or photo

              //액션 실행
              if(act=='delete'){
                   $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit_link',{
                      act : act,
                      uid : uid
                    },function(response){
                             var previewUl=$('[data-role="attach-preview-link"]'); // 파일 리스트 엘리먼트 class
                             var delEl=$(previewUl).find('[data-id="'+uid+'"]'); // 삭제 이벤트 진행된 엘리먼트
                             delEl.remove();// 삭제 이벤트 진행시 해당 li 엘리먼트 remove
                             // 모달 내용 초기화
                             var modal='#modal-attach-link';
                             $(modal).find('.closePreview').click();
                    });
              }else if(act=='showhide'){
                   var showhide=$(this).attr('data-content'); // data('content') 로 할 경우, ajax 로 변경된 값이 인식되지 않는다.
                   $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=edit_link',{
                      act : act,
                      uid : uid,
                      showhide : showhide
                    },function(response){
                         var result=$.parseJSON(response);
                         if(!result.error){
                               updateShowHide(uid,showhide);
                         }
                   });
               }else if(act=='saveLink'){
                       var data=$(this).attr('data-linkdata');
                       // title & description 은 사용자가 수정한 값을 최종값으로 한다.
                       var title = $('#previewInputTitle_' + linkSelector).html();
                       var url = $('#previewUrl_' + linkSelector).html();
                       var description = $('#previewInputDescription_' + linkSelector).html();

                       $.post(rooturl+'/?r='+raccount+'&m='+module+'&a=saveLink',{
                          data : data,
                          theme : theme,
                          preTitle : title,
                          preUrl : url,
                          preDescription : description,
                          uid : uid
                       },function(response){
                             var result=$.parseJSON(response);
                             if(!result.error){
                                 $(container).find('[data-role="attach-preview-link"]').append(result.list);
                             }
                       });

               }

        });

    };
})(jQuery);
