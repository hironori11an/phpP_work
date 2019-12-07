@extends('layouts.kanri.kanri')
@section('title','処理結果')
@section('titleHeader','BookSpace')
@section('work')
@if(isset($success_message))
<li align="center">{{ $success_message }}</li>
@endif
@endsection