@extends('layout/main-layout')

@section('title', 'Mốc thời gian tuyển sinh')

@section('content')
    <style>
        .custom-image {
            margin-top: 5vh;
            margin-bottom: 5vh;
            width: 90%;
        }

        @media (max-width: 576px) {
            .custom-image {
                margin-top: 0;
                margin-bottom: 0;
                width: 100%;
            }
        }
    </style>
    <div class="main-general">
        <img class="custom-image" src="{{ asset('images/MocTS.jpg') }}" alt="image" />
    </div>
@endsection
