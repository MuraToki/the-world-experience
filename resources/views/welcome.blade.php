<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WELCOME｜世界体験記</title>
    <link rel="shortcut icon" href="{{ asset('/favicon01.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="bg-dark" id="star">

<header class="wel-head">
    <p class="wel_pass text-center text-dark">
        <span class="wel_span">ようこそ 世界体験記へ！</span>
    </p>

</header>

<main class="log-regi">
    <div class="text-center ">
        @if (Route::has('login'))
            @auth
            <div class="wel-btn my-4">
                <a href="{{ url('/home') }}" class="">一覧画面に戻る</a>
            </div>
            @else
            <div class="wel-btn my-4">
                <a href="{{ route('login') }}" class=" ">ログイン</a>
            </div>
            
            @if (Route::has('register'))
            <div class="wel-btn my-4">
                <a href="{{ route('register') }}" class="">新規登録</a>
            </div>
            @endif
            @endauth
            @endif
    </div>

<div class="text-center">
    <div class="wel-btn my-4">
        <a href="{{ url('/en')}}" class="">英語版</a>
    </div>
    <div class="wel-btn my-4">
        <a href="{{ url('/about')}}" class="">世界体験記とは</a>
    </div>
</div>

</main>
    
</body>
</html>
