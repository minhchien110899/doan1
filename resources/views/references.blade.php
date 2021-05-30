@extends('layouts.main_nomenu')

@section('content')
    <div class="row d-flex justify-content-center">
        <h4 class="text-center text-uppercase font-weight-bold">Nguồn tham khảo</h4>
    </div>
    <div class="row d-flex justify-content-center" style="height:600px;margin-top: 50px;">
        <div class="col-2 text-center">
            <img src="https://image.flaticon.com/icons/png/512/609/609065.png" width="200px"><br>
        </div>
        <div class="col-3 text-left mt-3">
            <div class="d-flex justify-content-between mb-3">
                <a href="https://getbootstrap.com" style="color:black">https://getbootstrap.com</a><img
                    src="https://image.flaticon.com/icons/png/512/1348/1348026.png" width="30px" style="margin-left:20px">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a href="https://laravel.com" style="color:black">https://laravel.com</a>
                <img src="/images/laravel.jpg" width="30px" style="margin-left:20px">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a href="https://www.php.net" style="color:black">https://www.php.net</a>
                <img src="https://image.flaticon.com/icons/png/512/528/528261.png" width="30px" style="margin-left:20px">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <a href="http://lms.faa.iuh.edu.vn" style="color:black">http://lms.faa.iuh.edu.vn</a>
                <img src="/images/iuh.png" width="30px" style="margin-left:20px">
            </div>
        </div>
    </div>
@endsection
