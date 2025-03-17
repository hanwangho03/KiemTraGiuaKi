<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">🎓 Quản Lý Sinh Viên</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('sinhviens.*') ? 'active' : '' }}" href="{{ route('sinhviens.index') }}">
                        👨‍🎓 Sinh Viên
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('hocphans.index') ? 'active' : '' }}" href="{{ route('hocphans.index') }}">
                        📚 Học Phần
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dangky.index') ? 'active' : '' }}" href="{{ route('dangky.index') }}">
                        📝 Đăng Ký Môn
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            🔐 Đăng Nhập
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            👋 {{ Auth::user()->HoTen }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('sinhviens.show', Auth::user()->MaSV) }}">
                                    📄 Thông Tin Cá Nhân
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">🚪 Đăng Xuất</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
