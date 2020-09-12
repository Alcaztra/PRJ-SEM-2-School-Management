<div class="card">
    <div class="card-body">
        <div class="col-sm-4 py-2">
            <div class="input-group">
                <input class="form-control" type="text" name="search" id="filterInput"
                    placeholder="Search {{ $search }}">
                {{-- <div class="input-group-append">
                    <span class="btn btn-outline-dark" id="search">Search</span>
                </div> --}}
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-light table-hover">
                <thead class="thead-dark text-uppercase">
                    <tr>
                        <th scope="col">user_id</th>
                        <th scope="col">name</th>
                        @if (Request::is('student*'))
                            <th scope="col">class_id</th>
                        @endif
                        <th scope="col">avatar</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                    </tr>
                </thead>
                <tbody id="filterTable">
                    @isset($users)
                        @foreach ($users as $u)
                            <tr>
                                @if (Request::is('student*'))
                                    <td scope="row"><a href="{{ route('student.detail', ['student_id' => $u->user_id]) }}"
                                            class="text-decoration-none">{{ $u->user_id }}</a></td>
                                    <td scope="row">{{ $u->name }}</td>
                                    <td>{{ $u->class_id }}</td>
                                @elseif (Request::is('teacher*'))
                                    <td scope="row"><a href="{{ route('teacher.detail', ['teacher_id' => $u->user_id]) }}"
                                            class="text-decoration-none">{{ $u->user_id }}</a></td>
                                    <td scope="row">{{ $u->name }}</td>
                                @endif
                                <td>
                                    <img class="img-thumbnail"
                                        src="{{ $u->avatar !== null ? asset('storage/uploads/avatar/' . $u->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                                        alt="">
                                </td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone }}</td>
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
