@extends('layout.master')

@push('plugin-styles')
    {!! Html::style('/assets/plugins/dragula/dragula.min.css') !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Account Infomation</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th width="20%" class="border-right"> User ID </th>
                                    <td class="font-weight-medium"> {{ $user->user_id }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> User Name </th>
                                    <td> {{ $user->user_name }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Password </th>
                                    <td>
                                        <input type="text" class="form-control-plaintext p-0" value="{{ $user->password }}"
                                            readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Day of Birth </th>
                                    <td> {{ $user->day_of_birth }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Email </th>
                                    <td> {{ $user->user_email }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Phone </th>
                                    <td> {{ $user->user_phone }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Address </th>
                                    <td> {{ $user->user_address }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> Role </th>
                                    <td> {{ $user->role->position }} </td>
                                </tr>
                                <tr>
                                    <th class="border-right"> State </th>
                                    <td> {{ $user->user_state ? 'active' : 'deactive' }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a class="btn btn-warning" href="{{ url("user-pages/manage-account/update-{$user->user_id}") }}"
                        role="button">Change Info</a>
                    <hr>
                    <div class="row">
                        <div class="col-md-1"><img src="" class="img-thumbnail" style="max-width: 100px" id="preview_image"
                                alt=""></div>
                        <div class="col">
                            <form action="{{ url("user-pages/manage-account/change-image-{$user->user_id}/submit") }}"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="border border-dark custom-file-input"
                                            name="user_image_upload" id="user_image_upload">
                                        <label for="user_image_upload" class="custom-file-label"> Profile image </label>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="btn-group" role="group" aria-label="">
                                            <button type="submit" class="btn btn-outline-primary">Upload</button>
                                            <button type="reset" class="btn btn-outline-danger">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <a name="" id="" class="btn btn-primary"
                        href="{{ url("user-pages/manage-account/change-password-{$user->user_id}") }}" role="button">Change
                        Password</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/dragula/dragula.min.js') !!}
    {!! Html::script('/js/getInputFilename.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dragula.js') !!}
@endpush
