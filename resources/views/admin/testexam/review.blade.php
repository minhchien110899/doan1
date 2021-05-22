@extends('layouts.admin_main')

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
			<h5 class="font-weight-bold">Câu {{++$key}}: {{ $question->content }}&nbsp;<a href="#" data-toggle="modal" data-target="#del_question{{$key}}"><i class="fas fa-trash"></i></a>
				<!-- modal của xóa câu hỏi-->
                              <div class="modal fade" id="del_question{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        Bạn có thực sự muốn xóa câu hỏi này?
                                        <p><small>"Có thể lấy lại dữ liệu trong ngân hàng câu hỏi."</small></p>
                                    </div>
                                    <div class="modal-footer">
                                      <form action="/admin/testexam/{{$testexam->id}}/del_question/{{$question->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" name="del_question">Xác nhận</button>
                                      </form>
                                      <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          <!-- </div>content -->
                         <!-- kết thúc modal của xóa câu hỏi  -->
			</h5>
				@foreach($question->option->name as $index => $option)
	  			<p>{{ $aphabet[$index] }}: {{ $option }} @if($option == $question->option->answer)<span class="text-success font-weight-bold">&#10003;</span> @endif</p>
				@endforeach
			</div>	
		@endforeach
		<div class="text-right"><a href="#" class="btn btn-outline-success mr-1" data-toggle="modal" data-target="#add_question">Thêm câu hỏi</a></div>
		<!-- modal của thêm câu hỏi-->
            <div class="modal fade" id="add_question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
	                          <div class="modal-body">
	                          	<h4>Thêm câu hỏi</h4>
	                          	<table class="table card-text table-bordered">
			                      <thead>
			                        <tr class="text-center">
			                          <th>#</th>
			                          <th>Câu hỏi</th>
									  <th>Mức độ</th>
			                          <th>Chương</th>
			                          <th>Thêm</th>
			                        </tr>
			                      </thead>
			                      <tbody>
			                      	<form action="/admin/testexam/{{$testexam->id}}/add_question" method="POST">
			                      	@csrf	
			                      	@foreach($questions_notBelongs as $key => $question)
			                        <tr>
			                          <td class="text-center">{{++$key}}</td>
			                          <td style="width: 60%;">{{ $question->content }}</td>
									  <td class="text-center">{{$question->getLevel()}}</td>
			                          <td  class="text-center">{{ $question->chapter->name ?? '' }}</td>
			                          <td class="text-center"><input type="checkbox" name="question_added[]" value="{{$question->id}}"></td>
			                        </tr>
			                        @endforeach
			                      </tbody>
			                    </table>	                 
	                          </div>  
	                          <div class="modal-footer">
	                            <button type="submit" class="btn btn-success btn-sm" name="add">Xác nhận</button>
	                            </form> 
	                            <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
	                          </div>
                        </div>
                      </div>
            </div>
            <!-- </div> -->
         <!-- kết thúc modal của thêm câu hỏi -->
      </div>
    </div>
  <h4><a href="{{ route('admin.testexam') }}" style="margin-bottom: 30px !important;">&larr; Quay lại</a></h4>	
</div>
	
@endsection