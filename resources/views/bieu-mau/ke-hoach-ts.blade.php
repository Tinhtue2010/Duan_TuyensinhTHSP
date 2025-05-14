@extends('layout/bieu-mau-layout')

@section('title', 'Kế hoạch tuyển sinh')

@section('content2')
    <div class="main-general" style="flex-direction: column;">
        <br>
        <div class="row">
            <a class="main-general-info-text" href="{{ route('home.download-ke-hoach-ts') }}">
                <i class="fas fa-file-pdf">
                </i> Kế hoạch tuyển sinh
            </a>

        </div>
        <br>
        <div class="row mb-5">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('images/kh1.png') }}" alt="mô tả ảnh" class="img-fluid"
                    style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('images/kh2.png') }}" alt="mô tả ảnh" class="img-fluid"
                    style="height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
@endsection
