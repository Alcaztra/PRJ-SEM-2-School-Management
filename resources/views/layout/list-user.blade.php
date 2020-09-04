<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>user_id</th>
                        <th>name</th>
                        <th>avatar</th>
                        <th>gender</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>birthday</th>
                        <th>address</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($users)
                        @foreach ($users as $u)
                            <tr>
                                <td>{{ $u->user_id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>
                                    <img class="img-thumbnail"
                                        src="{{ $u->avatar !== null ? asset('storage/uploads/avatar/' . $u->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                                        alt="">
                                </td>
                                <td>{{ $u->gender }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone }}</td>
                                <td>{{ $u->birthday }}</td>
                                <td>{{ $u->address }}</td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
