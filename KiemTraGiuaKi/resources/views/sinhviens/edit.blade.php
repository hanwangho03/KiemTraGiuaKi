@extends('layouts.app')
@include('layouts.header')
@section('title', 'Chỉnh Sửa Sinh Viên')

@section('content')
<div class="container">
    <h2>Chỉnh Sửa Sinh Viên</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sinhviens.update', $sinhvien->MaSV) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="MaSV" class="form-label">Mã SV:</label>
            <input type="text" name="MaSV" class="form-control" value="{{ $sinhvien->MaSV }}" readonly>
        </div>

        <div class="mb-3">
            <label for="HoTen" class="form-label">Họ Tên:</label>
            <input type="text" name="HoTen" class="form-control" value="{{ $sinhvien->HoTen }}" required>
        </div>

        <div class="mb-3">
            <label for="GioiTinh" class="form-label">Giới Tính:</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam" {{ $sinhvien->GioiTinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ $sinhvien->GioiTinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
            <input type="date" name="NgaySinh" class="form-control" value="{{ $sinhvien->NgaySinh }}" required>
        </div>

        <div class="mb-3">
            <label for="MaNganh" class="form-label">Ngành Học:</label>
            <select name="MaNganh" class="form-control">
                @foreach($nganhs as $nganh)
                    <option value="{{ $nganh->MaNganh }}" {{ $sinhvien->MaNganh == $nganh->MaNganh ? 'selected' : '' }}>
                        {{ $nganh->TenNganh }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="Hinh" class="form-label">Ảnh Đại Diện:</label>
            <input type="file" name="Hinh" class="form-control">
            @if($sinhvien->Hinh)
                <div class="mt-2">
                    <img src="{{ asset($sinhvien->Hinh) }}" width="150" class="img-thumbnail">
                    <p>Ảnh hiện tại</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
        <a href="{{ route('sinhviens.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@endsection