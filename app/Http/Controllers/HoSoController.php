<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\HoSo;
use Carbon\Carbon;

class HoSoController extends Controller
{
    public function danhSachHoSo()
    {
        $data = HoSo::orderBy('ma_ho_so', 'desc')->get();
        return view('danh-sach-ho-so', data: compact(var_name: 'data'));
    }
    public function getHoSo(Request $request)
    {
        if ($request->ajax()) {
            $data = HoSo::orderBy('ma_ho_so', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn() // Adds auto-incrementing index
                ->editColumn('ma_ho_so', function ($yeuCau) {
                    return $yeuCau->ma_yeu_cau;
                })
                ->editColumn('created_at', function ($yeuCau) {
                    return Carbon::parse($yeuCau->created_at)->format('d-m-Y');
                })
                ->addColumn('thao_tac', function ($hoSo) {
                    $url = route('ho-so.tai-ho-so', ['ma_ho_so' => $hoSo->ma_ho_so]);
                    return '
                        <a href="' . $url . '">
                            <button class="btn btn-success">Tải hồ sơ</button>
                        </a>
                        <button class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#xoaModal"
                            data-ho-ten="' . e($hoSo->ho_ten) . '"
                            data-ma-ho-so="' . e($hoSo->ma_ho_so) . '"
                            data-so-cccd="' . e($hoSo->so_cccd) . '"
                            data-email="' . e($hoSo->email) . '"
                            data-sdt="' . e($hoSo->so_dien_thoai) . '">
                            Xóa
                        </button>';
                })
                ->rawColumns(['thao_tac'])
                ->make(true);
        }
    }
    public function submitHoSo(Request $request)
    {
        $province = $request->province;
        $district = $request->district;
        $ward = $request->ward;

        $noi_thuong_tru = $ward . ', ' . $district . ', ' . $province;

        $hoSo = HoSo::create([
            'ma_ho_so' => $request->ma_ho_so,
            'ho_ten' => $request->ho_ten,
            'so_cccd' => $request->so_cccd,
            'so_dien_thoai' => $request->so_dien_thoai,
            'noi_thuong_tru' => $noi_thuong_tru,
            'email' => $request->email,
            'file_name' => $request->file_name,
            'file_path' => $request->file_path,
        ]);
        if ($request->file('file')) {
            $this->luuFile($request, $hoSo);
        }
        session()->flash('alert-success', 'Thêm hồ sơ mới thành công');
        return redirect()->back();
    }
    public function xoaHoSo(Request $request)
    {
        HoSo::find($request->ma_ho_so)->delete();
        session()->flash('alert-success', 'Xóa hồ sơ thành công');
        return redirect()->back();
    }
    public function luuFile($request, $hoSo)
    {
        if ($hoSo->file_name) {
            Storage::delete('public/hoSo/' . $hoSo->file->path);
            $hoSo->file->delete();
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        while (Storage::exists('public/hoSo/' . $fileName)) {
            $fileInfo = pathinfo(path: $fileName);
            $fileName = $fileInfo['filename'] . '_' . time() . '.' . $fileInfo['extension'];
        }

        $filePath = $file->storeAs('ho_so', $fileName, 'public');

        $hoSo->file_name = $fileName;
        $hoSo->file_path = $filePath;
        $hoSo->save();
    }
    public function downloadFile($ma_ho_so)
    {
        $hoSo = HoSo::findOrFail($ma_ho_so);
        if (!$hoSo->file_name) {
            session()->flash('alert-danger', 'Không tìm thấy file trong hệ thống');
            return redirect()->back();
        }

        $filePath = storage_path('app/public/' . $hoSo->file_path);
        return response()->download($filePath, $hoSo->file_name);
    }
}
