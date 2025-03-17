@extends('layouts.app')
@include('layouts.header')
@section('title', 'Chi Tiết Sinh Viên')

@section('content')
<div class="container">
    <h2 class="my-4 text-center">Chi Tiết Sinh Viên</h2>
    <a href="{{ route('sinhviens.index') }}" class="btn btn-secondary mb-3">🔙 Quay Lại</a>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($sinhvien->Hinh)
                        <img src="{{ asset('images/' . basename($sinhvien->Hinh)) }}" 
                             class="img-thumbnail rounded" 
                             alt="Hình Sinh Viên" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <p class="text-muted">❌ Không có ảnh</p>
                    @endif
                </div>

                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light">Mã Sinh Viên</th>
                            <td>{{ $sinhvien->MaSV }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Họ Tên</th>
                            <td>{{ $sinhvien->HoTen }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Giới Tính</th>
                            <td>{{ $sinhvien->GioiTinh }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Ngày Sinh</th>
                            <td>{{ $sinhvien->NgaySinh }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Ngành Học</th>
                            <td>{{ $sinhvien->nganhHoc->TenNganh }}</td>
                        </tr>
                    </table>

                    <a href="{{ route('sinhviens.edit', $sinhvien->MaSV) }}" class="btn btn-warning">✏ Sửa</a>
                    <form action="{{ route('sinhviens.destroy', $sinhvien->MaSV) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">🗑 Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
