<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <div class="col-md-4">

                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="panel panel-info">

                        <div class="panel-body">
                            <p>
                                <img src="{{asset(\Illuminate\Support\Facades\Auth::User()->profile->avatar)}}"
                                     alt="avatar" width="70" height="70">
                                &nbsp;&nbsp;
                                <span href="" class="" style="text-decoration: none; font-size:20px; font-weight: bold;">
                                    {{\Illuminate\Support\Facades\Auth::User()->name}}
                                    <span class="badge">{{\Illuminate\Support\Facades\Auth::User()->points}}</span>
                                </span>
                            </p>
                            <p>
                                <div class="col-lg-6">
                                    <a href="{{route('user.profile')}}" class="btn btn-xs btn-info btn-block">

                                        Edit profile
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="{{route('logout')}}" class="btn btn-xs btn-info btn-block"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                        Logout
                                    </a>
                                </div>
                            </p>
                        </div>
                    </div>


        <a href="{{ route('discussion.create') }}" class="btn btn-primary form-control">
                    Create a new discussion
                </a>
                <br><br>
                @endif

                <div class="panel panel-info">

                    <div class="panel-body">
                        <li class="list-group-item">
                            <a href="/forum" class="" style="text-decoration: none;">
                                Home
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li class="list-group-item">
                                <a href="/forum?filter=me" class="" style="text-decoration: none;">
                                    My Discussions
                                </a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <a href="/forum?filter=solved" class="" style="text-decoration: none;">
                                Answered Discussions
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/forum?filter=not_solved" class="" style="text-decoration: none;">
                                Unanswered Discussions
                            </a>
                        </li>
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <li class="list-group-item">
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if(\Illuminate\Support\Facades\Auth::user()->admin)

                            <div class="panel-body">
                                <li class="list-group-item">
                                    <a href="{{route('channels.index')}}" class="" style="text-decoration: none;">
                                        All Channels
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('channels.create')}}" class="" style="text-decoration: none;">
                                        Create Channel
                                    </a>
                                </li>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        Channels
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($channels as $channel)
                                <li class="list-group-item">
                                    <a href="{{ route('channel', ['slug' => $channel->slug]) }}" style="text-decoration: none;">
                                        {{ $channel->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
<br><hr>
   <footer class="text-center">
       <p>
           Created by Sharif Qasrawi
       </p>
   </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <script>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            toastr.success("{{ \Illuminate\Support\Facades\Session::get('success') }}")
        @endif

        @if(\Illuminate\Support\Facades\Session::has('info'))
            toastr.info("{{ \Illuminate\Support\Facades\Session::get('info') }}")
        @endif
    </script>

</body>
</html>
