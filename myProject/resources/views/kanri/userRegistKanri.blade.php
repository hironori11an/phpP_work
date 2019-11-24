@extends('layouts.kanri.kanri')
@section('head')
<link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('titleHeader','BookSpace')
@section('title','管理者登録')
@section('work')
<form method="POST" action="{{ route('homeKanri.signin') }}">
  {{ csrf_field()}}
  <div id="app">
    <example-component></example-component>
  </div>
  <script src="{{mix('js/app.js')}}"></script>
</form>
@endsection