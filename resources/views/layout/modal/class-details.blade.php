<div class="modal fade" id="{{ $id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $label ?? '' }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Class Details</h4>
                <div class="spinner-border d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <button type="button" class="close mx-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th class="text-uppercase w-25">Class ID</th>
                            <td name='class_id'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Room</th>
                            <td name='room'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Size</th>
                            <td name='size'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Course</th>
                            <td name='course'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Study Shift</th>
                            <td name='study_shift'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Period</th>
                            <td name='period'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Total Duration</th>
                            <td name='total_duration'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">Start Day</th>
                            <td name='start_day'></td>
                        </tr>
                        <tr>
                            <th class="text-uppercase">End Day (expected)</th>
                            <td name='end_day'></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
