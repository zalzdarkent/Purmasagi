<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item  {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Main</span>
    </li>
    <li class="menu-item {{ Route::is('course.*') || Route::is('content.*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Account Settings">Courses</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Route::is('course.create') ? 'active' : '' }}">
                <a href="{{ route('course.create') }}" class="menu-link">
                    <div data-i18n="Account">Course</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('content.index') ? 'active' : '' }}">
                <a href="{{ route('content.index') }}" class="menu-link">
                    <div data-i18n="Notifications">Content</div>
                </a>
            </li>
        </ul>
    </li>
    @if (Auth::user()->role == 'admin')
        <li class="menu-item {{ Route::is('kegiatan.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                <div data-i18n="Account Settings">Kegiatan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('kegiatan.create') ? 'active' : '' }}">
                    <a href="{{ route('kegiatan.create') }}" class="menu-link">
                        <div data-i18n="Account">Tambah Kegiatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('kegiatan.index') ? 'active' : '' }}">
                    <a href="{{ route('kegiatan.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Kegiatan</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ Route::is('logo.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-palette"></i>
                <div data-i18n="Account Settings">Logo</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('logo.create') ? 'active' : '' }}">
                    <a href="{{ route('logo.create') }}" class="menu-link">
                        <div data-i18n="Account">Tambah Logo</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('logo.index') ? 'active' : '' }}">
                    <a href="{{ route('logo.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Logo</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Guru</span>
        </li>
        <li class="menu-item {{ Route::is('guru.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                <div data-i18n="Account Settings">Manajemen User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('guru.create') ? 'active' : '' }}">
                    <a href="{{ route('guru.create') }}" class="menu-link">
                        <div data-i18n="Account">Tambah Guru</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('guru.index') ? 'active' : '' }}">
                    <a href="{{ route('guru.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Guru</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Siswa</span>
        </li>
        <li class="menu-item {{ Route::is('siswa.*') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                <div data-i18n="Account Settings">Manajemen User</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('siswa.index') ? 'active' : '' }}">
                    <a href="{{ route('siswa.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Daftar Siswa</div>
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
