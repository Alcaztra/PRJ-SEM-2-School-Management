<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}">
            <img src="{{ url('assets/images/cat.svg') }}" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ url('assets/images/favicon.svg') }}" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        @if (request()->getHost() == 'localhost')
            <button class="navbar-toggler text-dark align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-close icon-menu"></span>
            </button>
        @endif
        {{-- <ul class="navbar-nav navbar-nav-left header-links">
            <li class="nav-item d-none d-xl-flex">
                <a href="#" class="nav-link">Sản phẩm <span class="badge badge-primary ml-1">New</span>
                </a>
            </li>
            <li class="nav-item active d-none d-lg-flex">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-elevation-rise"></i>Reports</a>
            </li>
            <li class="nav-item d-none d-md-flex">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-bookmark-plus-outline"></i>Thống kê</a>
            </li>
            <li class="nav-item dropdown d-none d-lg-flex">
                <a class="nav-link dropdown-toggle px-0" id="quickDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false"> Quick Links </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown pt-3" aria-labelledby="quickDropdown">
                    <a href="#" class="dropdown-item">Schedule <span class="badge badge-primary ml-1">New</span></a>
                    <a href="#" class="dropdown-item"><i class="mdi mdi-elevation-rise"></i>Reports</a>
                    <a href="#" class="dropdown-item"><i class="mdi mdi-bookmark-plus-outline"></i>Score</a>
                </div>
            </li>
        </ul> --}}
        <ul class="navbar-nav navbar-nav-right">
            {{-- <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="mdi mdi-file-outline"></i>
                    <span class="count">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="messageDropdown">
                    <a class="dropdown-item py-3">
                        <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ url('assets/images/faces/face10.jpg') }}" alt="image"
                                class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ url('assets/images/faces/face12.jpg') }}" alt="image"
                                class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ url('assets/images/faces/face3.jpg') }}" alt="image"
                                class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                </div>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count bg-success">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">4 new notifications </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-alert m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                            <p class="font-weight-light small-text mb-0"> Just now </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-settings m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                            <p class="font-weight-light small-text mb-0"> Private message </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-airballoon m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">Đăng ký</h6>
                            <p class="font-weight-light small-text mb-0"> 2 ngày </p>
                        </div>
                    </a>
                </div>
            </li> --}}
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false">
                    @switch(request()->getHost())
                        @case('localhost')
                        <span class="profile-text d-none d-md-inline-flex">{{ Auth::guard('admin')->user()->name }}</span>
                        <img class="img-xs rounded-circle"
                            src="{{ null !== ($avatar = Auth::guard('admin')->user()->avatar) ? asset('storage/uploads/avatar/' . $avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                            alt="">
                        @break
                        @case('student.localhost')
                        <span class="profile-text d-none d-md-inline-flex">{{ Auth::guard('student')->user()->name }}</span>
                        <img class="img-xs rounded-circle"
                            src="{{ null !== ($avatar = Auth::guard('student')->user()->avatar) ? asset('storage/uploads/avatar/' . $avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                            alt="">
                        @break
                        @case('teacher.localhost')
                        <span class="profile-text d-none d-md-inline-flex">{{ Auth::guard('teacher')->user()->name }}</span>
                        <img class="img-xs rounded-circle"
                            src="{{ null !== ($avatar = Auth::guard('teacher')->user()->avatar) ? asset('storage/uploads/avatar/' . $avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                            alt="">
                        @break
                        @default
                    @endswitch
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item p-0">
                        <div class="d-flex border-bottom w-100 justify-content-center">
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
                    @switch(request()->getHost())
                        @case('localhost')
                        <a class="dropdown-item mt-2" href="{{ route('dashboard') }}"> Dashboard </a>
                        <a class="dropdown-item mt-2" href="{{ route('profile') }}"> Manage Accounts </a>
                        <a class="dropdown-item" href="{{ route('profile.update.password') }}"> Change Password </a>
                        @break
                        @case('student.localhost')
                        <a class="dropdown-item mt-2" href="{{ route('student.dashboard') }}"> Dashboard </a>
                        <a class="dropdown-item mt-2" href="{{ route('student.profile.update.profile') }}"> Manage Accounts </a>
                        <a class="dropdown-item" href="{{ route('student.profile.update.password') }}"> Change Password </a>
                        @break
                        @case('teacher.localhost')
                        <a class="dropdown-item mt-2" href="{{ route('teacher.dashboard') }}"> Dashboard </a>
                        <a class="dropdown-item mt-2" href="{{ route('teacher.profile.update.profile') }}"> Manage Accounts </a>
                        <a class="dropdown-item" href="{{ route('teacher.profile.update.password') }}"> Change Password </a>
                        @break
                        @default
                    @endswitch
                    <a class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu icon-menu"></span>
        </button>

        @switch(request()->getHost())
            @case('localhost')
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @break
            @case('student.localhost')
            <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @break
            @case('teacher.localhost')
            <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @break
            @default
        @endswitch
    </div>
</nav>
