@extends('layouts.inspector_main')

@section('content')
<div class="container" style="padding-top: 60px">
	@error('avatar') 
        <div class="alert alert-danger text-center">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>         
    @enderror
		<div class="row mt-3 mb-3 justify-content-center">
			<div class="col-lg-10 text-center">
				<!-- start Card -->
				<div class="card">
					<div class="card-header">
                    	<h6 class="text-uppercase mb-0">Thông tin chung</h6>
                  	</div>
                  <div class="card-body">
                    <div class="container-fluid">
                    	<div class="row">
                    		<div class="col-6">
                    			<img src="{{ empty($inspector->avatar) ? '/images/undefined_user.jpg' : $inspector->avatar }}" class="img-thumbnail" width="30%" auto>
                    			<!-- <img src = "{{ secure_asset('/storage/avatar-inspector', empty($inspector->avatar) ? 'no_image.jpg' : $inspector->avatar) }}" class="img-thumbnail" width="30%" auto> -->
                    			<p><a href="#" data-toggle="modal" data-target="#change_avatar"> Thay đổi ảnh</a></p>
                    			<!-- modal của sửa ảnh-->
                              <div class="modal fade" id="change_avatar" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                          <div class="modal-body">
                                            <form action="{{ url('/inspector/profile/change_avatar',$inspector->id) }}" method="POST" enctype="multipart/form-data">
						                            @csrf
						                          <div class="form-group">
						                            <input type="file" class="form-control-file" name="avatar">
						                          </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-sm" name="change_content">Lưu</button>
                                        	</form>
                                            <a href='#' class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <!-- </div> -->
                              <!-- kết thúc modal của sửa ảnh -->
                    		</div>
                    		<div class="col-6 text-left">
                    			<p><span class="font-weight-bold">Họ và tên: </span> {{ $inspector->name }}</p>
				                <p><span class="font-weight-bold">Email: </span> {{ $inspector->email }}</p>
				                <p><span class="font-weight-bold">Tuổi: </span> {!! $inspector->age ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>
				                <p><span class="font-weight-bold">Điện thoại: </span>{!! $inspector->phone ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>
				                <p><span class="font-weight-bold">Địa chỉ: </span>{!! $inspector->address ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>
				                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_modal">Cập nhập</button>
				                <!-- Modal -->
			                  <div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                    <div class="modal-dialog" role="document">
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <h5 class="modal-title" id="exampleModalLabel">Cập nhập</h5>
			                        </div>
			                        <div class="modal-body">
			                          <!-- start form -->
			                          <form action="{{ url('/inspector/profile/change_info',$inspector->id) }}" method="POST">
			                            @csrf
			                          <div class="form-group">
			                            <label class="font-weight-bolder ml-2">Họ và tên: </label>
			                            <input type="text" class="form-control" name="name" value="{{ $inspector->name }}" required>
			                          </div>
			                          <div class="form-group">
			                            <label class="font-weight-bolder ml-2">Tuổi: </label>
			                            <input type="number" class="form-control" min=6 name="age" value="{{ $inspector->age }}">
			                          </div>
			                          <div class="form-group">
			                            <label class="font-weight-bolder ml-2">Số điện thoại: </label>
			                            <input type="text" class="form-control" name="phone"  minlength="9" maxlength="12" pattern="[0-9]{10,12}"  value="{{ $inspector->phone }}">
			                            <label style="font-size:9px;padding-left:20px;margin-top:5px"> Eg : 0812222224  </label> 
			                          </div>
			                          <div class="form-group">
			                            <label class="font-weight-bolder ml-2">Địa chỉ: </label>
			                            <input type="text" class="form-control" name="address" minlength="8" maxlength="80"  value="{{ $inspector->address }}">
			                          </div>			                       
			                          <!-- end form  -->
			                        </div>
			                        <div class="modal-footer">
			                          <button type="submit" class="btn btn-primary">Lưu</button>
			                          </form>
			                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
				              <!-- end modal   --> 
                    		</div>
                    	</div>
                    </div>
                  </div>
                </div>
                <!-- end card -->
			</div>
		</div>
</div>
@endsection
