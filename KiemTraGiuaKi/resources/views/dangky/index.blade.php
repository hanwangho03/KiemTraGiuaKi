@extends('layouts.app')
@include('layouts.header')
@section('content')
<div class="container">
    <h2>📚 Học Phần Đã Đăng Ký</h2>
    <a href="{{ route('hocphans.index') }}" class="btn btn-primary mb-3">🔙 Chọn Học Phần</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
    <div class="card-body d-flex align-items-center">
        <!-- Hiển thị ảnh sinh viên -->
        <img src="{{ asset('images/' . basename($sinhvien->Hinh)) }}" alt="Ảnh Đại Diện" 
             class="rounded-circle me-3" width="80" height="80" >

        <div>
            <h5>👨‍🎓 Thông Tin Sinh Viên</h5>
            <p><strong>Mã SV:</strong> {{ $sinhvien->MaSV }}</p>
            <p><strong>Họ Tên:</strong> {{ $sinhvien->HoTen }}</p>

            <!-- Giải mã JSON trước khi hiển thị -->
            @php
                $nganhHoc = json_decode($sinhvien->NganhHoc, true);
            @endphp
            <p><strong>Ngành Học:</strong> {{ $nganhHoc['TenNganh'] ?? 'Không xác định' }}</p>
        </div>
    </div>
</div>

    <!-- Thêm tổng số học phần và tổng số tín chỉ -->
    <div class="alert alert-info">
        <strong>📊 Tổng số học phần: {{ $hocphans->count() }} </strong> |
        <strong>🎓 Tổng số tín chỉ: {{ $hocphans->sum('SoTinChi') }}</strong>
    </div>

    @if($hocphans->count() > 0)
    <form action="{{ route('dangky.destroyAll') }}" method="POST" class="mb-3">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn hủy tất cả học phần?')">
            🗑 Xóa Tất Cả
        </button>
    </form>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Giảng Viên</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hocphans as $hp)
            <tr>
                <td>{{ $hp->MaHP }}</td>
                <td>{{ $hp->TenHP }}</td>
                <td>{{ $hp->SoTinChi }}</td>
                <td>{{ $hp->GiangVien }}</td>
                <td>
                    <form action="{{ route('dangky.destroy', $hp->MaHP) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hủy đăng ký học phần này?')">Hủy Đăng Ký</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $hocphans->links() }}

    @if($hocphans->count() > 0)
        <form action="{{ route('dangky.luu') }}" method="POST">
            @csrf
            @foreach($hocphans as $hp)
                <input type="hidden" name="hocphan_ids[]" value="{{ $hp->MaHP }}">
            @endforeach
            <button type="submit" class="btn btn-success">💾 Lưu Đăng Ký</button>
        </form>
    @endif
</div>
@endsection
