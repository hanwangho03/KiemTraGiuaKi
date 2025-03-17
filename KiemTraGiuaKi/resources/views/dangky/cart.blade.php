@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛒 Giỏ Hàng Học Phần</h2>
    <a href="{{ route('hocphans.index') }}" class="btn btn-primary mb-3">🔙 Tiếp Tục Chọn</a>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
            @foreach($cart as $hp)
            <tr>
                <td>{{ $hp->MaHP }}</td>
                <td>{{ $hp->TenHP }}</td>
                <td>{{ $hp->SoTinChi }}</td>
                <td>{{ $hp->GiangVien }}</td>
                <td>
                    <form action="{{ route('cart.remove', $hp->MaHP) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-warning">❌ Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">✅ Xác Nhận Đăng Ký</button>
    </form>
</div>
@endsection
