@extends('layouts.inspector_main')

@section('content')
<div class="container">
	<div class="row mt-3 justify-content-center">
    @error('name') 
            <div class="alert alert-danger w-50 text-center">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>         
        @enderror
    <div class="col-lg-10 mb-4">
    	 <div class="card text-center">
          <div class="card-header">
            <div class="row justify-content-between">
              <div class="col-4"></div>
              <div class="col-4">
                  <h4 class="text-uppercase mb-0 mt-2">Môn học</h4>
              </div>
              <div class="col-4"><a href="#" class="btn btn-outline-success mr-1" data-toggle="modal" data-target="#add_subject">Thêm môn học</a><a href="#" class="btn btn-outline-dark btn-sm mx-0 mt-2" data-toggle="modal" data-target="#trash">Rác</a>
                <!-- modal của thêm môn học-->
                    <div class="modal fade" id="add_subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                          <div class="modal-body">
                                            <form action="{{ url('/inspector/subject/add_subject') }}" method="POST" >
                                                @csrf
                                                <input type="text" class="form-control" name="name" placeholder="môn học....">
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm" name="change_name">Lưu</button> 
                                            </form>
                                            <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                          </div>
                                </div>
                              </div>
                    </div>
                    <!-- </div> -->
                 <!-- kết thúc modal của thêm môn học -->

             <!-- modal của thư mục rác-->
                <div class="modal fade" id="trash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
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
                                                  @if(count($trash_subjects) > 0)
                                                    @foreach($trash_subjects as $key => $subject)
                                                      <tr>
                                                        <th scope="row">{{++$key}}</th>
                                                        <td>{{ $subject->name }}</td>                             
                                                        <td><a href="{{url('/inspector/subject/restore_trash', $subject->id)}}" class="btn btn-info btn-sm">Khôi phục</a></td>
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
            <table class="table card-text table-hover table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Môn học</th>
                  <th>Số bài thi</th>
                  <th>Trạng thái</th>
                  <th>Hiệu chỉnh</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subjects as $key => $subject)
                  <tr data-toggle="collapse" data-target="#demo{{++$key}}" class="accordion-toggle">
                    <th>{{ $key }}</th>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->testexam_count }}</td>
                    <td>
                    @if($subject->status)
                       <p class="text-success"> Hoạt động </p>
                    @else
                        <p class="text-danger">Ngừng hoạt động </p>
                    @endif
                    </td>
                    <td><a href="#" class="btn btn-warning mr-1 btn-sm" data-toggle="modal" data-target="#change_name{{ $key }}">Sửa</a>
                      @if($subject->status)
                      <a href="#" class="btn btn-danger mr-1 btn-sm" data-toggle="modal" data-target="#off_status{{ $key }}">Off</a>
                      @else
                      <a href="#" class="btn btn-info mr-1 btn-sm" data-toggle="modal" data-target="#on_status{{ $key }}">On</a>
                      @endif
                      <a href="#" class="btn btn-secondary mr-1 btn-sm" data-toggle="modal" data-target="#del_subject{{ $key }}">Xóa</a>
                    </td>        
                  </tr>
                  <tr>
                    <td colspan="5">
                      <div class="accordian-body collapse" id="demo{{$key}}">
                        <table class="container table-bordered">
                          <tbody>
                            @foreach($subject->chapter as $key1 =>$val)
                            <tr>                              
                              <td>{{$val->name}}</td>
                              <td class="w-75 text-left">{{$val->description}}</td>
                              <td><a href="#" data-toggle="modal" data-target="#del_chapter{{$key}}-{{$key1}}"><i class="fas fa-trash text-danger"></i></a>
                                    <!-- modal của xóa môn học-->
                              <div class="modal fade" id="del_chapter{{ $key }}-{{$key1}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                              Bạn có thực sự muốn xóa {{$val->name}} - {{$subject->name}} ?
                                          </div>
                                          <div class="modal-footer">
                                            <form action="{{ url('/inspector/chapter/del_chapter', $val->id) }}" method="POST">
                                              @csrf
                                              <button type="submit" class="btn btn-primary btn-sm" name="del_chapter">Xác nhận</button>
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
                            <tr>
                              <td colspan ="3"><a  href="#" data-toggle="modal" data-target="#add_chapter{{$key}}"><i class="fas fa-plus text-success"></i></a></td>
                              <!-- modal của thêm chương-->
                              <div class="modal fade" id="add_chapter{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                                    <div class="modal-body">
                                                      <form action="{{ url('/inspector/chapter/add_chapter') }}" method="POST" >
                                                          @csrf
                                                          <input type="hidden" name="subject_id" value="{{$subject->id}}">
                                                          <input type="text" class="form-control" name="description" placeholder="Chương gì....">
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="submit" class="btn btn-primary btn-sm" name="add_chapter">Lưu</button> 
                                                      </form>
                                                      <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                                    </div>
                                          </div>
                                        </div>
                              </div>
                              <!-- </div> -->
                           <!-- kết thúc modal của thêm chương -->
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </td>  
                  </tr>
                  <!-- modal của sửa tên môn học-->
                      <div class="modal fade" id="change_name{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <form action="{{ url('/inspector/subject/change_name', $subject->id) }}" method="POST" >
                                        @csrf
                                      <div class="form-group">
                                        <label>Môn học</label>
                                        <input type="text" class="form-control" name="name" value="{{ $subject->name }}">
                                      </div>
                                      <div class="text-left">
                                      @foreach($subject->chapter as $key1 =>$val)
                                            <label class="mb-0 pl-2">{{$val->name}}:</label>
                                            <input type="hidden" name="chapter_id[]" value="{{$val->id}}">
                                            <input type="text" name="chapter_description[{{$val->id}}]" value="{{$val->description}}" class="form-control mb-2" required>   
                                      @endforeach
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
                      <!-- kết thúc modal của sửa môn học -->

                      <!-- modal của sửa trạng thái off-->
                      <div class="modal fade" id="off_status{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-body">
                                      Bạn có thực sự muốn ngừng sử dụng môn học này?
                                  </div>
                                  <div class="modal-footer">
                                    <form action="{{ url('/inspector/subject/off_status', $subject->id) }}" method="POST" >
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" name="status">Xác nhận</button>
                                    </form>
                                    <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- </div> -->
                      <!-- kết thúc modal của sửa trạng thái off-->

                      <!-- modal của sửa trạng thái on-->
                      <div class="modal fade" id="on_status{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-body">
                                      Bạn kích hoạt sử dụng môn học này?
                                  </div>
                                  <div class="modal-footer">
                                    <form action="{{ url('/inspector/subject/on_status', $subject->id) }}" method="POST" >
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm" name="status">Xác nhận</button>
                                    </form>
                                    <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- </div> -->
                      <!-- kết thúc modal của sửa trạng thái on-->

                      <!-- modal của xóa môn học-->
                      <div class="modal fade" id="del_subject{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-body">
                                      Bạn có thực sự muốn xóa môn học này?
                                      <p><small>"Có thể lấy lại dữ liệu trong tập tin rác."</small></p>
                                  </div>
                                  <div class="modal-footer">
                                    <form action="{{ url('/inspector/subject/del_subject', $subject->id) }}" method="POST">
                                      @csrf
                                      <button type="submit" class="btn btn-primary btn-sm" name="del_subject">Xác nhận</button>
                                    </form>
                                    <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- </div> -->
                      <!-- kết thúc modal của xóa môn học -->
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div> 
	</div>
</div>
@endsection
