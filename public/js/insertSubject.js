function insertSubject() {
    let sem_opt = $("#sem_opt").val();
    let sub_opt = $("#sub_opt").val();
    let data_table = $("#data_table>#sem_" + sem_opt);
    let template = "<input type='text' readonly class='form-control' name='sem_" + sem_opt + "' value='" + sub_opt + "'>";

    data_table.append(template);
}