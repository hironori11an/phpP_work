<html>

<head>
    <title>@yield('title')</title>
    <link href="{{ asset('css/kanri/kanri.css') }}" rel="stylesheet">
</head>

<body>
    <h1>@yield('titleHeader')</h1>
    <p class="title">@yield('title')</p>
    <div>
        @section('loginForm')
        @show
    </div>


</body>

</html>