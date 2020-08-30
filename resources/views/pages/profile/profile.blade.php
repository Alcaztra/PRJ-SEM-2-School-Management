@extends('layout.master')

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Information</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @foreach (($user_profile = Auth::guard('admin')->user())->toArray() as $key => $value)
                                <tr>
                                    <th class="text-uppercase">{{ $key }}</th>
                                    <td>
                                        @switch($key)
                                            @case('gender')
                                            {{-- fake value gender
                                            ['male'=>0,'female'=>1,'other'=>2] --}}
                                            @switch($value)
                                                @case(1)
                                                Male
                                                @break
                                                @case(2)
                                                Female
                                                @break
                                                @default
                                                Other
                                            @endswitch
                                            @break
                                            @case('avatar')
                                            <img src="{{ asset('storage/uploads/avatar/' . $user_profile->avatar) }}"
                                                class="img-thumbnail" alt="">
                                            @break
                                            @default
                                            {{ $value }}
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card">
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
                    <h4>Update Avatar</h4>
                    <div class="d-flex justify-content-between">
                        <div class="col">
                            <form action="{{ route('profile.update.avatar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview_image"
                                            id="preview_image">
                                        <label class="custom-file-label" for="preview_image"
                                            aria-describedby="inputGroupFileAddon02">Choose
                                            file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-outline-primary" id="">Upload</button>
                                        <button type="reset" class="btn btn-outline-primary" id="">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <img src="{{ asset('storage/uploads/avatar/' . $user_profile->avatar) }}" class="img-thumbnail"
                                id="preview_image" alt="">
                        </div>
                    </div>
                    @if ($errors->any() && $errors->has('preview_image'))
                        @foreach ($errors as $e)
                            <p class="text-danger">{{ $e }}</p>
                        @endforeach
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
    {!! Html::script('/js/getInputFileName.js') !!}
@endpush
