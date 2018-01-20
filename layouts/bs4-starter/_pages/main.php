<section>

  <div class="alert alert-warning text-center mt-5" role="alert">
    메인페이지를 등록해주세요.
  </div>

	<h1>메인 페이지 등록안내</h1>
	<ol>
    <li>관리자모드 > 사이트 모듈 > 페이지에 접속해 주세요.</li>
    <li>새 페이지 만들기를 해주세요. (페이지 형식에 메인페이지 속성에 체크해 주세요.)</li>
    <li>관리자 모드 > 사이트 모듈 > 사이트에 접속해 주세요.</li>
    <li>메인 페이지 항목에서 생성된 메인 페이지를 지정한후, 저장해 주세요.</li>
	</ol>

  <div class="card my-4">
    <div class="card-header">
      이 레이아웃에서 사용할 레이아웃 내장 페이지를 추가하는 방법!?
    </div>
    <div class="card-body">
      <ol>
        <li>추가하려는 페이지 파일을 만듭니다.파일의 확장자는 <code>.php</code> 로 합니다 (보기) 회사소개 페이지를 구성할 경우 : <code>company.php</code></li>
        <li>CSS가 필요할 경우 CSS파일을 만듭니다. 페이지 파일명과 동일하게 만듭니다. (보기) <code>company.css</code></li>
        <li>php파일과 css파일을 원하는 형식으로 구성(편집)합니다.</li>
        <li>편집한 파일을 이 레이아웃의 폴더내 _pages 안에 업로드합니다.</li>
        <li>페이지를 호출합니다.페이지 호출방법 : <code>/rb/?r=사이트코드&amp;layoutPage=파일명(확장자제외)</code><br>(변수) <code>&lt;?php echo $g['s']?&gt;/?r=&lt;?php echo $r?&gt;&amp;layoutPage=파일명(확장자제외)</code><br>하나의 사이트만 생성해서 운영할 경우 사이트코드는 생략가능합니다.</i></li>
        <li>이 샘플페이지를 참고하세요.<code>/레이아웃폴더/_pages/sample.php 와 sample.css</code></li>
      </ol>
    </div>
  </div><!-- /.card -->


</section>
