<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaiKhoanController extends Controller
{
    public function dangNhap()
    {
        return view('dang-nhap');
    }

    public function submitDangNhap(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->loai_tai_khoan == "Admin") {
                return redirect()->route('ho-so.danh-sach-ho-so');
            }
        }
        session()->flash('alert-danger', 'Tên đăng nhập hoặc tài khoản không đúng');
        return back();
    }

    public function dangXuat(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function danhSachTaiKhoan()
    {
        $data = User::orderBy('created_at', 'desc')->get();
        return view('danh-sach-tai-khoan',  compact(var_name: 'data'));
    }

    public function themTaiKhoan(Request $request)
    {
        if (!User::where('name', $request->name)->get()->isEmpty()) {
            session()->flash('alert-danger', 'Tên đăng nhập này đã tồn tại.');
            return redirect()->back();
        }
        User::create([
            'name' => $request->name,
            'ho_ten' => $request->ho_ten,
            'password' => Hash::make($request->mat_khau),
            'loai_tai_khoan' => "Admin",
        ]);
        session()->flash('alert-success', 'Thêm tài khoản mới thành công');
        return redirect()->back();
    }

    // public function thayDoiMatKhau(Request $request)
    // {
    //     return view('thay-doi-mat-khau');
    // }

    public function xoaTaiKhoan(Request $request)
    {
        if (User::find($request->id)) {
            User::find($request->id)->delete();
            session()->flash('alert-success', 'Xóa tài khoản thành công');
            return redirect()->back();
        }
        session()->flash('alert-danger', 'Có lỗi xảy ra');
        return redirect()->back();
    }
    public function updateTaiKhoan(Request $request)
    {
        if (User::find($request->id)) {
            User::find($request->id)->update(['password' => Hash::make($request->mat_khau)]);;
            session()->flash('alert-success', 'Cập nhật thành công');
            return redirect()->back();
        }
        session()->flash('alert-danger', 'Có lỗi xảy ra');
        return redirect()->back();
    }
    public function thayDoiMatKhauSubmit(Request $request)
    {
        if (User::find($request->id)) {
            $taiKhoan = User::find($request->id);
            if ($request->password != '') {
                $taiKhoan->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            session()->flash('alert-success', 'Cập nhật thành công');
            return redirect()->back();
        }
        session()->flash('alert-danger', 'Có lỗi xảy ra');
        return redirect()->back();
    }
}
