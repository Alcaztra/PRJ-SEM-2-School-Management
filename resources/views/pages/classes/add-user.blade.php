@extends('layout.master')
@section('page_title', 'Add Teacher | Student')
    @push('plugin-styles')
        <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
        {!! Html::style('/css/autocomplete/style.css') !!}
    @endpush

@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('class.addUser.submit') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="class_id">Class ID</label>
                            <select name="class_id" id="class_id" class="custom-select">
                                <option value="">- Select Class -</option>
                                @isset($classes)
                                    @foreach ($classes as $c)
                                        <option value="{{ $c->class_id }}">{{ $c->class_id }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="teacher_id">Teacher</label>
                            <select class="custom-select" name="teacher_id" id="teacher_id">
                                <option value="">- Select Teacher -</option>
                                @isset($teachers)
                                    @foreach ($teachers as $t)
                                        <option value="{{ $t->user_id }}">{{ $t->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inp_stu">Student List</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="inp_stu" id="inp_stu"
                                    placeholder="Enter Student ID | Name" autocomplete="off">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary" onclick="add()">Add</button>
                                </div>
                            </div>
                            <div class="list-group list-group-horizontal flex-wrap pt-3" id="list_stu">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
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
    {!! Html::script('/js/autocomplete.js') !!}
    <script>
        let students = new Array();
        let xml = new XMLHttpRequest();
        let url = document.location.origin + "/student/get-students";
        console.log(url)
        let res = "";
        // xml.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         // console.log(xml.response);
        //         res = JSON.parse(xml.response);
        //         // console.log(res);
        //         res.forEach(u => {
        //             students.push(u.user_id + "|" + u.name);
        //         });
        //     }
        // }
        // // console.log(students);
        // xml.open("GET", url, true);
        // xml.send();
        $(document).ready(function() {
            let req = $.ajax({
                url: document.location.origin + "/student/get-students",
                method: 'GET',
                success: function(data) {
                    // console.log(data);
                    data.forEach(u => {
                        students.push(u.user_id + "|" + u.name);
                    });
                }
            })
        });
        autocomplete(document.getElementById("inp_stu"), students);

        function add() {
            let int_stu = $("#inp_stu").val();
            if (int_stu == "") {
                return;
            }
            let stu_id = stu_name = "";
            stu_id = int_stu.split("|")[0];
            stu_name = int_stu.split("|")[1];
            // console.log(stu_id + "\n" + stu_name);
            let list = $("#list_stu");
            let item = "<a class='list-group-item cursor-pointer' data-toggle='tooltip' title='" + stu_id + "'>" +
                stu_name + "</a>";
            let inp_data = "<input type='hidden' name='students[]' value='" + stu_id + "' >";
            list.append(item);
            list.append(inp_data);
            $("#list_stu a").tooltip('enable');
            $("input[name='inp_stu']").val('');
        }

    </script>
@endpush
