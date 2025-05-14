@extends('layout/admin-layout')

@section('title', 'Danh sách hồ sơ')

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
                            <h4 class="font-weight-bold text-primary">Danh sách hồ sơ</h4>
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
                                    Họ và tên
                                </th>
                                <th>
                                    Số căn cước
                                </th>
                                <th>
                                    Số điện thoại
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Nơi thường trú
                                </th>
                                <th>
                                    Ngày thêm
                                </th>
                                <th>
                                    File
                                </th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Xóa Modal -->
    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận xóa hồ sơ</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ho-so.xoa-ho-so') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <h6 class="text-danger">Xác nhận xóa hồ sơ này?</h6>
                        <div>
                            <label><strong>Họ tên:</strong></label>
                            <p class="d-inline" id="modalHoTen"></p>
                        </div>
                        <div>
                            <label><strong>Số điện thoại:</strong></label>
                            <p class="d-inline" id="modalSDT"></p>
                        </div>
                        <div>
                            <label><strong>Căn cước công dân:</strong></label>
                            <p class="d-inline" id="modalCCCD"></p>
                        </div>
                        <div>
                            <label><strong>Email:</strong></label>
                            <p class="d-inline" id="modalEmail"></p>
                        </div>
                        <input type="hidden" name="ma_ho_so" id="modalMaHoSo">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Xác nhận xóa</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(event) {
            const button = event.target.closest('.btn-danger[data-bs-toggle="modal"]');
            const modalHoTen = document.getElementById('modalHoTen');
            const modalMaHoSo = document.getElementById('modalMaHoSo');
            const modalCCCD = document.getElementById('modalCCCD');
            const modalEmail = document.getElementById('modalEmail');
            const modalSDT = document.getElementById('modalSDT');
            if (button) {
                const hoTen = button.getAttribute('data-ho-ten');
                const maHoSo = button.getAttribute('data-ma-ho-so');
                const cccd = button.getAttribute('data-so-cccd');
                const email = button.getAttribute('data-email');
                const sdt = button.getAttribute('data-sdt');
                modalHoTen.textContent = hoTen;
                modalMaHoSo.value = maHoSo;
                modalCCCD.textContent = cccd;
                modalEmail.textContent = email;
                modalSDT.textContent = sdt;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{ route('ho-so.getHoSo') }}",

                language: {
                    searchPlaceholder: "Tìm kiếm",
                    search: "",
                    sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    sInfoEmpty: "Hiển thị 0 đến 0 của 0 mục",
                    sInfoFiltered: "Lọc từ _MAX_ mục",
                    sLengthMenu: "Hiện _MENU_ mục",
                    sEmptyTable: "Không có dữ liệu",
                },
                dom: '<"clear"><"row"<"col"l><"col"f>>rt<"row"<"col"i><"col"p>><"row"<"col"B>>',
                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        title: ''
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        title: ''
                    }
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'ho_ten',
                        name: 'ho_ten'
                    },
                    {
                        data: 'so_cccd',
                        name: 'so_cccd'
                    },
                    {
                        data: 'so_dien_thoai',
                        name: 'so_dien_thoai'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'noi_thuong_tru',
                        name: 'noi_thuong_tru'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'thao_tac',
                        name: 'thao_tac',
                    },
                ],
                initComplete: function() {
                    $('.dataTables_filter input[type="search"]').css({
                        width: '350px',
                        display: 'inline-block',
                        height: '40px'
                    });
                },
            });
        });
    </script>
@stop
