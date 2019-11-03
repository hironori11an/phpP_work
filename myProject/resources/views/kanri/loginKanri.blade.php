@extends('layouts.kanri.kanri')
@section('titleHeader','BookSpace')
@section('title','管理者ログイン')
@section('loginForm')

<form method="POST" action="{{ route('homeKanri.signin') }}">
  {{ csrf_field()}}
  <br>
  <!-- ID -->
  <input type="text" id="name" name="name">
  @if ($errors->has('name'))
  <p class="error">{{ $errors->first('name') }}</p>
  @endif
  <br><br>

  <!-- パスワード -->
  @if ($errors->has('password'))
  <p class="error">{{ $errors->first('password') }}</p>
  @endif
  <input type="text" id="password" name="password">
  <br><br>


  <input type="submit">
</form>
@endsection