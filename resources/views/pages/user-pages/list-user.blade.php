@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Table {{ $role }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2"> User ID </th>
                                    <th> User name </th>
                                    <th> Password </th>
                                    <th> Profile Image </th>
                                    <th> Day of Birth </th>
                                    <th> Email </th>
                                    <th> Phone </th>
                                    <th> Address</th>
                                    <th> State</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <td>{{ $u->user_id }}</td>
                                    <td><a class="btn btn-outline-warning" href="{{ url("user-pages/teacher/edit-{$u->user_id}") }}" role="button">Edit</a></td>
                                    <td>{{ $u->user_name }}</td>
                                    <td>{{ $u->password }}</td>
                                    <td><img src="{{ url($u->user_image ?? '') }}" class="img-thumbnail"
                                            alt="image profile"></td>
                                    <td>{{ $u->day_of_birth }}</td>
                                    <td>{{ $u->user_email }}</td>
                                    <td>{{ $u->user_phone }}</td>
                                    <td>{{ $u->user_address }}</td>
                                    <td>{{ $u->user_state ? 'active' : 'deactive' }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
