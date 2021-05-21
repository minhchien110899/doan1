<?php
$name = Auth::user()->name;
$array_name = explode(' ', $name);
$lastname = ucwords($array_name[count($array_name) - 1]);
?>
@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="/css/process_personalize.css">
    <style>
        .wrapEach {
            border: 1px #d4d2d2 solid;
            border-radius: 15px;
            padding: 30px;
            margin: 15px auto;
            width: 60%;
        }

        .buttonCustomer {
            line-height: 30px;
            background: #fd4d40;
            border-radius: 8px;
            border: 0;
        }
        .buttonCustomer:hover{
            background: #ff5144;
        }
        .buttonCustomer a {
            color: white;
        }

    </style>
    <div class="container w3-round-large w3-border py-2 mb-3" style="height:70vh;max-height:20000px; position: relative; ">

        <div class="row my-2 text-center">
            <div class="col">
                <h3 class="mb-0 text-uppercase">Lộ trình học của {{ $lastname }}</h3>
            </div>
        </div>
        <hr class="my-0">
        <div class="row">
            @if (count($personalizes) > 0)
                @foreach ($personalizes as $key => $val)
                    <div class="wrapEach">
                        {{-- <h3 class="progressbar-title">Tiếng Anh</h3>
                    <div class="progress">
                        <div class="progress-bar" style="width: 65%; background: #ed687c;">
                            <span class="progress-icon fa fa-check" style="border-color:#ed687c; color:#ed687c;"></span>
                            <div class="progress-value">65%</div>
                        </div>
                    </div> --}}
                        <h3 class="progressbar-title text-uppercase">{{ \App\Subject::find("$val->subject_id")->name }}
                        </h3>
                        <div class="progress">
                            <?php $mucDo = ($val->current_step() / $val->exam_number) * 100; ?>
                            <div class="progress-bar"
                                style="width: <?php echo round($mucDo); ?>%; background: #ed687c;">
                                <span class="progress-icon fa fa-check" style="border-color:#ed687c; color:#ed687c;"></span>
                                <div class="progress-value"><?php echo round($mucDo); ?>%
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <button class="buttonCustomer"><a href="/personalizeDetail/detail/{{ $val->id }}">Chi tiết</a></button>
                        </div>
                    </div>
                @endforeach
            @else
                <small class="font-italic ml-3">Chưa có lộ trình học nào. Vui lòng tạo mới.</small>
            @endif
        </div>
        <div class="row" style="position: absolute;bottom: 10px;left: 45%;">
            <div>
                <a href="{{ url('/personalizeElearning/init') }}" class="btn btn-warning btn-sm no-border-radius mt-4">Tạo
                    mới</a>
            </div>
        </div>
    </div>

@endsection
