@extends('layout.master')
@section('page_title', 'Add Teacher | Student')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
        {!! Html::style('/css/autocomplete/style.css') !!}
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('class.addUser.submit') }}" method="post" id="add_user_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="class_id">Class ID</label>
                            <select name="class_id" id="class_id" class="custom-select">
                                <option value="">- Select Class -</option>
                                @isset($classes)
                                    @foreach ($classes as $c)
                                        <option value="{{ $c->class_id }}">{{ $c->class_id }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="spinner-border d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Teacher</label>
                            <select class="custom-select" name="teacher_id" id="teacher_id">
                                <option value="">- Select Teacher -</option>
                                @isset($teachers)
                                    @foreach ($teachers as $t)
                                        <option value="{{ $t->user_id }}">{{ $t->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inp_stu">Student List</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="inp_stu" id="inp_stu"
                                    placeholder="Enter Student ID | Name" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary">
                                        <span name='loadStudents' class="spinner-border spinner-border-sm"></span>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary " onclick="add()">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="list-group" id="list_stu">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
    {!! Html::script('/js/autocomplete.js') !!}
    {!! Html::script('/js/addUser.js') !!}
@endpush
