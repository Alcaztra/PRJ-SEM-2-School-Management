let url = window.location.origin;

function saveOrder() {
    let ul = $("ul[name='drag_zone']");
    let sem = 1;
    $.each(ul, function () {
        let order = 1;
        $(this).attr('tabindex', sem++);
        $.each($(this).children('li'), function () {
            $(this).attr('tabindex', order++);
        });
    });
}

/**
 * 
function loadListSubjects() {
    $('#order_list div[role="status"]').toggleClass('d-none');
    let course_id = $('#course_id').val();
    $.get(url + "/course/subject-order/" + course_id, function(data) {
        $('#order_list div[role="status"]').toggleClass('d-none');
        $('#list_here').append(data);
        const sortable = new Sortable($("ul[name='drag_zone']"), {
            draggable: "li"
        })
    });
}
loadListSubjects(); 
 * */

function postOrder() {
    saveOrder();
    let sem = 1;
    let subjects = new Array();

    $('#order_list div[role="status"]').toggleClass('d-none');

    $.each($("ul[name='drag_zone']"), function () {
        let order = 1;
        $.each($(this).children('li'), function (e) {
            var id = $(this).data('subject');
            let subject = {
                course_id: $('#course_id').val(),
                semester: sem,
                subject_order: order++,
                subject_id: id
            };
            subjects.push(subject);
        });
        sem++;
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    // console.log(subjects);
    console.log('call order');
    $.post(url + '/course/subject-order', {
        'subjects': subjects
    },
        function (data, status) {
            console.log('callback' + data);
            // window.open().document.write(data);
            $('#order_list div[role="status"]').toggleClass('d-none');
            console.log(data);
            if (data) {
                let ok = confirm("Order of subjects is updated.!\nRefresh this page.!");
                if (ok) {
                    window.location.reload();
                }
            } else {
                alert("Cannot update order of subjects.!\nPlease contact technical staff.!");
            }

        });
}