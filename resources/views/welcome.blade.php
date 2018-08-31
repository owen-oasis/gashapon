<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>萬人扭誕蛋 - TripMatch自遊配</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">    
        <meta name="author" content="HO, KAI - SHIH">
        <meta name="copyright" content="Copyright©2017,Trip Match Co.">
        <meta name="keywords" content="自遊配,tripmatch,訂房,飯店,酒店,線上訂房,住宿" />
        <meta name="description" content="TripMatch自遊配提供全台上萬間房間住宿配對，最好玩最有趣的訂房平台，歡慶註冊會員破萬人，天天聖誕慶，連續五天登入會員扭蛋蛋 ！上百樣好禮等著你，立刻註冊會員再享旅遊金100元，找房超Easy，天天超回饋 ！">

        <meta itemprop="name" content="萬人扭誕蛋 - TripMatch自遊配">
        <meta itemprop="image" content="https://active.tripmatch.net/image/meta_img.png">
        <meta itemprop="description" content="TripMatch自遊配提供全台上萬間房間住宿配對，最好玩最有趣的訂房平台，歡慶註冊會員破萬人，天天聖誕慶，連續五天登入會員扭蛋蛋 ！上百樣好禮等著你，立刻註冊會員再享旅遊金100元，找房超Easy，天天超回饋 ！">

        <meta property="og:title" content="萬人扭誕蛋 - TripMatch自遊配" >
        <meta property="og:url" content="https://active.tripmatch.net/2017gashapon">
        <meta property="og:site_name" content="萬人扭誕蛋 - TripMatch自遊配" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="https://active.tripmatch.net/image/meta_img.png">
        <meta property="og:image:width" content="563" /> 
        <meta property="og:image:height" content="296" /> 
        <meta property="fb:app_id" content="269081420163880" />
        <meta property="og:description" content="TripMatch自遊配提供全台上萬間房間住宿配對，最好玩最有趣的訂房平台，歡慶註冊會員破萬人，天天聖誕慶，連續五天登入會員扭蛋蛋 ！上百樣好禮等著你，立刻註冊會員再享旅遊金100元，找房超Easy，天天超回饋 ！" >


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <?php
            header('Location: https://active.tripmatch.net/2017gashapon');
    exit;
    ?>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
