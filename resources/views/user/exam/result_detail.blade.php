@extends('layouts.main')

@section('content')
<div class="container mb-3">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
			  <div class="card-header">
			  	<div class="container">
			  		<div class="row">
			  			<div class="col-md-8">
			  				<h4 class="font-weight-bold">{{$testexam->name}}</h4>
			    			<p>Đã thực hiện: {{date('H:i d-m-Y', strtotime($history->created_at)) }}</p>	
			  			</div>
			  			<div class="col-md-4 text-right">
			  				<h4 class="font-weight-bold">Điểm: <span class="text-danger">{{$history->mark}}/5</span></h4>
			  			</div>
			  		</div>
			  	</div>
			  </div>
			  <div class="card-body">

			  		@foreach($questions as $question)
			  		<h5 class="font-weight-bold">Câu {{++$loop->index}}: {{$question->content}}</h5>
			  		<table class="table w-50 table-bordered">
			  			@foreach($question->option->name as $option)
					    <tr>
					      <td class="w-75 @if($option == $question->option->answer) text-success font-weight-bold @endif " >{{$option}}</td>
					      <td class="text-center ">
					      	@if($option == $history->choose["$question->id"])
					      		<li class="fas fa-pen"></li>
					      	@endif
					      </td>
					      <td class="text-center">
					      	@if($question->option->answer == $history->choose["$question->id"] && $option == $history->choose["$question->id"] )
					      		<p class="text-danger m-0 font-weight-bold">+ 1</p>
					      	@elseif($question->option->answer != $history->choose["$question->id"] && $option == $history->choose["$question->id"])
					      		<p class="text-danger m-0">x</p>	
					      	@endif
					      </td>
					    </tr>
					    @endforeach 
					</table>	
			  		@endforeach
			  		<a href="/exam/result/detail/{{$history->id}}/send_mail" class="btn btn-warning my-2" >Gửi kết quả về mail</a>
			  </div>
			</div>
			<div class="text-right"><a href="{{route('user.result')}}" class="m-0">Lịch sử chung >>></a></div>
		</div>
	</div>
</div>
@endsection
