<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/bookspace.css">
  <script src="{{mix('js/app.js')}}"></script>
  <script src="{{ mix('js/show_chart.js') }}"></script>
 
  <script src="/js/bookspaceHome.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>BookSpace 読書レビューを共有しよう</title>
</head>

<body>
      @csrf
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
        <!-- ページメイン ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ -->
        <div id="pageBody">
          <section class="mainVisual">
            <div id="pageBodyMain">
              <!-- 以下グラフ ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ -->
              @if(isset($items))
                @if(count($items) > 0)
                <p>
                <b><a href="/myreview/{{session('name')}}">マイレビュー一覧</a></b>
                </p>
                &nbsp;&nbsp;&nbsp;&nbsp;ジャンル・著者別の内訳（全{{count($items)}}冊）
                
                  <div class="ChartItem"><canvas id="genreChart"></canvas></div>
                  <div class="ChartItem"><canvas id="chyshChart"></canvas></div>
                @else
                マイレビュー一覧<br>
                &nbsp;&nbsp;レビュー投稿がありません
                @endif
              @endif

              <script src="{{ mix('js/show_chart.js') }}"></script>
              <script>
                @if(isset($items))
                  id = 'genreChart';
                  labels = @json($genreGraphKeys);
                  data = @json($genreGraphCounts);
                  make_chart(id,labels,data);
                  
                  id = 'chyshChart';
                  labels = @json($chyshGraphKeys);
                  data = @json($chyshGraphCounts);
                  make_chart(id,labels,data);
                @endif
              </script>
            <!-- 以下いいねしたレビュー ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ -->
              @isset($reviewLikes)
              <details>
                <summary>いいねしたレビュー</summary>
                @if(count($reviewLikes) > 0)
                @foreach ($reviewLikes as $reviewLike)

                <table width="900" border="0" id="reviewLikeTable">
                  <tr>
                    <input type="hidden" name="reviewLike_review_id" class="reviewLike_review_id"
                      value="{{$reviewLike->pivot->review_id}}">

                    <td width="800">
                      <table border="0" width="800">
                        <tr class=tr_title>
                          <td colspan="2">
                            <div>
                              <p><span class="title">
                                  <a href="/search/results/title/{{$reviewLike->title}}">{{$reviewLike->title}}</a>
                                </span>
                              </p>
                            </div>
                          </td>
                        </tr>
                        <tr class=tr_title>
                          <td width="270">
                            著者:&nbsp;&nbsp;
                            <a href="/search/results/chysh/{{$reviewLike->chysh}}">{{$reviewLike->chysh}}</a>
                          </td>
                          <td>ジャンル：
                            @foreach ($reviewLike->genres as $genre)
                            {{ $genre->genre_name }}
                            @endforeach
                          </td>
                        </tr>
                      </table>
                      <table border="0" width="800">
                        <tr class=tr_review>
                          <td width="22%">
                            @isset($reviewLike->photo_path)
                              <img src="{{$reviewLike->photo_path}}" width="150px" height="100px">
                            @else
                              <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
                            @endisset
                          </td>
                          <td class="tdReviwNiy_iine">
                            <a
                              href="/search/results/{{$reviewLike->user_name}}">{{$reviewLike->user_name}}</a>さんのレビュー&nbsp;&nbsp;
                            <img src="{{ asset('/images/hyk_level/ico_grade_'.$reviewLike->hyk.'.gif')}}" width="80"
                              height="15"><br>
                            {{$reviewLike->review_niy}}
                          </td>
                        </tr>
                        <tr class=tr_review>
                          <td>
                            <label class="iineUser">
                              <input type="button" id="likedUser" value="いいねしたユーザ&nbsp;({{count($reviewLike->users)}})">
                            </label>
                          </td>
                          <td class="tag_td_iine">
                            @foreach ($reviewLike->review_tags as $review_tag)
                            <a href="/search/results/tag/{{$review_tag->tag_name}}">{{$review_tag->tag_name}}</a>&nbsp;&nbsp;
                            @endforeach
                          </td>
                        </tr>

                      </table>
                    </td>

                    <td>
                      <input type="button" class="btn-strong" value="取消">
                    </td>
                  </tr>
                </table>
                <br>
                @endforeach

                @else
                いいねしたレビューがありません
                @endif

              </details>
              <br>
              @endisset
              <!-- 以下タグ一覧 ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ -->              
              @if(isset($items))
              登録したタグ一覧<br>
                @if(count($myReviewTags) ===0)
                  登録されているタグはありません
                @else
                  @foreach ($myReviewTags as $myReviewTag)        
                          <a href="/search/results/tag/{{$myReviewTag->tag_name}}">{{$myReviewTag->tag_name}}</a>&nbsp;&nbsp;
                  @endforeach
                @endif
              @endif


            </div>
            @unless(isset($items)){{--itemsがない場合は画像表示 class:mainVisualText--}}
              <div class="mainVisualText">
                <h1>読書レビューサイト</h1>
                <p>読みたい本が見つかる。<br>
                  読み終わった本のレビューを投稿しよう</p>
              </div>
              <img src="{{ asset('/images/bookspace_home.jpg')}}" width="980" height="500" alt="">
            @endunless
          </section>
        </div>
      </div>
      <!-- 小画面遷移時に、この画面全体を暗くするためのdiv -->
      <div id="fadeLayer">
      </div>
</body>

</html>