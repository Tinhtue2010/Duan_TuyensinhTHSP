@extends('layout/bieu-mau-layout')

@section('title', 'Thông báo 2')

@section('content2')
    <div class="main-general" style="flex-direction: column;">
        <br>
        <div class="row">
                <a class="main-general-info-text" href="{{ route('home.download-thong-bao-2') }}">
                    <i class="fas fa-file-pdf">
                    </i> Thông báo 2
                </a>

        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('images/BM_THPT_1.png') }}" alt="mô tả ảnh" width="chiều_rộng" height="chiều_cao">
            </div>
            <div class="col-6">
                <img src="{{ asset('images/BM_THPT_2.png') }}" alt="mô tả ảnh" width="chiều_rộng" height="chiều_cao">
            </div>
        </div>

    </div>
@endsection
