@extends('layout.master')
@section('page_title', 'Create new Subject')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('subject.create.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="subject_id">Subject ID</label>
                            {!! Form::text('subject_id', '', ['id' => 'subject_id', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="name">Subject tName</label>
                            {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="nos">Number of Sessions</label>
                            {!! Form::number('NoS', '', ['id' => 'nos', 'class' => 'form-control']) !!}
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
