<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('/css/css1.css')}}">--}}

</head>
<body class="antialiased">

@include('inc.admin.header')

<div class="container-fluid">
    <div class="row">
        @include('inc.admin.sidebar')
        @include('inc.admin.main')
    </div>
</div>
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/workWithFile.js')}}"></script>

@stack('child-scripts')
</body>
</html>
