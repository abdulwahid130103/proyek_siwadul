<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            {{-- <figure class="avatar mr-2 avatar-sm"> --}}
                <img src="{{ asset('frontend/image/siwadul_logo.png') }}" height="40px" width="40px" alt="...">
            {{-- </figure> --}}
            <a href="index.html">Siwadul</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SW</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu == 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('admin/dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                </ul>
            </li>
            @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'admin')
                <li class="menu-header">Data</li>
                <li class="nav-item dropdown {{ $type_menu == 'data' ? 'active' : '' }}">
                    <a href="#"
                        class="nav-link has-dropdown"><i class="fas fa-server"></i><span>Data Master</span></a>
                    <ul class="dropdown-menu">
                        <li class='{{ Request::is('admin/user') ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ route('user.index') }}">Data User</a>
                        </li>
                        <li class='{{ Request::is('admin/jabatan') ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ route('jabatan.index') }}">Data Jabatan</a>
                        </li>
                        <li class='{{ Request::is('admin/jenisPengaduan') ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ route('jenisPengaduan.index') }}">Data Jenis Pengaduan</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi'
             || Auth::user()->jabatan->nama_jabatan == 'admin'
             || Auth::user()->jabatan->nama_jabatan == 'adminprodi'
             || Auth::user()->jabatan->nama_jabatan == 'laboran')
            <li class="menu-header">Transaksional</li>
            <li class="nav-item dropdown {{ $type_menu == 'transaksi' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-briefcase"></i><span>Pengaduan</span></a>
                <ul class="dropdown-menu">
                    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi') 
                        <li class='{{ Request::is('admin/pengaduan') ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ url('admin/pengaduan') }}">List Pengaduan</a>
                        </li>
                    @endif
                    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan != 'kaprodi' && Auth::user()->jabatan->nama_jabatan != 'admin') 
                        <li class='{{ Request::is('admin/history') ? 'active' : '' }}'>
                            <a class="nav-link"
                            href="{{ url('admin/history') }}">Buat Pengaduan</a>
                        </li>
                    @endif
                    <li class='{{ Request::is('admin/pengurus') ? 'active' : '' }}'>
                        <a class="nav-link"
                        href="{{ url('admin/pengurus') }}">Pengurusanku</a>
                    </li>
                    @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'admin') 
                        <li class='{{ Request::is('admin/manage') ? 'active' : '' }}'>
                            <a class="nav-link"
                                href="{{ url('admin/manage') }}">Manage Status</a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif
            @if (Auth::check() && Auth::user()->jabatan->nama_jabatan == 'kaprodi')
            <li class="menu-header">Laporan</li>
            <li class="nav-item dropdown {{ $type_menu == 'laporan' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-flag"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('admin/laporanPengaduan') ? 'active' : '' }}'>
                        <a class="nav-link"
                        href="{{ url('admin/laporanPengaduan') }}">Laporan Pengaduan</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </aside>
</div>
