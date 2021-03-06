<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name') }} | @yield('title')</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand mr-auto" href="{{ route('home') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('messages.Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-md-0">
                        <li class="nav-item mr-2">
                            <a href="{{ route('home') }}" class="nav-link">持ち歌一覧</a>
                        </li>
                        
                        <li class="nav-item mr-2">
                            <a href="{{ route('search') }}" class="nav-link">曲を探す</a>
                        </li>
                        
                        <li class="nav-item mr-2">
                            <a href="{{ route('users.search') }}" class="nav-link">ユーザーを探す</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('following') }}">
                                    フォロー <span class="badge badge-primary">{{ $follow_count }}</span>
                                </a>
                                
                                <a class="dropdown-item" href="{{ route('followers') }}">
                                    フォロワー <span class="badge badge-primary">{{ $follower_count }}</span>
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('edit') }}">
                                    アカウント編集
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('messages.Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="py-3 my-5">
            @if(session('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-secondary text-center" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="container">
                <div class="row">
                    <div class="col-11 col-md-10 mx-auto">
                        <div class="mt-5 mb-4">
                            @yield('back')
                            
                            <h3 class="text-primary text-center">@yield('page_heading')</h3>
                        </div>
                        
                        @yield('content')
                        
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
