@extends('layouts.main')

@section('content')
<div class="container w3-round-large w3-border mt-3">
    <div class="row my-2 text-center">
        <div class="col"><h3 class="mb-0 font-weight-bold">Lộ trình học của {{ ucwords(Auth::user()->name) }}</h3></div>
    </div>
    <hr class="my-0" style="width: 50%;">
    <div class="row">
        <div class="col text-center"><p class="mb-0">Chào {{ ucwords(Auth::user()->name) }}!</p><p>Để tạo lộ trình học cho riêng mình thì hệ thống muốn {{ ucwords(Auth::user()->name) }} tham gia một bài kiểm tra để ôn lại kiến thức nha</p></div>
    </div>
    <div class="row">
        @if(count($subjects) > 0)
            @foreach($subjects as $subject)
            <div class="col-sm-6 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">{{ ucfirst($subject->name) }}</h3>
                    <p class="card-text">Tổng hợp các câu hỏi từ dễ đến khó của môn {{ ucfirst($subject->name) }} để kiểm tra trình độ hiện tại.</p>			 	
                    <a href="{{ url('/exam/subject',$subject->id) }}" class="btn btn-primary">Chọn</a>
                  </div>
                </div>
            </div>
            @endforeach
    </div>	
        @else
            {{__('Không có môn học nào') }}
        @endif
</div>
	
@endsection