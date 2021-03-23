@extends('layouts.main')

@section('content')
<div class="container w3-round-large w3-border mt-3" style="height: 600px;">
    <h1 class="text-center mt-3">Cài đặt chung</h1>
    <hr style="width: 70%;">
    <div class="container p-0" style="width:70%">
        <h5>Màu nền</h5>
        <form action="{{ url('setting/change_theme_color') }}" method="POST" >
            @csrf
            <div class="row text-center">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border" style="background-color:#f8f9fa; ;padding: 10px 11px;">Default</div>
                    <p><input type="radio" name="theme_color" value="default" checked></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray" style="background-color: #ffc0cb;">Pink</div>
                    <p><input type="radio" name="theme_color" value="pink"></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray" style="background-color: #fbb3ae; padding: 10px 14px;">Salmon</div>
                    <p><input type="radio" name="theme_color" value="red"></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2 ">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray" style="background-color: #85e889;">Green</div>
                    <p><input type="radio" name="theme_color" value="green"></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray" style="background-color: cyan;">Blue</div>
                    <p><input type="radio" name="theme_color" value="cyan"></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 text-light w3-round-large w3-border" style="background-color: #1c1e21;">Black</div>
                    <p><input type="radio" name="theme_color" value="black"></p>
                </div>
            </div>
            <!-- nút submit -->
            <div class="text-center align-text-bottom">
                <button type="submit" class="btn btn-info">Lưu lại</button>
            </div>
        </form>
    </div>
</div>
@endsection