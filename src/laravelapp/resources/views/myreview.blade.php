<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/myreview.css">
  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/myreview.js"></script>
  <title>マイレビュー　一覧</title>
</head>

<body>
  <form method="POST" action="{{ action('editMyReviewController@init') }}">
    {{ csrf_field()}}
    <input name="user_name" type="hidden" value={{ session('name') }}>
    <div class="sampleHead">
      <h1>BookSpace</h1>

      <div class="bookSite">
        {{-- ログイン前はゲスト、ログイン後はユーザネーム --}}
        @if(Session::has('role'))
        <a href="{{ action('bookspaceController@init') }}">ログアウト</a>
        &nbsp;&nbsp;
        <a>{{ session('name') }}</a></div>
      @else
      <a href="/loginbs">ログイン</a>&nbsp;&nbsp;
      <a>ゲスト</a>
      @endif
    </div>
    </div>
    <div id="page">

      <header id="pageHead">
        <nav class="globalNavi">
          <ul>
            @if(Session::has('role'))
            <li class="current"><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
            @else
            <li><a href="/">ホーム</a></li>
            @endif
            <li><a href="{{ action('searchController@init') }}">探す</a></li>
            @if(Session::has('role'))
            <li><a href="{{ action('reviewController@init') }}">レビューする</a></li>
            @endif

          </ul>
        </nav>
      </header>

      <div id="pageBody">
        <section class="mainVisual">
        <div id="pageBodyMain">
        <h3>マイレビュー 一覧</h3>
        

        @if(count($myreviewsByGenre0) ===0)
        @else
          文学・評論<br>
          @component('components.myreviewElement')
            @slot('reviews',$myreviewsByGenre0)
          @endcomponent
        @endif

        @if(count($myreviewsByGenre1) ===0)
        @else
          <br>ノンフィクション<br>
          @component('components.myreviewElement')
            @slot('reviews',$myreviewsByGenre1)
          @endcomponent
        @endif

        @if(count($myreviewsByGenre2) ===0)
        @else
          <br>人文・思想・宗教<br>
          @component('components.myreviewElement')
            @slot('reviews',$myreviewsByGenre2)
          @endcomponent
        @endif

        @if(count($myreviewsByGenre3) ===0)
        @else
          <br>コミックス<br>
          @component('components.myreviewElement')
            @slot('reviews',$myreviewsByGenre3)
          @endcomponent
        @endif

        @if(count($myreviewsByGenre8) ===0)
        @else
          <br>その他<br>
          @component('components.myreviewElement')
            @slot('reviews',$myreviewsByGenre8)
          @endcomponent
        @endif
 
          </div>
        </section>
      </div>
      <br>
    </div>


  </form>
</body>

</html>