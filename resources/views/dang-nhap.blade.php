@extends('layout/main-layout')

@section('title', 'Mốc thời gian tuyên sinh')

@section('content')
    <div class="main-general">
        <img class="main-general-info-image" src= "{{ asset('images/people_generalx.png') }}" alt="image" />
        <form class="main-general-form" method="POST" action="{{ route('submit-dang-nhap') }}">
            @csrf
            @if (session('alert-danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Thông tin đăng nhập không chính xác</strong>
            </div>
            @endif
            <span class="main-general-form-text"> ĐĂNG NHẬP </span>
            <input class="main-general-form-input" type="text" name="name" placeholder="Tài khoản" />
            <input class="main-general-form-input" type="password" name="password" placeholder="Mật khẩu" />
            <button class="main-general-form-button" type="submit">
                Đăng nhập
            </button>
            <br>
        </form>
    </div>
@endsection
