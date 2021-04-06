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
                                <h6 class="text-uppercase mb-0 mt-2">Quản lý hỗ trợ viên</h6>
                            </div>
                            <div class="col-4 text-right"><a href="{{ url('/admin/inspector/add') }}"><button
                                        class="btn btn-outline-success no-border-radius"><i
                                            class="fas fa-user-plus"></i></button></a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row d-flex justify-content-end">
                                <div class="col-3 mb-2 pr-0"><input type="text" class="form-control no-border-radius" id="myInput1" onkeyup="myFunction1()" placeholder="Tìm kiếm theo tên..." title="Type in a email"></div>
                                <div class="col-3 mb-2"><input type="text" class="form-control no-border-radius" id="myInput" onkeyup="myFunction()" placeholder="Tìm kiếm theo username..." title="Type in a username"></div>
                              </div>
                            <table class="table table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hiệu chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inspectors as $key => $inspector)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $inspector->name }}</td>
                                            <td>{{ $inspector->username }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $inspector->status == 1 ? 'success' : 'danger' }}">{{ $inspector->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                <i class="fas fa-edit bg-hover-secondary"
                                                    style="padding: 2px; border-radius:3px" data-toggle="modal"
                                                    data-target="#status_inspector{{ $key }}"></i>
                                                {{-- modal status giáo viên --}}
                                                <div class="modal fade" id="status_inspector{{ $key }}"
                                                    tabindex="-1" data-backdrop="static" aria-labelledby="status_inspector"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Trạng thái hỗ trợ viên</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <form action="{{ url('/admin/inspector/change_status') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id_inspector"
                                                                        value="{{ $inspector->id }}">
                                                                    <select name="status"
                                                                        class="form-control no-border-radius mb-4">
                                                                        <option value="1"
                                                                            {{ $inspector->status == 1 ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="0"
                                                                            {{ $inspector->status == 0 ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                    <small class="font-italic">
                                                                        <span class="font-weight-bold">Lưu ý:</span>
                                                                        Active là hoạt động bình thường.
                                                                        Inactive là vô hiệu hóa hỗ trợ viên truy cập vào hệ
                                                                        thống.<br>
                                                                        Quản trị hãy cân nhắc khi sửa trạng thái của các hỗ
                                                                        trợ viên.
                                                                    </small>
                                                                    <input type="submit" style="display: none"
                                                                        id="changeStatus">
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm no-border-radius"
                                                                    data-dismiss="modal"
                                                                    onclick="$('#changeStatus').click()">Xác nhận</button>
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm no-border-radius"
                                                                    data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span><i class="fas fa-info-circle text-info mr-1 bg-hover-info p-1 rounded"
                                                        style="font-size: 20px" data-toggle="modal"
                                                        data-target="#detail_inspector{{ $key }}"></i></span>
                                                <span><img src="/images/rotation-lock.svg" width="28px"
                                                        class="bg-hover-primary p-1 rounded" data-toggle="modal"
                                                        data-target="#resetpass_inspector{{ $key }}"
                                                        style="margin-bottom: 7px;"></span>
                                                {{-- modal detail giáo viên --}}
                                                <div class="modal fade" id="detail_inspector{{ $key }}"
                                                    tabindex="-1" data-backdrop="static" aria-labelledby="detail_inspector"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Thông tin hỗ
                                                                    trợ viên</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <label>Họ và tên:</label>
                                                                        {{ $inspector->name }}<br>
                                                                        <label>Username:</label>
                                                                        {{ $inspector->username }}<br>
                                                                        <label>Email:</label> {{ $inspector->email }}<br>
                                                                        <label>Tuổi:</label> {!! $inspector->age ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>
                                                                        <label>Sđt:</label> {!! $inspector->phone ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>
                                                                        <label>Địa chỉ:</label> {!! $inspector->address ?? '<small class="font-italic">Chưa cung cấp</small>' !!}<br>
                                                                        <?php if ($inspector->status == 1):
                                                                        $class = 'success';
                                                                        $status = 'Active';
                                                                        else:
                                                                        $class = 'danger';
                                                                        $status = 'Inactive';
                                                                        endif; ?>
                                                                        <label>Trạng thái:</label> <span
                                                                            class="badge badge-{{ $class }}">{{ $status }}</span><br>
                                                                        <label>Khởi tạo:</label>
                                                                        {{ date('d-m-Y', strtotime($inspector->created_at)) }}<br>
                                                                    </div>
                                                                    <div class="col-3 pr-2">
                                                                        <img src="{{ !empty($inspector->avatar) ? $inspector->avatar : '/images/undefined_user.jpg' }}"
                                                                            width="90%" class="rounded img-thumbnail">
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
                                                <div class="modal fade" id="resetpass_inspector{{ $key }}"
                                                    tabindex="-1" data-backdrop="static"
                                                    aria-labelledby="resetpass_inspector" aria-hidden="true">
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
                                                                <small class="font-italic">Khi hỗ trợ viên quên mất mật khẩu
                                                                    của mình thì quản lý có thể khởi tạo lại mật khẩu cho hỗ
                                                                    trợ viên với mật khẩu có giá trị là:<p
                                                                        class="font-weight-bold mb-0 "
                                                                        style="font-size: 16px">password</p></small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form
                                                                    action="{{ url('/admin/inspector/reset_password') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id_inspector"
                                                                        value="{{ $inspector->id }}">
                                                                    <button class="btn btn-danger btn-sm no-border-radius"
                                                                        type="submit">Xác nhận</button>
                                                                </form>
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm no-border-radius"
                                                                    data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- end reset password modal --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
        function myFunction1() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput1");
            filter = input.value.toLowerCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
