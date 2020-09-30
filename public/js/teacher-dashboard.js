let host = document.location.origin;
$('#class_details').on('show.bs.modal', function (event) {
    $('#class_details div[role="status"]').toggleClass('d-none', false);
    var button = $(event.relatedTarget);
    var recipent = button.data('class-id');
    $.get(host + '/class-details/' + recipent, function (data) {
        // console.log('here', button, recipent, data);
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                const element = data[key];
                $('#class_details td[name=' + key + ']').html(element);
            }
        }
        $('#class_details div[role="status"]').toggleClass('d-none', true);
    });
});

$('select#select_class').on('click', function () {
    let class_id = $(this).val();
    // console.log('get class_id: ' + class_id);
    if ("" !== class_id) {
        $('#attendance div[role="status"]').toggleClass('d-none', false);
        $.get(host + '/list-subjects/' + class_id,
            function (data) {
                // console.log(data);
                $('select#select_subject').empty();
                $('select#select_subject').append("<option value='' selected>- Subject Id -</option>");
                if (data.length > 0) {
                    data.forEach(e => {
                        let txt = "<option value='" + e.subject_id + "'>";
                        txt += e.name;
                        txt += "</option>";
                        $('select#select_subject').append(txt);
                        $('#attendance div[role="status"]').toggleClass('d-none', true);
                    });
                }
            });
    }
});

$('#select_subject').on('click', function () {
    let class_id = $('#select_class').val();
    let subject_id = $(this).val();
    if ("" !== subject_id) {
        $.get(host + '/list-sessions/' + subject_id,
            function (data) {
                // console.log(data);
                $('#select_session').empty();
                $('#select_session').append("<option value='' selected>- Session -</option>");
                if (data.length > 0) {
                    for (let i = 1; i <= data; i++) {
                        let txt = "<option value='" + i + "'>";
                        txt += "Session " + i;
                        txt += "</option>";
                        $('select#select_session').append(txt);
                        $('#attendance div[role="status"]').toggleClass('d-none', true);
                    }
                }
            });
    }
});

/* let now = () => {
    let year = new Date().getFullYear();
    let month = new Date().getMonth() + 1;
    let date = new Date().getDate();
    let now = "";
    now += year + "-";
    if (month < 10) {
        now += "0" + month + "-";
    } else {
        now += month + "-";
    }
    if (date < 10) {
        now += "0" + date;
    } else {
        now += date;
    }
    return now;
}

$('input#select_date').attr('max', now()); */

function getClass() {
    let class_id = $('select#select_class').val();
    let subject_id = $('select#select_subject').val();
    let session = $('#select_session').val();
    // let date_picker = $('input#select_date').val();

    // console.log(class_id, subject_id, date_picker);
    $("#attendance div[getClass]").toggleClass('was-validated', true);
    // let now = new Date();
    // let picker = new Date(date_picker);
    // if (now.getTime() < picker.getTime()) {
    //     console.log('select furture day')
    // }
    if ("" !== class_id && "" !== subject_id && "" !== session) {
        $('#attendance div[role="status"]').toggleClass('d-none', false);
        $.get(host + '/list-students/' + class_id + '/' + subject_id + '/' + session,
            function (data) {
                // console.log(data, data.length);
                $('table#list_students tbody').empty();
                if (data.length > 0) {
                    data.forEach(e => {
                        $('table#list_students tbody').append(row(e.user_id, e.name, e.status));
                    });
                }
                $('#attendance div[role="status"]').toggleClass('d-none', true);
            });
    }
    function row(id, name, status) {
        let txt = '<tr>';
        txt += '<td name="student_id">' + id + '</td><td>' + name + '</td>';
        txt += '<td class="text-center">';
        if (true == status) {
            txt += '<input type="radio" name="' + id + '" value="1" checked>';
            txt += '</td>';
            txt += '<td class="text-center">';
            txt += '<input type="radio" name="' + id + '" value="0">';
        } else {
            txt += '<input type="radio" name="' + id + '" value="1">';
            txt += '</td>';
            txt += '<td class="text-center">';
            txt += '<input type="radio" name="' + id + '" value="0" checked>';
        }
        txt += '</td>';
        txt += '</tr>';
        return txt;
    }
}

function postAttendance() {
    // console.log($('form#status').serializeArray());
    // let date_picker = $('input#select_date').val();
    let subject_id = $('select#select_subject').val();
    let session = $('#select_session').val();
    let form_data = $('form#status').serializeArray();
    $('#attendance div[role="status"]').toggleClass('d-none', false);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    if (form_data.length > 0) {
        $.post(host + '/attendance/' + subject_id + '/' + session, { status: form_data }, function (data) {
            // console.log(data);
            // window.open().document.write(data);
            $('#attendance div[role="status"]').toggleClass('d-none', true);
            getClass();
        }, 'json');
    } else {
        $('#attendance div[role="status"]').toggleClass('d-none', true);
    }

}