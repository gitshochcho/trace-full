<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"><a href="/admin/settings" class="brand-link">
            <!--begin::Brand Image--> {{-- Logo Image --}}
@if($setting?->getFirstMediaUrl('logo_image'))
    <img src="{{ $setting->getFirstMediaUrl('logo_image') }}"
         alt="{{ $setting->logo_text ?? 'Logo' }}"
         class="brand-image opacity-10 shadow"
         style="height: 33px; width: auto; object-fit: contain;">
@else
    <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}"
         alt="Logo"
         class="brand-image opacity-75 shadow">
@endif

{{-- Logo Text + Tagline --}}
<span class="brand-text fw-light">
    {{ $setting?->logo_text ?? '' }}
    @if($setting?->logo_tagline)
        <small class="d-block opacity-50" style="font-size:10px; line-height:1;">
            {{ $setting->logo_tagline }}
        </small>
    @endif
</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-border"></i>
                        <p>Dashboard</p>
                    </a>
                </li> -->

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
                    <a href="{{ route('admin.teams.index') }}" class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Team Manager</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.insight-types.index') }}" class="nav-link {{ request()->routeIs('admin.insight-types.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>Insight Type</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.insights.index') }}" class="nav-link {{ request()->routeIs('admin.insights.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journals"></i>
                        <p>Insights Manager</p>
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

                <li class="nav-item">
                    <a href="{{ route('admin.cv-submissions.index') }}" class="nav-link {{ request()->routeIs('admin.cv-submissions.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-person"></i>
                        <p>CV Submissions</p>
                    </a>
                </li>

                <li class="nav-item">
    <a href="#" class="nav-link {{ request()->is('admin/partners*') ? 'active' : '' }}">
        <i class="nav-icon bi bi-people"></i>
        <p>
            Partners
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.partners.index') }}" class="nav-link {{ request()->routeIs('admin.partners.index') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>All Partners</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.partners.create') }}" class="nav-link {{ request()->routeIs('admin.partners.create') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add Partner</p>
            </a>
        </li>
    </ul>
</li>

                <!-- <li class="nav-item {{ request()->is('admin/role/permission/*') ? 'menu-open' : '' }}"> <a href="#" class="nav-link {{ request()->is('admin/role/permission/*') ? 'active' : '' }}">  <span class="nav-icon mdi mdi-home"></span>
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
                </li> -->
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
