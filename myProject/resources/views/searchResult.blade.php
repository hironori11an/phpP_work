<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
</head>

<body>
  <form method="POST" action="{{ action('searchController@search') }}">
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
            <li><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
            @else
            <li><a href="/">ホーム</a></li>
            @endif
            <li class="current"><a href="{{ action('searchController@init') }}">探す</a></li>
            @if(Session::has('role'))
            <li><a href="{{ action('reviewController@init') }}">レビューする</a></li>
            @endif

          </ul>
        </nav>
      </header>

      <div id="pageBody">
        @if(count($items) ===0)
        検索結果はありません。他の条件で検索してください。
        @else


        <section class="mainVisual">
          <div id="pageBodyMain">
            @foreach ($items as $item)
            <table id="mainTable">
              <tr>
                <td rowspan="5" width="22%">
                  @isset($item->photo_path)
                  <img src="{{$item->photo_path}}" width="150px" height="150px">
                  @else
                  画像なし
                  @endisset
                </td>
                <th>
                  ジャンル
                </th>
                <td>
                  @foreach ($item->genres as $genre)
                  {{ $genre->genre_name }}
                  @endforeach
                </td>
              </tr>
              <tr>
                <th>
                  タイトル
                </th>
                <td>
                  {{$item->title}}
                </td>
              </tr>
              <tr>
                <th>
                  著者
                </th>
                <td>
                  {{$item->chysh}}
                </td>
              </tr>
              <tr>
                <th>
                  評価
                </th>
                <td>
                  {{$item->hyk}}
                </td>
              </tr>
              <tr>
                <th>
                  レビュー
                </th>
                <td>
                  {{$item->review_niy}}
                </td>
              </tr>
            </table><br>
            @endforeach
            @endif

          </div>
        </section>
      </div>
      <br>
    </div>


  </form>
</body>

</html>