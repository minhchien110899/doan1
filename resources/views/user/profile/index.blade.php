@extends('layouts.main')

@section('content')
    <div class="container w3-round-large w3-border" style="height: 800px; ">
        <h1 class="text-center mb-5 mt-1">Thông tin chung</h1>
        @error('avatar') 
            <div class="alert alert-danger w-50 text-center">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>         
        @enderror 
        <div class="row">
            <div class="col-6 text-center">
                    
                <img src="{{ empty($user->avatar) ? '/images/no_image.jpg' : $user->avatar }}" class="img-thumbnail" width="30%" auto>
                <!-- <img src = "{{ secure_asset('/storage/avatar-user', empty($admin->avatar) ? 'no_image.jpg' : $admin->avatar) }}" class="img-thumbnail" width="30%" auto> -->
                {{-- <p><a href="#" data-toggle="modal" data-target="#change_image"> Thay đổi ảnh</a></p> --}}
                {{-- <div class="modal fade" id="change_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-body">
                        <form action="{{ url('/profile/change_avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="change_avatar">Lưu</button>
                        <a href='#' class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        </form>
                      </div>
                    </div>
                  </div>
                </div> --}}
                <p><a href="#" onclick="document.getElementById('id01').style.display='block'"> Thay đổi ảnh</a></p>

                <!-- The Modal -->
                <div id="id01" class="w3-modal">
                  <div class="w3-modal-content w3-animate-left w3-round py-3 w-25" style="top: 30%;">
                    <div class="w3-container">
                      <span onclick="document.getElementById('id01').style.display='none'"
                      class="w3-button w3-display-topright" style="font-size: 25px;line-height: 24px;">&times;</span>
                      <form action="{{ url('/profile/change_avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control-file" name="avatar">
                        <hr>
                      <footer class="w3-container float-right">
                        <button type="submit" class="w3-btn w3-round-large w3-medium btn-primary w3-padding-small" name="change_avatar">Lưu</button>
                        <a href='#' class="w3-btn w3-round-large w3-medium btn-secondary w3-padding-small" onclick="document.getElementById('id01').style.display='none'">Đóng</a>
                      </form>
                      </footer>  
                    </div>
                  </div>
                </div>

            </div>

            <div class="col-6">
                <p><span class="font-weight-bold">Họ và tên: </span> {{ $user->name }}</p>
                <p class="overflow-hidden"><span class="font-weight-bold">Email: </span> {{ $user->email }}</p>
                <p><span class="font-weight-bold">Tuổi: </span> {!! $user->age ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>
                <p><span class="font-weight-bold">Điện thoại: </span>{!! $user->phone ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>
                <p><span class="font-weight-bold">Địa chỉ: </span>{!! $user->address ?? '<small class="font-size-10 font-italic">(Chưa cung cấp)</small>' !!}</p>

                <button type="button" class="btn btn-primary" onclick="document.getElementById('id02').style.display='block'">
                    Cập nhập
                </button>

                <div id="id02" class="w3-modal">
                  <div class="w3-modal-content w3-animate-opacity w3-round py-3 w-25">
                    <div class="w3-container">
                      <span onclick="document.getElementById('id02').style.display='none'"
                      class="w3-button w3-display-topright" style="font-size: 25px;line-height: 24px;">&times;</span>
                      <form action="{{ url('/profile/change_info') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label class="font-weight-bolder">Họ và tên: </label>
                          <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                          <label class="font-weight-bolder">Tuổi: </label>
                          <input type="number" class="form-control" min=6 name="age" value="{{ $user->age }}">
                        </div>
                        <div class="form-group">
                          <label class="font-weight-bolder">Số điện thoại: </label>
                          <input type="text" class="form-control" name="phone"  minlength="9" maxlength="12" pattern="[0-9]{10,12}"  value="{{ $user->phone }}">
                          <label style="font-size:9px;padding-left:20px"> Eg : 0812222224  </label> 
                        </div>
                        <div class="form-group">
                          <label class="font-weight-bolder">Địa chỉ: </label>
                          <input type="text" class="form-control" name="address" minlength="8" maxlength="80"  value="{{ $user->address }}">
                        </div>
                        <!-- end form  -->
                        <hr>
                      <footer class="w3-container float-right">
                        <button type="submit" class="w3-btn w3-round-large w3-medium btn-primary w3-padding-small" name="update">Lưu</button>
                        <a href='#' class="w3-btn w3-round-large w3-medium btn-secondary w3-padding-small" onclick="document.getElementById('id02').style.display='none'">Đóng</a>
                      </form>
                      </footer>  
                    </div>
                  </div>
                </div>

                  <!-- Modal -->
                  {{-- <div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Cập nhập</h5>
                        </div>
                        <div class="modal-body">
                          <!-- start form -->
                          <form action="{{ url('/profile/change_info') }}" method="POST">
                            @csrf
                          <div class="form-group">
                            <label class="font-weight-bolder">Họ và tên: </label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                          </div>
                          <div class="form-group">
                            <label class="font-weight-bolder">Tuổi: </label>
                            <input type="number" class="form-control" min=6 name="age" value="{{ $user->age }}">
                          </div>
                          <div class="form-group">
                            <label class="font-weight-bolder">Số điện thoại: </label>
                            <input type="text" class="form-control" name="phone"  minlength="9" maxlength="12" pattern="[0-9]{10,12}"  value="{{ $user->phone }}">
                            <label style="font-size:9px;padding-left:20px"> Eg : 0812222224  </label> 
                          </div>
                          <div class="form-group">
                            <label class="font-weight-bolder">Địa chỉ: </label>
                            <input type="text" class="form-control" name="address" minlength="8" maxlength="80"  value="{{ $user->address }}">
                          </div>
                          <!-- end form  -->
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" id='btn_update'>Lưu</button>
                          </form>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                      </div>
                    </div>
                  </div> --}}

                  <!-- <script type="text/javascript">
                    $("#btn_update").click(function(){
                      $("#update").click();
                    })
                  </script>  --> 
            </div>
        </div>
        
    </div>
@endsection