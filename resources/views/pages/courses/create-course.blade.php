@extends('layout.master')
@section('page_title', 'Create new Course')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('course.create.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="course_id">Course ID</label>
                            {!! Form::text('course_id', '', ['id' => 'course_id', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="name">Course Name</label>
                            {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">Semester</label>
                            <div class="input-group pb-2">
                                <select class="custom-select custom-select" id="">
                                    <option value="">- Select semester -</option>
                                    <option value="">Sem 1</option>
                                    <option value="">Sem 2</option>
                                </select>
                                <select class="custom-select custom-select" id="">
                                    <option value="">- Select subject -</option>
                                    <option value="">Subject 1</option>
                                    <option value="">Subject 2</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary">Add</button>
                                </div>
                            </div>
                            <div class="table">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Sem 1</th>
                                            <th scope="col">sem 2</th>
                                            <th scope="col">Sem 3</th>
                                            <th scope="col">Sem 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">1</td>
                                            <td class="">subject 1
                                                <span class="badge badge-danger btn float-right">&times;</span></td>
                                            <td class="table-danger">subject 2
                                                <span class="badge badge-danger btn float-right">&times;</span></td>
                                            <td>subject 3
                                                <span class="badge badge-danger btn float-right">&times;</span></td>
                                            <td>subject 4
                                                <span class="badge badge-danger btn float-right">&times;</span></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">2</td>
                                            <td></td>
                                            <td></td>
                                            <td class="table-danger">subject 2
                                                <span class="badge badge-danger btn float-right">&times;</span></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
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
