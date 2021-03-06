let students = new Array();
let xml = new XMLHttpRequest();
let host = document.location.origin;

function item(name, id) {
    var style = 'list-group-item cursor-pointer d-flex justify-content-between';
    var txt = "<a class='" + style + "' data-toggle='tooltip' title='" + id + "' data-id='" + id + "' data-label='addItem' onclick='removeStudent( this,\"" + id + "\" )'>" + name + " <span class='mx-1'>&times;</span></a>";
    txt += "<input type='hidden' form='add_user_form' name='students[]' value='" + id + "'>";
    return txt;
}

// console.log(host)
let list = $("#list_stu");

/* get list of free students */
$.get(host + "/student/get-students", function (data) {
    console.log('data loaded.', data)
    $("button span[name='loadStudents']").parent().toggle();
    data.forEach(u => {
        students.push(u.user_id + "|" + u.name);
    });
});
autocomplete(document.getElementById("inp_stu"), students);

$("select#class_id").on('click', function () {
    let class_id = $(this).val();
    let teacher_id = '';
    list.empty();
    let t_load, s_load;
    t_load = s_load = false;
    let spin = function () {
        if (t_load && s_load) {
            $("div[role='status']").toggleClass('d-none', true);
        } else {
            $("div[role='status']").toggleClass('d-none', false);
        }
    }
    // console.log(host + '/class/get-teacher/' + class_id);
    if ("" !== class_id) {
        spin();
        $.get(host + '/class/get-teacher/' + class_id, function (data) {
            if (data.length > 0) {
                teacher_id = data[0].teacher_id;
                $("select#teacher_id").val(teacher_id);
            } else {
                $("select#teacher_id").val('');
            }
            t_load = true;
            spin();
        });
        $.get(host + '/class/get-students/' + class_id, function (data) {
            if (data.length > 0) {
                data.forEach(stu => {
                    // console.log(stu)
                    list.append(item(stu.name, stu.user_id));
                });
                $("#list_stu a").tooltip('enable');
            }
            s_load = true;
            spin();
        });
    }

});

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
    list.append(item(stu_name, stu_id));
    $("#list_stu a").tooltip('enable');
    $("input[name='inp_stu']").val('');
    validationAdd();
}

function removeStudent(item, input) {
    // console.log(item);
    $("#list_stu a").tooltip('hide');
    item.remove();
    $("input[value='" + input + "']").first().remove();
    validationAdd();
}

function validationAdd() {
    let list = new Array();
    $("a[data-label='addItem']").each(function () {
        // console.log($(this))
        list.push($(this).data('id'));
    });
    let check = false;
    list.forEach(e => {
        var f = list.indexOf(e);
        var l = list.lastIndexOf(e);
        if (check = (f == l)) {
            $("a[data-id='" + e + "']").toggleClass('list-group-item-danger', false);
        } else {
            $("a[data-id='" + e + "']").toggleClass('list-group-item-danger', true);
        }
    });
    return check;
}

validationAdd();

$('#add_user_form').on('submit', function (event) {
    event.preventDefault();
    this.classList.add('was-validated');
    $('#class_id').attr('required', 'required');
    let valid = false;
    let check_class = document.getElementById('class_id').checkValidity();
    let check_student = validationAdd();
    if (check_class) {
        if (check_student) {
            if ("" == $('#teacher_id').val()) {
                if (confirm("The teacher has yet to be assigned.")) {
                    valid = true;
                }
            } else {
                valid = true;
            }
        } else {
            if ($("#list_stu").contents().length == 0) {
                if ("" == $('#teacher_id').val()) {
                    if (confirm("The teacher has yet to be assigned.\nClass has no students.")) {
                        valid = true;
                    }
                } else {
                    if (confirm("Class has no students.")) {
                        valid = true;
                    }
                }
            }
        }
    }
    if (valid) {
        document.getElementById('add_user_form').submit();
    }
});