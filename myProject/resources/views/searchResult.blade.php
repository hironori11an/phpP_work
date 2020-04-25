<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/searchResult.css">

  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/searchResult.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>レビュー検索結果</title>
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
        <a>{{ session('name') }}</a>

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
            <table border="0" width="800" id="reviewTable">
              <tr class=tr_title>
                <input type="hidden" name="reviewId" class="reviewId" value="{{$item->id}}">
                <td colspan="2">
                  <div>
                    <p><span class="title">{{$item->title}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>


                  </div>
                </td>
              </tr>
              <tr class=tr_title>
                <td width="270"> 著者:&nbsp;&nbsp;{{$item->chysh}}
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
                  <a href="/search/results/{{$item->user_name}}">{{$item->user_name}}</a>さんのレビュー&nbsp;&nbsp;
                  <img src="{{ asset('/images/hyk_level/ico_grade_'.$item->hyk.'.gif')}}" width="80" height="15"><br>
                  {{$item->review_niy}}
                </td>
              </tr>
              <tr class=tr_review>
                <td class="td">
                  {{--ログインしていない場合は、いいねボタンを非表示--}}
                  @if(Session::has('role'))
                  <label class="iine-btn">
                    @forelse($item->users as $user)
                    @if($user->name === session('name'))
                    <img src="{{ asset('/images/iineZumi.png')}}" class="iine-off" width="20" height="20">
                    <div class="iine-word">いいね済み</div>
                    @break
                    @endif

                    @empty
                    <img src="{{ asset('/images/iine.png')}}" class="iine-on" width="20" height="20">
                    <div class="iine-word">いいね</div>
                    @endforelse

                    @if((count($item->users) > 0) && ($user->name != session('name')))
                    <img src="{{ asset('/images/iine.png')}}" class="iine-on" width="20" height="20">
                    <div class="iine-word">いいね</div>
                    @endif
                  </label>
                  @endif
                  <label class="iineUser">
                    <input type="button" id="likedUser" value="いいねしたユーザ&nbsp;({{count($item->users)}})">
                  </label>

                </td>
                <td class="tag_td">
                  @foreach ($item->review_tags as $review_tag)
                  <input type="submit" class="buttonLink" name="tag_button" value="{{ $review_tag->tag_name }}">
                  @endforeach
                </td>
              </tr>

            </table>
            <br><br>
            @endforeach
            @endif
          </div>
      </div>
      </section>
    </div>
    <br>
    <!-- 小画面遷移時に、この画面全体を暗くするためのdiv -->
    <div id="fadeLayer">
    </div>
  </form>
</body>

</html>