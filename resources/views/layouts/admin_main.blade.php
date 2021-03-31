<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin multichoice</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ url('admin_assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- orion icons-->
    <link rel="stylesheet" href="{{ url('admin_assets/css/orionicons.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ url('admin_assets/css/style.red.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ url('admin_assets/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ url('admin_assets/img/favicon.png?3') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="{{ route('admin.index') }}" class="navbar-brand font-weight-bold text-uppercase text-base">MultiChoice<span class="text-danger">.</span></a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          <li class="nav-item">
            <form id="searchForm" class="ml-auto d-none d-lg-block">
              <div class="form-group position-relative mb-0">
                <button type="submit" style="top: -3px; left: 0;" class="position-absolute bg-white border-0 p-0"><i class="o-search-magnify-1 text-gray text-lg"></i></button>
                <input type="search" placeholder="Search ..." class="form-control form-control-sm border-0 no-shadow pl-4">
              </div>
            </form>
          </li>
          <li class="nav-item dropdown mr-3"><a id="notifications" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-bell"></i><span class="notification-icon"></span></a>
            <div aria-labelledby="notifications" class="dropdown-menu"><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 2 followers</p>
                  </div>
                </div></a><a href="#" class="dropdown-item"> 
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-green text-white"><i class="fas fa-envelope"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">You have 6 new messages</p>
                  </div>
                </div></a><a href="#" class="dropdown-item">
                <div class="d-flex align-items-center">
                  <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                  <div class="text ml-2">
                    <p class="mb-0">Server rebooted</p>
                  </div>
                </div></a><a href="#" class="dropdown-item">
              <div class="d-flex align-items-center">
                <div class="icon icon-sm bg-violet text-white"><i class="fab fa-twitter"></i></div>
                <div class="text ml-2">
                  <p class="mb-0">You have 2 followers</p>
                </div>
                </div></a>
              <div class="dropdown-divider"></div><a href="#" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a>
            </div>
          </li>
          <li class="nav-item dropdown ml-auto"><a id="userInfo" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img src="{{ empty(Auth::guard('admin')->user()->avatar) ? '/images/no_image.jpg' : Auth::guard('admin')->user()->avatar }}" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family">{{ Auth::guard('admin')->user()->name }}</strong></a>
              <div class="dropdown-divider"></div><a href="{{ route('admin.index') }}" class="dropdown-item">Home</a>
              <div class="dropdown-divider"></div><a href="{{ route('admin.profile') }}" class="dropdown-item">Thông tin chung</a>
              <div class="dropdown-divider"></div><a href="{{ route('admin.logout') }}" class="dropdown-item">Đăng xuất</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="{{ route('admin.index') }}" class="sidebar-link text-muted "><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
              <li class="sidebar-list-item"><a href="{{route('admin.inspector')}}" class="sidebar-link text-muted mb-2"><i class="fas fa-user-shield mr-3 text-gray" style="font-size: 19.5px"></i><span>Hỗ trợ viên</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="fas fa-users mr-3 text-gray" style="font-size: 19.5px"></i><span>Thí sinh</span></a></li>
              <li class="sidebar-list-item"><a href="{{route('admin.profile')}}" class="sidebar-link text-muted mb-1"><i class="o-profile-1 mr-3 text-gray"></i><span>Thông tin chung</span></a></li>
        </ul>
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="{{ route('admin.subject') }}" class="sidebar-link text-muted"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Môn học</span></a></li>
              <li class="sidebar-list-item"><a href="{{route('admin.testexam')}}" class="sidebar-link text-muted"><i class="o-paperwork-1 mr-3 text-gray"></i><span>Bài thi</span></a></li>
              <li class="sidebar-list-item"><a href="{{route('admin.question')}}" class="sidebar-link text-muted"><i class="o-survey-1 mr-3 text-gray"></i><span>Câu hỏi</span></a></li>
              {{-- <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Demo</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-imac-screen-1 mr-3 text-gray"></i><span>Demo</span></a></li>
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-paperwork-1 mr-3 text-gray"></i><span>Demo</span></a></li> --}}
              <!-- <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-wireframe-1 mr-3 text-gray"></i><span>Demo</span></a></li -->
        </ul>
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
        <!-- content -->
        @yield('content')
        <!-- end content -->
        <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 text-center text-md-left text-primary">
                <p class="mb-2 mb-md-0">MultiChoice &copy; 2020-2021</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ url('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('admin_assets/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ url('admin_assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('admin_assets/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ url('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{ url('admin_assets/js/charts-home.js') }}"></script>
    <script src="{{ url('admin_assets/js/front.js') }}"></script>
  </body>
</html>