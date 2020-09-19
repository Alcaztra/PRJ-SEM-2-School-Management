<div class="modal fade" id="{{ $id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $label ?? '' }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">List Enrolled Subjects</h4>
                <button type="button" class="close mx-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Subject ID</th>
                                <th>Subject Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($enrolled)
                                @foreach ($enrolled as $s)
                                    <tr>
                                        <td>{{ $s->subject_id }}</td>
                                        <td>{{ $s->name }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr><td colspan="2">#</td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
