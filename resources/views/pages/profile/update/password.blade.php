@extends('layout.master')
@section('page_title', 'Update Password')
@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Password</h4>
                    <form action="{{ route('profile.update.password.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" name="old_password" id="old_password"
                                aria-describedby="" placeholder="**********">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                aria-describedby="" placeholder="**********">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confrm_password" id="confirm_password"
                                aria-describedby="" placeholder="**********">
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
