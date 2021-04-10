<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inspector Multichoice</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/inspector_assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/inspector_assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/inspector_assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/inspector_assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('inspector.index') }}">MultiChoice</a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('inspector.index') }}">MultiChoice</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ empty(Auth::guard('inspector')->user()->avatar) ? '/images/undefined_user.jpg' : Auth::guard('inspector')->user()->avatar }}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth::guard('inspector')->user()->name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('inspector.index') }}">
                                <i class="mdi mdi-cached mr-2 text-success"></i> Refresh Page </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('inspector.logout') }}">
                                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="{{ url('/inspector/profile') }}" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ empty(Auth::guard('inspector')->user()->avatar) ? '/images/undefined_user.jpg' : Auth::guard('inspector')->user()->avatar }}" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span
                                    class="font-weight-bold mb-2">{{ Auth::guard('inspector')->user()->name }}</span>
                                <span class="text-secondary text-small">Inspector Management</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/inspector') }}">
                            <span class="menu-title">Home</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/inspector/subject') }}">
                            <span class="menu-title">Quản lý môn học</span>
                            {{-- <i class="mdi mdi-book menu-icon"></i> --}}
                            <i class="fas fa-book menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/inspector/testexam') }}">
                            <span class="menu-title">Quản lý bài thi</span>
                            <i class="mdi mdi-book-plus menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/inspector/question') }}">
                            <span class="menu-title">Quản lý câu hỏi</span>
                            <i class="mdi mdi-comment-question-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/inspector/profile') }}">
                            <span class="menu-title">Thông tin chung</span>
                            <i class="mdi mdi-account-outline menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item sidebar-actions">
                        <span class="nav-link">
                            <div class="border-bottom">
                                <h6 class="font-weight-normal mb-3">Quick access</h6>
                            </div>
                            <a href="https://www.facebook.com/multichoice.online" target="_blank" class="text-decoration-none"><button class="btn btn-block btn-lg btn-gradient-info mt-4">Fanpage<i class="mdi mdi-facebook-box ml-1"></i></button></a>
                            <a href="https://www.facebook.com/multichoice.online/inbox" target="_blank" class="text-decoration-none"><button class="btn btn-block btn-lg text-dark btn-gradient-success mt-4">Tin nhắn<i class="mdi mdi-facebook-box ml-1"></i></button></a>
                            <a href="#" class="text-decoration-none"><button class="btn btn-block btn-lg text-dark btn-gradient-warning mt-4">Điều khoản<i class="mdi mdi-bookmark ml-1"></i></button></a>
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright
                            ©multichoice</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Mọi thắc mắc hãy liên
                            hệ qua <a href="https://www.facebook.com/multichoice.online"
                                class="text-facebook">multichoice.online<i class="mdi mdi-facebook-box"></i></a></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/inspector_assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/inspector_assets/js/off-canvas.js"></script>
    <script src="/inspector_assets/js/hoverable-collapse.js"></script>
    <script src="/inspector_assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/inspector_assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
