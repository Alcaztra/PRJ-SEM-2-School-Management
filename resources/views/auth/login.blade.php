@extends('layout.bg-particles')
@section('page_title', 'Admin Login')
@section('content')
    @parent
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 mx-auto mt-md-5 p-2 card bg-transparent">
                <div class="card-body">
                    @include('layout.form-login',['action'=>'admin.login.submit'])
                    @include('layout.show-form-errors')
                </div>
            </div>
        </div>
    </div>
@endsection
