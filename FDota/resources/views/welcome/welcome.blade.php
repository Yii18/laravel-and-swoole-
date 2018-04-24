<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>欢迎来到个人小站 ~ 🙇</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="keywords" content="fdota,个人博客系统,blog,php,laravel,php社区,laravel社区,laravel教程,php教程,php开源,php新手,php7,laravel5">
    <meta name="author" content="PHPBlog">
    <meta name="description" content="welcome to {{ url()->current() }} , this my blog => {{ route('blogHomeIndex') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('ico/weng.jpeg')  }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <canvas id="canvas"></canvas>

    <div id="cloud">
        <div class="cloud"></div>
        <div class="rain"></div>
    </div>

    <div class="welcome">
        <div class="welcome-button">
            <div class="bt-sl-solid-l down out"></div>
            <div class="bt-sl-solid-r down out"></div>
            <a href="{{ route('blogHomeIndex') }}" class="button out lin-t">BLOG</a>
        </div>
    </div>

</body>
<script src="{{ asset('js/welcome.js') }}"></script>
</html>
