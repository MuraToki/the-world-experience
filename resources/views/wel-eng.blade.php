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
<body class="bg-light" id="star">

<header class="wel-head">
    <p class="wel_pass text-center"><span class="wel_span">Welcome to the World Experience!</span></p>
</header>

<main class="log-regi">
    <div class="text-center">
        @if (Route::has('login'))
            @auth
            <div class="wel-btn-en my-4">
              <a href="{{ url('/home') }}" class="">Home</a>
            </div>
            @else
            <div class="wel-btn-en my-4">
              <a href="{{ route('login') }}" class="">Login</a>
            </div>
            
            @if (Route::has('register'))
            <div class="wel-btn-en my-4">
              <a href="{{ route('register') }}" class="">Register</a>
            </div>
            @endif
            @endauth
            @endif

    </div>
          <div class="text-center">

            <div class="wel-btn-en my-4">
              <a href="{{ url('/')}}" class="">Japanease Version</a>
            </div>
            
            <div class="wel-btn-en my-4">
              <a href="{{ url('/about')}}" class="">What is the World Experience?</a>
            </div>

          </div>

</main>
    
</body>
</html>
