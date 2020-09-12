@extends('layout.master')
@section('page_title', 'List Teacher')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin">
        @include('layout.list-user',['users'=>$teachers,'search'=>'Teacher'])
    </div>
</div>
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
    {!! Html::script('/js/filtertables.js') !!}
@endpush
