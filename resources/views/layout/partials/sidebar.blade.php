<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="{{ Request::is('dashboard', '/') ? 'active' : '' }}">
                            <a href="{{ url('dashboard') }}" class="{{ Request::is('dashboard', '/') ? 'active' : '' }}">
                                <i data-feather="grid"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="{{ Request::is('users*') ? 'active' : '' }}">
                                <i data-feather="users"></i><span>Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
