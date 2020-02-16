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

            <li class="current"><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
            @else
            <li class="current"><a href="/">ホーム</a></li>
            @endif
            <li><a href="{{ action('searchController@init') }}">探す</a></li>
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
            @if(isset($items))
            マイレビュー<br>
            @if(count($items) ===0)
            レビュー投稿がありません
            @endif
            <div id="my_review">
              @foreach ($items as $item)
              <table id="my_review">
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
                  <td width="540">
                    @foreach ($item->genres as $genre)
                    {{ $genre->genre_name }}
                    @endforeach

                    {{--編集できるよう
                    <select name="genre">
                      @foreach ($allgenres as $allgenre)
                      @foreach ($item->genres as $genre)
                      @if($allgenre->id === $genre->id)
                      <option selected value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                      @else
                      <option value="{{ $allgenre->id }}">{{ $allgenre->genre_name }}</option>
                      @endif
                      @endforeach
                      @endforeach
                    </select>
                    --}}
                  </td>
                </tr>
                <tr>
                  <th>
                    タイトル
                  </th>
                  <td width="540">
                    {{$item->title}}
                  </td>
                </tr>
                <tr>
                  <th>
                    著者
                  </th>
                  <td width="540">
                    {{$item->chysh}}
                  </td>
                </tr>
                <tr>
                  <th>
                    評価
                  </th>
                  <td width="540">
                    {{$item->hyk}}
                  </td>
                </tr>
                <tr>
                  <th>
                    レビュー
                  </th>
                  <td width="540">
                    {{$item->review_niy}}
                  </td>
                </tr>
              </table>
              <br>
              @endforeach
            </div>
            @else
          </div>

          <div class="mainVisualText">

            <h1>読書レビューサイト</h1>
            <p>読みたい本が見つかる。<br>
              読み終わった本のレビューを投稿しよう</p>
          </div>
          <img src="{{ asset('/images/bookspace_home.jpg')}}" width="980" height="500" alt="">
          @endif
        </section>
      </div>
    </div>
  </form>
</body>

</html>