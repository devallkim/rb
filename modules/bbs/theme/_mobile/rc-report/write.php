<div id="bbswrite">

	<form name="writeForm" id="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return writeCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="write_contactUs" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>" />
	<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
	<input type="hidden" name="reply" value="<?php echo $reply?>" />
	<input type="hidden" name="nlist" value="<?php echo $g['bbs_list']?>" />
	<input type="hidden" name="pcode" value="<?php echo $date['totime']?>" />
	<input type="hidden" name="category" value="메일문의" />
	<input type="hidden" name="subject" value="메일문의" />
	<input type="hidden" name="backtype" value="ajax" />
	<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>" />


	<div class="form-list m-b-0">
     <div class="input-row">
       <label>이름</label>
       <input class="form-control" type="text" placeholder="작성자명" name="name" value="<?php echo $R['uid']?>" readonly="">
     </div>
     <div class="input-row">
       <label>이메일</label>
       <input type="email" value="" name="email" readonly="">
     </div>
   </div>

	 <div class="content-padded">
		 <input type="hidden" name="html" value="TEXT" />
		 <textarea class="form-control" rows="5" name="content" placeholder="내용을 입력해주세요.." required=""><?php echo $reply=='Y'?'':strip_tags($R['content'])?></textarea>

		 <div class="row">
			 <div class="col-xs-6">
				 <button type="button" class="btn btn-secondary btn-block" data-history="back">취소하기</button>
			 </div>
			 <div class="col-xs-6 p-l-0">
				 <button type="button" class="btn btn-primary btn-block" data-role="submit"]>제보하기</button>
			 </div>
		 </div>
	 </div>

	</form>


</div>
