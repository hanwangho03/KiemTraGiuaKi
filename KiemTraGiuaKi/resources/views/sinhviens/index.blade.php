@extends('layouts.app')
@include('layouts.header')
@section('title', 'Quản Lý Sinh Viên')

@section('content')
<div class="container">
    <h2>Danh Sách Sinh Viên</h2>
    <a href="{{ route('sinhviens.create') }}" class="btn btn-primary mb-3">Thêm Sinh Viên</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Ngành Học</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sinhviens as $sv)
            <tr>
                <td>{{ $sv->MaSV }}</td>
                <td>{{ $sv->HoTen }}</td>
                <td>{{ $sv->GioiTinh }}</td>
                <td>{{ $sv->NgaySinh }}</td>
                <td>{{ $sv->nganhHoc->TenNganh }}</td>
                <td>
                    <a href="{{ route('sinhviens.show', $sv->MaSV) }}" class="btn btn-info">Xem</a>
                    <a href="{{ route('sinhviens.edit', $sv->MaSV) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('sinhviens.destroy', $sv->MaSV) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa sinh viên này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $sinhviens->links() }}
</div>
@endsection