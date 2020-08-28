@extends('layout.bg-particles')
@section('title', 'Login')
@section('content')
    @parent
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-4 mx-auto mt-md-5 p-2 card bg-transparent">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Account</label>
                            {!! Form::text('user_id', $user_id ?? '', ['id' => 'user_id', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Login', ['class' => 'btn btn-outline-primary']) !!}
                    </form>
                    @if ($errors->any())
                        <div class="error">
                            @foreach ($errors->all() as $e)
                                <span class="error">{{ print_r($e) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
