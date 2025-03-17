<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DangKy;
use App\Models\HocPhan;
use Illuminate\Support\Facades\Auth;
use App\Models\ChiTietDangKy;

class DangKyController extends Controller
{
    // Hiển thị danh sách học phần đã đăng ký
    public function index()
    {
        $MaSV = Auth::user()->MaSV;

        $hocphans = HocPhan::whereHas('chiTietDangKy.dangKy', function ($query) use ($MaSV) {
            $query->where('MaSV', $MaSV);
        })->paginate(10);

        return view('dangky.index', compact('hocphans'));
    }

    // Đăng ký học phần
    public function store($MaHP)
    {
        $MaSV = Auth::user()->MaSV;

        // Kiểm tra xem sinh viên đã đăng ký môn học này chưa
        $exists = ChiTietDangKy::join('dangky', 'chitietdangky.MaDK', '=', 'dangky.MaDK')
            ->where('dangky.MaSV', $MaSV)
            ->where('chitietdangky.MaHP', $MaHP)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký học phần này rồi.');
        }

        // Kiểm tra xem sinh viên đã có bản ghi trong bảng dangky chưa
        $dangKy = DangKy::firstOrCreate(
            ['MaSV' => $MaSV],
            ['NgayDK' => now()]
        );

        // Thêm chi tiết đăng ký môn học
        ChiTietDangKy::create([
            'MaDK' => $dangKy->MaDK,
            'MaHP' => $MaHP,
        ]);

        return redirect()->route('dangky.index')->with('success', 'Đăng ký học phần thành công!');
    }

    // Hủy đăng ký học phần
    public function destroy($MaHP)
    {
        $MaSV = Auth::user()->MaSV;

        $dangKy = DangKy::where('MaSV', $MaSV)->first();
        if ($dangKy) {
            ChiTietDangKy::where('MaDK', $dangKy->MaDK)->where('MaHP', $MaHP)->delete();
        }

        return redirect()->route('dangky.index')->with('success', 'Đã hủy đăng ký học phần.');
    }
    public function destroyAll()
{
    $MaSV = Auth::user()->MaSV;

    // Tìm bản ghi đăng ký của sinh viên
    $dangKy = DangKy::where('MaSV', $MaSV)->first();

    if ($dangKy) {
        // Xóa tất cả các chi tiết đăng ký liên quan
        ChiTietDangKy::where('MaDK', $dangKy->MaDK)->delete();

        // Sau khi xóa hết chi tiết đăng ký, xóa luôn bản ghi đăng ký
        $dangKy->delete();
    }

    return redirect()->back()->with('success', 'Đã hủy đăng ký tất cả học phần!');
}
}
