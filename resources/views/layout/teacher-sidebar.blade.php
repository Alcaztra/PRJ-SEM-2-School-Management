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
        <li class="nav-item {{ active_class(['dashboard#list-classes']) }}">
            <a class="nav-link" href="#list-classes">
                <i class="menu-icon mdi mdi-tag-text-outline"></i>
                <span class="menu-title">List Class</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['dashboard#attendance']) }}">
            <a class="nav-link" href="#attendance">
                <i class="menu-icon mdi mdi-account-check"></i>
                <span class="menu-title">Attendance</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['dashboard#schedule']) }}">
            <a class="nav-link" href="#schedule">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Schedule</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['dashboard#profile']) }}">
            <a class="nav-link" href="#profile">
                <i class="menu-icon mdi mdi-account-card-details"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['dashboard#change-avatar']) }}">
            <a class="nav-link" href="#change-avatar">
                <i class="menu-icon mdi mdi-account-box-outline"></i>
                <span class="menu-title">Avatar</span>
            </a>
        </li>
    </ul>
</nav>
