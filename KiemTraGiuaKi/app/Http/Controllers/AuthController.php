<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SinhVien;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'MaSV' => 'required|exists:sinhvien,MaSV'
        ], [
            'MaSV.required' => 'Vui lòng nhập Mã Sinh Viên.',
            'MaSV.exists' => 'Mã Sinh Viên không tồn tại.'
        ]);

        // Tìm sinh viên theo MaSV
        $sinhvien = SinhVien::where('MaSV', $request->MaSV)->first();

        if ($sinhvien) {
            Auth::login($sinhvien); // Đăng nhập không cần mật khẩu
            return redirect()->route('sinhviens.index');
        }

        return back()->withErrors(['login' => 'Đăng nhập thất bại!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
