<div class="panel panel-default">
        <div class="panel-heading">
        </div>
    @if(count($questions) > 0)
        <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($questions as $question)
            @if ($i > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $i }}.<br />{{$question->content}}</strong>

                        <input
                            type="hidden"
                            name="questions[{{ $i }}]"
                            value="{{ $question->id }}">
                    @foreach($question->option->name as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option }}">
                            {{ $option }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        </div>
    @endif
    </div>


<div class="row">
		<div class="col-8">
			<div class="card mt-3 mb-1">
		      	<div class="card-body">	
		      		@php

	      				$ques = $request->query('ques') ?? 0;
	      				if($ques == 0):
	      					
	      				else:
	      					$ques = (int)$ques;	
	      				endif;
	      				$number = $ques + 1;
	      			@endphp
	          		<form action="{{ url('/exam/choose', $questions[$ques]->id) }}" method="POST">
	          			@csrf
	          			<h5 class="font-weight-bold">Câu {{$number}}: {{$questions[$ques]->content}}</h5>
	          			@foreach($questions[$ques]->option->name as $i => $option)
	          				<input type="hidden" name="question_id" value="{{$questions[$ques]}}">
	          				<input type="radio" name="select_option" value="{{$option}}">
  							<label>{{$option}}</label>
  							<br>
	          			@endforeach
	          			<button type="submit">Demo</button>
	          		</form>
		        </div>
			</div>
			<div class="d-flex justify-content-between">
				@php
					$n = $ques; 
				@endphp
				@if($ques == 0)
					<div></div>
				@else
					<div><a href="/exam/make/{{$testexam->id}}?ques={{--$ques}}" class="btn btn-primary">&larr;Trước</a></div>
				@endif
				@if(count($questions) != ($n+1))
			  		<div><a href="/exam/make/{{$testexam->id}}?ques={{++$n}}" class="btn btn-primary">Sau &rarr;</a></div>
			  	@else
			  		<div></div>
			  	@endif		
			</div>
		</div>
		<div class="col-4">
			<div class="card mt-3">
		      	<div class="card-body p-2">	
	      				<h5>Danh sách các câu hỏi:</h5>
						@foreach($questions as $index => $question)
							<a href="/exam/make/{{$testexam->id}}?ques={{$index}}" class="btn 
								@if($index == $request->query('ques')) 
									btn-info 
								@else
									btn-outline-info
								@endif m-1" style="border-radius: 10%;">{{++$index}}</a>
						@endforeach
						<div class="text-center mt-3">
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#complete">Nộp bài</button>
						</div>
		        </div>
			</div>
		</div>
		 <h6 style="margin-top:100px !important;"><a href="{{ url('/exam', $testexam->subject->id) }}" >&larr; Thoát</a></h6>		
	</div> 


	@foreach($questions as $question)
    	<div class="row">
    		<div class="col-12 form-group">
    			<div class="form-group">
			    	{{$question->content}}
			    	@foreach($question->option->name as $option)
			    			<label class="radio-inline">
			                    <input
			                        type="radio"
			                        name="answers[]"
			                        value="{{ $option }}">
			                    {{ $option }}
			                </label>
			    	@endforeach
		    	</div>
		    </div>	
		</div>    	
    @endforeach	   



    <div class="container" style="margin-bottom: 40px">
	<div class="card">
	<div class="card-header text-center pb-0">
    	<h4 class="font-weight-bold">{{$testexam->name}}</h4>
    	<p>{{$testexam->description}}</p>
  	</div>	
  	<div class="card-body">
		<form action="#" method="POST">
			@csrf	
		    @foreach($questions as $key => $question)
		    	<div class="row">
		    		<div class="col-12">
		    			<div class="form-group">
					    	<h6 class="font-weight-bold">Câu {{++$key}}: {{$question->content}}</h6>
					    	@foreach($question->option->name as $option)
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
		</form>
	</div>
	</div>	
</div>	
cgqkiklpusgebobd
tkeszquclvviedpa


hbsgjogeunyezavf