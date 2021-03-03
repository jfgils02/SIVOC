function saveCorrectiveAction() {

    let issue = $("#inputIssiueCorrectiveAction").val();
    let action = $("#inputActionCorrectiveAction").val();
    let participant = $("#sltParticipantesInternos").val();
    let status = $("#inputStatusCorrectiveAction").val();
    let file = $('#fileCorrectiveAction')[0];

    let data = new FormData();
    data.append("issue", issue);
    data.append("action", action);
    data.append("participant", participant);
    data.append("status", status);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "correctiveActions",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterCorrectiveAction").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");
                location.reload();

            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function editCorrectiveAction(id) {
    $("#inputEditStatusCorrectiveAction").empty();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        url: "/correctiveActions/edit/" + id,
        //data: $("#formRegisterUser").serialize(),
        dataType: 'json',
        success: function(data) {
            console.log(data.correctiveAction.status);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let option = "";
                switch (data.correctiveAction.status) {
                    case 'Abierta':
                        option = "<option value='Abierta' selected>Abierta</option>" +
                            "<option value='Cerrada'>Cerrada</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Desfazada'>Desfazada</option>";
                        break;
                    case 'Cerrada':
                        option = "<option value='Abierta'>Abierta</option>" +
                            "<option value='Cerrada' selected>Cerrada</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Desfazada'>Desfazada</option>";
                        break;
                    case 'Proceso':
                        option = "<option value='Abierta' selected>Abierta</option>" +
                            "<option value='Cerrada'>Cerrada</option>" +
                            "<option value='Proceso' selected>Proceso</option>" +
                            "<option value='Desfazada'>Desfazada</option>";
                        break;
                    case 'Desfazada':
                        option = "<option value='Abierta' selected>Abierta</option>" +
                            "<option value='Cerrada'>Cerrada</option>" +
                            "<option value='Proceso'>Proceso</option>" +
                            "<option value='Desfazada' selected>Desfazada</option>";
                        break;

                    default:
                        break;


                }
                console.log(option);
                $("#inputEditIssiueCorrectiveAction").val(data.correctiveAction.issue);
                $("#inputEditActionCorrectiveAction").val(data.correctiveAction.action);
                $("#inputEditNameAutor").val(data.users.name + " " + data.users.last_name + " " + data.users.mother_last_name);
                $("#sltEditParticipantesInternos").val(data.correctiveAction.involved);
                $("#inputEditStatusCorrectiveAction").append(option);


                $("#ModalEditCorrectiveAcition").modal('show');


            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function saveEditCorrectiveAction() {

    let issue = $("#inputIssiueCorrectiveAction").val();
    let action = $("#inputActionCorrectiveAction").val();
    let participant = $("#sltParticipantesInternos").val();
    let status = $("#inputStatusCorrectiveAction").val();
    let file = $('#fileCorrectiveAction')[0];

    let data = new FormData();
    data.append("issue", issue);
    data.append("action", action);
    data.append("participant", participant);
    data.append("status", status);
    data.append("tamanoFiles", file.files.length);
    for (let i = 0; i < file.files.length; i++) {
        data.append('file' + i, file.files[i]);
    }


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "correctiveActionscorrectiveActions/saveEdit/{id}",
        data: data,
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterCorrectiveAction").modal('hide');

                messageAlert("Guardado Correctamente", "success", "");
                location.reload();

            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}

function showCorrectiveActionFile(id) {
    $("#bodyCorrectiveActionFiles").empty();
    $.ajax({
        type: "GET",
        url: `correctiveActions/showCorrectiveActionsFiles/${id}`,
        //data: { "id": minute },
        dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                let table = "";
                for (const i in data.correctiveActionfiles) {
                    table += `<tr>"
                        <td> ${data.correctiveActionfiles[i].id}</td> 
                        <td>
                            <a href="storage/Documents/Accion_Correctiva/${id}/${data.correctiveActionfiles[i].file}" target="_blank">${data.correctiveActionfiles[i].file}</a>
                        </td>"
                    </tr>`;

                }

                $("#bodyCorrectiveActionFiles").append(table);


            }

        },
        error: function(data) {
            console.log(data.responseJSON);
            if (data.responseJSON.message == "The given data was invalid.") {
                messageAlert("Datos incompletos.", "warning");
            } else {
                messageAlert("Ha ocurrido un problema.", "error", "");
            }
            //messageAlert("Datos incompletos", "error", `${data.responseJSON.errors.apellido_paterno}` + "\n" + `${data.responseJSON.errors.name}`);
        }
    });
}