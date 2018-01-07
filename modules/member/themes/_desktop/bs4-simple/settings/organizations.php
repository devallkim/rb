

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<div class="col-9 page-main">
			<div class="Subhead mt-0 border-bottom-0 mb-1">
				<h2 class="Subhead-heading">소속단체 관리</h2>
				<div class="Subhead-actions">

	    </div>
			</div>
			<?php $sqlque	= 'mbruid='.$my['uid'].' and auth=1'; ?>
			<?php $_RCD=getDbArray($table['orgsmember'],$sqlque,'*','uid','asc',100,1)?>
			<?php $NUM = getDbRows($table['orgsmember'],$sqlque); ?>
			<?php if ($NUM): ?>
			<ul class="list-group">
				<?php while($_C=db_fetch_array($_RCD)):?>
				<?php $_M=getDbData($table['orgsdata'],'memberuid='.$_C['org'],'*')?>
				<?php $_MD=getDbData($table['s_mbrid'],'uid='.$_C['org'],'*')?>
			  <li class="list-group-item d-flex justify-content-start align-items-center" id="org-item-<?php echo $_C['org'] ?>">
					<div class="col-8 px-0">
						<img alt="@<?php echo $_MD['id']?>" class="rounded" height="20" src="<?php echo $g['s']?>/_var/avatar/<?php echo $_M['photo']?$_M['photo']:'organ.gif'?>" width="20">
						<strong class="align-text-top ml-1"><a href="/<?php echo $_MD['id']?>"><?php echo $_M['name'] ?></a></strong>


						<span class="badge badge-<?php echo $_C['owner']?'primary':'secondary' ?>">
							<?php echo $_C['owner']?'owner':'member' ?>
						</span>

					</div>
					<div class="col-4 px-0 text-right">
						<?php if ($_C['owner']): ?>
							<a class="btn btn-danger btn-sm" href="/organizations/<?php echo $_MD['id']?>/settings">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
								계정삭제
							</a>
						<?php else: ?>
							<button class="btn btn-light btn-sm" type="button" name="button" data-toggle="modal" data-target="#confirm_leave" data-backdrop="static" data-title="<?php echo $_M['name'] ?>" data-id="<?php echo $_MD['id']?>" data-org="<?php echo $_C['org'] ?>">
								떠나기
							</button>
						<?php endif; ?>
					</div>
				</li>
				<?php endwhile?>
			</ul>
			<?php else: ?>

			<div class="blankslate blankslate-spacious blankslate-large">
				<i class="fa fa-building-o fa-2x" aria-hidden="true"></i>
			  <h3 class="mt-2">소속된 단체가 없습니다.</h3>
			  <p class="text-gray f13">단체 계정이란 개인 정보가 아닌 단체 정보를 등록하여 가입하고 관리자와 멤버들이 함께 공유하여 사용할 수 있는 계정입니다.</p>
			  <a class="btn btn-primary" href="/organizations/new">새 단체계정 만들기</a>
			</div>

			<?php endif; ?>

		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<div class="modal fade" tabindex="-1" role="dialog" id="confirm_leave">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">단체 떠나기(탈퇴)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center py-5">
				<h3> <span class="js-title"></span> <code class="js-id"></code>에서 <br> 탈퇴 하시겠습니까?</h3>
        <p>단체를 탈퇴하면 단체에서 관리하는 프로젝트에 대한<br>모든 접근권한을 상실하게 됩니다.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger ml-auto js-org" data-act="leave" data-org="">단체 떠나기</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">취소</button>
      </div>
    </div>
  </div>
</div>




<script>

document.title = '소속단체 관리 · <?php echo $my['nic'] ?> ';

$('#confirm_leave').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var title = button.data('title')
	var id = button.data('id')
	var org = button.data('org')
  var modal = $(this)
  modal.find('.js-title').text(title)
	modal.find('.js-id').text(id)
  modal.find('.js-org').attr('data-org',org)
})

// 요청취소 및 삭제
$('body').on('click','[data-act="leave"]',function(){
	var org = $(this).data('org');
	$('#confirm_leave').modal('hide')
	console.log(org)
	setTimeout(function(){
		$('#org-item-'+org).remove();
		getIframeForAction('');
		window.frames.__iframe_for_action__.location.href = rooturl + '/?r=' + raccount + '&m=orgs&a=member_leave&org='+org;
	}, 300);


});



</script>
