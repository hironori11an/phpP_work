<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
</head>

<body>
  <form method="POST" action="{{ action('reviewController@regist') }}">
    {{ csrf_field()}}
    <input name="user_name" type="hidden" value={{ session('name') }}>
    <div class="sampleHead">
      <h1>BookSpace</h1>

      <div class="bookSite">
        <a>{{ session('name') }}</a>
      </div>
    </div>
    <div id="page">

      <header id="pageHead">
        <h1 id="siteTitle">komorikomasha</h1>
        <p id="catchcopy">1人じゃできないことも、力を合わせればできる。やってみたいをカタチにする、3人の楽しいものづくり。</p>
        <nav class="globalNavi">
          <ul>
            <li><a href="{{ action('bookspaceController@login') }}">ホームバック</a></li>
            <li><a href="about/index.html">探す</a></li>
            <li class="current"><a href="{{ action('reviewController@init') }}">レビューする</a></li>

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
              <tr>
                <th>
                  評価
                </th>
                <td>
                  <input type="radio" name="hyk" value="5">5
                  <input type="radio" name="hyk" value="4">4
                  <input type="radio" name="hyk" value="3" checked="checked">3
                  <input type="radio" name="hyk" value="2">2
                  <input type="radio" name="hyk" value="1">1
                </td>
              </tr>
              <tr>
                <th>
                  レビュー
                </th>
                <td>
                  <textarea name="review_niy" maxlength="10000" rows="4" placeholder="レビューを書く"
                    value="{{ old('review_niy') }}" style="width:100%;"></textarea>
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