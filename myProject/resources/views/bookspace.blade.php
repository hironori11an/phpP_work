<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
</head>

<body>
  <form method="POST" name="form1">
    <div class="sampleHead">
      <h1>BookSpace</h1>

      <div class="bookSite">
        {{-- ログイン前はゲスト、ログイン後はユーザネーム --}}


        @if(Session::has('role'))
        <a href="{{ action('bookspaceController@init') }}">ログアウト</a>
        &nbsp;&nbsp;
        <a>{{ session('name') }}</a></div>
      @else
      <a href="/loginKanri">ログイン</a>&nbsp;&nbsp;
      <a>ゲスト</a>
      @endif
    </div>
    </div>
    <div id="page">

      <header id="pageHead">
        <h1 id="siteTitle">komorikomasha</h1>
        <p id="catchcopy">1人じゃできないことも、力を合わせればできる。やってみたいをカタチにする、3人の楽しいものづくり。</p>
        <nav class="globalNavi">
          <ul>
            @if(Session::has('role'))

            <li><a href="{{ action('bookspaceController@back') }}">ホームバック</a></li>
            @else
            <li class="current"><a href="/">ホーム</a></li>
            @endif
            <li><a href="about/index.html">探す</a></li>
            {{-- ログイン後に表示 --}}
            @if(Session::has('role'))
            <li><a href="portfolio/index.html">記録する</a></li>
            @endif

          </ul>
        </nav>
      </header>

      <div id="pageBody">
        <section class="mainVisual">
          <div class="mainVisualText">
            <h1>Cafe Debut</h1>
            <p>baserCMS、カフェサイト用テーマ<br>
              baserCMS2012 テーマコンテスト　飲食店系テーマ賞受賞</p>
          </div>
          <img src="{{ asset('/images/bookspace_home.jpg')}}" width="980" height="500" alt="">
        </section>
      </div>
    </div>
  </form>
</body>

</html>