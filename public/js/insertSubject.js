function insertSubject() {
    let sem_opt = $("#sem_opt").val();
    let sub_opt = $("#sub_opt").val();
    let sub_opt_title = $("#sub_opt>option[value=" + sub_opt + "]").html();
    let data_table = $("#data_table");
    let input = "<input type='hidden' readonly name='semester_" + sem_opt + "[]' value='" + sub_opt + "'>";
    let class_name = "btn btn-outline-primary p-2 m-1 text-uppercase cursor-pointer";
    let test = "<p role='button' class='" + class_name + "' data-toggle='tooltip' title='" + sub_opt_title + "' onclick='removeSubject( this,\"" + sub_opt + "\" )'>" + sub_opt + " <span class='mx-1'>&times;</span></p>";
    if (sem_opt !== "" && sub_opt !== "") {
        data_table.append(input);
        $("#data_table #sem_" + sem_opt).append(test);
    }

    $("#data_table p[role='button']").tooltip('enable');
}

function removeSubject(item, input) {
    // console.log(item);
    $("#data_table p[role='button']").tooltip('dispose');
    item.remove();
    $("input[value='" + input + "']").remove();
}