@extends('layout.master')
@section('page_title', 'Course Details')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-8 col-xl-6">
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
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Order Subjects</h4>
                        <button type="button" class="btn btn-outline-secondary" onclick="postOrder()">Save</button>
                    </div>
                    <div id="order_list">
                        <div class="spinner-border d-none" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <div id="list_here">
                            @include('layout.subjects-order-list',['sub_sem'=>$sub_sem])
                        </div>
                    </div>
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
    {!! Html::script('/js/orderSubjects.js') !!}
@endpush
