let students = new Array();
let xml = new XMLHttpRequest();
let host = document.location.origin;

function item(name, id) {
    var style = 'list-group-item cursor-pointer';
    var txt = "<a class='" + style + "' data-toggle='tooltip' data-id='" + id + "' data-label='addItem' onclick='removeStudent( this,\"" + id + "\" )'>" + name + " <span class='mx-1'>&times;</span></a>";
    txt += "<input type='hidden' name='students[]' value='" + id + "'>";
    return txt;
}

// console.log(host)
let list = $("#list_stu");

$.get(host + "/student/get-students", function (data) {
    // console.log(data);
    data.forEach(u => {
        students.push(u.user_id + "|" + u.name);
    });
});
autocomplete(document.getElementById("inp_stu"), students);

$("select#class_id").on('click', function () {
    let class_id = $(this).val();
    let teacher_id = '';
    let list = $("#list_stu");

    console.log(host + '/class/get-teacher/' + class_id);
    if ("" !== class_id) {
        $.get(host + '/class/get-teacher/' + class_id, function (data) {
            if (data.length > 0) {
                teacher_id = data[0].teacher_id;
                $("select#teacher_id").val(teacher_id);
            } else {
                $("select#teacher_id").val('');
            }
        });
        $.get(host + '/class/get-students/' + class_id, function (data) {
            list.empty();
            if (data.length > 0) {
                data.forEach(stu => {
                    console.log(stu)
                    list.append(item(stu.name, stu.user_id));
                });
                $("#list_stu a").tooltip('enable');
            }
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
    $("#list_stu a").tooltip('dispose');
    item.remove();
    $("input[value='" + input + "']").remove();
    validationAdd();
}

function validationAdd() {
    let list = new Array();
    $("a[data-label='addItem']").each(function () {
        // console.log($(this))
        list.push($(this).data('id'));
    });
    list.forEach(e => {
        var f = list.indexOf(e);
        var l = list.lastIndexOf(e);
        if (f !== l) {
            $("a[data-id='" + e + "']").toggleClass('list-group-item-danger', true);
        } else {
            $("a[data-id='" + e + "']").toggleClass('list-group-item-danger', false);
        }
    });
}