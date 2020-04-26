@extends('layouts.kanri.kanri')
@section('head')
<link href="/css/userRegist.css" rel="stylesheet" type="text/css">
@endsection
@section('titleHeader','BookSpace')
@section('headerRight')
<a href="{{ action('bookspaceController@init') }}">ホーム</a>
@endsection
@section('title','ユーザ登録')
@section('work')

<form id="form" method="POST" action="{{ action('userRegistController@regist') }}">
  @csrf
  <div class="form_ur">
    <div class="error">{!!session('err_m')!!}</div>
    <p class="item_ur" id="user_id">ユーザID
    </p>
    @if ($errors->has('name'))
    <div class="error">{{ $errors->first("name") }}</div>
    @else
    <br>
    @endif

    <input class="value_ur" type="text" name="name" size="20" value="{{ old('name') }}">

    <p class="item_ur" id="password">パスワード
    </p>
    @if ($errors->has('password'))
    <div class="error">{{ $errors->first("password") }}</div>
    @else
    <br>
    @endif
    <input class="value_ur" type="password" name="password" size="20">

    <p class="item_ur" id="passwordKknn">パスワードの確認</p>
    <br>
    <input class="value_ur" type="password" name="password_kknn" size="20">
  </div>
  <br><br>
  <center>
    <input type="submit" class="btn">
  </center>
  <script src="{{mix('js/app.js')}}"></script>
  <script>
    $(function() {
      $('#form').submit(function(e) {
        v_password = $('input[name="password"]').val();
        v_password_kknn = $('input[name="password_kknn"]').val();
        if (v_password !== v_password_kknn) {
          alert('パスワードが一致しません');
          return false;
        }
      });
    });
  </script>
</form>
@endsection