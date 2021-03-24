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
<div class="container" style="margin-bottom: 40px">
	<div class="card">
	<div class="card-header text-center pb-0">
    	<h4 class="font-weight-bold">{{$testexam->name}}</h4>
    	<p>{{$testexam->description}}</p>
  	</div>	
  	<div class="card-body">
		<form action="{{ url('/exam/create_history', $testexam->id) }}" method="POST">
			@csrf
			@if(count($questions) > 0)	
		    @foreach($questions->random(5) as $key => $question)
		    <input type="hidden" name="questionChoose[]" value="{{$question->id}}">
		    	<div class="row">
		    		<div class="col-12">
		    			<div class="form-group">
					    	<h6 class="font-weight-bold">Câu {{++$key}}: {{$question->content}}</h6>
					    	<?php
					    		$options = $question->option->name;
					    		$options = Arr::random($options, 4);
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
	<h6 style="margin-top:100px !important;"><a href="{{ url('/exam/subject', $testexam->subject->id) }}" >&larr; Thoát</a></h6>	
</div>	
@endsection
