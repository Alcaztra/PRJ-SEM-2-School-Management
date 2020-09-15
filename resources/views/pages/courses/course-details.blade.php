@extends('layout.master')
@section('page_title', 'Course Details')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    {{-- @dump($subjects,$course,$sub_sem) --}}
                    @include('layout.form-create-course',[
                    'action'=>'course.details.submit',
                    'param'=>['course_id'=>$course->course_id],
                    'subjects'=>$subjects,
                    'course'=>$course,
                    'sub_sem'=>$sub_sem
                    ])
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
    {!! Html::script('/js/createCourse.js') !!}
@endpush
