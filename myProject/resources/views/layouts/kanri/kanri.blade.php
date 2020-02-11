<html>

<head>
    <title>@yield('title')</title>
    <link href="{{ asset('css/kanri/kanri.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}">
    <link rel="stylesheet" href="/css/common.css">
    @section('head')
    @show
</head>

<body>
    <div class="header">

        <h1>@yield('titleHeader')</h1>
        <div class="bookSite">
            @section('headerRight')
            @show
        </div>


    </div>
    <p class="title">@yield('title')</p>

    <div class="work">
        @section('work')
        @show
    </div>


</body>

</html>