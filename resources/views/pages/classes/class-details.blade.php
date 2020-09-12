@extends('layout.master')
@section('page_title', 'Class Details')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    @include('layout.form-create-class',
                    ['action'=>'class.details.submit','params'=>['class_id'=>$class->class_id],'class'=>$class,'courses'=>$courses])
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4>Teacher</h4>
                    @if ($class->getTeacher() !== null)
                        <p class="text-info">{{ $class->getTeacher()->user_id }} | {{ $class->getTeacher()->name }}</p>
                    @else
                        <p class="text-danger">* Please designate a teacher</p>
                    @endif
                    <h4>Total Duration</h4>
                    <p class="text-info">{{ $class->calcDuration() }} (hours)</p>
                    <h4>End Day (expected)</h4>
                    <p class="text-info">{{ $class->getEndDay() }}</p>
                    <table class="table table-striped">
                        <h4>List Students</h4>
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="2">Student ID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @isset($students)
                                @foreach ($students as $s)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $s->user_id }}</td>
                                        <td>{{ $s->name }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Total student: {{ $class->calcSize() }}</td>
                            </tr>
                        </tfoot>
                    </table>
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
