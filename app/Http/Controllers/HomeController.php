<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function trangChu()
    {
        return view('trang-chu');
    }
    public function dangNhap()
    {
        return view('dang-nhap');
    }
    public function keHoachTS()
    {
        return view('bieu-mau.ke-hoach-ts');
    }
    public function bieuMauTS()
    {
        return view('bieu-mau.bieu-mau-ts');
    }
    public function thongBao1()
    {
        return view('bieu-mau.thong-bao-1');
    }
    public function thongBao2()
    {
        return view('bieu-mau.thong-bao-2');
    }

    public function mocThoiGianTS()
    {
        return view('moc-thoi-gian-ts');
    }

    public function downloadKeHoachTS()
    {
        $tenFile = "422- Kehoach TS L.10 THPTTHSP 2025.doc";
        $filePath = storage_path('app/public/files/'. $tenFile);
        return response()->download($filePath, $tenFile);
    }
    public function downloadBieuMauTS()
    {
        $tenFile = "1. THPT_PHIẾU ĐĂNG KÍ DỰ TUYỂN.27.4.2025.docx";
        $filePath = storage_path('app/public/files/'. $tenFile);
        return response()->download($filePath, $tenFile);
    }
    public function downloadThongBao1()
    {
        $tenFile = "106_TB Tuyen sinh vao lop 10 THSP.pdf";
        $filePath = storage_path('app/public/files/'. $tenFile);
        return response()->download($filePath, $tenFile);
    }
}
