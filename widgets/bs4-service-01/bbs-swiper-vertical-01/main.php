<style>

.widget-bbs-swiper-vertical-01 {
  overflow: hidden;
  width: 300px;
}

.widget-bbs-swiper-vertical-01 .title,
.widget-bbs-swiper-vertical-01 .swiper-slide a {
  font-size: 15px;
  font-family: "맑은 고딕",malgun gothic;
  letter-spacing: -1px;
  color: #000;
  line-height: 1.8
}
.widget-bbs-swiper-vertical-01 .btn-group-sm>.btn {
    padding: .25rem;
    font-size: 11px;
    line-height: 1;
    border-radius: .2rem;
}


.widget-bbs-swiper-vertical-01 .rb-button-prev.swiper-button-disabled,
.widget-bbs-swiper-vertical-01 .rb-button-next.swiper-button-disabled  {
  color: #ccc
}

</style>


<section class="widget-bbs-swiper-vertical-01">
  <div class="d-flex justify-content-between">

    <div class="swiper-container pl-3" style="width: 400px;height: 25px">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="">
            '전안법' 개정안 통과 안내
          </a>
        </div>
        <div class="swiper-slide">
          <a href="">
            파일링크 서비스 시스템 작업 안내
          </a>
        </div>
        <div class="swiper-slide">
          <a href="">
            이미지 호스팅 서비스 시스템 작업 안내
          </a>
        </div>
      </div>
    </div>
    <div class="">

      <div class="btn-group btn-group-sm" role="group" aria-label="">
        <button type="button" class="btn btn-light js-button-prev" data-toggle="tooltip" title="이전">
          <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-light js-button-next" data-toggle="tooltip" title="다음">
          <i class="fa fa-angle-right fa-lg" aria-hidden="true"></i>
        </button>
      </div>

    </div>
  </div>
</section>

<script>

$(document).ready(function(){
  var swiper = new Swiper('.widget-bbs-swiper-vertical-01 .swiper-container', {

    navigation: {
      nextEl: '.widget-bbs-swiper-vertical-01 .js-button-next',
      prevEl: '.widget-bbs-swiper-vertical-01 .js-button-prev',
    },
    loop: true,
    direction: 'vertical',
    height: 25,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    autoplayDisableOnInteraction: false
  });
});

</script>
