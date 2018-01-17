
<div class="text-center" style="margin-top: -100px">
	<h1>
		<i class="kf kf-bi-06 fa-lg d-block mb-4 animated bounce delay-3" title="KimsQ is Kind" data-tooltip="tooltip"></i>
		설치가 완료되었습니다.
	</h1>
	<p class="text-muted">
		<?php echo sprintf('%s님, 이 페이지를 보고 계시면 킴스큐가 정상적으로 설치된 것입니다.',$my['name'])?><br>
		이제 킴스큐를 시작할 준비가 되셨습니다.
	</p>
	<p>
	<a class="btn btn-primary d-block" href="./?r=<?php echo $r?>&amp;panel=Y&amp;_admpnl_=<?php echo urlencode('./?r='.$r.'&m=admin&module=site')?>">
		시작하기
	</a>
	</p>
</div>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-55876126-3', 'auto');
ga('send', 'pageview');
</script>
