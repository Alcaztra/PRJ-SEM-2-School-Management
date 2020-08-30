$('.custom-file-input').on('change', function (e) {
    let fileName = $(this).val().split('\\').pop();
    // $(this).next('.custom-file-label').html(fileName)
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;

    let reader = new FileReader();
    reader.onload = (e) => {
        $('img#preview_image').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
})
$('button[type=reset]').on('click', function () {
    $('.custom-file-label').html('Profile image');
    $('#preview_image').attr('src', '');
})
