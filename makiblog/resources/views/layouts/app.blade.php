<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-inverse bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                    @include('inc.messages')

                <div class="row">
                    @if (Auth::check())
                    <div class="col-md-3">
                            <ul class="list-group mb-3">
                                    <li class="list-group-item list-group-item-info"><a href="/home"> Pocetna </a></li>
                                    @if (auth()->user()->isAdmin())
                                    <li class="list-group-item list-group-item-info"><a href="{{ route('users.index') }}"> Korisnici </a></li>
                                    @endif
                                    <li class="list-group-item list-group-item-info"><a href="{{ route('categories.index') }}">Kategorije</a></li>
                                    <li class="list-group-item list-group-item-info"><a href="{{ route('tags.index') }}">Tagovi</a></li>
                                    <li class="list-group-item list-group-item-info"><a href="{{ route('posts.index') }}">Postovi</a></li>
                                    <li class="list-group-item list-group-item-info"><a href="{{ route('trashed-posts.index') }}">Odbaceni postovi</a></li>
                            </ul>

                            <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><a href="{{ route('categories.create') }}">Kreiraj kategoriju </a></li>
                            <li class="list-group-item list-group-item-info"><a href="{{ route('tags.create') }}">Kreiraj tag </a></li>
                            <li class="list-group-item list-group-item-info"><a href="{{ route('posts.create') }}">Kreiraj post </a></li>

                            </ul>
                        
                        </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
                @else 
                @yield('content')
                @endif

                
            </div>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
