let valid = false;

validationAdd();

function insertSubject() {
    let sem_opt = $("#sem_opt").val();
    let sub_opt = $("#sub_opt").val();
    let sub_opt_title = $("#sub_opt>option[value=" + sub_opt + "]").html();

    if (sem_opt !== "" && sub_opt !== "") {
        $("#data_table #sem_" + sem_opt).append(item(sem_opt, sub_opt, sub_opt_title));
    }

    $("#data_table p[role='button']").tooltip('enable');
    validationAdd()
}

function item(sem, sub, title) {
    var style = "btn btn-outline-primary p-2 m-1 text-uppercase cursor-pointer";
    var text = "<p role='button' class='" + style + "' data-label='addItem' data-id='" + sub + "' data-toggle='tooltip' title='" + title + "' onclick='removeSubject( this,\"" + sub + "\"," + sem + " )'>" + sub + " <span class='mx-1'>&times;</span></p>";
    text += "<input type='hidden' readonly name='semester_" + sem + "[]' value='" + sub + "'>";
    return text;
}

function removeSubject(item, input, sem) {
    // console.log(item);
    $("#data_table p[role='button']").tooltip('hide');
    item.remove();
    $("input[value='" + input + "'][name='semester_" + sem + "[]']").first().remove();
    validationAdd();
}

function validationAdd() {
    let list = new Array();
    $("p[data-label='addItem']").each(function () {
        // console.log($(this))
        list.push($(this).data('id'));
    });
    list.forEach(e => {
        var f = list.indexOf(e);
        var l = list.lastIndexOf(e);
        if (f !== l) {
            $("p[data-id='" + e + "']").toggleClass('btn-outline-primary', false);
            $("p[data-id='" + e + "']").toggleClass('btn-outline-danger', true);
            valid = false;
        } else {
            $("p[data-id='" + e + "']").toggleClass('btn-outline-primary', true);
            $("p[data-id='" + e + "']").toggleClass('btn-outline-danger', false);
            valid = true;
        }
    });
}

function checkValid() {
    let form = $('form#create_course_form');
    // console.log(form);
    if (valid) {
        confirm('form is valid');
        form.trigger('submit');
    } else {
        confirm('Form is invalid');
    }
    // alert('still not submit');
}