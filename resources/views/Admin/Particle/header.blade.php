<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#"
                    data-toggle="search"
                    class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        @if (Auth::check() && Auth::user()->jabatan->nama_jabatan != 'kaprodi' && Auth::user()->jabatan->nama_jabatan != 'admin')  
            <li class="dropdown dropdown-list-toggle"><a href="#"
                    data-toggle="dropdown"
                    class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifikasi
                        <div class="float-right">
                            {{-- <a href="#">Lihat Semua Pesan</a> --}}
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        
                    </div>
                    <div class="dropdown-footer text-center">
                        {{-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> --}}
                    </div>
                </div>
            </li>
        @endif
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <figure class="avatar mr-2 avatar-sm">
                    <img src="{{ asset('storage/user/' . Auth::user()->foto) }}" alt="...">
                </figure>
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->nama }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0)" id="tombol-profile"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
