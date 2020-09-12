$(document).ready(function () {
    $("#filterInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#filterTable tr").filter(function () {
            $(this).toggle($(this).children("td[scope='row']").text().toLowerCase().search(value) > -1)
        });
    });
});
