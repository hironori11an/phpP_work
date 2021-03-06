<html>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/editMyReview.css">
  <script src="{{mix('js/app.js')}}"></script>
  <script src="/js/editMyReview.js"></script>
  <title>マイレビュー　編集</title>
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
        <div id="error">
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>

          @endforeach
          @endif
        </div>
        <section class="mainVisual">
          <div id="pageBodyMain">
            <table border="0">
              <tr>
                <td colspan="2">
                  <table id="mainTable">
                    <tr>
                      <td rowspan="8" width="25%">
                        @isset($item->photo_path)
                          <img src="{{$item->photo_path}}" width="150" height="100">
                        @else
                          <img src="{{ asset('/images/no-image.png')}}" width="150" height="100">
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
                    <tr>
                      <th>
                        再読回数
                      </th>
                      <td>
                        <select name="reread_times">
                          <option value="1" {{ $item->reread_times === "1" ? 'selected="selected"' : ''}}>初回</option>
                          <option value="2" {{ $item->reread_times === "2" ? 'selected="selected"' : ''}}>２回</option>
                          <option value="3" {{ $item->reread_times === "3" ? 'selected="selected"' : ''}}>３回</option>
                          <option value="4" {{ $item->reread_times === "4" ? 'selected="selected"' : ''}}>４回以上</option>
                        </select>
                      </td>
                    </tr>

                    <tr>
                      <th>
                        読了日
                      </th>
                      <td>
                        <div id="read_end_date_are">
                          初回&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="date" name="read_end_date_for_first" value="{{$item->read_end_date_for_first}}"><br>
                          &nbsp;２回&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="date" name="read_end_date_for_second" value="{{$item->read_end_date_for_second}}" disabled=true><br>
                          &nbsp;３回&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="date" name="read_end_date_for_third" value="{{$item->read_end_date_for_third}}" disabled=true><br>
                          &nbsp;４回以降&nbsp;
                            <input type="date" name="read_end_date_for_fourth" value="{{$item->read_end_date_for_fourth}}" disabled=true><br>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <th>
                        タグ
                      </th>
                      <td>
                        <input name="tag_name" type="text" value="{{ $review_tag_all }}" maxlength="40" size="80">
                        <br>※複数タグを登録する場合はカンマ区切りで入力してください。
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

              </tr>
              <tr>
                <td colspan="2">
                  <input type="checkbox" name="delPhoto" value="1">画像を削除する
                </td>
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