@extends('layout.master')
@section('page_title', 'List Courses')
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
                            <input class="form-control" type="text" name="search" id="filterInput" placeholder="Course ID">
                            {{-- <div class="input-group-append">
                                <span class="btn btn-outline-dark" id="search">Search</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Semester 1</th>
                                    <th scope="col">Semester 2</th>
                                    <th scope="col">Semester 3</th>
                                    <th scope="col">Semester 4</th>
                                </tr>
                            </thead>
                            <tbody id="filterTable">
                                @isset($courses)
                                    @foreach ($courses as $c)
                                        <tr>
                                            <td scope="row">
                                                <a class="text-decoration-none"
                                                    href="{{ route('course.details', ['course_id' => $c->course_id]) }}">{{ $c->course_id }}</a>
                                            </td>
                                            <td>{{ $c->name }}</td>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <td style="border-left: 1px solid lightgray;">
                                                    <div class="row" style="min-width: 300px">
                                                        @foreach ($subjects as $s)
                                                            @if ($s->course_id == $c->course_id && $s->semester == $i)
                                                                <div class="col-sm-6 col-md-4 col-lg-3 p-0">
                                                                    <button class="btn btn-block btn-outline-info"
                                                                        data-toggle="tooltip"
                                                                        title="{{ $s->name }}">{{ $s->subject_id }}</button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </td>
                                            @endfor
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
