<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{url("css/style.css")}}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstarp.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="/jquery-3.6.4.min.js"></script>
</head>
<body>
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
      </symbol>
      <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
      </symbol>
      <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
  </svg>
  <nav class="navbar navbar-expand-lg bg-body-tertiary shadow py-2 mb-3 sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{route('index')}}">SkaydiLaravel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('about')}}">about</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('contact')}}">contact</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Computers
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route('home')}}">Show All Computers</a></li>
              @auth
                <li><a class="dropdown-item" href="{{route('computers.index')}}">Show Your Computers</a></li>
                <li><a class="dropdown-item" href="{{route('computers.create')}}">Create New Computer</a></li>
              @endauth
            </ul>
          </li>
          @guest
            @if (Route::has('login'))
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
            @endif

            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
          @endguest
        </ul>
        <form class="d-flex" role="search" method="POST" action="{{route('search')}}">
          @method('GET')
          <input name="search" id="s" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
   </nav>
  {{-- <div id="app">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 mb-3 rounded sticky-top">
      <div class="container d-flex justify-content-between">
          <a class="navbar-brand" href="{{route('index')}}">SkaydiProjet</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('about')}}">about</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('contact')}}">contact</a>
              </li>
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="">Create</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="">Computers</a>
                </li>    
              @endauth
              
              
              
            </ul>
            
          </div>
      </div>
    </nav>
  </div> --}}
  <section class="container">
      @yield('content')
  </section>
  
  <footer>
    <div class="footer-content">
        <h3>Skaydi</h3>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo iste corrupti doloribus odio sed!</p>
        <ul class="socials">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2023 SkaydiX.</p>
    </div>
  </footer>
  
</body>
</html>
