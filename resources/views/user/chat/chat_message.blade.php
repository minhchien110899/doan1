<!doctype html>
<html lang="en">

  <head>
    <title>MultiChoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700|Indie+Flower" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('/css/aos.css') }}">

     {{-- <script src="{{ url('/js/jquery-3.3.1.min.js') }}"></script> --}}
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">

    <link rel="shortcut icon" href="{{ url('/images/favicon.png?3') }}">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
    

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>



      <div class="site-navbar site-navbar-target" role="banner">

        <div class="container mb-3">
          <div class="d-flex align-items-center">
            <div class="site-logo mr-auto">
              <a href="/" class="text-black text-decoration-none">MultiChoice<span class="text-primary">.</span></a>
            </div>
            <div class="site-quick-contact d-none d-lg-flex ml-auto " style="color: black;">
              <div class="d-flex site-info align-items-center mr-5">
                <span class="block-icon mr-3"><span class="icon-map-marker text-yellow"></span></span>
                <span class="text-black">12 Nguy???n V??n B???o, Ph?????ng 4, G?? V???p, HCM,<br> Vi???t Nam</span>
              </div>
              <div class="d-flex site-info align-items-center">
                <span class="block-icon mr-3"><span class="icon-clock-o"></span></span>
                <span class="text-black">Work all day 6:30AM - 9:00PM <br> No OFF day </span>
              </div>
              
            </div>
          </div>
        </div>


        <div class="container mb-4">
          <div class="menu-wrap d-flex align-items-center bg-light">
            <span class="d-inline-block d-lg-none"><a href="#" class="text-black site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-black"></span></a></span>

              

              <nav class="site-navigation text-left mr-auto d-none d-lg-block " role="navigation">
                <ul class="site-menu main-menu js-clone-nav mr-auto ">
                  <li><a href="/" class="nav-link">Trang Ch???</a></li>
                  <li><a href="/" class="nav-link">Gi???i thi???u</a></li>
                  <li><a href="/" class="nav-link">Tham kh???o</a></li>
                  <li><a href="/" class="nav-link">C??ng t??c</a></li>
                  <li><a href="/" class="nav-link">D???ch v???</a></li>
                  <li><a href="/" class="nav-link">Li??n h???</a></li>
                  <li><a href="/chat" class="nav-link">Chat</a></li>
                </ul>
              </nav>

              <div class="top-social ml-auto">
                @guest
                            
                    @if (Route::has('register'))
                        <a href="/login">????ng nh???p</a>
                        <a href="/register">????ng k??</a>
                    @endif
                @else
                 <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/home">Home</a>
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Th??ng tin chung</a>
                                    <a class="dropdown-item" href="{{ route('subject') }}">????? thi</a>
                                    <a class="dropdown-item" href="{{ route('user.result') }}">K???t qu???</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('????ng xu???t') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>         
                @endguest
          </div>
        </div>
      </div>
    @include('inc.messages')   
    <div id="app">
        <chat-app :user="{{ Auth()->user() }}"></chat-app>
    </div>  
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="footer-heading mb-3">Gi???i thi???u</h2>
                <p class="mb-5">Trang web gi??p b???n t??? h???c t???i nh?? v???i nh???ng ????? thi ch???n l???c ph?? h???p v???i kh??? n??ng c???a b???n. </p>

                <h2 class="footer-heading mb-4">B???n mu???n ???????c t?? v???n th??m</h2>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="G???I" class="btn btn-primary">
                </form>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row justify-content-end">
              <!-- <div class="col-lg-4 ml-auto">
                <h2 class="footer-heading mb-4">Navigation</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div> -->
              <div class="col-lg-4">
                <h2 class="footer-heading mb-4">T??m hi???u th??m</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Gi???i thi???u</a></li>
                  <li><a href="#">Ch??nh s??ch</a></li>
                  <li><a href="#">??i???u kho???n</a></li>
                  <li><a href="#">D???ch v???</a></li>
                  <li><a href="#">Li??n h???</a></li>
                </ul>
                
              </div>

              
              
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="#" target="_blank" >MultiChoice</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>

        </div>
      </div>
    </footer>
    </div>
    <script src="{{ url('/js/app.js') }}"></script>
     <script src="{{ url('/js/jquery-3.3.1.min.js') }}"></script> 
    <script src="{{ url('/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/owl.carousel.min.js') }}"></script>
     <script src="{{ url('/js/jquery.sticky.js') }}"></script>
    <script src="{{ url('/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ url('/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ url('/js/jquery.fancybox.min.js') }}"></script>
     <script src="{{ url('/js/jquery.stellar.min.js') }}"></script>
     <script src="{{ url('/js/jquery.easing.1.3.js') }}"></script>
     <script src="{{ url('/js/bootstrap-datepicker.min.js') }}"></script> 
    <script src="{{ url('/js/aos.js') }}"></script>

    <script src="{{ url('/js/main.js') }}"></script> 
  </body>

</html>