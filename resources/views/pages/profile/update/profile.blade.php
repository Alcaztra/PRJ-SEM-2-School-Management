@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Profile</h4>
                    <form action="{{ route('profile.update.profile.submit') }}" method="post">
                        @csrf
                        {{-- USER_ID NAME GENDER EMAIL PHONE BIRTHDAY ADDRESS
                        --}}
                        <div class="form-group">
                            <label for="user_id">USER_ID</label>
                            {!! Form::text('user_id', $user_profile->user_id, ['id' => 'user_id', 'class' => 'form-control',
                            'readonly']) !!}
                        </div>
                        <div class="form-group">
                            <label for="name">NAME</label>
                            {!! Form::text('name', $user_profile->name, ['id' => 'name', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="gender">GENDER</label>
                            <div class="d-flex btn-group btn-group-toggle" data-toggle="buttons">
                                <div class="btn btn-outline-secondary">
                                    <label class="form-check-label">
                                        {!! Form::radio('gender', 'male', $user_profile->gender == 'male' ? 1 : 0, ['class'
                                        => 'form-check-input']) !!}Male
                                    </label>
                                </div>
                                <div class="btn btn-outline-secondary">
                                    <label class="form-check-label">
                                        {!! Form::radio('gender', 'female', $user_profile->gender == 'female' ? 1 : 0,
                                        ['class' => 'form-check-input']) !!}Female
                                    </label>
                                </div>
                                <div class="btn btn-outline-secondary">
                                    <label class="form-check-label">
                                        {!! Form::radio('gender', 'other', $user_profile->gender == 'other' ? 1 : 0,
                                        ['class' => 'form-check-input']) !!}Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            {!! Form::email('email', $user_profile->email, ['id' => 'email', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="phone">PHONE</label>
                            {!! Form::tel('phone', $user_profile->phone, ['id' => 'phone', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="birthday">BIRTHDAY</label>
                            {!! Form::date('birthday', $user_profile->birthday, ['id' => 'birthday', 'class' =>
                            'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="address">ADDRESS</label>
                            {!! Form::text('address', $user_profile->address, ['id' => 'address', 'class' =>
                            'form-control']) !!}
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    @if ($errors->any())
                        <div class="content-wrapper">
                            @foreach ($errors as $e)
                                <p class="text-danger">{{ $e }}</p>
                            @endforeach
                        </div>
                    @endif
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
