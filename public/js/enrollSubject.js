function enrollSubject(class_id) {
    $('span[name="enrollSubject"]').toggleClass('d-none', false);
    console.log('click enroll')
    let subject_id = $('#enroll_box select').val();
    let key_enroll = $('#enroll_box input').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    let url = window.location.origin;
    $.post(url + '/enrollment', {
        'class_id': class_id,
        'subject_id': subject_id,
        'key_enroll': key_enroll
    }, function(data) {
        console.log(data);
        if (true == data) {
            alert("Enroll Subject Success.!\nPage will reload.!");
            window.location.reload();
        } else {
            alert("Enroll Key Incorrect.!");
        }
        $('span[name="enrollSubject"]').toggleClass('d-none', true);
    }, 'json');
}