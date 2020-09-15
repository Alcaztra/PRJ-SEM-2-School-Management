@extends('layout.master')
@section('page_title', 'Dashboard')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-4 py-2">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" id="filterInput" placeholder="Class ID">
                            {{-- <div class="input-group-append">
                                <span class="btn btn-outline-dark" id="search">Search</span>
                            </div> --}}
                        </div>
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
    <div class="row">
        <div class="col-md-8 grid-margin">
            <div class="card">
                <div class="card-body">
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
    <div class="row">
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
    <script>
        $(document).ready(function() {
            let host = document.location.origin;
            $('#class_details').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var recipent = button.data('class-id');
                var modal = $(this);
                $.get(host + '/class-details/' + recipent, function(data) {
                    // console.log('here', button, recipent, data);
                    for (const key in data) {
                        if (data.hasOwnProperty(key)) {
                            const element = data[key];
                            $('#class_details td[name=' + key + ']').html(element);
                        }
                    }
                });
            });
        });

    </script>
@endpush
