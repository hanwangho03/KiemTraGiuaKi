@extends('layouts.app')
@include('layouts.header')
@section('content')
<div class="container">
    <h2>📚 Học Phần Đã Đăng Ký</h2>
    <a href="{{ route('hocphans.index') }}" class="btn btn-primary mb-3">🔙 Chọn Học Phần</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Thêm tổng số học phần và tổng số tín chỉ -->
    <div class="alert alert-info">
        <strong>📊 Tổng số học phần: {{ $hocphans->count() }} </strong> |
        <strong>🎓 Tổng số tín chỉ: {{ $hocphans->sum('SoTinChi') }}</strong>
    </div>

    <!-- Nút Xóa Tất Cả -->
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
</div>
@endsection
