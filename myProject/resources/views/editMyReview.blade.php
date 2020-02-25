<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/editMyReview.css">
  <script src="{{mix('js/app.js')}}"></script>
</head>

<body>
  <form method="POST" action="{{ action('editMyReviewController@edit') }}" enctype="multipart/form-data">
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
            <li class="current"><a href="{{ action('bookspaceController@login') }}">ホーム</a></li>
            @else
            <li><a href="/">ホーム</a></li>
            @endif
            <li><a href="{{ action('searchController@init') }}">探す</a></li>
            @if(Session::has('role'))
            <li><a href="{{ action('reviewController@init') }}">レビューする</a></li>
            @endif

          </ul>
        </nav>
      </header>

      <div id="pageBody">
        <section class="mainVisual">
          <div id="pageBodyMain">
            <table border="0">
              <tr>
                <td colspan="2">
                  <table id="mainTable">
                    <tr>
                      <td rowspan="5" width="22%">
                        @isset($item->photo_path)
                        <input type="image" src="{{$item->photo_path}}" width="150px" height="150px">
                        @else
                        画像なし
                        @endisset
                      </td>
                      <th>
                        ジャンル
                      </th>
                      <td>
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
                      </td>
                    </tr>
                    <tr>
                      <th>
                        タイトル
                      </th>
                      <td>
                        <input name="title" type="text" value="{{$item->title}}" maxlength="20" size="40">

                      </td>
                    </tr>
                    <tr>
                      <th>
                        著者
                      </th>
                      <td>
                        <input name="chysh" type="text" value="{{$item->chysh}}" maxlength="10" size="20">

                      </td>
                    </tr>
                    <tr>
                      <th>
                        評価
                      </th>
                      <td>
                        <input type="radio" name="hyk" value="5" {{ $item->hyk === "5" ? 'checked="checked"' : ''
                        }}>5&nbsp;&nbsp;
                        <input type="radio" name="hyk" value="4" {{ $item->hyk === "4" ? 'checked="checked"' : ''
                        }}>4&nbsp;&nbsp;
                        <input type="radio" name="hyk" value="3" {{ $item->hyk === "3" ? 'checked="checked"' : ''
                        }}>3&nbsp;&nbsp;
                        <input type="radio" name="hyk" value="2" {{ $item->hyk === "2" ? 'checked="checked"' : ''
                        }}>2&nbsp;&nbsp;
                        <input type="radio" name="hyk" value="1" {{ $item->hyk === "1" ? 'checked="checked"' : ''
                        }}>1&nbsp;&nbsp;
                      </td>
                    </tr>
                    <tr>
                      <th>
                        レビュー
                      </th>
                      <td>
                        <textarea name="review_niy" maxlength="250" rows="9"
                          style="width:100%;">{{$item->review_niy}}</textarea>

                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>

                <td width="100">

                  <label class="upload-img-btn">
                    画像を変更する
                    <input type="file" id="file" name="photo" style="display:none"
                      onchange="$('#fake_text_box').val($(this).val().split('\\').pop())">
                  </label>

                </td>
                <td>
                  <input type="text" id="fake_text_box" value="" size="35" readonly onClick="$('#file').click();">
                </td>

                {{--
                <td>
                  <input type="file" name="photo">
                </td>
                --}}
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td></td>
                <td align="right">
                  <input type="submit" class="btn" name="upd-btn"
                    value="更新">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn-strong" name="del-btn" value="削除"></td>
              </tr>
            </table>


          </div>
        </section>
      </div>
      <br>
    </div>


  </form>
</body>

</html>