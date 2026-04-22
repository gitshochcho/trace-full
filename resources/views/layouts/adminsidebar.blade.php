<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="../../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-border"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.slider.edit') }}" class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Home Slider</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.content.index') }}" class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>Content Manager</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-collection"></i>
                        <p>Services Manager</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-briefcase"></i>
                        <p>Projects Manager</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-envelope"></i>
                        <p>Contact Messages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.contact-info.index') }}" class="nav-link {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-telephone"></i>
                        <p>Contact Information</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.job-postings.index') }}" class="nav-link {{ request()->routeIs('admin.job-postings.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-briefcase"></i>
                        <p>Job Postings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.job-applications.index') }}" class="nav-link {{ request()->routeIs('admin.job-applications.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Job Applications</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/role/permission/*') ? 'menu-open' : '' }}"> <a href="#" class="nav-link {{ request()->is('admin/role/permission/*') ? 'active' : '' }}">  <span class="nav-icon mdi mdi-home"></span>
                        <p>
                           Role & Permission
                            <i class="nav-arrow bi bi-chevron-right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('admin.roleIndex') }}" class="nav-link {{ request()->is('admin/role/permission/role/*') ? 'active' : '' }}"> <i
                                    class="mdi mdi-account-group"></i>
                                <p>Role List</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.permissionIndex') }}" class="nav-link {{ request()->is('admin/role/permission/permission/*') ? 'active' : '' }}"> <i
                                    class="mdi mdi-axis-lock"></i>
                                <p>Permission List</p>
                            </a> </li>
                    </ul>
                </li>
                <!-- <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Forms
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="../forms/general.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>General Elements</p>
                            </a> </li>
                    </ul>
                </li>



                <li class="nav-header">DOCUMENTATIONS</li>
                <li class="nav-item"> <a href="../docs/introduction.html" class="nav-link"> <i -->
                            <!-- class="nav-icon bi bi-download"></i>
                        <p>Installation</p>
                    </a> </li> -->

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside>
