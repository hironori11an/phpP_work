<!-- <?php phpinfo();?> -->
@extends('layouts.app')

@section('content')


@foreach($items as $item)
{{$item->name}}<br>

@endforeach
@endsection