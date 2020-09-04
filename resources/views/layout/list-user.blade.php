<div class="card">
    <div class="card-body">
        <div class="col-sm-4 py-2">
            <div class="input-group">
                <input class="form-control" type="text" name="search" id="filterInput" placeholder="Search {{ $search }}">
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
                        <th scope="col">avatar</th>
                        <th scope="col">gender</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                    </tr>
                </thead>
                <tbody id="filterTable">
                    @isset($users)
                        @foreach ($users as $u)
                            <tr>
                                <td scope="row">{{ $u->user_id }}</td>
                                <td scope="row">{{ $u->name }}</td>
                                <td>
                                    <img class="img-thumbnail"
                                        src="{{ $u->avatar !== null ? asset('storage/uploads/avatar/' . $u->avatar) : asset('assets/images/faces-clipart/pic-1.png') }}"
                                        alt="">
                                </td>
                                <td>{{ $u->gender }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone }}</td>
                                <td>{{ date_format($u->birthday, 'Y-m-d') }}</td>
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
