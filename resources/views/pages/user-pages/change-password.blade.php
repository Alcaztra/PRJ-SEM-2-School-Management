@extends('layout.master')

@push('plugin-styles')
    {!! Html::style('/assets/plugins/dragula/dragula.min.css') !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="{{ url("user-pages/manage-account/change-password-{$user->user_id}/submit") }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" aria-describedby=""
                        placeholder="old password">
                    @if ($errors->any())
                        <small id="" class="form-text text-muted">{{ $errors->first('old_password') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby=""
                        placeholder="new password">
                    @if ($errors->any())
                        <small id="" class="form-text text-muted">{{ $errors->first('new_password') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        aria-describedby="" placeholder="confirm password">
                    @if ($errors->any())
                        <small id="" class="form-text text-muted">{{ $errors->first('confirm_password') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/dragula/dragula.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dragula.js') !!}
@endpush
