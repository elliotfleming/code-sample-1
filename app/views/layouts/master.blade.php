<!doctype html>
<html lang="en">
<head>
    
    <!--Meta-->
    <meta charset="utf-8">
    <meta name="token" content="{{ Session::token() }}">

    <!--Title-->
    <title>@yield('title')</title>
    
    <!--Icons-->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    
    <!--Styles-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    
    <!--Scripts-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>

</head>
<body>

    <div class="container-main">

        <div class="container">

            <header>

                <div id="nav">
                    <nav class="navbar navbar-default" role="navigation">
                        
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-target">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ URL::route('home') }}">
                                <img src="/img/logo-large-splash.png" width="30">
                                Every Equity
                            </a>
                        </div>
                        
                        <div class="collapse navbar-collapse navbar-collapse-target">

                            <ul class="nav navbar-nav">
                                <li><a href="{{ URL::route('home') }}"><i class="icon-home"></i> Home</a></li>
                                @if (Auth::check())
                                    @if (Authority::can('read', 'Admin'))
                                        <li><a href="{{ URL::to('admin') }}"><i class="icon-cogs"></i> Admin</a></li>
                                    @endif
                                    @if (Authority::can('read', 'Users'))
                                        <li><a href="{{ URL::to('users') }}"><i class="icon-group"></i> Users</a></li>
                                    @endif
                                    <li><a href="{{ URL::route('auth.logout') }}"><i class="icon-signout"></i> Logout</a></li>
                                @else
                                    <li><a href="{{ URL::route('auth.login') }}"><i class="icon-signin"></i> Login</a></li>
                                    <li><a href="{{ URL::route('auth.signup') }}"><i class="icon-check"></i> Sign Up</a></li>
                                @endif
                            </ul>
                            
                            @if (Auth::check())
                                <p class="navbar-text pull-right"><a href="{{ URL::to('account') }}" class="navbar-link"><i class="icon-user"></i> {{ Auth::user()->email }}</a></p>
                            @endif

                        </div>

                    </nav> <!--End .navbar-->
                </div> <!--End #nav-->

            </header>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div id="notifications" class="text-center">

                        {{ Notification::showAll() }}

                    </div> <!--End #notifications-->

                </div>
            </div> <!--End .row-->

        </div> <!--End .container-->

        <div id="content">

            @yield('content')

        </div> <!--End #content-->

    </div> <!--End #container-->

</body>
</html>