@extends('layout.master')
@section('page_title', 'Dashboard')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
        {!! Html::style('/assets/plugins/fullcalendar/main.css') !!}
        {!! Html::script('/assets/plugins/fullcalendar/main.js') !!}
        {!! Html::script('/js/initCalendar.js') !!}
    @endpush
@section('content')
    <div class="row">
        <div class="col-md-6">
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
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
