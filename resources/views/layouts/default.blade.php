<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- 使国产浏览器默认采用高速模式渲染页面 -->
        <meta name="renderer" content="webkit">

        <meta name="description" content="Oriidea - 胥希进@Symon的个人博客">
        <meta name="keywords" content="前端开发, 前端工程师, UI设计, UI设计师, front-end, frontend, web development">
        <meta name="author" content="胥希进@Symon">

        <title>Oriidea - @yield('title', '')</title>

        <link rel="stylesheet" href="/css/app.css">

        <!--[if lt IE 9]>
        <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="icon" href="/favicon.ico">

    </head>
    <body>

        @include('layouts._header')

        <a id="skippy" class="sr-only sr-only-focusable" href="#content">
            <div class="container"><span class="skiplink-text">直接进入主内容区</span>
            </div>
        </a>
        <!-- skippy **end -->

        <!-- 提示信息 -->
        @include('shared._messages')

        <!-- 主内容 -->
        @yield('content')

        @include('layouts._footer')

        <script src="/js/app.js"></script>
    </body>
</html>
