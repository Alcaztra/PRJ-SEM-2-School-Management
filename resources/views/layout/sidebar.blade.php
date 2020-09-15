<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ null !== Auth::guard('admin')->user()->avatar ? asset('storage/uploads/avatar/' . Auth::guard('admin')->user()->avatar) : asset('assets\images\faces-clipart\pic-1.png') }}"
                            alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::guard('admin')->user()->name }}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                                data-toggle="dropdown" aria-expanded="false">
                                <small
                                    class="designation text-secondary">{{ Auth::guard('admin')->user()->user_id }}</small>
                                <span class="status-indicator online"></span>
                            </a>
                            {{-- <div class="dropdown-menu"
                                aria-labelledby="UsersettingsDropdown">
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
                            </div> --}}
                        </div>
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
                <i class="menu-icon mdi mdi-folder-account"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['course/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#course"
                aria-expanded="{{ is_active_route(['course/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi-tag-text-outline"></i>
                <span class="menu-title">Course Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['course/*']) }}" id="course">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['course/list']) }}">
                        <a class="nav-link" href="{{ url('course/list') }}">
                            <i class="menu-icon mdi mdi-view-list"></i>
                            List Courses</a>
                    </li>
                    <li class="nav-item {{ active_class(['course/create']) }}">
                        <a class="nav-link" href="{{ url('course/create') }}">
                            <i class="menu-icon mdi mdi-plus-circle-outline"></i>
                            Create New Course</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['subject/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#subject"
                aria-expanded="{{ is_active_route(['subject/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi-tag-text-outline"></i>
                <span class="menu-title">Subject Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['subject/*']) }}" id="subject">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['subject/list']) }}">
                        <a class="nav-link" href="{{ url('subject/list') }}">
                            <i class="menu-icon mdi mdi-book-multiple"></i>
                            List Subjects</a>
                    </li>
                    <li class="nav-item {{ active_class(['subject/create']) }}">
                        <a class="nav-link" href="{{ url('subject/create') }}">
                            <i class="menu-icon mdi mdi-book-plus"></i>
                            Create New Subject</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['class/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#class" aria-expanded="{{ is_active_route(['class/*']) }}"
                aria-controls="">
                <i class="menu-icon mdi mdi-tag-text-outline"></i>
                <span class="menu-title">Class Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['class/*']) }}" id="class">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['class/list']) }}">
                        <a class="nav-link" href="{{ url('class/list') }}">
                            <i class="menu-icon mdi mdi-view-list"></i>
                            List Classes</a>
                    </li>
                    <li class="nav-item {{ active_class(['class/create']) }}">
                        <a class="nav-link" href="{{ url('class/create') }}">
                            <i class="menu-icon mdi mdi-plus-circle-outline"></i>
                            Create New Class</a>
                    </li>
                    <li class="nav-item {{ active_class(['class/add']) }}">
                        <a class="nav-link" href="{{ url('class/add') }}">
                            <i class="menu-icon mdi mdi-plus-circle-outline"></i>
                            Add Teacher | Student</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['teacher/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#teacher"
                aria-expanded="{{ is_active_route(['teacher/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi-tag-faces"></i>
                <span class="menu-title">Teacher Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['teacher/*']) }}" id="teacher">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['teacher/list']) }}">
                        <a class="nav-link" href="{{ url('teacher/list') }}">
                            <i class="menu-icon mdi mdi-view-list"></i>
                            List Teachers</a>
                    </li>
                    <li class="nav-item {{ active_class(['teacher/create']) }}">
                        <a class="nav-link" href="{{ url('teacher/create') }}">
                            <i class="menu-icon mdi mdi-account-plus"></i>
                            Create New Teacher</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['student/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#student"
                aria-expanded="{{ is_active_route(['student/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi-tag-faces"></i>
                <span class="menu-title">Student Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['student/*']) }}" id="student">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['student/list']) }}">
                        <a class="nav-link" href="{{ url('student/list') }}">
                            <i class="menu-icon mdi mdi-view-list"></i>
                            List Students</a>
                    </li>
                    <li class="nav-item {{ active_class(['student/create']) }}">
                        <a class="nav-link" href="{{ url('student/create') }}">
                            <i class="menu-icon mdi mdi-account-plus"></i>
                            Create New Student</a>
                    </li>
                </ul>
            </div>
        </li>
        {{--<li class="nav-item {{ active_class(['schedule/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#schedule"
                aria-expanded="{{ is_active_route(['subject/*']) }}" aria-controls="">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Schedule</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['schedule/*']) }}" id="schedule">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['schedule/calendar']) }}">
                        <a class="nav-link" href="{{ url('schedule/calendar') }}">
                            <i class="menu-icon mdi mdi-calendar-multiple"></i>
                            Calendar</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['demo/basic-ui/*']) }}">
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
