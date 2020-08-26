@extends('layout.master-mini')

@push('plugin-styles')
    {!! Html::style('/css/particles/style.css') !!}
@endpush

@section('content')
    <div id="particles-js"></div>
    @yield('sub-content')
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/particles.js-master/particles.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/particles.js') !!}
@endpush
