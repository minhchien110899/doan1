<?php
$name = Auth::user()->name;
$array_name = explode(' ', $name);
$lastname = ucwords($array_name[count($array_name) - 1]);
?>
@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="/css/process_personalize.css">
    <div class="container w3-round-large w3-border py-2 mb-3" style="height:500px;max-height:1500px; position: relative; ">

        <div class="row my-2 text-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">Lộ trình học của {{ $lastname }}</h3>
            </div>
        </div>
        <hr class="my-0">
        <div class="row">
            @if (count($personalizes) > 0)
                <div class="col-md-6 col-lg-12">
                    <h3 class="progressbar-title">Tiếng Anh</h3>
                    <div class="progress">
                        <div class="progress-bar" style="width: 65%; background: #ed687c;">
                            <span class="progress-icon fa fa-check" style="border-color:#ed687c; color:#ed687c;"></span>
                            <div class="progress-value">65%</div>
                        </div>
                    </div>
                </div>
            @else
                <small class="font-italic ml-3">Chưa có lộ trình học nào. Vui lòng tạo mới.</small>
            @endif
        </div>
        <div class="row" style="position: absolute;bottom: 10px;left: 45%;">
            <div>
                <a href="{{ url('/personalizeElearning/init') }}"
                    class="btn btn-warning btn-sm no-border-radius">Tạo mới</a>
            </div>
        </div>
    </div>

@endsection
