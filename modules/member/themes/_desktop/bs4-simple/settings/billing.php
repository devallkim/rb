<?php
	include $g['path_core'].'function/rss.func.php';
	$g['livequry'] = 'https://ssl.3-pod.com/User/api.aspx?ptncode=0331&ptnkey=FD08508FA0220C53BA94BE59EBC06045&enc=utf-8&cmd=';

	$_SMID=getUrlData($g['livequry'].'GET_MEMBER_INFO&type=SMNO&mno='.$my['mbrno'],10);

	function getLiveAutoLogin()
	{
		global $g,$_SMID;
		if ($_SMID)
		{
			$mbrno = getRssContent($_SMID,'MemberNo');
			$mbrid = getRssContent($_SMID,'MemberID');
			$mbrpw = getRssContent($_SMID,'MemberPwd');
			return 'http://livewindow.kimsq.co.kr/Body/FormLogin.aspx?mgno='.$mbrno.'&amp;mpkv='.md5($mbrid.'0331'.$mbrpw).'&amp;page=';
		}
		return 'noAccount';
	}


	$g['liveauto'] = getLiveAutoLogin();

?>

<!-- global css -->
<link href="<?php echo $g['url_module_skin']?>/_style.css" rel="stylesheet">
<div class="container">

	<div class="page-wrapper row">
		<div class="col-3 page-nav">
			<?php include $g['dir_module_skin'].'_nav.php';?>
		</div>

		<div class="col-9 page-main">

			<?php if (!$type): ?>
			<div class="Subhead mt-0">
				<h2 class="Subhead-heading">결제내역</h2>
			</div>

			<div class="card">
				<table class="table table-hover payment-history mb-0">
					<thead>
						<tr>
							<th>상품명</th>
							<th>결제금액</th>
							<th>주문종류</th>
							<th>결제방식</th>
							<th>주문상태</th>
							<th>주문일자</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="orderlist">
						<!-- 2013/3/15일 이후 kimsq.net => kimsq.co.kr로 변경 (계정명만 표기) (by. taiji88 13/3/15) -->
						<?php $_XDomain = getRssContent($_SMID,'MemberID').'.kimsq.co.kr'?>

						<?php $_orderlist = getRssArray($g['livequry'].'GET_ORDER_LIST&outsc_type=2&date_mode=A&zero_order=0&member_no='.$my['mbrno'],'Order')?>
						<?php $_i=0?>
						<?php foreach($_orderlist as $_result):?>
						<?php $_ProductName=getRssContent($_result,'ProductName')?>
						<?php if(!$_ProductName)continue;$_i++?>
						<?php if($_i > 15)break?>
						<?php $_Domain=getRssContent($_result,'DomUrl')?>
						<?php $_XDomain = getRssContent($_result,'guest_name')?>
						<?php $_Price=getRssContent($_result,'OrderAmt')?>
						<?php $_OrderStatusName=getRssContent($_result,'OrderStatusName')?>
						<?php $_OrderNo=getRssContent($_result,'OrderNo')?>
						<tr>
							<td>
								<a href="#." onclick="LivePopup('<?php echo $g['liveauto'].urlencode('http://livewindow.kimsq.co.kr/body/Spt08/Pop02.aspx?order_no='.$_OrderNo)?>','600','650','yes');" title="주문정보">
									<?php echo $_ProductName?>
								</a><?php echo $_Domain?'<br>'.$_Domain:'<br>'.$_XDomain.'' ?>
							</td>
							<td class="price"><?php echo number_format($_Price)?>원</td>
							<td><?php echo getRssContent($_result,'OrderTypeName')?></td>
							<td class="paykind"><?php echo getRssContent($_result,'PayMethodName')?></td>
							<td<?php if($_OrderStatusName!='결제완료'):?> class="table-secondary"<?php endif?>><?php echo $_OrderStatusName?></td>
							<td class="date"><?php echo getRssContent($_result,'OrderDate')?></td>
							<td>
							<?php if($_OrderStatusName=='결제완료'):?>
								<a href="#." onclick="LivePopup('<?php echo $g['liveauto'].urlencode('http://livewindow.kimsq.co.kr/body/Spt08/Pop05.aspx?order_type=1&order_key='.$_OrderNo)?>','400','550','no');"><img src="<?php echo $g['img_module_skin']?>/btn_r_receipt.gif" alt="입금표" data-toggle="tooltip" title="입금표 출력"></a>
								<a href="#." onclick="LivePopup('<?php echo $g['liveauto'].urlencode('http://livewindow.kimsq.co.kr/body/Spt08/Pop06_01.aspx?order_type=1&order_key='.$_OrderNo)?>','700','600','no');"><img src="<?php echo $g['img_module_skin']?>/btn_r_spec.gif" alt="거래명세표" data-toggle="tooltip" title="거래명세표 출력"></a>
							<?php endif?>
							</td>
						</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
			<?php if(!$_i):?>
			<div class="blankslate mb-3">
		    결제내역이 없습니다.
		  </div>
			<?php endif?>

			<div class="card mt-5 p-3">
				<div class="mb-2">
					<img src="<?php echo $g['img_module_skin']?>/btn_r_receipt.gif" alt="입금표" /> 입금표 출력 &nbsp;&nbsp;
					<img src="<?php echo $g['img_module_skin']?>/btn_r_spec.gif" alt="거래명세표" /> 거래명세표 출력
				</div>
				<ul class="mb-0">
					<li>신용카드로 결제한 내역은 카드 매출전표를 인쇄할 수 있습니다.</li>
					<li>신용카드 매출전표는 최근 18개월간 결제한 내역까지 조회할 수 있습니다.</li>
					<li>모든 거래/주문건에 대해서 세금계산서나 현금영수증을 받으시려면 <a href="<?php echo $g['liveauto'].urlencode('http://livewindow.kimsq.co.kr/body/Spt08/Mst01.aspx')?>" target="_blank" class="u">여기</a>를 클릭하세요</li>
					<li>상품명을 클릭하시면 자세한 주문정보를 확인하실 수 있습니다.</li>
					<li>거래/주문건은 최근 15개까지만 출력됩니다. 전체내역을 확인하려면 <a href="<?php echo $g['liveauto'].urlencode('http://livewindow.kimsq.co.kr/body/Spt08/Mst01.aspx')?>" target="_blank" class="u">여기</a>를 클릭하세요</li>
				</ul>
			</div>

			<?php endif?>

			<!-- 결제수단 추가 -->
			<?php if($type =='payment'): ?>

				<div class="Subhead mt-0">
					<h2 class="Subhead-heading">
						 <a href="/settings/billing">결제정보 관리</a>
						/ 결제정보 관리
					</h2>
				</div>

				<dl class="form-group">
					<dt>
						<label>구분</label>
					</dt>
					<dd>
						<div class="btn-group" data-toggle="buttons">
						  <label class="btn btn-white active">
						    <input type="radio" name="options" id="option1" autocomplete="off" checked> 신용카드
						  </label>
						  <label class="btn btn-white">
						    <input type="radio" name="options" id="option2" autocomplete="off"> 페이팔 계정
						  </label>
						</div>
					</dd>
				</dl>

				<dl class="form-group">
					<dt>
						<label>신용카드 번호</label>
					</dt>
					<dd>
						<div class="input-group w-50">
						  <input type="text" class="form-control" required="required">
						  <span class="input-group-addon bg-white">
								<i class="fa fa-credit-card" aria-hidden="true"></i>
							</span>
						</div>
					</dd>
				</dl>

				<div class="clearfix">
					<dl class="form-group float-left">
						<dt>
							<label>유효기간</label>
						</dt>
						<dd>

							<select autocomplete="off" class="form-control mr-3 d-inline-block" name="" required="required" style="width: 80px">
								<option value="" disabled="true" selected="true">MM</option>
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
						</select>

						<select autocomplete="off" class="form-control d-inline-block" name="" required="required" style="width: 80px">
							<option value="" disabled="true" selected="true">YY</option>
							<option value="2017">17</option>
							<option value="2018">18</option>
							<option value="2019">19</option>
							<option value="2020">20</option>
							<option value="2021">21</option>
							<option value="2022">22</option>
							<option value="2023">23</option>
							<option value="2024">24</option>
							<option value="2025">25</option>
							<option value="2026">26</option>
							<option value="2027">27</option>
						</select>

						</dd>
					</dl>
					<dl class="form-group float-left ml-3">
						<dt>
							<label>보안코드 <i class="fa fa-question-circle-o" aria-hidden="true"></i></label>
						</dt>
						<dd>
							<input type="text" class="form-control" required="required" style="width: 80px">
						</dd>
					</dl>
				</div>


				<div class="mt-3">
					<button class="btn btn-primary" type="button" name="button">
						정보 업데이트
					</button>
					<a class="btn btn-light" href="/settings/billing">취소</a>
				</div>


			 <?php endif?>


			<!-- 멤버쉽 플랜변경 -->
			<?php if ($type =='plans'): ?>
				<div class="Subhead mt-0">
					<h2 class="Subhead-heading">
						 <a href="/settings/billing">결제정보 관리</a>
						/ 멤버쉽 플랜변경
					</h2>
				</div>

				<div class="card">
					<table class="table billing-plans mb-0">
						<thead>
							<tr>
								<th>멤버쉽 플랜</th>
								<th>
									가격
								</th>
								<th class="num">프로젝트(개)</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr class="">
								<td class="name">Silver</td>
								<td class="pricing">
									<span class="default-currency">30,000원/월</span>
								</td>
								<td class="num">20</td>
								<td class="text-right">
										<a href="#confirm_plan" data-toggle="modal"  class="btn btn-sm btn-light" data-name="Silver" data-type="업그레이드" data-cost="25,000원/월">업그레이드</a>
								</td>
							</tr>
							<tr class="current" data-name="bronze">
								<td class="name">Bronze</td>
								<td class="pricing">
									<span class="default-currency">25,000원/월</span>
								</td>
								<td class="num">10</td>
								<td class="text-right">
										<i class="fa fa-check" aria-hidden="true"></i>
										현재 멤버쉽
								</td>
							</tr>
							<tr class="" data-name="free" data-cost="$0">
								<td class="name">Free</td>
								<td class="pricing">
									<span class="default-currency">0원/월</span>
								</td>
								<td class="num">0</td>
								<td class="text-right">
										<a href="#confirm_downgrade_free" data-toggle="modal" class="btn btn-sm btn-light">다운그레이드</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- 모달-업/다운그레이드 -->
				<div class="modal fade" id="confirm_plan">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title">멤버쉽 플랜 변경</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">

								<table class="table table-bordered">
									<colgroup>
										<col width="100">
										<col>
									</colgroup>
									<tr>
										<th>전환구분</th>
										<td data-role="type"></td>
									</tr>
									<tr>
										<th>멤버쉽 플랜</th>
										<td data-role="plan"></td>
									</tr>
									<tr>
										<th>월정액</th>
										<td data-role="cost"></td>
									</tr>
								</table>


				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary btn-block">업그레이드</button>
				      </div>
				    </div>
				  </div>
				</div>

				<!-- 무료전환 -->
				<div class="modal fade" id="confirm_downgrade_free">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">무료 멤버쉽으로 전환합니다.</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-check">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
								   이 계획의 가격이 너무 높습니다.
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
								    이 계획의 규모가 너무 커서 모든 저장소가 필요하지 않습니다.
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
								    우리는 다른 플랫폼에 저장소를 통합하고 있습니다.
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
								    나는 실수로 이조직을 구성했고 필요하지 않습니다.
								  </label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
										기타
									</label>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary btn-block">다운그레이드</button>
							</div>
						</div>
					</div>
				</div>

			<?php endif; ?>



		</div><!-- /.page-main -->
	</div><!-- /.page-wrapper -->
</div><!-- /.container -->

<!-- global js -->
<script src="<?php echo $g['url_module_skin']?>/_script.js" charset="utf-8"></script>

<script type="text/javascript">

$('#confirm_plan').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var plan = button.data('name')
  var type = button.data('type')
  var cost = button.data('cost')
  var modal = $(this)
  modal.find('[data-role="plan"]').text(plan)
	modal.find('[data-role="type"]').text(type)
	modal.find('[data-role="cost"]').text(cost)
})


function LivePopup(url,w,h,scroll)
{
	if (memberid == '')
	{
		alert('로그인 후에 이용하실 수 있습니다.   ');
		//crLayer('킴스큐 Live 로그인','<iframe src='+rooturl+'/?r='+raccount+'&m='+moduleid+'&live=iframe/login&iframe=Y width=100% height=100% frameborder=0 scrolling=no></iframe>','login');
		return false;
	}

	window.open(url,'','left=0,top=0,width='+w+'px,height='+h+'px,statusbar=no,scrollbars='+scroll+',toolbar=no');
}

</script>
