@extends('layout.master')
@section('page_title', 'List Classes')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-sm-4 py-2">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search" id="filterInput" placeholder="Class ID">
                            {{-- <div class="input-group-append">
                                <span class="btn btn-outline-dark" id="search">Search</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Class ID</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Teacher</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Total Duration (hour)</th>
                                    <th scope="col">Start Day</th>
                                    <th scope="col">End Day (expected)</th>
                                </tr>
                            </thead>
                            <tbody id="filterTable">
                                @isset($classes)
                                    @foreach ($classes as $c)
                                        <tr>
                                            <td scope="row">{{ $c->class_id }}</td>
                                            <td>{{ $c->room }}</td>
                                            <td>{{ $c->course_id }}</td>
                                            <td>{{ $c->getTeacher()->name }}</td>
                                            <td>{{ $c->calcSize() }}</td>
                                            {{-- <td>{{ $c->calcDuration() }}</td>
                                            --}}
                                            <td>{{ $c->total_duration }}</td>
                                            <td>{{ $c->start_day }}</td>
                                            <td>{{ $c->getEndDay() }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
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
    {!! Html::script('/js/filtertables.js') !!}
@endpush
