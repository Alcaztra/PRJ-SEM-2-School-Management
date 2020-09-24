$('#create_subject').on('submit', function (event) {
    event.preventDefault();
    if ($('#sessions').val() == 0) {
        if (confirm("Session is 0.!")) {
            document.getElementById('create_subject').submit();
        }
    } else {
        document.getElementById('create_subject').submit();
    }
})