@extends('layout.master')
@section('page_title', 'List Teacher')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>user_id</th>
                                    <th>name</th>
                                    <th>avatar</th>
                                    <th>gender</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>birthday</th>
                                    <th>address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @isset($teachers)
                                        @foreach ($teachers as $t)
                                            <td>{{ $t->user_id }}</td>
                                            <td>{{ $t->name }}</td>
                                            <td>
                                                <img class="img-thumbnail"
                                                    src="{{ $t->avatar !== null ? asset('storage/uploads/avatar/' . $t->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $t->gender }}</td>
                                            <td>{{ $t->email }}</td>
                                            <td>{{ $t->phone }}</td>
                                            <td>{{ $t->birthday }}</td>
                                            <td>{{ $t->address }}</td>
                                        @endforeach
                                    @endisset
                                </tr>
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
@endpush
