<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/reviewNiyRep.css">

  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/reviewNiyRep.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>レビュー詳細</title>
</head>

<body>
  <form method="POST" action="{{ action('reviewNiyServiceController@post') }}">
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



        <section class="mainVisual">
          <div id="pageBodyMain">

            <table border="0" width="800" id="reviewTable">
              <tr class=tr_title>
                <input type="hidden" name="reviewId" class="reviewId" value="{{$reviewMain->id}}">
                <td colspan="2">
                  <div>
                    <p><span class="title">{{$reviewMain->title}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>


                  </div>
                </td>
              </tr>
              <tr class=tr_title>
                <td width="270"> 著者:&nbsp;&nbsp;{{$reviewMain->chysh}}
                </td>
                <td>
                  ジャンル：
                  @foreach ($reviewMain->genres as $genre)
                  {{ $genre->genre_name }}
                  @endforeach
                </td>
              </tr>
            </table>
            <table border="0" width="800">
              <tr class=tr_review>
                <td width="22%">
                  @isset($reviewMain->photo_path)
                  <img src="{{$reviewMain->photo_path}}" width="150px" height="150px">
                  @else
                  画像なし
                  @endisset
                </td>
                <td class="tdReviwNiy">
                  <a href="/search/results/{{$reviewMain->user_name}}">{{$reviewMain->user_name}}</a>さんのレビュー&nbsp;&nbsp;
                  <img src="{{ asset('/images/hyk_level/ico_grade_'.$reviewMain->hyk.'.gif')}}" width="80"
                    height="15"><br>
                  {{$reviewMain->review_niy}}
                </td>
              </tr>
              <tr class=tr_review>
                <td class="td">
                  {{--ログインしていない場合は、いいねボタンを非表示--}}
                  @if(Session::has('role'))
                  <label class="iine-btn">
                    @forelse($reviewMain->users as $user)
                    @if($user->name === session('name'))
                    <img src="{{ asset('/images/iineZumi.png')}}" class="iine-off" width="20" height="20">
                    <div class="iine-word">いいね済み</div>
                    @break
                    @endif

                    @empty
                    <img src="{{ asset('/images/iine.png')}}" class="iine-on" width="20" height="20">
                    <div class="iine-word">いいね</div>
                    @endforelse

                    @if((count($reviewMain->users) > 0) && ($user->name != session('name')))
                    <img src="{{ asset('/images/iine.png')}}" class="iine-on" width="20" height="20">
                    <div class="iine-word">いいね</div>
                    @endif
                  </label>
                  @endif
                  <label class="iineUser">
                    <input type="button" id="likedUser" value="いいねしたユーザ&nbsp;({{count($reviewMain->users)}})">
                  </label>

                </td>
                <td class="tag_td">
                  @foreach ($reviewMain->review_tags as $review_tag)
                  <a href="/search/results/tag/{{$review_tag->tag_name}}">{{$review_tag->tag_name}}</a>&nbsp;&nbsp;
                  @endforeach
                </td>
              </tr>

            </table>
            <br>
            コメントを書く<br>
            <textarea name="reviewNiyRep" maxlength="250" rows="3" value="{{ old('reviewNiyRep') }}"></textarea>
            <input type="submit" class="btn" name="commentBtn" value="登録">
            @if(count($reviewNiyReplies)>0)
            <br>コメント<br>
            <table>
              <tr>
                <td>

                  <table class="commentIchiran" rules="none" border="1">
                    @foreach ($reviewNiyReplies as $review_niy_reply)
                    <tr>
                      <input type="hidden" class="comId" name="comId"
                        value="{{$review_niy_reply->review_niy_replies_id}}">
                      <td class="comUserName">
                        <a href="/search/results/{{$review_niy_reply->name}}">{{$review_niy_reply->name}}</a>
                      </td>
                      <td class="comNiy">
                        {{ $review_niy_reply->reply }}
                      </td>
                      <td>
                        @if($review_niy_reply->user_id === session('userId'))
                        <input type="submit" class="btn-strong" name="comDelBtn" value="削除">
                        @else
                        &nbsp;
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </table>

              </tr>
              </td>
            </table>
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