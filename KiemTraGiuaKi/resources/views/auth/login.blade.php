@extends('layouts.app')
@include('layouts.header')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-4">Đăng Nhập</h3>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                <input type="text" name="MaSV" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
        </form>
    </div>
</div>
@endsection
