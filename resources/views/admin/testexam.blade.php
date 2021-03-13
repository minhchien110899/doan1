@extends('layouts.admin_main')

@section('content')
	<div class="container">
		<div class="row mt-3 mb-3 justify-content-center">
			<div class="col-lg-10 text-center">
        @error('subject_id') 
            <div class="alert alert-danger w-50 text-center">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>         
        @enderror
        @error('name') 
            <div class="alert alert-danger w-50 text-center">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>         
        @enderror
				<div class="card">
                  <div class="card-header">
			            <div class="row justify-content-between">
			              <div class="col-4"></div>
			              <div class="col-4">
			                  <h4 class="text-uppercase mb-0">Bài thi</h4>
			              </div>
			              <div class="col-4"><a href="#" class="btn btn-outline-success mr-1" data-toggle="modal" data-target="#add_testexam">Thêm đề thi</a><a href="#" class="btn btn-outline-dark btn-sm mx-0 mt-2" data-toggle="modal" data-target="#trash_testexam">Rác</a>

			              	<!-- modal của thêm đề-->
                    <div class="modal fade" id="add_testexam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                          <div class="modal-body text-left">
                                            <form action="{{ url('/admin/testexam/add_testexam') }}" method="POST" >
                                                @csrf
                                                <label class="mb-0 pl-2">Thuộc môn học:</label>
						                          <select name="subject_id" class="form-control mb-2">
						                          	<option>-Chọn môn học mà đề thi thuộc:</option>
						                          	@if(count($subjects) > 0)
						                          		@foreach($subjects as $key => $subject)
						                          			<option value="{{$subject->id}}">{{$subject->name}}</option>
						                          		@endforeach
						                          	@endif
						                          </select> 
												              <label class="mb-0 pl-2">Tên dề thi:</label>
                                          <input type="text" class="form-control mb-2" name="name" required placeholder="đề thi....">
                                      <label class="mb-0 pl-2">Miêu tả:</label>
                                          <input type="text" class="form-control" name="description" required placeholder="Miêu tả...."> 
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm" name="add">Lưu</button> 
                                            </form>
                                            <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                          </div>
                                </div>
                              </div>
                    </div>
                    <!-- </div> -->
                 <!-- kết thúc modal của thêm đề -->

			              	<!-- modal của thư mục rác-->
                <div class="modal fade" id="trash_testexam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                      <div class="modal-body">
                                          <table class="table">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Môn học đã xóa</th>
                                                    <th scope="col">Hiệu chỉnh</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  @if(count($trash_testexams) > 0)
                                                    @foreach($trash_testexams as $key => $testexam)
                                                      <tr>
                                                        <th scope="row">{{++$key}}</th>
                                                        <td>{{ $testexam->name }}</td>                             
                                                        <td><a href="{{url('/admin/testexam/restore_trash', $testexam->id)}}" class="btn btn-info btn-sm">Khôi phục</a></td>
                                                      </tr>
                                                    @endforeach
                                                  @endif                                                  
                                                </tbody>
                                          </table> 
                                      </div>
                                      <div class="modal-footer">
                                        <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                      </div>
                            </div>
                          </div>
                </div>
                <!-- </div> -->
             <!-- kết thúc modal của thư mục rác -->
			              </div>
			            </div>  
                  </div>
                  <div class="card-body">
                    <table class="table card-text table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Tên đề</th>
                          <th>Thuộc môn</th>
                          <th>Số câu hỏi</th>
                          <th>Thời gian</th>
                          <th>Hiệu chỉnh</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@if(count($testexams) > 0)
                      		@foreach($testexams as $key=>$testexam)
                      			<tr>
		                          <th scope="row">{{++$key }}</th>
		                          <td>{{ $testexam->name }}</td>
		                          <td>{{ $testexam->subject->name }}</td>
		                          <td>{{ $testexam->question_count }}</td>
		                          <td>{!! $test->time ?? '<small class="text-secondary">Chưa cung cấp</small>'!!}</td>
		                          <td><a href="/admin/testexam/{{$testexam->id}}/review" class="btn btn-sm btn-info mr-1">Show</a><a href="#" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#change_name{{ $key }}">Sửa</a><a href="#" class="btn btn-sm btn-secondary mr-1" data-toggle="modal" data-target="#del_testexam{{ $key }}">Xóa</a>
		                          	<!-- modal của sửa tên đề thi-->
				                      <div class="modal fade" id="change_name{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
				                              <div class="modal-dialog modal-dialog-centered">
				                                <div class="modal-content">
				                                  <div class="modal-body">
				                                    <form action="{{ url('/admin/testexam/change_name', $testexam->id) }}" method="POST" >
				                                        @csrf
				                                      <div class="form-group">
				                                        <input type="text" class="form-control" name="name" value="{{ $testexam->name }}">
				                                      </div>

				                                  </div>
				                                  <div class="modal-footer">
				                                    <button type="submit" class="btn btn-warning btn-sm" name="change_name">Lưu</button>
				                                    <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
				                                    </form>
				                                  </div>
				                                </div>
				                              </div>
				                            </div>
				                        <!-- </div> -->
				                      <!-- kết thúc modal của sửa đề thi -->

				                    <!-- modal của xóa môn học-->
				                      <div class="modal fade" id="del_testexam{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
				                              <div class="modal-dialog modal-dialog-centered">
				                                <div class="modal-content">
				                                  <div class="modal-body">
				                                      Bạn có thực sự muốn xóa đề thi này?
				                                      <p><small>"Có thể lấy lại dữ liệu trong tập tin rác."</small></p>
				                                  </div>
				                                  <div class="modal-footer">
				                                    <form action="{{ url('/admin/testexam/del_testexam', $testexam->id) }}" method="POST">
				                                      @csrf
				                                      <button type="submit" class="btn btn-primary btn-sm" name="del_testexam">Xác nhận</button>
				                                    </form>
				                                    <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
				                                  </div>
				                                </div>
				                              </div>
				                            </div>
				                        <!-- </div> -->
				                      <!-- kết thúc modal của xóa môn học -->  
		                          </td>
		                        </tr>
                      		@endforeach
                      	@endif
                        
                      </tbody>
                    </table>
                    {{ $testexams->links() }}
                  </div>
                </div>


			</div>
		</div>
	</div>
@endsection