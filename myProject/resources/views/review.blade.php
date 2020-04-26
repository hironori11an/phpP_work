<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/review.css">
  <title>レビュー投稿</title>
</head>

<body>
  <form method="POST" action="{{ action('reviewController@regist') }}" enctype="multipart/form-data">
    {{ csrf_field()}}
    <input name="user_name" type="hidden" value={{ session('name') }}>
    <div class="sampleHead">
      <h1>BookSpace</h1>

      <div class="bookSite">
        <a href="{{ action('bookspaceController@init') }}">ログアウト</a>
        &nbsp;&nbsp;
        <a>{{ session('name') }}</a>
      </div>
    </div>
    <div id="page">

      <header id="pageHead">
        <nav class="globalNavi">
          <ul>
            <li><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
            <li><a href="{{ action('searchController@init') }}">探す</a></li>
            <li class="current"><a href="{{ action('reviewController@init') }}">レビューする</a></li>

          </ul>
        </nav>
      </header>

      <div id="pageBody">
        <div id="error">
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>

          @endforeach
          @endif
        </div>
        <section class="mainVisual">
          <div id="pageBodyMain">
            <table id="mainTable">
              <tr>
                <th>
                  ジャンル
                </th>
                <td>
                  <select name="genre">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                    @endforeach
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
              <tr>
                <th>
                  評価
                </th>
                <td>
                  <input type="radio" name="hyk" value="5">5&nbsp;&nbsp;
                  <input type="radio" name="hyk" value="4">4&nbsp;&nbsp;
                  <input type="radio" name="hyk" value="3" checked="checked">3&nbsp;&nbsp;
                  <input type="radio" name="hyk" value="2">2&nbsp;&nbsp;
                  <input type="radio" name="hyk" value="1">1&nbsp;&nbsp;
                </td>
              </tr>
              <tr>
                <th>
                  レビュー
                </th>
                <td>
                  <textarea name="review_niy" maxlength="250" rows="6" placeholder="250文字以内でレビューしてください"
                    value="{{ old('review_niy') }}" style="width:100%;"></textarea>
                </td>
              </tr>

              <tr>
                <th>
                  画像
                </th>
                <td>
                  <input type="file" name="photo">
                </td>
              </tr>

              <tr>
                <th>
                  タグ
                </th>
                <td>
                  <input name="tag" type="text" value="{{ old('tag') }}" maxlength="40" size="80">
                  <br>※複数タグを登録する場合はカンマ区切りで入力してください。
                </td>
              </tr>

            </table>
        </section>
      </div>
      <br>
      <input type="submit" class="btn">
    </div>

  </form>
</body>

</html>