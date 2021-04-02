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
                            <div class="col-4 text-right"><button class="btn btn-outline-success no-border-radius"><i
                                        class="fas fa-user-plus"></i></button></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <table class="table table-bordered table-hover table-striped">
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
                                                <span class="badge badge-{{ $inspector->status == 1 ? 'success' : 'danger' }}">{{ $inspector->status == 1 ? 'Active' : 'Inactive' }}</span>
                                                <i class="fas fa-edit bg-hover-secondary" style="padding: 2px; border-radius:3px" data-toggle="modal"
                                                data-target="#status_inspector{{$key}}"></i>
                                                {{-- modal status giáo viên --}}
                                                <div class="modal fade" id="status_inspector{{$key}}" tabindex="-1"
                                                    data-backdrop="static" aria-labelledby="add_inspector"
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
                                                                <form action="{{url('/admin/inspector/change_status')}}" method="post">
                                                                @csrf 
                                                                <input type="hidden" name="id_inspector" value="{{$inspector->id}}">
                                                                <select name="status" class="form-control no-border-radius mb-4">
                                                                    <option value="1" {{ $inspector->status == 1 ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ $inspector->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                                <small class="font-italic">
                                                                    <span class="font-weight-bold">Lưu ý:</span> 
                                                                    Active là hoạt động bình thường.
                                                                    Inactive là vô hiệu hóa hỗ trợ viên truy cập vào hệ thống.<br>
                                                                    Quản trị hãy cân nhắc khi sửa trạng thái của các hỗ trợ viên.
                                                                </small>
                                                                <input type="submit" style="display: none" id="changeStatus"> 
                                                                </form>   
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm no-border-radius"
                                                                    data-dismiss="modal" onclick="$('#changeStatus').click()">Xác nhận</button>    
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
                                                        data-target="#detail_inspector{{$key}}"></i></span>
                                                <span><img src="/images/rotation-lock.svg" width="30px"
                                                        class="bg-hover-danger p-1 mb-1 rounded "></span>
                                                {{-- modal detail giáo viên --}}
                                                <div class="modal fade" id="detail_inspector{{$key}}" tabindex="-1"
                                                    data-backdrop="static" aria-labelledby="add_inspector"
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
                                                                <label>Họ và tên:</label> {{ $inspector->name }}<br>
                                                                <label>Username:</label> {{ $inspector->username }}<br>
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
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm no-border-radius"
                                                                    data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

@endsection
