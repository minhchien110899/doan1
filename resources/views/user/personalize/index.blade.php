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

        .buttonCustomer:hover {
            background: #ff5144;
        }

        .buttonCustomer a {
            color: white;
        }
        .centerFlex{
            display: flex;
            align-items: center;
            padding-top: 2px;
            font-weight: bold;
        }

    </style>
    <div class="container w3-round-large w3-border py-2 mb-3" style="min-height:600px;max-height:20000px; ">

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
                        <div class="d-flex justify-content-between mb-2">
                            <?php
                            $expired_time = strtotime($val->expired_time);
                            $now = time();
                            $distance = $expired_time - $now;
                            ?>
                            @if ($distance > 0)
                                @if ($val->current_step() == $val->exam_number)
                                    @if ($val->check_success() == 1)
                                        <div>
                                            <p class="text-uppercase text-success mb-0 centerFlex">Hoàn thành</p>
                                        </div>
                                    @elseif($val->check_success() == 0)
                                        <div>
                                            <p class="text-uppercase text-warning mb-0 centerFlex">Chưa đạt</p>
                                        </div>
                                    @endif
                                @else
                                        <p class="text-uppercase text-info mb-0 centerFlex">Đang thực hiện</p>
                                @endif
                            @else
                                <div>
                                    <p class="text-uppercase text-danger mb-0 centerFlex">Hết hạn</p>
                                </div>
                            @endif
                            <button class="buttonCustomer"><a href="/personalizeDetail/detail/{{ $val->id }}">Chi
                                    tiết</a></button>
                        </div>
                    </div>
                @endforeach
            @else
                <small class="font-italic ml-3">Chưa có lộ trình học nào. Vui lòng tạo mới.</small>
            @endif
        </div>
        <div class="row d-flex justify-content-center">
                <a href="{{ url('/personalizeElearning/init') }}" class="btn btn-warning btn-sm no-border-radius mt-4">Tạo
                    mới</a>
        </div>
    </div>

@endsection
