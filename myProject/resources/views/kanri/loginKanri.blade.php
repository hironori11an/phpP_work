@extends('layouts.kanri.kanri')
@section('title','ログイン')
@section('titleHeader','BookSpace')
@section('head')
@endsection
@section('work')
<form method="POST" action="{{ route('homeKanri.login') }}">
  @csrf
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
    <tr height="20"></tr>
  </table>

  <center><input type="submit" class="btn" name="login" value="ログイン"></center>
  <br><br><br>
</form>

<form method="POST" action="{{ route('homeKanri.kntnLogin') }}">
  @csrf
  <table align="center" width="350" class="tbl_bold">
    <tr>
      <th class="tbl_bold_thtd">
        かんたんログイン
      </th>
      <td class="tbl_bold_thtd">
        <input type="submit" class="btn" name="ippn" value="一般ログイン">
      </td>
      <td>
        <input type="submit" class="btn" name="knr" value="管理ログイン">
      </td>
    </tr>
  </table>


</form>
@endsection