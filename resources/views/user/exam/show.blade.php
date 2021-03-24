@extends('layouts.main')

@section('content')
<div class="container">
	<div class="row">
	@if(count($exams) > 0)
	@foreach($exams as $exam)	
		<div class="col-sm-6 mb-3">
			<div class="card">
			  <div class="card-body">
			    <h3 class="card-title">{{ $exam->name }}</h3>
			    <p class="card-text">{{$exam->description}}</p>	
			    <a href="{{ url('/exam/make', $exam->id) }}" class="btn btn-warning">bắt đầu</a>
			    {{-- <a href="{{ url('/exam/review', $exam->id) }}" class="btn btn-info">Tham khảo</a> --}}
			    
			  </div>
			</div>
		</div>
	@endforeach	
	@else
		<h4>Chưa cập nhập bài thi.Xin chọn môn khác.</h4>	
	@endif	
	</div>
	<h5><a href="{{ route('subject') }}">&larr;Chọn môn khác</a></h5>
</div>
@endsection
