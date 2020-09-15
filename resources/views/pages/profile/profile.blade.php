@extends('layout.master')
@section('page_title', 'Account Profile')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
    @endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @include('layout.profile-table',['guard_name'=>'admin','result'=>Session::get('result')])
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Update Profile</h4>
                    <div class="">
                        <a class="btn btn-warning" href="{{ route('profile.update.profile') }}" role="button">Update
                            Profile</a>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Update Password</h4>
                    <div class="">
                        <a class="btn btn-warning" href="{{ route('profile.update.password') }}" role="button">Change
                            Password</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @include('layout.form-change-avatar',
                    ['action'=>'profile.update.avatar','avatar'=>Auth::guard('admin')->user()->avatar])
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
    {!! Html::script('/js/getInputFileName.js') !!}
@endpush
