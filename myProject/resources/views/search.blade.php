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
        <h1 id="siteTitle">komorikomasha</h1>
        <p id="catchcopy">1人じゃできないことも、力を合わせればできる。やってみたいをカタチにする、3人の楽しいものづくり。</p>
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
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>

        @endforeach

        @endif
        <section class="mainVisual">
          <div id="pageBodyMain">
            <table>
              <tr>
                <th>
                  ジャンル
                </th>
                <td>
                  <select name="genre">
                    <option value="0">文学・評論</option>
                    <option value="1">ノンフィクション</option>
                    <option value="2">人文・思想・宗教</option>
                    <option value="3">コミックス</option>
                  </select>

                </td>
              </tr>
              <tr>
                <th>
                  タイトル
                </th>
                <td>
                  <input name="title" type="text" value="{{ old('title') }}">
                </td>
              </tr>
              <tr>
                <th>
                  著者
                </th>
                <td>
                  <input name="chysh" type="text" value="{{ old('chysh') }}">
                </td>
              </tr>
            </table>
        </section>
      </div>
      <br>
      <input type="submit" class="btn" value="検索">
    </div>

  </form>
</body>

</html>