@extends('layouts.kanri.kanri')
@section('head')
<link href="{{ asset('css/pagination.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('headerRight')
<a href="/kanri">ホーム</a>
@endsection

@section('titleHeader','BookSpace')
@section('title','ユーザ一覧')
@section('work')
<table border="0" align="center" height="180">
  <tr>
    <td valign="top">
      <table border="1" margin="0" width="400" style="border-collapse:collapse;border:none;">
        <tr class="input_item">
          <th>ユーザ名</th>
          <th>役割</th>
        </tr>
        @foreach ($items as $item)
        <tr>
          <td>
            <a href="/kanri/reviews/{{$item->name}}">{{$item->name}}</a>
          </td>
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
<center>
  {{ $items->links()}}
</center>
@endsection