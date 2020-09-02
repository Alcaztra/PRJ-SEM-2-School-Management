@extends('layout.master')
@section('page_title', 'List Students')
@push('plugin-styles')
  <!-- {!! Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')

@endsection

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush