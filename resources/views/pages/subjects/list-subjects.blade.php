@extends('layout.master')
@section('page_title', 'List Subjects')
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
                            <input class="form-control" type="text" name="search" id="filterInput" placeholder="Subject ID">
                            {{-- <div class="input-group-append">
                                <span class="btn btn-outline-dark" id="search">Search</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Subject ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Number of Sessions</th>
                                    <th scope="col">Duration (hour)</th>
                                </tr>
                            </thead>
                            <tbody id="filterTable">
                                @isset($subjects)
                                    @foreach ($subjects as $s)
                                        <tr>
                                            <td scope="row">{{ $s->subject_id }}</td>
                                            <td>{{ $s->name }}</td>
                                            <td>{{ $s->NoS }}</td>
                                            <td>{{ $s->duration }}</td>
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
