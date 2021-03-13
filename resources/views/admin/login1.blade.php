<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Admin page</title>
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
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center py-5">
          <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
            <div class="pr-lg-5"><img src="{{ url('admin_assets/img/demoexam.jpg') }}" alt="" class="img-fluid w-75"></div>
          </div>
          <div class="col-lg-5 px-lg-4">
            @if(session('error'))
            <div class="alert alert-danger">
                  {{ session('error') }}
            </div>
            @endif
            <h1 class="text-base text-primary text-uppercase mb-4" style="font-size: 50px !important">Admin MultiChoice</h1>
            <h2 class="mb-4">Welcome back!</h2>
            <p class="text-muted">Trang xử lý tác vụ dành cho admin trong hệ thống MultiChoice</p>
            <form action="{{ url('/admin/login') }}" method="POST" class="mt-4">
            @csrf  
              <div class="form-group mb-4">
                <input type="text" name="username" placeholder="Username" class="form-control border-0 shadow form-control-lg">
              </div>
              
              <div class="form-group mb-4">
                <input type="password" name="password" placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
              </div>
              <div class="form-group mb-4">
                <div class="custom-control custom-checkbox">
                  <input id="customCheck1" type="checkbox" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                  <label for="customCheck1" class="custom-control-label">Remember Me</label>
                </div>
              </div>
              <button type="submit" class="btn btn-danger shadow px-5">Log in</button>
            </form>
          </div>
        </div>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                 -->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ url('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('admin_assets/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ url('admin_assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('admin_assets/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ url('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="{{ url('admin_assets/js/front.js') }}"></script>
  </body>
</html>