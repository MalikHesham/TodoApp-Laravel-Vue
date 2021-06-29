<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel TodoApp</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito"
            rel="stylesheet"
        />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap"
            rel="stylesheet"
        />
        <!-- Font Awesome CDN -->
        <script
            src="https://kit.fontawesome.com/7786be5985.js"
            crossorigin="anonymous"
        ></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
                <div class="container">
                    @if(Auth::check())
                    <a class="navbar-brand">
                        Welcome Back, {{Auth::user()->name}}!
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Tic-tac-do!
                    </a>
                    @endif
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest @if (Route::currentRouteName()=='register')
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('login') }}"
                                    >{{ __("Login") }}</a
                                >
                            </li>
                            @endif @if ( Route::currentRouteName()=='login' ||
                            Route::currentRouteName()=='')
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('register') }}"
                                    >{{ __("Register") }}</a
                                >
                            </li>
                            @endif @else
                            <li class="nav-item dropdown">
                                <a
                                    id="navbarDropdown"
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    v-pre
                                >
                                    {{ Auth::user()->name }}
                                </a>

                                <div
                                    class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="navbarDropdown"
                                >
                                    <a
                                        class="dropdown-item btn btn-secondary"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                    >
                                        {{ __("Logout") }}
                                        <i class="fas fa-sign-out-alt"></i>
                                    </a>

                                    <form
                                        id="logout-form"
                                        action="{{ route('logout') }}"
                                        method="POST"
                                        class="d-none"
                                    >
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
                @yield('content')
            </main>
        </div>
    </body>
</html>
