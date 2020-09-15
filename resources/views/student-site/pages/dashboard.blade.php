@extends('layout.master')
@section('page_title', 'Dashboard')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-book text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Current Subject</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-book text-primary icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Next Subject</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-bulletin-board text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Attendance Status</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-calendar text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Next Exam</strong>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Class Information</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-uppercase w-25">Class ID</th>
                                <td>{{ $class->class_id }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Room</th>
                                <td>{{ $class->room }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Course</th>
                                <td>{{ $class->course_id . ' | ' . $course->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Teacher</th>
                                <td>{{ $class->getTeacher()->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Study Shift</th>
                                <td>{{ $class->getStudyShift() }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Period</th>
                                <td>{{ $class->getPeriod()->start_time . ' => ' . $class->getPeriod()->end_time }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Total Duration</th>
                                <td>{{ $class->calcDuration() }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">Start Day</th>
                                <td>{{ $class->start_day }}</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase">End Day (expected)</th>
                                <td>{{ $class->getEndDay() }}</td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <h4>Course Information</h4>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Semester 1</th>
                                    <th scope="col">Semester 2</th>
                                    <th scope="col">Semester 3</th>
                                    <th scope="col">Semester 4</th>
                                </tr>
                            </thead>
                            <tbody id="filterTable">
                                <tr>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <td style="border-left: 1px solid lightgray;">
                                            <div class="row" style="min-width: 300px">
                                                @foreach ($course->getSubjects() as $s)
                                                    @if ($s->semester == $i)
                                                        <div class="col-sm-6 col-md-4 col-lg-3 p-0">
                                                            <button class="btn btn-block btn-outline-info"
                                                                data-toggle="tooltip"
                                                                title="{{ $s->name }}">{{ $s->subject_id }}</button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    @endfor
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Schedule</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col grid-margin">
            <div class="card">
                <div class="card-body"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @include('layout.profile-table',['guard_name'=>'student','result'=>Session::get('result')])
                    <hr>
                    <div class="row mt-3 d-flex justify-content-between">
                        <div class="col-md-5 pb-1 d-flex justify-content-between">
                            <h4>Update Profile</h4>
                            <a class="btn btn-warning" href="{{ route('student.profile.update.profile') }}"
                                role="button">Update Profile</a>
                        </div>
                        <div class="col-md-5 pb-1 d-flex justify-content-between">
                            <h4>Change Password</h4>
                            <a class="btn btn-warning" href="{{ route('student.profile.update.password') }}"
                                role="button">Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @include('layout.form-change-avatar',['action'=>'student.profile.update.avatar','avatar'=>Auth::guard('student')->user()->avatar])
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
@endpush
