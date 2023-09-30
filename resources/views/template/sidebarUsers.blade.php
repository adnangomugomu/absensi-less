<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
    <li class=" nav-item {{ Request::routeIs('user.dashboard') ? 'active' : '' }}">
        <a href="{{ route('user.dashboard') }}">
            <i class="menu-livicon" data-icon="desktop"></i> <span class="menu-title">Dashboard</span>
        </a>
    </li>
</ul>