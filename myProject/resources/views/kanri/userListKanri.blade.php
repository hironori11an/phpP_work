@extends('layouts.kanri.kanri')
@section('head')
{{--
<link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
--}}
<style>
  .pagination {
    fonst-size: 10pt;
  }

  .pagination {
    display: inline;
  }
</style>
@endsection


@section('titleHeader','BookSpace')
@section('title','ユーザ一覧')
@section('work')
<table border="0" align="center" height="200">
  <tr>
    <td valign="top">
      <table border="1" margin="0" width="400" style="border-collapse:collapse;border:none;">
        <tr>
          <th>ユーザ名</th>
          <th>役割</th>
        </tr>
        @foreach ($items as $item)
        <tr>
          <td>{{$item->name}}</td>
          @if ($item->role === 0)
          <td>一般</td>
          @elseif ($item->role === 1)
          <td>管理</td>
          @endif
        </tr>
        @endforeach
      </table>
  </tr>
  </td>
</table>
<div align="center">
  @component('components.btn_modoru')
  @slot('url','/kanri')
  @slot('value','戻る')
  @endcomponent

  {!! $items->links('default') !!}
</div>
@endsection