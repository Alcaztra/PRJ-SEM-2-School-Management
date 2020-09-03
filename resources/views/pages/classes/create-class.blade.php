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
                            <label for="date_start">Date Start</label>
                            {!! Form::date('date_start', '', ['id' => 'date_start', 'class' => 'form-control']) !!}
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
