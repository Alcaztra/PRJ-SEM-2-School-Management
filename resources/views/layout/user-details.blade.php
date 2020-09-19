{{-- {{ $user->getClasses() }} --}}
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                @if (Session::has('result') && Session::get('result'))
                    <div class='alert alert-info alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Notify !</strong> Password has been reset.</div>
                @elseif (Session::has('result') && !Session::get('result'))
                    <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Notify !</strong> Reset password failed.</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <legend>User Details</legend>
                        <tr>
                            <th class="text-uppercase">user_id</th>
                            <td>{{ $user->user_id }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">class_id</th>
                            <td>
                                @if (Request::is('teacher*'))
                                    <ul class="list-group">
                                        @foreach ($user->getClasses() as $c)
                                            <li class="list-group-item">{{ $c->class_id }}</li>
                                        @endforeach
                                    </ul>
                                @elseif (Request::is('student*'))
                                    {{ $user->class_id }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">gender</th>
                            <td>{{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">birthday</th>
                            <td>{{ date_format($user->birthday, 'Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">address</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div>
                    @if (Request::is('teacher*'))
                        <a href="{{ route('teacher.reset.password', ['teacher_id' => $user->user_id]) }}" role="button"
                            class="btn btn-warning" data-toggle='tooltip' title="Reset password back to default"
                            onclick="return confirm('Reset password for this teacher..!!')">Reset Password</a>
                    @elseif (Request::is('student*'))
                        <a href="{{ route('student.reset.password', ['student_id' => $user->user_id]) }}" role="button"
                            class="btn btn-warning" data-toggle='tooltip' title="Reset password back to default"
                            onclick="return confirm('Reset password for this student..!!')">Reset Password</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Avatar</div>
            <div class="card-body">
                <img class="img-fluid"
                    src="{{ $user->avatar !== null ? asset('storage/uploads/avatar/' . $user->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                    alt="">
            </div>
        </div>
    </div>
</div>
