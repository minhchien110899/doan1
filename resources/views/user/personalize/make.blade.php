@extends('layouts.main')

@section('content')
<button class="btn time_exam btn-warning px-0" id="time" >30:00</button>
<script>
	function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            $("button[name=complete]").click();
        }
    }, 1000);
}

window.onload = function () {
    var thirtyMinutes = 60 * 30,
        display = document.querySelector('#time');
    startTimer(thirtyMinutes, display);
};
</script>

    <div class="container w3-round-large w3-border py-2 mb-3">
        <div class="container">
            <div class="card my-3">
                <div class="card-header text-center">
                    <h4 class="text-uppercase mb-0">{{ $testexam->name }}</h4>
                    <h6 class="text-uppercase my-1">Bài kiểm tra tổng hợp để đánh giá khách quan trình độ</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/exam/create_history', $testexam->id) }}" method="POST">
                        @csrf
                        @if(count($questions) > 0)	
                        @foreach($questions as $key => $question)
                        <input type="hidden" name="questionChoose[]" value="{{$question->id}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <h6 class="font-weight-bold">Câu {{++$key}}: {{$question->content}}</h6>
                                        <?php
                                            $options = $question->option->name;
                                            shuffle($options);
                                        ?>
                                        @foreach($options as $option)
                                                <label class="radio-inline">
                                                    <input
                                                        type="radio"
                                                        name="choose[{{$question->id}}]"
                                                        value="{{ $option }}">
                                                    {{ $option }}
                                                </label><br>
                                        @endforeach
                                    </div>
                                </div>	
                            </div>    	
                        @endforeach
                        @endif
                        @if(count($questions) > 0)
                        <div class="text-center"><button type="submit" class="btn btn-outline-warning" name="complete">Nộp bài</button></div>
                        @else
                            <p>Quản lý đang soạn câu hỏi.Vui lòng chọn đề khác</p>
                        @endif   	 
                    </form>
                </div>
            </div>
            <a href="{{ url('/personalizeElearning/init') }}"
                    style="margin-bottom: 30px !important;">&larr; Quay lại</a>
        </div>
    </div>
@endsection
