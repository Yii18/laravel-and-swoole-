<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="php,laravel,vuejs,laravel5.3,blog,laravel博客,vue博客,博客,vue2,php开源,php新手,laravel新手,php7,laravel5">
    <meta name="author" content="Weng">
    <meta name="description" content="{{ isset($row->content) ? mb_substr(clearMk($row->content), 0, 200) . '...' : config('blog.default_description') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ config('blog.default_icon') }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    <style>
        body {
            background-color: #182023;
        }
    </style>

    @yield('styles')
</head>
<body>
    <div id="main" class="col-md-8 col-md-offset-2">
        @yield('content')
    </div>
</body>
</html>