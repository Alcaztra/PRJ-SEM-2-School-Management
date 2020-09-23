@extends('layout.master')
@section('page_title', 'Dashboard')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row" id="list-classes">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6 pb-2 d-inline-flex">
                        <h4 class="w-100">List Classes</h4>
                        <input class="form-control" type="text" name="search" id="filterInput" placeholder="Class ID">
                        {{-- <div class="input-group-append">
                            <span class="btn btn-outline-dark" id="search">Search</span>
                        </div> --}}
                    </div>
                    <div class="table-responsive table-sticky" style="overflow-y: auto; max-height: 60vh">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Class ID</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Total Duration (hours)</th>
                                    <th scope="col">Start Day</th>
                                    <th scope="col">End Day (expected)</th>
                                </tr>
                            </thead>
                            <tbody id="filterTable">
                                @isset($classes)
                                    @foreach ($classes as $c)
                                        <tr>
                                            <td scope="row">
                                                <a role="button" class="cursor-pointer text-decoration-none text-info"
                                                    data-toggle='modal' data-target='#class_details'
                                                    data-class-id="{{ $c->class_id }}">{{ $c->class_id }}</a>
                                            </td>
                                            <td>{{ $c->room }}</td>
                                            <td>{{ $c->course_id }}</td>
                                            <td>{{ $c->calcSize() }}</td>
                                            {{-- <td>{{ $c->calcDuration() }}</td>
                                            --}}
                                            <td class="text-center">{{ $c->calcDuration() }}</td>
                                            <td>{{ $c->start_day }}</td>
                                            <td>{{ $c->getEndDay() }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @include('layout.modal.class-details',['id'=>'class_details', 'label'=>'teacher_view_class_details'])
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="attendance">
        <div class="col grid-margin">
            <div class="card">
                <div class="card-body" getClass>
                    <div class="d-inline-block">
                        <h4>Attendance</h4>
                        <div class="spinner-border d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select_class">Select class</label>
                        <select class="custom-select custom-select-sm" name="select_class" id="select_class" required>
                            <option value="" selected>- Class Id -</option>
                            @isset($classes)
                                @foreach ($classes as $c)
                                    <option value="{{ $c->class_id }}">{{ $c->class_id }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select_subject">Select Subject</label>
                        <select class="custom-select custom-select-sm" name="select_subject" id="select_subject" required>
                            <option value="" selected>- Sebject Id -</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select_date">Select Date</label>
                        <input type="date" class="form-control" name="select_date" id="select_date" placeholder="" required>
                    </div>
                    <div class="form-group d-flex justify-content-around">
                        <button class="btn btn-outline-info" onclick="getClass()">Get Class</button>
                        <button class="btn btn-outline-warning" onclick="postAttendance()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-sticky">
                        <form action="return false" method="post" id="status">
                            <table class="table table-striped" id="list_students">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th class="text-center">Present</th>
                                        <th class="text-center">Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- student here --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">#</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="schedule">
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div id="calendar">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Class</label>
                        <div class="input-group">
                            <select class="custom-select" name="" id="get_class" required>
                                <option value="">- Select one -</option>
                                @isset($classes)
                                    @foreach ($classes as $c)
                                        <option value="{{ $c->class_id }}">{{ $c->class_id }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark" onclick="getEvents()">Get</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="profile">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @include('layout.profile-table',['guard_name'=>'teacher','result'=>Session::get('result')])
                    <div class="row mt-3 d-flex justify-content-between">
                        <div class="col-md-5 pb-1 d-flex justify-content-between">
                            <h4>Update Profile</h4>
                            <a class="btn btn-warning" href="{{ route('teacher.profile.update.profile') }}"
                                role="button">Update Profile</a>
                        </div>
                        <div class="col-md-5 pb-1 d-flex justify-content-between">
                            <h4>Change Password</h4>
                            <a class="btn btn-warning" href="{{ route('teacher.profile.update.password') }}"
                                role="button">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="change-avatar">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @include('layout.form-change-avatar',['action'=>'teacher.profile.update.avatar','avatar'=>Auth::guard('teacher')->user()->avatar])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
    {!! Html::style('/assets/plugins/fullcalendar/main.css') !!}
    {!! Html::script('/assets/plugins/fullcalendar/main.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
    {!! Html::script('/js/getInputFileName.js') !!}
    {!! Html::script('/js/initCalendar.js') !!}
    {!! Html::script('/js/teacher-dashboard.js') !!}
@endpush
