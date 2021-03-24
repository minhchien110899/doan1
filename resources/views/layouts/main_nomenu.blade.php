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
    <link rel="stylesheet" href="{{ url('/css/w3school.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ url('/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('/css/aos.css') }}">


    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    @if(Auth::user())
      @if(!empty(Auth::user()->setting))
        @if(!(Auth::user()->setting->theme_color == "default"))
          <link rel="stylesheet" href="/css/customtheme/style_custom_{{ Auth::user()->setting->theme_color }}mode.css">
        @endif
      @endif
    @endif
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
                <span class="text-black">12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, HCM,<br> Việt Nam</span>
              </div>
              <div class="d-flex site-info align-items-center">
                <span class="block-icon mr-3"><span class="icon-clock-o"></span></span>
                <span class="text-black">Work all day 6:30AM - 9:00PM <br> No OFF day </span>
              </div>
              
            </div>
          </div>
        </div>


        <div class="container mb-4">
          <div class="menu-wrap d-flex align-items-center" style="background-color: #f6f5f5;">
            <span class="d-inline-block d-lg-none"><a href="#" class="text-black site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-black"></span></a></span>

              

              <nav class="site-navigation text-left mr-auto d-none d-lg-block " role="navigation">
                <ul class="site-menu main-menu js-clone-nav mr-auto ">
                  <li><a href="/" class="nav-link">Trang Chủ</a></li>
                  <li><a href="/" class="nav-link">Giới thiệu</a></li>
                  <li><a href="/" class="nav-link">Tham khảo</a></li>
                  <li><a href="/" class="nav-link">Công tác</a></li>
                  <li><a href="/" class="nav-link">Dịch vụ</a></li>
                  <li><a href="/" class="nav-link">Liên hệ</a></li>
                  <li><a href="/chat" class="nav-link">Chat</a></li>
                </ul>
              </nav>

              <div class="top-social ml-auto">
                @guest
                            
                    @if (Route::has('register'))
                        <a href="/login">Đăng nhập</a>
                        <a href="/register">Đăng kí</a>
                    @endif
                @else
                 <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <?php
                                  $name = Auth::user()->name;
                                  $lastname = explode(' ', $name);
                                  ?>  
                                  {{ ucwords($lastname[count($lastname) - 1]) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="/home">Home</a> --}}
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">Thông tin chung</a>
                                    <a class="dropdown-item" href="{{ route('subject') }}">Đề thi</a>
                                    <a class="dropdown-item" href="{{ route('user.result') }}">Kết quả</a>
                                    <a class="dropdown-item" href="{{ route('user.setting') }}">Cài đặt chung</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Đăng xuất') }}
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
  
    @yield('content')
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="footer-heading mb-3">Giới thiệu</h2>
                <p class="mb-5">Trang web giúp bạn tự học tại nhà với những đề thi chọn lọc phù hợp với khả năng của bạn. </p>

                <h2 class="footer-heading mb-4">Bạn muốn được tư vấn thêm</h2>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="GỬI" class="btn btn-primary">
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
                <h2 class="footer-heading mb-4">Tìm hiểu thêm</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Giới thiệu</a></li>
                  <li><a href="#">Chính sách</a></li>
                  <li><a href="#">Điều khoản</a></li>
                  <li><a href="#">Dịch vụ</a></li>
                  <li><a href="#">Liên hệ</a></li>
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
     <script src="{{ url('/js/jquery-3.3.1.min.js') }}"></script> 
    <script src="{{ url('/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
     <script src="{{ url('/js/bootstrap.min.js') }}"></script>
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
    @if(Auth::user())
      @if(!empty(Auth::user()->setting))
        @if(!(Auth::user()->setting->theme_color == "default"))
          <script src="/js/customtheme/{{ Auth::user()->setting->theme_color }}_mode.js"></script>
        @endif
      @endif  
    @endif 
  </body>

</html>