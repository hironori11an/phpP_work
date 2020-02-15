@extends('layouts.kanri.kanri')
@section('title','処理結果')
@section('titleHeader','BookSpace')
@section('work')
<div align="center">
  @if(isset($success_message))
  {{ $success_message }}
  @endif

  @if(isset($url))
  <br><br>
  @component('components.btn_modoru')
  @slot('url',"$url")
  @slot('value','戻る')
  @endcomponent
  @endif
</div>
@endsection