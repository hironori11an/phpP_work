@extends('layouts.kanri.kanri')
@section('title','管理者ホーム')
@section('titleHeader','BookSpace')
@section('work')
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<br>
<table align="center" border="0" width="220">
  <tr>
    <td>
      <a href="/kanri/userRegist">●&nbsp;&nbsp;ユーザ登録</a>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <a href="/kanri/userList">●&nbsp;&nbsp;ユーザ一覧</a>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <a href="/home/">●&nbsp;&nbsp;最新作・話題作編集</a>
    </td>
  </tr>
</table>
@endsection