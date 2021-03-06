<?php
$name = Auth::user()->name;
$array_name = explode(' ', $name);
$lastname = ucwords($array_name[count($array_name) - 1]);
?>
@extends('layouts.main')

@section('content')
    <div class="container w3-round-large w3-border py-2 mb-3" style="height:500px;max-height:1500px;position: relative;">
        <div class="row">
            <div class="col text-center">
                <p class="mb-0"></p>
                <p>Để tạo lộ trình học cho riêng mình thì hệ thống muốn <span
                        class="font-weight-bold">{{ $lastname }}</span> tham gia một bài kiểm tra để ôn lại kiến thức
                    nha. Hãy chọn một môn học để tạo lộ trình mới.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (count($subjects) > 0)
                @foreach ($subjects as $subject)
                    <div class="col-sm-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ ucfirst($subject->name) }}</h3>
                                <p class="card-text" style="font-size: 12px">Tổng hợp các câu hỏi từ dễ đến khó của môn
                                    {{ ucfirst($subject->name) }} để kiểm tra trình độ hiện tại.</p>
                                <a href="{{ url('/personalizeElearning/make', $subject->id) }}"
                                    class="btn btn-primary">Chọn</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <small class="text-secondary font-italic">{{ __('Không có môn học nào.') }}</small>
                <small class="text-secondary font-italic">Các môn đang thực hiện lộ trình cần hoàn thành mới có thể tạo mới.</small>
            @endif
            <a href="{{ url('/personalizeElearning') }}" style="position: absolute;bottom: 1px;left: 7px;">&larr; Quay lại</a>
        </div>
    </div>
@endsection
