@extends('layout.master')
@section('page_title', 'Create new Class')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('class.create.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="class_id">Class ID</label>
                            {!! Form::text('class_id', '', ['id' => 'class_id', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="room">Room</label>
                            {!! Form::text('room', '', ['id' => 'room', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Study Shift</label>
                            <div class="input-group">
                                <select name="DoW" id="" class="custom-select">
                                    <option value="">- Day of Week -</option>
                                    {{-- <option value="0">Mon - Fri</option> --}}
                                    <option value="1">Mon / Wed / Fri</option>
                                    <option value="2">Tue / Thu / Sat</option>
                                </select><select name="period" id="" class="custom-select">
                                    <option value="">- Period -</option>
                                    <option value="m">Morning</option>
                                    <option value="a">Afternoon</option>
                                    <option value="e">Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_day">Start Day</label>
                            {!! Form::date('start_day', '', ['id' => 'start_day', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="course_id">Course</label>
                            <select name="course_id" id="course_id" class="custom-select">
                                <option value="">- Select Course -</option>
                                @isset($courses)
                                    @foreach ($courses as $s)
                                        <option value="{{ $s->course_id }}">{{ $s->course_id . ' - ' . $s->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
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
@endpush
