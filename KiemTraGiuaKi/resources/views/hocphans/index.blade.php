@extends('layouts.app')
@include('layouts.header')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh Sách Học Phần</h2>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Mã Học Phần</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hocphans as $hp)
            <tr>
                <td>{{ $hp->MaHP }}</td>
                <td>{{ $hp->TenHP }}</td>
                <td>{{ $hp->SoTinChi }}</td>
                <td>
                    <form action="{{ route('dangky.store', $hp->MaHP) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Đăng Ký</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
