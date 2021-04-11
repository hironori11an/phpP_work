<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/search.css">
  <title>レビュー検索</title>
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
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>

        @endforeach

        @endif
        <section class="mainVisual">
          <div id="pageBodyMain">
            <table id="mainTable">
              <tr>
                <th>
                  ジャンル
                </th>
                <td>
                  <select name="genre">
                    <option value="9">指定しない</option>
                    <option value="0">文学・評論</option>
                    <option value="1">ノンフィクション</option>
                    <option value="2">人文・思想・宗教</option>
                    <option value="3">コミックス</option>
                    <option value="8">その他</option>
                  </select>

                </td>
              </tr>
              <tr>
                <th>
                  タイトル
                </th>
                <td>
                  <input name="title" type="text" value="{{ old('title') }}" maxlength="20" size="40">
                </td>
              </tr>
              <tr>
                <th>
                  著者
                </th>
                <td>
                  <input name="chysh" type="text" value="{{ old('chysh') }}" maxlength="10" size="20">
                </td>
              </tr>
              @if(Session::has('role'))
              <tr>
                <th>
                  マイレビューのみ対象
                </th>
                <td>
                  <input type="checkbox" name="onlyMine" value="1">
                </td>
              </tr>
              @endif
            </table>
            <br>
            <input type="submit" name="searchBtn" class="btn" value="検索">
            <br><br>
        </section>
      </div>
      <div id="tagArea">
        <div class="headline">
          <タグ検索>
            <div class="headlineChild">
              &nbsp;&nbsp;※未入力での検索は、タグありのレビューが検索対象となります。
            </div>
        </div>
        <input name="tagNyryk" type="text" value="{{ old('tagNyryk') }}" maxlength="40" size="80">
        <input type="submit" class="btn" name="tagSearchBtn" value="検索">
        <br><br>
        <div class="headline">人気のあるタグ</div>
        <div id="tagNnk">
          {{--タグ上位１０件を表示--}}
          @foreach ($reviewTags as $reviewTag)
          @if ($loop->index < 10) <a href="/search/results/tag/{{$reviewTag->tag_name}}">
            {{$reviewTag->tag_name}}</a><br>
            @endif
            @endforeach
        </div>
      </div>
    </div>

  </form>
</body>

</html>