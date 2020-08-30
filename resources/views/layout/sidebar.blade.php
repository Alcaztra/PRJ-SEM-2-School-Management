<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('storage/uploads/avatar/' . Auth::guard('admin')->user()->avatar) }}"
                            alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::guard('admin')->user()->name }}</p>
                        {{-- <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                                href="#" data-toggle="dropdown" aria-expanded="false">
                                <small class="designation text-muted">Mô tả tài khoản</small>
                                <span class="status-indicator online"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                                <a class="dropdown-item p-0">
                                    <div class="d-flex border-bottom">
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                        </div>
                                        <div
                                            class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                            <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                        </div>
                                        <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                            <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item mt-2"> Manage Accounts </a>
                                <a class="dropdown-item"> Change Password </a>
                                <a class="dropdown-item"> Sign Out </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item {{ active_class(['dashboard', 'dashboard/*']) }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['profile', 'profile/*']) }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="menu-icon mdi mdi-clipboard-account"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['teacher/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#teacher"
                aria-expanded="{{ is_active_route(['teacher/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi mdi-bulletin-board"></i>
                <span class="menu-title">Teacher Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['teacher/*']) }}" id="teacher">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['teacher/list']) }}">
                        <a class="nav-link" href="{{ url('teacher/list') }}">List Teacher</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['student/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#student"
                aria-expanded="{{ is_active_route(['student/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi mdi-bulletin-board"></i>
                <span class="menu-title">Student Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['student/*']) }}" id="student">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['student/list']) }}">
                        <a class="nav-link" href="{{ url('student/list') }}">List Student</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item {{ active_class(['demo/basic-ui/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui"
                aria-expanded="{{ is_active_route(['demo/basic-ui/*']) }}" aria-controls="basic-ui">
                <i class="menu-icon mdi mdi-dna"></i>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['demo/basic-ui/*']) }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['demo/basic-ui/buttons']) }}">
                        <a class="nav-link" href="{{ url('demo/basic-ui/buttons') }}">Buttons</a>
                    </li>
                </ul>
            </div>
        </li> --}}
    </ul>
</nav>
