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
                  <input id="tytle" type="text">
                </td>
              </tr>
              <tr>
                <th>
                  著者
                </th>
                <td>
                  <input id="chysh" type="text">
                </td>
              </tr>
              <tr>
                <th>
                  評価
                </th>
                <td>
                  <input type="radio" name="hyuk" value="5">5
                  <input type="radio" name="hyuk" value="4">4
                  <input type="radio" name="hyuk" value="3" checked="checked">3
                  <input type="radio" name="hyuk" value="2">2
                  <input type="radio" name="hyuk" value="1">1
                </td>
              </tr>
              <tr>
                <th>
                  レビュー
                </th>
                <td>
                  <textarea name="review_" id="review_" maxlength="10000" rows="4" placeholder="レビューを書く"
                    style="width:100%;"></textarea>
                </td>
              </tr>
            </table>
        </section>
      </div>
    </div>

  </form>
</body>

</html>