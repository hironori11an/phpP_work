<html>

<head>
    <title>@yield('title')</title>
    <link href="{{ asset('css/kanri/kanri.css') }}" rel="stylesheet">
    @section('head')
    @show
</head>

<body>
    <h1>@yield('titleHeader')</h1>

    <p class="title">@yield('title')</p>

    <div class="work">
        @section('work')
        @show
    </div>


</body>

</html>