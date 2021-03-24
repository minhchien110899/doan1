@extends('layouts.main')

@section('content')
<?php
    $theme_color = Auth::user()->setting->theme_color ?? "default";
?>
<div class="container w3-round-large w3-border" style="height: 800px;">
    <h1 class="text-center mt-3">Cài đặt chung</h1>
    <hr style="width: 70%;">
    <div class="container p-0" style="width:70%">
        <h5>Màu nền</h5>
        <form action="{{ url('setting/change_theme_color') }}" method="POST" >
            @csrf
            <div class="row text-center">
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-padding-16" w3-padding-16 style="background-color:#f8f9fa; ;" onclick="$('input[value=default]').click();"></div>
                    <p><input type="radio" name="theme_color" value="default" @if($theme_color == 'default') checked @endif></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray w3-padding-16" style="background-color: #ffc0cb;" onclick="$('input[value=pink]').click();"></div>
                    <p><input type="radio" name="theme_color" value="pink" @if($theme_color == 'pink') checked @endif></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray w3-padding-16 w3-padding-16" style="background-color: #fbb3ae;" onclick="$('input[value=red]').click();"></div>
                    <p><input type="radio" name="theme_color" value="red" @if($theme_color == 'red') checked @endif></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2 ">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray w3-padding-16" style="background-color: #85e889;" onclick="$('input[value=green]').click();"></div>
                    <p><input type="radio" name="theme_color" value="green" @if($theme_color == 'green') checked @endif></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 w3-round-large w3-border w3-border-dark-gray w3-padding-16" style="background-color:#7dfbfb;" onclick="$('input[value=cyan]').click();"></div>
                    <p><input type="radio" name="theme_color" value="cyan" @if($theme_color == 'cyan') checked @endif></p>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="btn w-100 text-light w3-round-large w3-border w3-padding-16" style="background-color: #1c1e21;" onclick="$('input[value=black]').click();"></div>
                    <p><input type="radio" name="theme_color" value="black"@if($theme_color == 'black') checked @endif></p>
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