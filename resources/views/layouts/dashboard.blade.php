<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>
        @yield('title')
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
  </head>

  <body>

    <!-- Topbar -->
    {{-- <section class="topbar d-lg-flex position-static">
        <div class="container small-3">
          <nav class="nav">
          </nav>
          <div class="col-6 col-lg-3 text-right order-lg-last">
            <div class="social">
              <a class="social-facebook text-dark" href="https://www.facebook.com/thethemeio"><i class="fa fa-facebook"></i></a>
              <a class="social-twitter text-dark" href="https://twitter.com/chuckymagic"><i class="fa fa-twitter"></i></a>
              <a class="social-instagram text-dark " href="https://www.instagram.com/afterworkchills/"><i class="fa fa-instagram"></i></a>
              <a class="social-youtube text-dark" href="https://www.youtube.com/channel/UC0vvRCPV8yFDXLhtIaUCSvg?view_as=subscriber"><i class="fa fa-youtube"></i></a>
              <a class="social-whatsapp text-dark" href="https://www.instagram.com/afterworkchills/"><i class="fa fa-whatsapp"></i></a>
            </div>
          </div>
        </div>
    </section> --}}
    <!-- /.topbar -->


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="smart">
        <div class="container">

        <div class="navbar-left mr-4">
            <button class="navbar-toggler" type="button">&#9776;</button>
            <a class="navbar-brand" href="{{route('dashboard')}}">
            <img class="logo-dark" src="{{asset('img/awc-web-logo.png')}}" alt="logo">
            <img class="logo-light" src="{{asset('img/awc-web-logo.png')}}" alt="logo">
            </a>
        </div>

        <section class="navbar-mobile">
            <nav class="nav nav-navbar mr-auto">
                <a class="nav-link active" href="{{ route('dashboard')}} ">Home</a>
                <a class="nav-link" href="{{route('dashboard.about')}}">About</a>
                <a class="nav-link" href="{{route('dashboard')}}">Events</a>
            </nav>

        </section>

        @auth
            <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-xs btn-round btn-success text-white" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->username }} <span class="arrow"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (auth()->user()->isAdmin())
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        Admin Panel
                    </a>
                @endif
                @if (auth()->user()->isSuperAdmin())
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        Admin Panel
                    </a>
                @endif
                @if (auth()->user()->isWriter())
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        Admin Panel
                    </a>
                @endif
                <a class="dropdown-item" href="{{ route('dashboard.profile', Auth::user()->id ) }}">
                    My Profile
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @endauth

        <!-- Right Side Of Navbar -->
            <!-- Authentication Links -->
        @guest
                <a class="nav-link btn btn-xs btn-round btn-primary mr-3 text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
                <a class="nav-link btn btn-xs btn-round btn-success text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @endguest

        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Header -->
    @yield('header')


    <!-- Main Content -->
    @yield('content')


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
        <div class="row gap-y align-items-center">

            <div class="col-md-3 text-center text-md-left">
            <a href="#"><img src="{{asset('img/awc-web-logo.png')}}" alt="logo"></a>
            </div>

            <div class="col-md-6">
            <div class="nav nav-center">
                <a class="nav-link" href="{{route('dashboard.about')}}">About</a>
                <a class="nav-link" href="#">Terms</a>
                <a class="nav-link" href="#">FAQ</a>
                <a class="nav-link" href="#">Policy</a>
                <a class="nav-link" href="#">Help</a>
                <a class="nav-link" href="#">Contact</a>
            </div>
            </div>

            <div class="col-md-3 text-center text-md-right">
            <small>Built by <a href="https://www.yenum.dev">Yenum O.</a> for <a href="http://www.afterworkchills.com">AWC</a> <br>© 2020. All rights reserved.</small>
            </div>

        </div>
        </div>
    </footer>
    <!-- /.footer -->


    <!-- Scripts -->
    <script>
        let updateAvatarRoute = "{{ route('admin.dashboard') }}";
        let updateHeaderRoute = "{{ route('admin.dashboard') }}";
        let updateProfileRoute = "{{ route('admin.dashboard') }}";
        console.log(updateAvatarRoute);
        console.log(updateHeaderRoute);
        console.log(updateProfileRoute);
    </script>
    <script src="{{asset('js/page.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script type="text/javascript"  src="{{asset('js/function.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Material Design -->
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-540433b5029e06e8"></script>

  </body>
</html>
