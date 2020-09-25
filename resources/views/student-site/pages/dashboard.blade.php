@extends('layout.master')
@section('page_title', 'Dashboard')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row" id="states">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body" data-toggle='modal' data-target='#enroll_subjects' role="button">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-bookmark-check text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <strong class="mb-0 text-right">Enrolled Subject</strong>
                            <div class="fluid-container text-right">
                                <h3 class="font-weight-medium mb-0">
                                    @isset($course)
                                        {{ $course->getSubjects()->count() - count($enroll_subject) . ' / ' . $course->getSubjects()->count() }}
                                    @endisset
                                </h3>
                                <i>More details</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @isset($enrolled)
                @include('layout.modal.enrolled-subjects',['id'=>'enroll_subjects',
                'label'=>'list_enrolled_subjects','enrolled'=>$enrolled, 'attendance'=>$attendance])
            @endisset
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-book text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            @isset($current_subject)
                                <strong class="mb-0 text-right">Current Subject: {{ $current_subject->subject_id }}</strong>
                                <div class="fluid-container">
                                    <strong class="font-weight-medium mb-0">
                                        <ul class="list-unstyled">
                                            <li>{{ $current_subject->name }}</li>
                                            <li>Sessions: {{ $current_subject->sessions }}</li>
                                            <li>Duration: {{ $current_subject->duration }}</li>
                                        </ul>
                                    </strong>
                                </div>
                            @else
                                <strong class="mb-0 text-right">Current Subject: N/A</strong>
                            @endisset
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
                            @isset($next_subject)
                                <strong class="mb-0 text-right">Next Subject: {{ $next_subject->subject_id }}</strong>
                                <div class="fluid-container">
                                    <strong class="font-weight-medium mb-0">
                                        <ul class="list-unstyled">
                                            <li>{{ $next_subject->name }}</li>
                                            <li>Sessions: {{ $next_subject->sessions }}</li>
                                            <li>Duration: {{ $next_subject->duration }}</li>
                                        </ul>
                                    </strong>
                                </div>
                            @else
                                <strong class="mb-0 text-right">Next Subject: N/A</strong>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-bulletin-board text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            @isset($attendance)
                            <strong class="mb-0 text-right">Attendance status:</strong>
                            <div class="fluid-container">
                                <strong class="font-weight-medium mb-0">
                                    <ul class="list-unstyled">
                                        @foreach ($attendance as $a)
                                            <li>{{ $a['subject_id'] }}: {{ $a['present'] }} / {{ $a['sessions'] }}
                                                ( {{ ($a['present'] / $a['sessions']) * 100 }}% )</li>
                                        @endforeach
                                    </ul>
                                </strong>
                            </div>
                            @else
                            <strong class="mb-0 text-right">Attendance status: N/A</strong>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                <h3 class="font-weight-medium text-right mb-0">{{ $next_exam ?? '' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="class-info">
        <div class="col grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Class Information</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @isset($class)
                                <tr>
                                    <th class="text-uppercase w-25">Class ID</th>
                                    <td id="class_id">{{ $class->class_id }}</td>
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
                                    <td>{{ $class->getTeacher()->name ?? 'N/A' }}</td>
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
                            @else
                                <tr>
                                    <td>Student does not have a class.</td>
                                </tr>
                            @endisset
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
                                @isset($course)
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
                                @endisset
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
                    <h4>Enrollment Subject</h4>
                    <div class="input-group w-50" id="enroll_box">
                        <select class="custom-select custom-select-sm" style="height: inherit" name="" id="">
                            <option value="">- Subject -</option>
                            @isset($enroll_subject)
                                @foreach ($enroll_subject as $es)
                                    <option value="{{ $es->subject_id }}">{{ $es->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                        <input type="text" class="form-control" name="enroll_key" id=""
                            placeholder="[Class id] _ [Subject id]">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success"
                                onclick="enrollSubject('{{ $class->class_id ?? '' }}')">Submit{{--
                            </button> --}}
                            {{-- <button type="button" class="btn btn-outline-success">
                                --}}
                                <span name='enrollSubject' class="d-none spinner-border spinner-border-sm"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="schedule">
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Schedule</h4>
                    <div id="calendar">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col grid-margin">
            <div class="card">
                <div class="card-body"></div>
            </div>
        </div> --}}
    </div>
    <div class="row" id="profile">
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
    <div class="row" id="change-avatar">
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
    {!! HTML::script('/js/enrollSubject.js') !!}
    <script>
        if (null !== $('#class_id')) {
            getEvents($('#class_id').html());
        }

    </script>
@endpush
