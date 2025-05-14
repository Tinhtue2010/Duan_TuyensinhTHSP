<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', 'Tuyển sinh')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylev4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mediav4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/DataTables/datatables.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />


    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (must be included before Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap Datepicker CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.vi.min.js">
    </script>


    <style>
        a {
            font-size: 18px;
            text-decoration: none;
            color: #f7fdfc;
        }

        a:hover {
            text-decoration: underline;
        }

        .link-item {
            margin: 15px 0;
        }

        .fa-google-drive {
            color: #0F9D58;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container-header">
            <div class="header-logo">
                <img class="header-logo-image" src="images/logo1.png" alt="image" />
                <div style="flex-direction: column;">
                    <span class="header-text" style="font-weight: 300;">TRƯỜNG ĐẠI HỌC HẠ LONG</span>
                    <span class="header-text" style="font-weight: 500;">TRƯỜNG TH, THCS & THPT THSP</span>
                </div>
            </div>

            @if (Auth::user())
                <form action="{{ route('dang-xuat') }}" method="POST" style="display: none;" id="logout-form">
                    @csrf
                </form>
                <a href="/dang-xuat" class="a-no-style"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button class="header-button" type="button">
                        Đăng xuất

                    </button>
                </a>
            @else
                <a href="/dang-nhap" class="a-no-style">
                    <button class="header-button" type="button">
                        Đăng nhập
                    </button>
                </a>
            @endif
            <ul class="header-links">
                <li><a class="header-links-link" href="/">Trang chủ</a></li>
                <li><a class="header-links-link" href="/moc-thoi-gian-ts">Mốc thời gian</a></li>
                <li><a class="header-links-link" href="/bieu-mau-ts">Thông báo</a></li>
            </ul>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="container-footer">
            <div class="footer-container">
                <!---<img class="footer-logo" src="images/logo1.png" alt="image" />--->
                <div class="row text-white" style="margin-left: 13vw">
                    <span class="mt-2 ">
                        <img class="header-logo-image footer-icon" src="images/svg/location.svg" alt="image" />
                        Số 258 đường Bạch Đằng, phường Nam Khê, thành phố Uông Bí, tỉnh
                        Quảng Ninh
                    </span>
                    <br />
                    <span class="mt-2">
                        <img class="header-logo-image footer-icon" src="images/svg/phone.svg" alt="image" />
                        0912.651.877- 08322.356.368 - 0904.083.936
                    </span>
                </div>
            </div>
            <hr />
            <div class="row mt-4">
                <p class="text-white text-center" style="font-weight: 300; font-size: 15px;">@Bản quyền 2025 của Trường TH, THCS, THPT Thực hành Sư phạm, Trường Đại học Hạ Long
                </p>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/temp-input-table.js') }}"></script>
    <script src="{{ asset('js/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showAlert(message) {
            const alertBox = document.getElementById('customAlert');
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.textContent = message;
            alertBox.style.display = 'block';
            alertBox.style.opacity = '1';
        }

        function closeAlert() {
            const alertBox = document.getElementById('customAlert');
            alertBox.style.opacity = '0';
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 600);
        }
    </script>
</body>

</html>
