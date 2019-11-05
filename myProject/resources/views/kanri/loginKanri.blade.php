@extends('layouts.kanri.kanri')
@section('titleHeader','BookSpace')
@section('title','管理者ログイン')
@section('loginForm')
<form method="POST" action="{{ route('homeKanri.signin') }}">
  {{ csrf_field()}}
  <!-- 認証エラーメッセージ -->
  <table align="center" border="0" width="350" height="35">
    <tr>
      <td style="text-align: left" class="error">
        @if(Session::has('message_auth'))
        {{ session('message_auth') }}
        @endif
      </td>
    </tr>
  </table>
  <!-- ID -->
  <table align="center" border="0" width="350">
    <tr>
      <td class="input_item">
        &nbsp;ユーザID
      </td>

      <td class="input_item_value">
        <input type="text" id="name" name="name">
      </td>
    </tr>
    <tr>
      <td colspan="2" height="30">
        @if ($errors->has('name'))
        <p class="error">{{ $errors->first('name') }}</p>
        @endif
      </td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <!-- パスワード -->
    <tr>
      <td class="input_item">
        &nbsp;パスワード
      </td>

      <td class="input_item_value">
        <input type="text" id="password" name="password">
      </td>
    </tr>
    <tr>
      <td colspan="2" height="30">
        @if ($errors->has('password'))
        <p class="error">{{ $errors->first('password') }}</p>
        @endif
      </td>
    </tr>
    <tr height="30"></tr>
  </table>

  <input type="submit">
</form>
@endsection