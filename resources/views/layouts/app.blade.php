<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ config('app.name') }}
    </title>
{{--    <title>{{ config('app.name', 'Laraveldre Social') }}</title>--}}

<!-- Scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/99e52f3ecd.js" crossorigin="anonymous"></script>  <!--icons-->
    <link rel="icon" href="{{ URL::asset('/images/svg/meeting.svg') }}" type="image/x-icon"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<header>

    <section class="main-col">
        <nav id="main-nav" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <img id="logo" src="/images/svg/meeting.svg" alt="site_icon">
            <a class="navbar-brand" href="{{ url('/users') }}">Laraveldre social</a>


            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Users <span class="caret"></span> </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" id="posts" href="{{ route('users.index') }}"
                                   onclick="location.href = 'users'">{{'All users'}}
                                </a>
                                <a class="dropdown-item" id="posts"
                                   href="{{route('users.friends',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
                                   onclick="location.href = 'users'">{{'My friends'}}
                                </a>
                                <a class="dropdown-item" id="posts"
                                   href="{{route('users.followers',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
                                   onclick="location.href = 'users'">{{'My followers'}}
                                </a>
                                <a class="dropdown-item" id="posts"
                                   href="{{route('users.followings',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
                                   onclick="location.href = 'users'">{{'Following'}}
                                </a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Posts <span class="caret"></span> </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" id="all-posts" href="{{ route('posts.index') }}"
                                   onclick="location.href = 'posts'">{{'All posts'}}
                                </a>
                                <a class="dropdown-item" id="my-posts"
                                   href="{{ action('UsersController@showPosts',[auth()->user()->id, auth()->user()->name, auth()->user()->surname]) }}"
                                   onclick="location.href ='posts/redirect'">{{'My posts'}}
                                </a>
                                <a class="dropdown-item" id="create-post" href="{{ route('posts.create-post') }}"
                                   onclick="location.href = 'posts/create-post'">{{'Create new post'}}
                                </a>
                            </div>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My account <span class="caret"></span> </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" id="wall" href="{{ route('home') }}"
                                   onclick="location.href = 'home'">{{'My wall'}}
                                </a>
                                <a class="dropdown-item" id="profile" href="{{ route('users.profile') }}"
                                   onclick="location.href = 'home'">{{'My profile'}}
                                </a>
                                <a class="dropdown-item" id="change-password" href="{{ route('users.change-password-form') }}"
                                   onclick="location.href = 'home'">{{'Change password'}}
                                </a>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </nav>

        <main class="pb-4">
            @yield('content')
        </main>

    </section>
</header>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
        integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
        crossorigin="anonymous"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'));
    config.fillEmptyBlocks = false;
    config.fillEmptyBlocks = function (element) {
        if (element.attributes['class'].indexOf('clear-both') !== -1)
            return false;
    }
</script>

</body>
</html>

