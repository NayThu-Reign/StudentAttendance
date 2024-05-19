<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <style>
        .active-link {
            background-color: rgb(168, 177, 214) !important;
        }

        .sort:hover {
            background: rgb(213, 209, 209);
        }
    </style>
</head>
<body>
    <div id="app" class="row g-0" style="height: 100vh">
                <div class="col-2 border" style="background: #222">
                    <div class="mt-3 ms-3 d-flex align-items-center gap-3">
                        <div style="width: 80px; height: 80px; background: white">
                            @if(Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{Auth::user()->name}}" style="width: 100%; height: 100%">
                            @else
                                <img src="{{ asset('vector-users-icon.jpg')}}" alt="{{Auth::user()->name}}" style="width: 100%; height: 100%">
                            @endif
                        </div>
                        <a href="{{url("admin/admins/detail/" . Auth::user()->id )}}" class="text-light">
                            <h3>{{Auth::user()->name}}</h3>
                            <h5>Admin</h5>
                        </a>
                    </div>

                    <ul class="list-group text-center text-center mt-5">
                        <li class="list-group-item d-flex align-items-center justify-content-center {{ Request::is("admin") ? 'active-link' : '' }}" style="height: 60px; font-size: 20px; border: none; background: #222 ">
                            <a href="{{ url("/admin")}}" class="ms-2 text-decoration-none d-none d-lg-inline text-light">Dashboard</a>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-center {{ Request::is("admin/grades/view/all") ? 'active-link' : '' }}" style="height: 60px; font-size: 20px; border: none; background: #222">
                            <a href="{{ url("admin/grades/view/all")}}" class="ms-2 text-decoration-none d-none d-lg-inline text-light">Grades</a>
                        </li>

                        <li class="list-group-item d-flex align-items-center justify-content-center {{ Request::is("admin/attendances/view/all") ? 'active-link' : '' }}" style="height: 60px; font-size: 18px; border: none; background: #222">
                            <a href="{{ url('/admin/attendances/view/all')}}" class="ms-2 text-decoration-none d-none d-lg-inline text-light">Attendance Records</a>
                        </li>
                        {{-- <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 60px; font-size: 18px; border: none; background: #222">
                            <a href="#"  class="ms-2 text-decoration-none d-none d-lg-inline text-light">Teachers</a>
                        </li>
                        <li class="list-group-item d-flex align-items-center justify-content-center" style="height: 60px; font-size: 18px; border: none; background: #222"">
                            <a href="#" class="ms-2 text-decoration-none d-none d-lg-inline text-light">Transport</a>
                        </li> --}}
                    </ul>
                </div>
        <main class="col-10 py-4" >

            <nav class="navbar navbar-expand-md  navbar-light bg-white shadow-sm mb-3" style="height: 30px">
                <h5 class="ms-4">Wecome to School Management</h5>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto me-5">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                </div>
            </nav>
            @yield('content')
        </main>
    </div>
</body>
</html>
