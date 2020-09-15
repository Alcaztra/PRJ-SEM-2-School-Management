<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ null !== ($avatar = Auth::guard('teacher')->user()->avatar) ? asset('storage/uploads/avatar/' . $avatar) : asset('assets\images\faces-clipart\pic-1.png') }}"
                            alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::guard('teacher')->user()->name }}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                                data-toggle="dropdown" aria-expanded="false">
                                <small
                                    class="designation text-secondary">{{ Auth::guard('teacher')->user()->user_id }}</small>
                                <span class="status-indicator online"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item {{ active_class(['dashboard', 'dashboard/*']) }}">
            <a class="nav-link" href="{{ route('teacher.dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{-- <li class="nav-item {{ active_class(['profile', 'profile/*']) }}">
            <a class="nav-link" href="{{ route('teacher.profile') }}">
                <i class="menu-icon mdi mdi-folder-account"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li> --}}
    </ul>
</nav>
