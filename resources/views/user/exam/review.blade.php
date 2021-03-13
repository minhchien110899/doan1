@extends('layouts.main')

@section('content')
<div class="container">
	<div class="card my-3">
                  <div class="card-header text-center">
                    <h4 class="text-uppercase mb-0">{{$testexam->name}}</h4>
                    <h6 class="text-uppercase my-1">{{ $testexam->description }}</h6>
                  </div>
                  <div class="card-body">	
                    @foreach($questions as $key => $question)
                    @php
                    	$aphabet = range('A','D');
                    @endphp
                    <div>
						<h5 class="font-weight-bold">Câu {{++$key}}: {{ $question->content }}</h5>
							@foreach($question->option->name as $index => $option)
				  			<p>{{ $aphabet[$index] }}: {{ $option }}</p>
							@endforeach
						</div>	
					@endforeach
                  </div>
                </div>
  <h4><a href="{{ url('/exam/subject', $testexam->subject->id) }}" style="margin-bottom: 30px !important;">&larr; Quay lại</a></h4>	
</div>
	
@endsection