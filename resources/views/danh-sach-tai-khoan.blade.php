@extends('layout/admin-layout')

@section('title', 'Danh sách tài khoản')

@section('content2')
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="myAlert">
                    <strong>{{ session('alert-success') }}</strong>
                </div>
            @elseif (session('alert-danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
                    <strong>{{ session('alert-danger') }}</strong>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header pt-3">
                    <div class="row">
                        <div class="col-9">
                            <h4 class="font-weight-bold text-primary">Danh sách tài khoản</h4>
                        </div>
                        <div class="col-3">
                            <button data-bs-toggle="modal" data-bs-target="#themModal"
                                class="btn btn-success float-end">Thêm tài khoản mới</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <th>
                                    STT
                                </th>
                                <th>
                                    Tên đăng nhập
                                </th>
                                <th>
                                    Họ tên
                                </th>
                                <th>
                                    Ngày tạo
                                </th>
                                <th>
                                    Thao tác
                                </th>
                            </thead>
                            <tbody class="clickable-row">
                                @foreach ($data as $index => $taiKhoan)
                                    <tr data-ma-tai-khoan="{{ $taiKhoan->id }}"
                                        data-ten-dang-nhap="{{ $taiKhoan->name }}"
                                        data-ho-ten="{{ $taiKhoan->ho_ten }}"
                                        data-loai-tai-khoan="{{ $taiKhoan->loai_tai_khoan }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $taiKhoan->name }}</td>
                                        <td>{{ $taiKhoan->ho_ten }}</td>
                                        <td>{{ $taiKhoan->created_at->format('d-m-Y') }}</td>
                                        <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoaModal"
                                                data-ma-tai-khoan="{{ $taiKhoan->id }}"
                                                data-ten-dang-nhap="{{ $taiKhoan->name }}"
                                                data-ho-ten="{{ $taiKhoan->ho_ten }}"
                                                data-loai-tai-khoan="{{ $taiKhoan->loai_tai_khoan }}">
                                                Xóa
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thông tin Modal -->
    <div class="modal fade" id="thongTinModal" tabindex="-1" aria-labelledby="thongTinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thongTinModalLabel">Thông tin tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tai-khoan.update-tai-khoan') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input hidden id="modalMaTaiKhoanInput" name="id">
                        <p><strong>Tên đăng nhập:</strong> <span id="modalTenDangNhap"></span></p>
                        <p><strong>Họ tên:</strong> <span id="modalHoTen"></span></p>
                        {{-- <p><strong>Loai tài khoản:</strong> <span id="modalLoaiTaiKhoan"></span></p> --}}
                        <hr />
                        <label class="mt-1" for="mat_khau"><strong>Mật khẩu</strong> (Nhập mật khẩu mới để thay đổi mật
                            khẩu)</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                            autocomplete="new-password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Thêm -->
    <div class="modal fade" id="themModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tai-khoan.them-tai-khoan') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <label for="name">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Nhập tên đăng nhập" required>
                            
                        <label for="name">Họ tên</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                            placeholder="Nhập họ tên" required>

                        <label class="mt-3" for="mat_khau">Mật khẩu</label>
                        <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                            placeholder="Nhập mật khẩu" autocomplete="new-password" required>

                        {{-- <label class="mt-3" for="loai_tai_khoan">Loại tài khoản</label>
                        <select class="form-control" id="loai-tai-khoan-dropdown" name="loai_tai_khoan"
                            aria-placeholder="Chọn loại tài khoản" required>
                            <option></option>
                            <option value="Admin">Admin</option>
                        </select> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Xóa Modal -->
    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận xóa tài khoản</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tai-khoan.xoa-tai-khoan') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <h6 class="text-danger">Xác nhận xóa tài khoản này?</h6>
                        <div>
                            <label><strong>Tên đăng nhập:</strong></label>
                            <p class="d-inline" id="modalTenDangNhapXoa"></p>
                        </div>
                        <div>
                            <label><strong>Họ tên:</strong></label>
                            <p class="d-inline" id="modalHoTenXoa"></p>
                        </div>
                        {{-- <div>
                            <label><strong>Loại tài khoản:</strong></label>
                            <p class="d-inline" id="modalLoaiTaiKhoanXoa"></p>
                        </div> --}}
                        <input type="hidden" name="id" id="modalInputMaTaiKhoanXoa">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Script áp dụng cho 3 cột đầu --}}
    <script>
        $(document).ready(function() {
            $('#dataTable tbody').on('click', 'tr', function(event) {
                if ($(event.target).closest('td:last-child').length) {
                    return;
                }
                var maTaiKhoan = $(this).data('ma-tai-khoan');
                var tenDangNhap = $(this).data('ten-dang-nhap');
                var hoTen = $(this).data('ho-ten');
                // var loaiTaiKhoan = $(this).data('loai-tai-khoan');

                $('#modalMaTaiKhoan').text(maTaiKhoan);
                $('#modalTenDangNhap').text(tenDangNhap);
                $('#modalHoTen').text(hoTen);
                // $('#modalLoaiTaiKhoan').text(loaiTaiKhoan);
                document.getElementById('modalMaTaiKhoanInput').value = maTaiKhoan;

                $('#thongTinModal').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-danger[data-bs-toggle="modal"]');
            const modalTenDangNhap = document.getElementById('modalTenDangNhapXoa');
            const modalHoTen = document.getElementById('modalHoTenXoa');
            // const modalLoaiTaiKhoan = document.getElementById('modalLoaiTaiKhoanXoa');
            const modalInputMaTaiKhoan = document.getElementById('modalInputMaTaiKhoanXoa');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const maTaiKhoan = this.getAttribute('data-ma-tai-khoan');
                    const tenDangNhap = this.getAttribute('data-ten-dang-nhap');
                    const hoTen = this.getAttribute('data-ho-ten');

                    // const loaiTaiKhoan = this.getAttribute('data-loai-tai-khoan');

                    modalTenDangNhap.textContent = tenDangNhap;
                    modalHoTen.textContent = hoTen;
                    modalInputMaTaiKhoan.value = maTaiKhoan;
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    searchPlaceholder: "Tìm kiếm",
                    search: "",
                    "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "sInfoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                    "sInfoFiltered": "Lọc từ _MAX_ mục",
                    "sLengthMenu": "Hiện _MENU_ mục",
                    "sEmptyTable": "Không có dữ liệu",
                },
                stateSave: true,
                dom: '<"clear"><"row"<"col"l><"col"f>>rt<"row"<"col"i><"col"p>><"row"<"col"B>>',
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        title: ''
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        title: ''
                    }
                ]
            });

            $('.dataTables_filter input[type="search"]').css({
                width: '350px',
                display: 'inline-block',
                height: '40px',
            });
        });
    </script>
@stop
