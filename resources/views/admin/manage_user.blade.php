@extends('layouts.admin_main')

@section('content')
    <div class="container">
        <div class="row mt-3 mb-3 justify-content-center">
            <div class="col-lg-12 text-center">
                <!-- start Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <h6 class="text-uppercase mb-0 mt-2">Quản lý thí sinh</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-end">
                                <div class="col-3 mb-2 pr-0"><input type="text" class="form-control no-border-radius" id="myInput1" onkeyup="myFunction1()" placeholder="Tìm kiếm theo email..." title="Type in a email"></div>
                                <div class="col-3 mb-2"><input type="text" class="form-control no-border-radius" id="myInput" onkeyup="myFunction()" placeholder="Tìm kiếm theo username..." title="Type in a username"></div>
                              </div>
                            <table class="table table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Khởi tạo</th>
                                        <th scope="col">Hiệu chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ ucwords($user->name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{!! !empty($user->google_id) ? '<i class="fab fa-google-plus-square text-danger mt-1" style="font-size: 20px"></i>' : $user->username !!}</td>
                                            <td class="font-italic">{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                            <td><i class="fas fa-info-circle bg-hover-info text-info p-1 rounded"
                                                    style="font-size: 20px" data-toggle="modal"
                                                    data-target="#detail_user{{ $key }}"></i>
                                                <span><img src="/images/rotation-lock.svg" width="28px"
                                                        class="bg-hover-primary p-1 rounded" data-toggle="modal"
                                                        data-target="#resetpass_user{{ $key }}"
                                                        style="margin-bottom: 7px;"></span>
                                            </td>
                                            {{-- modal detail user --}}
                                            <div class="modal fade" id="detail_user{{ $key }}" tabindex="-1"
                                                data-backdrop="static" aria-labelledby="detail_user" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thông tin thí
                                                                sinh</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <label>Họ và tên:</label> {{ $user->name }}<br>
                                                                    <label>Username:</label> {{ $user->username }}<br>
                                                                    <label>Email:</label> {{ $user->email }}<br>
                                                                    <label>Tuổi:</label> {!! $user->age ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>
                                                                    <label>Sđt:</label> {!! $user->phone ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>
                                                                    <label>Địa chỉ:</label> {!! $user->address ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>

                                                                    <label>Khởi tạo:</label>
                                                                    {{ date('d-m-Y', strtotime($user->created_at)) }}<br>
                                                                    <label>GG login:</label> {!! $user->google_id ? '<i class="far fa-check-circle text-success"></i>' : '<i class="far fa-times-circle"></i>' !!}<br>
                                                                </div>
                                                                <div class="col-3 pr-2">
                                                                    <img src="{{ !empty($user->avatar) ? $user->avatar : '/images/undefined_user.jpg'}}" width="90%" class="rounded img-thumbnail">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm no-border-radius"
                                                                data-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end detail modal --}}
                                            {{-- modal reset password giáo viên --}}
                                            <div class="modal fade" id="resetpass_user{{ $key }}"
                                            tabindex="-1" data-backdrop="static"
                                            aria-labelledby="resetpass_user" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reset mật
                                                            khẩu</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        @if($user->google_id)    
                                                        <small class="text-danger">Tài khoản đăng nhập bên thứ ba (google, facebook,...) không thể reset mật khẩu!</small>
                                                        @else
                                                        <small class="font-italic">Chỉ reset mật khẩu các thí đăng nhập bằng tài khoản hệ thống.
                                                            Khi thí sinh quên mất mật khẩu
                                                            của mình thì quản lý có thể khởi tạo lại mật khẩu cho thí
                                                            sinh với mật khẩu có giá trị là (password + ID):<p
                                                                class="font-weight-bold mb-0 "
                                                                style="font-size: 16px">password{{$user->id}}</p></small>
                                                        @endif        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ url('/admin/user/reset_password') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="id_user"
                                                                value="{{ $user->id }}">
                                                            @if(!$user->google_id)    
                                                            <button class="btn btn-danger btn-sm no-border-radius"
                                                                type="submit">Xác nhận</button>
                                                            @endif
                                                        </form>
                                                        <button type="button"
                                                            class="btn btn-secondary btn-sm no-border-radius"
                                                            data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end reset password modal --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{ $users->links() }}
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toLowerCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        function myFunction1() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput1");
            filter = input.value.toLowerCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection
