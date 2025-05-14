@extends('layout/main-layout')

@section('title', 'Trang chủ')

@section('content')
    <style>
        .carousel-inner img {
            height: 800px;
            object-fit: cover;
        }

        .space {
            margin-top: 160px;
        }

        @media (max-width: 768px) {
            .carousel-inner img {
                max-height: 200px;
                object-fit: cover;
            }

            .space {
                margin-top: 10px;
            }
        }
    </style>

    <div class="main-general ">
        <div class="main-general-info space">
            <span class="main-general-info-text">
                Trường TH, THCS & THPT THSP
            </span>
            <br class="d-block d-md-none">
            <span class="main-general-info-text">
                Trường Đại học Hạ Long
            </span>
            <br class="d-block d-md-none ">
            <span class="main-general-info-text">
                Thông báo tuyển sinh THPT năm 2025
            </span>
            <ul class="main-general-info-list fs-5 justify-text" style="font-weight: 400;" style="margin-left: 5vh">
                <li>Đối tượng tuyển sinh là học sinh trong độ tuổi vào lớp 10 (theo thông tư 32/2020/TT-BGDĐT ngày
                    15/9/2020 của Bộ GD&ĐT)</li>
                <li>Địa bàn tuyển sinh: trên địa bàn tỉnh Quảng Ninh</li>
                <li>Chỉ tiêu tuyển sinh: 04 lớp, 180 học sinh </li>
                <li>Thời gian đăng ký: từ ngày 05/5/2025 đến ngày 18/6/2025</li>
            </ul>
            <img class="main-general-info-image" src="images/people_generalx.png" alt="image" />

        </div>
        <form class="main-general-form main-form-margin" method="POST" action="{{ route('ho-so.submit-ho-so') }}"
            enctype="multipart/form-data">
            @csrf
            <span class="main-general-form-text">Nộp hồ sơ tuyển sinh</span>
            <input class="main-general-form-input" style="font-weight: 400" type="text" name="ho_ten" id="txtTen"
                placeholder="Họ tên" />
            <input class="main-general-form-input" style="font-weight: 400" type="text" name="so_cccd" id="txtCCCD"
                placeholder="Số Căn cước công dân" />
            <input class="main-general-form-input" style="font-weight: 400" type="text" name="so_dien_thoai"
                id="txtSdt" placeholder="Số điện thoại" />
            <input class="main-general-form-input" style="font-weight: 400" type="email" name="email" id="txtEmail"
                placeholder="Email" />

            <input class="main-general-form-input" name="province" id="txtProvince" hidden />
            <input class="main-general-form-input" name="district" id="txtDistrict" hidden />
            <input class="main-general-form-input" name="ward" id="txtWard" hidden />
            <div>
                <select id="province" class="main-general-form-input" style="width: 100%;font-weight: 400">
                    <option value="">Chọn Tỉnh/Thành phố</option>
                </select>
            </div>
            <div>
                <select id="district" class="main-general-form-input" style="width: 100%;font-weight: 400">
                    <option value="">Chọn Quận/Huyện</option>
                </select>
            </div>
            <div>
                <select id="ward" class="main-general-form-input" style="width: 100%;font-weight: 400">
                    <option value="">Chọn Phường/Xã</option>
                </select>
            </div>

            <div class="file-upload">
                <input type="file" name="file" class="file-upload-input" id="fileInput">
                <button type="button" class="header-button" style="width: 100%; background-color:rgb(247, 241, 186) ;">
                    Tải hồ sơ dạng file .pdf
                </button>
                <span class="file-name" id="fileName"></span>
            </div>
            <button class="main-general-form-button mb-5" type="submit">
                Nộp hồ sơ
            </button>
        </form>
    </div>
    <div class="main-qr">
        <div class="main-info-timer-gif">
            <img src="images/DK_QR.gif" alt="gif" />
        </div>
        <span class="main-info-timer-info">Quét mã để được tư vấn tuyển sinh</span>

        <img class="main-qr-image" src="images/QR2.jpg" alt="image" />

    </div>

    <center><img class="main-info-info-image w-100" src="images/MocTS.jpg" alt="jpg" /></center>

    <div class="main-info">
        <div class="main-info-timer">
            <div class="main-info-timer-gif">
                <img src="images/download.gif" alt="gif" />
            </div>
            <span class="main-info-timer-info">Nhiều cơ hội học tập và phát triển bản thân </span>
        </div>
        <div class="main-info-info justify-text">
            <img class="main-info-info-image" src="images/TTTuyensinh.png" alt="image" />
            <span class="main-info-info-span">Học tại trường TH, THCS, THPT Thực hành Sư phạm có gì khác biệt ?</span>
            <ul class="main-info-info-list gap-3">
                <li>Môi trường học đường hiện đại - an toàn - truyền cảm hứng</li>
                <li>Chương trình linh hoạt - học thuật vượt trội: Tăng cường tiếng Anh, miễn phí học ngoại ngữ 2 (Trung,
                    Nhật, Hàn), luyện thi chứng chỉ quốc tế (IELTS, HSK, SAT, MOS) ngay tại trường.</li>
                <li>Định hướng đại học - nghề nghiệp rõ ràng: Học sinh được tư vấn, ôn luyện các kỳ thi đánh giá năng lực,
                    tư duy và tuyển sinh đại học top đầu.</li>
                <li>Phát triển toàn diện - vững vàng tương lai: Tích hợp STEM, giáo dục kỹ năng sống, hoạt động ngoại khóa
                    đa dạng, hướng nghiệp chuyên sâu. </li>
                <li>Tiện ích đồng bộ - hỗ trợ tối đa: Xe buýt toàn tỉnh, ký túc xá hiện đại, học bán trú - nội trú linh
                    hoạt. </li>
                <li>Cam kết đầu ra - mở rộng cánh cửa du học: 100% học sinh có cơ hội xét tuyển đại học phù hợp; kết nối học
                    bổng, giao lưu và du học quốc tế</li>
            </ul>
        </div>
    </div>

    <div class="mt-4">
        <div class="main-qr">
            <span class="main-info-timer-info mt-3 mb-3">Các hoạt động của trường</span>
        </div>
        <div id="carouselExampleControls" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/1.jpg') }}" class="d-block w-100" alt="Banner 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/5.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/6.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/7.jpg') }}" class="d-block w-100" alt="Banner 2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <script>
        const apiProvinces = '/data/tinh_tp.json';
        const apiDistricts = '/data/quan_huyen.json';
        const apiWards = '/data/xa_phuong.json';

        let provinces = [];
        let districts = [];
        let wards = [];

        $(document).ready(function() {
            $.getJSON(apiProvinces, function(data) {
                provinces = data;
                provinces.forEach(function(province) {
                    $('#province').append(new Option(province.Name, province.Id));
                });
            });

            $('#province').change(function() {
                const provinceId = $(this).val();
                $('#district').empty().append(new Option('Chọn Quận/Huyện', ''));
                $('#ward').empty().append(new Option('Chọn Phường/Xã', ''));
                if (provinceId) {
                    $.getJSON(apiDistricts, function(data) {
                        districts = data.filter(d => d.ProvinceId == provinceId);
                        districts.forEach(function(district) {
                            $('#district').append(new Option(district.Name, district.Id));
                        });
                    });
                }
                let provinceText = $('#province option:selected').text();
                document.getElementById('txtProvince').value = provinceText;

            });

            $('#district').change(function() {
                const districtId = $(this).val();
                $('#ward').empty().append(new Option('Chọn Phường/Xã', ''));
                if (districtId) {
                    $.getJSON(apiWards, function(data) {
                        wards = data.filter(w => w.DistrictId == districtId);
                        wards.forEach(function(ward) {
                            $('#ward').append(new Option(ward.Name, ward.Id));
                        });
                    });
                }
                let districtText = $('#district option:selected').text();
                document.getElementById('txtDistrict').value = districtText;
            });

            $('#ward').change(function() {
                let wardText = $('#ward option:selected').text();
                document.getElementById('txtWard').value = wardText;
            });


        });
    </script>
    <script>
        function isValidCCCD(cccd) {
            if (!/^\d{12}$/.test(cccd)) {
                return false;
            }
            if (/^(\d)\1{11}$/.test(cccd)) {
                return false;
            }
            return true;
        }

        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function isValidVietnamesePhoneNumber(number) {
            const regex = /^(03|05|07|08|09|01[2|6|8|9])\d{8}$/;
            return regex.test(number);
        }
        document.querySelector('.main-general-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('txtTen').value.trim();
            const cccd = document.getElementById('txtCCCD').value;
            const phone = document.getElementById('txtSdt').value.trim();
            const email = document.getElementById('txtEmail').value.trim();
            const location = document.getElementById('ward').value;
            const hoSo = document.getElementById('fileInput');

            if (!name) {
                alert('Vui lòng nhập họ tên.');
                return;
            }

            if (!isValidCCCD(cccd)) {
                alert('Vui lòng nhập số căn cước công dân hợp lệ.');
                return;
            }

            if (!isValidVietnamesePhoneNumber || !/^\d{9,11}$/.test(phone)) {
                alert('Vui lòng nhập số điện thoại hợp lệ.');
                return;
            }

            if (!isValidEmail || !/^\S+@\S+\.\S+$/.test(email)) {
                alert('Vui lòng nhập email hợp lệ.');
                return;
            }

            if (!location) {
                alert('Vui lòng chọn nơi thường trú.');
                return;
            }
            if (hoSo.files.length === 0) {
                alert('Vui lòng chọn file hồ sơ.');
                return;
            }

            alert('Hồ sơ đã được nộp thành công!');
            this.submit();
        });
    </script>
    <script>
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('fileName');
        const fileUpload = document.querySelector('.file-upload');
        document.getElementById("fileInput").addEventListener("change", function() {
            let file = this.files[0]; // Get the selected file

            if (file) {
                const isPDF = file.type === "application/pdf" || file.name.toLowerCase().endsWith(".pdf");

                if (!isPDF) {
                    alert("Chỉ chấp nhận tệp PDF!");
                    this.value = ""; // Clear the file input
                    fileName.textContent = '';
                    fileUpload.classList.remove('file-selected');
                    return;
                }

                if (file.size > 20 * 1024 * 1024) { // 5MB limit
                    alert("File quá lớn! Vui lòng chọn tệp dưới 5MB.");
                    this.value = "";
                    fileName.textContent = '';
                    fileUpload.classList.remove('file-selected');
                } else {
                    fileName.textContent = file.name;
                    fileUpload.classList.add('file-selected');
                }
            }
        });
    </script>
@endsection
