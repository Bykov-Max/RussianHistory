<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="{{asset('/fonts/Ancient.otf')}}" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/css1.css')}}">

</head>
<body class="antialiased">

@include('inc.navbar')


@yield('content')


@include('inc.footer')
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/workWithFile.js')}}"></script>
</body>
</html>
