<div class="rb-attach">
      <ul class="list-group rb-attach-place" data-role="attach-preview-place"><!-- 위치 리스트 -->
         <?php if($parent_data['uid']):?>
             <?php echo getAttachFileList($parent_data,'upload','place')?>
          <?php endif?>
      </ul> 
</div>
<!-- 위치 추가  -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-attach-map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">위치 추가</h4>
            </div>
            <div class="modal-body">
                <p>지도 검색 UI </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary">적용하기</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



