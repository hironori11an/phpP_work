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
          <div class="oneArea">
            @foreach ($myreviewsByGenre0 as $myreviewByGenre0)
              <div class="onebox">
                <input type="hidden" name="reviewId" class="reviewId" value="{{$myreviewByGenre0->id}}">
                <b>『{{$myreviewByGenre0->title}}』</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$myreviewByGenre0->chysh}}<br>
                <div class="hyk_level"><img src="{{ asset('/images/hyk_level/ico_grade_'.$myreviewByGenre0->hyk.'.gif')}}" width="80" height="15"></div>
                <p><div class="picture">
                  @isset($myreviewByGenre0->photo_path)
                    <img src="{{$myreviewByGenre0->photo_path}}" width="150" height="100">
                  @else
                    <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                  @endisset
                </div>
                </p>
              </div>
            @endforeach
          </div>
        @endif

        @if(count($myreviewsByGenre1) ===0)
        @else
          <br>ノンフィクション<br>
          <div class="oneArea">
            @foreach ($myreviewsByGenre1 as $myreviewByGenre1)
              <div class="onebox">
                <input type="hidden" name="reviewId" class="reviewId" value="{{$myreviewByGenre1->id}}">
                <b>『{{$myreviewByGenre1->title}}』</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$myreviewByGenre1->chysh}}<br>
                <div class="hyk_level"><img src="{{ asset('/images/hyk_level/ico_grade_'.$myreviewByGenre1->hyk.'.gif')}}" width="80" height="15"></div>
                <p><div class="picture">
                  @isset($myreviewByGenre1->photo_path)
                    <img src="{{$myreviewByGenre1->photo_path}}" width="150" height="100">
                  @else
                    <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                  @endisset
                </div>
                </p>
              </div>
            @endforeach
          </div>
        @endif

        @if(count($myreviewsByGenre2) ===0)
        @else
          <br>人文・思想・宗教<br>
          <div class="oneArea">
            @foreach ($myreviewsByGenre2 as $myreviewByGenre2)
              <div class="onebox">
                <input type="hidden" name="reviewId" class="reviewId" value="{{$myreviewByGenre2->id}}">
                <b>『{{$myreviewByGenre2->title}}』</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$myreviewByGenre2->chysh}}<br>
                <div class="hyk_level"><img src="{{ asset('/images/hyk_level/ico_grade_'.$myreviewByGenre2->hyk.'.gif')}}" width="80" height="15"></div>
                <p><div class="picture">
                  @isset($myreviewByGenre2->photo_path)
                    <img src="{{$myreviewByGenre2->photo_path}}" width="150" height="100">
                  @else
                    <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                  @endisset
                </div>
                </p>
              </div>
            @endforeach
          </div>
        @endif

        @if(count($myreviewsByGenre3) ===0)
        @else
          <br>コミックス<br>
          <div class="oneArea">
            @foreach ($myreviewsByGenre3 as $myreviewByGenre3)
              <div class="onebox">
                <input type="hidden" name="reviewId" class="reviewId" value="{{$myreviewByGenre3->id}}">
                <b>『{{$myreviewByGenre3->title}}』</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$myreviewByGenre3->chysh}}<br>
                <div class="hyk_level"><img src="{{ asset('/images/hyk_level/ico_grade_'.$myreviewByGenre3->hyk.'.gif')}}" width="80" height="15"></div>
                <p><div class="picture">
                  @isset($myreviewByGenre3->photo_path)
                    <img src="{{$myreviewByGenre3->photo_path}}" width="150" height="100">
                  @else
                    <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                  @endisset
                </div>
                </p>
              </div>
            @endforeach
          </div>
        @endif

        @if(count($myreviewsByGenre8) ===0)
        @else
          <br>その他<br>
          <div class="oneArea">
            @foreach ($myreviewsByGenre8 as $myreviewByGenre8)
              <div class="onebox">
                <input type="hidden" name="reviewId" class="reviewId" value="{{$myreviewByGenre8->id}}">
                <b>『{{$myreviewByGenre8->title}}』</b><br>
                &nbsp;&nbsp;&nbsp;&nbsp;{{$myreviewByGenre8->chysh}}<br>
                <div class="hyk_level"><img src="{{ asset('/images/hyk_level/ico_grade_'.$myreviewByGenre8->hyk.'.gif')}}" width="80" height="15"></div>
                <p><div class="picture">
                  @isset($myreviewByGenre8->photo_path)
                    <img src="{{$myreviewByGenre8->photo_path}}" width="150" height="100">
                  @else
                    <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                  @endisset
                </div>
                </p>
              </div>
            @endforeach
          </div>
        @endif
 
          </div>
        </section>
      </div>
      <br>
    </div>


  </form>
</body>

</html>