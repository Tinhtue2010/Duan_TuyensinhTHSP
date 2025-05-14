@extends('layout.admin-layout')

@section('title', 'Kết xuất báo cáo')

@section('content2')
    <div id="layoutSidenav_content">
        <div class=" px-4">
            <div class="card shadow mb-4">
                <div class="card-header pt-3">
                    <div class="row">
                        @if (session('alert-success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="myAlert">
                                <strong>{{ session('alert-success') }}</strong>
                            </div>
                        @elseif (session('alert-danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
                                <strong>{{ session('alert-danger') }}</strong>
                            </div>
                        @endif
                        <div class="col-9">
                            <h4 class="font-weight-bold text-primary">Kết xuất báo cáo</h4>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
                <div class="container-fluid card-body">
                    <div class="row justify-content-center">
                        <div class="card p-3 me-3 col-10">
                            <h4>Báo cáo số lượng hồ sơ</h4>
                            <div class="form-group">
                                <form action="{{ route('bao-cao.bao-cao-ho-so') }}" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="label-text mb-2" for="ma_to_khai">Từ ngày</label>
                                            <input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy"
                                                name="tu_ngay" readonly>
                                        </div>
                                        <div class="col-6">
                                            <label class="label-text mb-2" for="ma_to_khai">Đến ngày</label>
                                            <input type="text" class="form-control datepicker" placeholder="dd/mm/yyyy"
                                                name="den_ngay" readonly>
                                        </div>
                                    </div>
                                    <center><button type="submit" class="btn btn-primary mt-2">Tải xuống báo
                                            cáo</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                language: 'vi',
                endDate: '0d'
            });
        });
    </script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Flatpickr Tiếng Việt -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>

    <!-- Plugin chọn tháng -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

@stop
