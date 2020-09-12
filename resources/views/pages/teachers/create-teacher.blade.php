@extends('layout.master')
@section('page_title', 'Create new Teacher')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Teacher Information</h4>
                    @include('layout.form-user',['action'=>"teacher.create.submit"])
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
