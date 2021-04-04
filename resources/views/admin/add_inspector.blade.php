@extends('layouts.admin_main')

@section('content')
    <div class="container" style="padding-top: 50px ">
        <div class="row mt-3 mb-3 justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <!-- start Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="text-uppercase mb-0 mt-2">Thêm hỗ trợ viên</h6>
                    </div>
                    <div class="card-body text-left">
                        <form action="{{ url('/admin/inspector/add') }}" method="POST">
                            @csrf
                            <label class="mb-0">Họ và tên: <span class="text-danger alert-error">@error('name'){{ $message }}@enderror</span></label>
                            <input type="text" name="name" class="form-control no-border-radius mb-2"
                                placeholder="Nhập họ và tên..." value="{{ old('name')?? '' }}">
                            <label class="mb-0">Email: <span class="text-danger alert-error">@error('email'){{ $message }}@enderror</span></label>
                            <input type="email" name="email" class="form-control no-border-radius mb-2"
                                placeholder="Nhập Email..." value="{{ old('email')?? '' }}">
                            <label class="mb-0">Username: <span class="text-danger alert-error">@error('username'){{ $message }}@enderror</span></label>
                            <input type="text" name="username" class="form-control no-border-radius mb-2"
                                placeholder="Nhập Username..." value="{{ old('username')?? '' }}">
                            <label class="mb-0">Password: <span class="text-danger alert-error">@error('password'){{ $message }}@enderror</span></label>
                            <input type="password" name="password" class="form-control no-border-radius "
                                placeholder="Nhập password từ 8 kí tự trở lên...">
                            <small class="font-italic text-secondary">Lưu ý: Mặc định giá trị là "password" nếu để
                                trống.</small><br>
                            <div class="text-center mt-3"><button class="btn btn-lg btn-outline-primary"
                                    type="submit">Thêm</button></div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
    <script>
        // $( document ).ready(function() {
        //     setTimeout(function(){ $('.alert-error').innerHTML = ""; }, 2000);
        // });
        document.addEventListener("DOMContentLoaded", function(){
            setTimeout(function(){ 
                var alerterror = document.getElementsByClassName('alert-error');
                Array.from(alerterror).forEach(function(val){
                    val.outerHTML = " ";
                }); 
            }, 3000);
        });
    </script>    
@endsection
