@extends('layout.bg-particles')
@section('page_title', 'Teacher Login')
@section('content')
    @parent
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 mx-auto mt-md-5 p-2 card bg-transparent">
                <div class="card-body">
                    @include('layout.form-login',['action'=>'teacher.login.submit'])
                    @if ($errors->any())
                        <div class="status-error">
                            @foreach ($errors->all() as $e)
                                <p class="text-danger">* {{ $e }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
