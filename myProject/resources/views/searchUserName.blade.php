<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/searchResult.css">
  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/bookspaceHome.js"></script>
</head>

<body>

  <div class="sampleHead">
    <h1>BookSpace</h1>

    <div class="bookSite">
      {{-- ログイン前はゲスト、ログイン後はユーザネーム --}}
      @if(Session::has('role'))
      <a href="{{ action('bookspaceController@init') }}">ログアウト</a>
      &nbsp;&nbsp;
      <a>{{ session('name') }}</a>
    </div>
    @else
    <a href="/userRegist">ユーザ登録</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="/loginbs">ログイン</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a>ゲスト</a>
    @endif
  </div>
  </div>
  <div id="page">

    <header id="pageHead">
      <nav class="globalNavi">
        <ul>
          @if(Session::has('role'))

          <li><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
          @else
          <li><a href="/">ホーム</a></li>
          @endif
          <li class="current"><a href="{{ action('searchController@init') }}">探す</a></li>
          {{-- ログイン後に表示 --}}
          @if(Session::has('role'))
          <li><a href="{{ action('reviewController@init') }}">レビューする</a></li>
          @endif

        </ul>
      </nav>
    </header>

    <div id="pageBody">
      <section class="mainVisual">
        <div id="pageBodyMain">
          {{$items[0]->user_name}}さんのレビュー一覧<br>
          @foreach ($items as $item)
          <table border="0" width="800">
            <tr class=tr_title>
              <td colspan="2">
                <div>
                  <p><span class="title">{{$item->title}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                  </p>


                </div>
              </td>
            </tr>
            <tr class=tr_title>
              <td width="270">
                著者:&nbsp;&nbsp;{{$item->chysh}}

              </td>
              <td>
                ジャンル：
                @foreach ($item->genres as $genre)
                {{ $genre->genre_name }}
                @endforeach
              </td>
            </tr>
          </table>
          <table border="0" width="800">
            <tr class=tr_review>
              <td width="22%">
                @isset($item->photo_path)
                <img src="{{$item->photo_path}}" width="150px" height="150px">
                @else
                画像なし
                @endisset
              </td>
              <td class="td">
                <img src="{{ asset('/images/hyk_level/ico_grade_'.$item->hyk.'.gif')}}" width="80" height="15"><br>
                {{$item->review_niy}}
              </td>
            </tr>
          </table>
          <br><br>
          @endforeach
        </div>

      </section>
    </div>
  </div>

</body>

</html>