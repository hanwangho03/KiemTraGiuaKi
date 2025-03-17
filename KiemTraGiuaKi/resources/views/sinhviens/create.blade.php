@extends('layouts.app')
@include('layouts.header')
<div class="container">
    <h2>Thêm Sinh Viên</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sinhviens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Mã Sinh Viên</label>
            <input type="text" name="MaSV" class="form-control">
        </div>

        <div class="mb-3">
            <label>Họ Tên</label>
            <input type="text" name="HoTen" class="form-control">
        </div>

        <div class="mb-3">
            <label>Giới Tính</label>
            <select name="GioiTinh" class="form-control">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ngày Sinh</label>
            <input type="date" name="NgaySinh" class="form-control">
        </div>

        <div class="mb-3">
            <label>Ngành Học</label>
            <select name="MaNganh" class="form-control">
                @foreach ($nganhhocs as $nganh)
                    <option value="{{ $nganh->MaNganh }}">{{ $nganh->TenNganh }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Hình Ảnh</label>
            <input type="file" name="Hinh" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
