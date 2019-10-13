@extends('layouts.kanri.kanri')
@section('titleHeader','BookSpace')
@section('title','管理者ログイン')
@section('loginForm')

<form method="POST" action="/hello">
  {{ csrf_field()}}
  <br>
  <input type="text" id="loginId">
  <br><br>
  <input type="text" id="loginPass">
  <br><br>
  <input type="submit">
</form>
@endsection