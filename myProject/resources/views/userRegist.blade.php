@extends('layouts.kanri.kanri')
@section('head')
<link href="/css/userRegist.css" rel="stylesheet" type="text/css">
@endsection


@section('titleHeader','BookSpace')
@section('title','ユーザ登録')
@section('work')

<form id="form" method="POST" action="{{ action('userRegistController@regist') }}">
  {{ csrf_field()}}

  <div id="minyryk">
    {!!session('err_m')!!}
  </div>
  @if ($errors->any())
  <!-- バリデーションエラー  userRegistRequest-->
  <table border="0" class="all_errormessage">
    <tr>
      <td>
        <div class="error">
        </div>
    </tr>
    </td>
  </table>
  @else
  <!-- バリデーションエラー  既存ユーザチェック、空入力チェック-->
  <table border="0" class="all_errormessage" id="error_client_tbl" style="visibility:hidden;">
    <tr>
      <td>
        <div class="error_client">

        </div>
      </td>
    </tr>
  </table>
  @endif
  <br>
  <div class="form_ur">
    <p class="item_ur" id="user_id">ユーザID
    </p>
    @if ($errors->has('name'))
    {{ $errors->first("name") }}
    @else
    <br>
    @endif

    <input class="value_ur" type="text" name="name" size="20">

    <p class="item_ur" id="password">パスワード
    </p>
    @if ($errors->has('password'))
    {{ $errors->first("password") }}
    @else
    <br>
    @endif
    <input class="value_ur" type="text" name="password" size="20">

    <p class="item_ur" id="passwordKknn">パスワードの確認</p>
    <br>
    <input class="value_ur" type="text" name="password_kknn" size="20">
  </div>
  <br>
  <center>
    <input type="submit" class="btn">
  </center>
  <script src="{{mix('js/app.js')}}"></script>
  <script>
    $(function() {
      $('#form').submit(function(e) {});
      v_password = $('input[name="password"]').val();
      v_password_kknn = $('input[name="password_kknn"]').val();
      if (v_password !== v_password_kknn) {
        alert('パスワードが一致しません');
      }

    });
  </script>
</form>
@endsection