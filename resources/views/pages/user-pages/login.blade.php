@extends('layout.master-mini')
@section('title')
    Login
@stop
@section('content')

    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
        style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto" style="max-width: 400px">
                <div class="auto-form-wrapper">
                    <form action="submit" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="label">Username</label>
                            <div class="input-group">
                                <input type="text" name="user_name" class="form-control" placeholder="Username">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        @if ($errors->has('user_name'))
                                            <i class="mdi mdi-close text-danger"></i>
                                        @else
                                            <i class="mdi mdi-check text-success"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @if ($errors->any())
                                <small class="text-danger">{{ $errors->first('user_name') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="*********">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        @if ($errors->has('password'))
                                            <i class="mdi mdi-close text-danger"></i>
                                        @else
                                            <i class="mdi mdi-check text-success"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @if ($errors->any())
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        {{-- {{ $errors }} --}}
                        {{-- <div class="form-group d-flex justify-content-between">
                            <div class="form-check-flat mt-0">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                            </div>
                            <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                        </div> --}}
                        {{-- <div class="form-group">
                            <button class="btn btn-block g-login">
                                <img class="mr-3" src="{{ url('assets/images/file-icons/icon-google.svg') }}" alt="">Log in
                                with Google</button>
                        </div>
                        <div class="text-block text-center my-3">
                            <span class="text-small font-weight-semibold">Not a member ?</span>
                            <a href="{{ url('/user-pages/register') }}" class="text-black text-small">Create new account</a>
                        </div> --}}
                    </form>
                </div>
                {{-- <ul class="auth-footer">
                    <li>
                        <a href="#">Conditions</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                    <li>
                        <a href="#">Terms</a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>

@endsection
@push('custom-scripts')

@endpush
