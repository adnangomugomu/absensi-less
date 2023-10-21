<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
    <li class=" nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
            <i class="menu-livicon" data-icon="desktop"></i> <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class=" nav-item {{ Request::routeIs('admin.pertemuan') ? 'active' : '' }}">
        <a href="{{ route('admin.pertemuan') }}">
            <i class="menu-livicon" data-icon="calendar"></i> <span class="menu-title">Pertemuan</span>
        </a>
    </li>
    <li class=" nav-item {{ Request::routeIs('admin.rekap') ? 'active' : '' }}">
        <a href="{{ route('admin.rekap') }}">
            <i class="menu-livicon" data-icon="notebook"></i> <span class="menu-title">Rekap Data</span>
        </a>
    </li>
    <li class="navigation-header"><span>Setting</span></li>
    <li class=" nav-item {{ Request::routeIs('admin.role') ? 'active' : '' }}">
        <a href="{{ route('admin.role') }}">
            <i class="menu-livicon" data-icon="idea"></i> <span class="menu-title">Role</span>
        </a>
    </li>
    <li class=" nav-item {{ Request::routeIs('admin.registrasi') ? 'active' : '' }}">
        <a href="{{ route('admin.registrasi') }}">
            <i class="menu-livicon" data-icon="users"></i> <span class="menu-title">Registrasi</span>
        </a>
    </li>
</ul>
