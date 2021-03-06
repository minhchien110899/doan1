<!DOCTYPE html>
<html lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name=viewport content="initial-scale=1, minimum-scale=1, width=device-width">
	<title>Result from Multichoice</title>
</head>
<body>
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
			  				<h4 class="font-weight-bold">Đúng/Tổng: <span class="text-danger">{{$history->mark}}/{{count($history->choose)}}</span></h4>
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
					      <td class="text-center font-weight-bold">
					      	@if($option == $history->choose["$question->id"])
					      		O
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
			  </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>