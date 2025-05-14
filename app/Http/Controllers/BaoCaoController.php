<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BaoCaoHoSo;

class BaoCaoController extends Controller
{
    public function baoCao()
    {
        return view('bao-cao');
    }

    public function baoCaoHoSo(Request $request)
    {
        $tu_ngay_name = $this->formatDateToDMY($request->tu_ngay);
        $den_ngay_name = $this->formatDateToDMY($request->den_ngay);
        $tu_ngay = $this->formatDateToYMD($request->tu_ngay);
        $den_ngay = $this->formatDateToYMD($request->den_ngay);
        
        $fileName = 'Báo cáo hồ sơ từ ' . $tu_ngay_name . ' đến ' . $den_ngay_name . '.xlsx';
        return Excel::download(new BaoCaoHoSo($tu_ngay, $den_ngay), $fileName);
    }
    private function formatDateToYMD($dateString)
    {
        return Carbon::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
    }
    private function formatDateToDMY($dateString)
    {
        return Carbon::createFromFormat('d/m/Y', $dateString)->format('d-m-Y');
    }
    private function formatDateNow()
    {
        return Carbon::now()->format('d-m-Y');
    }
}
