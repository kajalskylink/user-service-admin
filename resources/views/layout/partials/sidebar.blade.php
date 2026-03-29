<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('dashboard', '/') ? 'active subdrop' : '' }}"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('dashboard') }}"
                                        class="{{ Request::is('dashboard', '/') ? 'active' : '' }}">Admin Dashboard</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
