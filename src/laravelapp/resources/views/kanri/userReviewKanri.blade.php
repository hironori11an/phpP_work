@extends('layouts.kanri.kanri')

@section('titleHeader','BookSpace')
@section('title')
{{$items[0]->user_name}}のレビュー一覧
@endsection
@section('head')
<link href="{{ asset('css/kanri/userReviewKanri.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('headerRight')
<a href="/kanri/userList">戻る</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/kanri">ホーム</a>
@endsection

@section('work')
<center>
  @foreach ($items as $item)
  <table border="0" width="800">
    <tr class=tr_title>
      <td colspan="2">
        <div>
          <p><span class="title">{{$item->title}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
          </p>
        </div>
      </td>
    </tr>
    <tr class=tr_title>
      <td width="270">
        著者:&nbsp;&nbsp;{{$item->chysh}}

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
        <img src="{{ asset('/images/hyk_level/ico_grade_'.$item->hyk.'.gif')}}" width="80" height="15"><br>
        {{$item->review_niy}}
      </td>
    </tr>
  </table>
  <br><br>
  @endforeach
  </div>
</center>

@endsection