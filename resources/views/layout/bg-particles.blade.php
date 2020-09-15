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
    @switch(request()->getHost())
        @case('teacher.localhost')
        {!! Html::script('/assets/js/teacher-particles.js') !!}
        @break
        @case('student.localhost')
        {!! Html::script('/assets/js/student-particles.js') !!}
        @break
        @default
        {!! Html::script('/assets/js/admin-particles.js') !!}
    @endswitch

@endpush
