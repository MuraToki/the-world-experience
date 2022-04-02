<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>世界体験記とは</title>
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
<body id="app_body" >

<div class="japanease rounded mt-2">
  <div class="about-title text-center">
    <h1><span class="span-about-ja fw-bold">世界体験記とは</span></h1>
  </div>
  <div class="jp-passage">
    <p>このWebアプリは、国外や国内に行ったときの体験を書くものです。また、タイトルと内容と画像を投稿することができます。<br>皆様の面白い体験、奇妙な体験、怖い体験などを書いてください。<br>このWebアプリは無料で新規登録とログインができます。<br>使用するときも無料です。ぜひ、あなたの体験を投稿してください！
    </p>

  </div>
  
  <div class="about-btn text-center">
        @if (Route::has('login'))
        @auth
        @else
        <div class="my-2">
          <a href="{{ route('login') }}" class="btn btn-outline-dark ">ログイン</a>
        </div>
        
        @if (Route::has('register'))
        <div class="my-2 ms-3">
          <a href="{{ route('register') }}" class="btn btn-outline-dark ">新規登録</a>
        </div>
        @endif
        @endauth
        @endif
      </div>
    </div>
      
<div class="english mt-4 mb-3">
  <div class="about-title text-center">
    <h1><span class="span-about-en text-light fw-bold">What is The World Experience?</span></h1>
  </div>
  <div class="eng-passage">
    <p class="text-light fw-bold">This web application is to write about your experiences when you have been out of the country or in the country.<br> You can also submit a title, content and images.<br> Please write about your funny, strange, or scary experiences. <br>This web application is free and you can register and log in as a new user. <br> It's also free to use. Please submit your experiences!</p>
  </div>
  <div class="about-btn text-center">
    @if (Route::has('login'))
    @auth
            @else
            <div class="my-2 ">
              <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
            </div>
            
            @if (Route::has('register'))
            <div class="my-2 ms-3">
              <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
            </div>
            @endif
            @endauth
            @endif
            
          </div>
</div>
          


</body>
</head>
