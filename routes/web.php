<?php

use App\Http\Controllers\BaoCaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoSoController;
use App\Http\Controllers\TaiKhoanController;

Route::get('/', function () {
    return view('trang-chu');
});
Route::get('/dang-nhap', [TaiKhoanController::class, 'dangNhap'])->name('dang-nhap');
Route::post('/submit-dang-nhap', [TaiKhoanController::class, 'submitDangNhap'])->name('submit-dang-nhap');
Route::post('/dang-xuat', [TaiKhoanController::class, 'dangXuat'])->name('dang-xuat');

Route::name('home.')->group(function () {
    Route::get('/ke-hoach-ts', [HomeController::class, 'keHoachTS'])->name('ke-hoach-ts');
    Route::get('/bieu-mau-ts', [HomeController::class, 'bieuMauTS'])->name('bieu-mau-ts');
    Route::get('/thong-bao-1', [HomeController::class, 'thongBao1'])->name('thong-bao-1');
    Route::get('/thong-bao-2', [HomeController::class, 'thongBao2'])->name('thong-bao-2');

    Route::get('/download-ke-hoach-ts', [HomeController::class, 'downloadKeHoachTS'])->name('download-ke-hoach-ts');
    Route::get('/download-bieu-mau-ts', [HomeController::class, 'downloadBieuMauTS'])->name('download-bieu-mau-ts');
    Route::get('/download-thong-bao-1', [HomeController::class, 'downloadThongBao1'])->name('download-thong-bao-1');
    Route::get('/download-thong-bao-2', [HomeController::class, 'downloadThongBao2'])->name('download-thong-bao-2');

    Route::get('/moc-thoi-gian-ts', [HomeController::class, 'mocThoiGianTS'])->name('moc-thoi-gian-ts');
});

Route::name('ho-so.')->group(function () {
    Route::get('/danh-sach-ho-so', [HoSoController::class, 'danhSachHoSo'])->name('danh-sach-ho-so');
    Route::post('/submit-ho-so', [HoSoController::class, 'submitHoSo'])->name('submit-ho-so');
    Route::post('/xoa-ho-so', [HoSoController::class, 'xoaHoSo'])->name('xoa-ho-so');
    Route::get('/tai-ho-so/{ma_ho_so}', [HoSoController::class, 'downloadFile'])->name('tai-ho-so');
    Route::get('/getHoSo', [HoSoController::class, 'getHoSo'])->name('getHoSo');
});
Route::name('tai-khoan.')->group(function () {
    Route::get('/danh-sach-tai-khoan', [TaiKhoanController::class, 'danhSachTaiKhoan'])->name('danh-sach-tai-khoan');
    Route::post('/them-tai-khoan', [TaiKhoanController::class, 'themTaiKhoan'])->name('them-tai-khoan');
    Route::post('/update-tai-khoan', [TaiKhoanController::class, 'updateTaiKhoan'])->name('update-tai-khoan');
    Route::post('/xoa-tai-khoan', [TaiKhoanController::class, 'xoaTaiKhoan'])->name('xoa-tai-khoan');
});
Route::name('bao-cao.')->group(function () {
    Route::get('/danh-sach-bao-cao', [BaoCaoController::class, 'baoCao'])->name('danh-sach-bao-cao');
    Route::get('/bao-cao-ho-so', [BaoCaoController::class, 'baoCaoHoSo'])->name('bao-cao-ho-so');
});
