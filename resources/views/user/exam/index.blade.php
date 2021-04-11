@extends('layouts.main')

@section('content')
<div class="container" style="max-height:1500px;">
<div class="row">
	@if(count($subjects) > 0)
		@foreach($subjects as $subject)
		<div class="col-sm-6 mb-3">
			<div class="card">
			  <div class="card-body">
			    <h3 class="card-title">{{ $subject->name }}</h3>
			    <p class="card-text">Tổng hợp các đề thi kiến thức liên quan đến trình độ THPT môn {{ $subject->name }} </p>			 	
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