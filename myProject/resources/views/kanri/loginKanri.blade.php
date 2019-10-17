@extends('layouts.kanri.kanri')
@section('titleHeader','BookSpace')
@section('title','管理者ログイン')
@section('loginForm')

<form method="POST" action="{{ route('homeKanri.signin') }}">
  {{ csrf_field()}}
  <br>
  <input type="text" id="loginId" name="loginId">
  <br><br>
  <input type="text" id="loginPass" name="loginPass">
  <br><br>
  <input type="submit">
</form>
@endsection