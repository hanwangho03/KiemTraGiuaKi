<?php

namespace App\Http\Controllers;

use App\Models\SinhVien;
use App\Models\NganhHoc;
use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    public function index()
    {
        $sinhviens = SinhVien::with('nganhHoc')->paginate(10);
        return view('sinhviens.index', compact('sinhviens'));
    }

    public function create()
    {
        $nganhhocs = NganhHoc::all();
        return view('sinhviens.create', compact('nganhhocs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'MaSV' => 'required|unique:sinhvien,MaSV',
        'HoTen' => 'required|string|max:50',
        'GioiTinh' => 'required|string|max:5',
        'NgaySinh' => 'required|date',
        'MaNganh' => 'required|exists:nganhhoc,MaNganh',
        'Hinh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Chỉ chấp nhận file ảnh
    ]);

    // Xử lý upload hình ảnh
    $imagePath = null;
    if ($request->hasFile('Hinh')) {
        $image = $request->file('Hinh');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Đổi tên file
        $image->move(public_path('images'), $imageName); // Lưu vào thư mục public/images
        $imagePath = 'images/' . $imageName; // Lưu đường dẫn vào DB
    }

    // Tạo sinh viên mới
    SinhVien::create([
        'MaSV' => $request->MaSV,
        'HoTen' => $request->HoTen,
        'GioiTinh' => $request->GioiTinh,
        'NgaySinh' => $request->NgaySinh,
        'MaNganh' => $request->MaNganh,
        'Hinh' => $imagePath // Lưu đường dẫn ảnh vào DB
    ]);

    return redirect()->route('sinhviens.index')->with('success', 'Thêm sinh viên thành công!');
}

    public function show($id)
    {
        $sinhvien = SinhVien::with('nganhHoc')->findOrFail($id);
        return view('sinhviens.show', compact('sinhvien'));
    }

    public function edit($id)
{
    $sinhvien = SinhVien::findOrFail($id);
    $nganhs = NganhHoc::all(); // Lấy danh sách ngành học

    return view('sinhviens.edit', compact('sinhvien', 'nganhs'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'HoTen' => 'required|string|max:50',
            'GioiTinh' => 'required|string|max:5',
            'NgaySinh' => 'required|date',
            'MaNganh' => 'required|exists:nganhhoc,MaNganh',
            'Hinh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $sinhvien = SinhVien::findOrFail($id);
    
        // Xử lý upload ảnh mới nếu có
        if ($request->hasFile('Hinh')) {
            // Xóa ảnh cũ (nếu có)
            if ($sinhvien->Hinh && file_exists(public_path($sinhvien->Hinh))) {
                unlink(public_path($sinhvien->Hinh));
            }
    
            // Lưu ảnh mới
            $image = $request->file('Hinh');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $sinhvien->Hinh = 'images/' . $imageName;
        }
    
        // Cập nhật thông tin sinh viên
        $sinhvien->update([
            'HoTen' => $request->HoTen,
            'GioiTinh' => $request->GioiTinh,
            'NgaySinh' => $request->NgaySinh,
            'MaNganh' => $request->MaNganh
        ]);
    
        return redirect()->route('sinhviens.index')->with('success', 'Cập nhật sinh viên thành công!');
    }

    public function destroy($id)
    {
        SinhVien::destroy($id);
        return redirect()->route('sinhviens.index')->with('success', 'Xóa sinh viên thành công!');
    }
}

