@extends('layouts.sidebar')

@section('content.c')
    <div class="container mt-3" style="height: 400px; ">
        <div class="row justify-content-left">
            <div class="col-md-6">
                
                    <a href="/profile"><h3>Quản lý thông tin cá nhân</h3></a>
                    <a href="/exam"><h3>Xem đề thi</h3></a>
                    <a href="/exam/result"><h3>Xem lịch sử thi</h3></a>
                    <a href="/personalizeElearning"><h3>Tạo lộ trình học riêng</h3></a>
                    <a href="/setting"><h3>Cài đặt chung</h3></a>
            </div>
        </div>
    </div>
@endsection

