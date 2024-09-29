<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item  {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{route("admin.dashboard")}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
    </li>
    <li class="menu-item {{ Route::is('course.*') || Route::is('content.*') ? 'open active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book"></i>
            <div data-i18n="Account Settings">Courses</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Route::is('course.create') ? 'active' : '' }}">
                <a href="{{route("course.create")}}" class="menu-link">
                    <div data-i18n="Account">Course</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('content.create') ? 'active' : '' }}">
                <a href="{{route("content.create")}}" class="menu-link">
                    <div data-i18n="Notifications">Content</div>
                </a>
            </li>
        </ul>
    </li>
</ul>
