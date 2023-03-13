<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

   {{--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
  
  <link rel="stylesheet" href="{{asset('assets/css/maicons.css')}}">

  <link rel="stylesheet" href="{{asset('assets/vendor/animate/animate.css')}}">

  <link rel="stylesheet" href="{{asset('assets/vendor/owl-carousel/css/owl.carousel.css')}}">

  <link rel="stylesheet" href="{{asset('assets/vendor/fancybox/css/jquery.fancybox.css')}}">

  <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/> -->
 
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script> -->

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="d-inline-block">
              <span class="mai-mail fg-primary"></span> <a href="mailto:corperatesupport@mfmrd.gov.ki">corperatesupport@mfmrd.gov.ki</a>
            </div>
            <div class="d-inline-block ml-2">
              <span class="mai-call fg-primary"></span> <a href="tel:+0011223495">+0011223495</a>
            </div>
          </div>
          <div class="col-md-4 text-right d-none d-md-block">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-youtube"></span></a>
              <a href="#"><span class="mai-logo-linkedin"></span></a>
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .top-bar -->

    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a href="index.html" class="navbar-brand">KI<span>-FISHERIES</span><span class="text-primary">-IMS.</span></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarContent">
            
          <ul class="navbar-nav ml-auto pt-3 pt-lg-0">
          {{--<div class="btn-group">
            <div class="btn-group">
            <button type="button" class="btn btn-secondary">Island</button>
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('island.index')}}">Index</a></li>
                    <li><a class="dropdown-item" href="{{route('island.create')}}">Create</a></li>
                     <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            </div>
            <div class="btn-group">
            <div class="btn-group">
            <button type="button" class="btn btn-secondary">Village</button>
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('village.index')}}">Index</a></li>
                    <li><a class="dropdown-item" href="{{route('village.create')}}">Create</a></li>
                     <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            </div>
            <div class="btn-group">
            <div class="btn-group">
            <button type="button" class="btn btn-secondary">Training Types</button>
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('training_type.index')}}">Index</a></li>
                    <li><a class="dropdown-item" href="{{route('training_type.create')}}">Create</a></li>
                     <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            </div>
            <div class="btn-group">
            <div class="btn-group">
            <button type="button" class="btn btn-secondary">Training</button>
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('training.index')}}">Index</a></li>
                    <li><a class="dropdown-item" href="{{route('training.create')}}">Create</a></li>
                     <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            </div>--}}
           
          </ul>

          <ul class="navbar-nav ms-auto">
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

                                    @foreach ($navbars as $navbarItem)
                                        @can($navbarItem->permission)
                                            <a class="dropdown-item" href="{{ route($navbarItem->route) }}">{{ $navbarItem->name }}</a>
                                        @endcan
                                    @endforeach

                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
      </div> <!-- .container -->
    </nav> <!-- .navbar -->

    <!-- <div class="page-banner bg-img bg-img-parallax overlay-dark" style="background-image:url({{url('assets/img/bg_image_3.jpg')}})">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-lg-8">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
              </ol>
            </nav>
            <h1 class="fg-white text-center">About</h1>
          </div>
        </div>
      </div> -->
    <!-- </div> .page-banner -->
  </header>

  <main>
  <div class="row justify-content-center mt-0">

  <div class="page-section">
        
        <div class="container">
        @yield('content')
        </div> <!-- .container -->
      </div> <!-- .page-section -->
  
  </div>
  @stack('after-scripts')
  </main>

  <footer class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 py-3">
          <h3>Fisheries<span class="fg-primary">Training.</span></h3>
        </div>
        <div class="col-lg-3 py-3">
        <h5>Contact Information</h5>
          <p>Ministry of Fisheries and Marine Resources Development.</p>
          <p>Support: Corporate Service</p>
          <p>Email: kairaoii@mfmrd.gov.ki</p>
          <p>Phone: +00 112323980</p>
        </div>
        <div class="col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">Career</a></li>
            <li><a href="#">Resources</a></li>
            <li><a href="#">News & Feed</a></li>
          </ul>
        </div>
        <div class="col-lg-3 py-3">
          <h5>Newsletter</h5>
          <form action="#">
            <input type="text" class="form-control" placeholder="Enter your email">
            <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
          </form>
        </div>
      </div>

      <hr>

      <div class="row mt-4">
        <div class="col-md-6">
          <p>Copyright 2023 at MFMRD</p>
        </div>
        <div class="col-md-6 text-right">
          <div class="sosmed-button">
            <a href="#"><span class="mai-logo-facebook-f"></span></a>
            <a href="#"><span class="mai-logo-twitter"></span></a>
            <a href="#"><span class="mai-logo-youtube"></span></a>
            <a href="#"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  
<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>

{{--<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>--}}

<script src="{{asset('assets/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('assets/vendor/wow/wow.min.js')}}"></script>

<script src="{{asset('assets/vendor/fancybox/js/jquery.fancybox.min.js')}}"></script>

<script src="{{asset('assets/vendor/isotope/isotope.pkgd.min.js')}}"></script>

<script src="{{asset('assets/js/google-maps.js')}}"></script>

<script src="{{asset('assets/js/theme.js')}}"></script>