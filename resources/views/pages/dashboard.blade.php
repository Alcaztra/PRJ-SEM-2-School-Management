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
                            <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Students</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $counts['students'] }}</h3>
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
                            <i class="mdi mdi-account-box-multiple text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Teachers</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $counts['teachers'] }}</h3>
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
                            <i class="mdi mdi-account-group text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Classes</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $counts['classes'] }}</h3>
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
                            <i class="mdi mdi-library-books text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Course</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $counts['courses'] }}</h3>
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
                            <i class="mdi mdi-book-open-variant text-primary icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Subjects</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $counts['subjects'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
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
    {!! Html::script('/js/initCalendar.js') !!}
    {{-- <script>
        let stu = new XMLHttpRequest();
        let tea = new XMLHttpRequest();
        let url1 = document.location.origin + "/student/get-students";
        let url2 = document.location.origin + "/teacher/get-teachers";
        let students
        let teachers;
        stu.onreadystatechange = function() {
            if (this.status == 200 && this.readyState == 4) {
                students = JSON.parse(stu.response);
                console.log(students.length);
                $('#students_count').html(students.length)
            }
        }
        tea.onreadystatechange = function() {
            if (this.status == 200 && this.readyState == 4) {
                teachers = JSON.parse(tea.response);
                console.log(teachers.length);
                $('#teacher_count').html(teachers.length)
            }
        }
        stu.open("get", url1, true);
        stu.send();
        tea.open("get", url2, true);
        tea.send();

    </script> --}}
@endpush
