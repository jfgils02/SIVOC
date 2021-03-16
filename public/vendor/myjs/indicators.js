function saveTypeIndicator() {
    $.ajax({

        type: "POST",
        url: "/indicators/create/typeIndicator",
        data: $("#formRegisterTypeIndicador").serialize(),
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterTypeIndicador").modal('hide');

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

function saveIndicator() {
    let idArea = $("#sltArea").val();
    let typeIndicator = $("#inputIndicatorType").val();
    let valorOptenido = $("#inputValue").val();
    let fechaRegistro = $("#inputreRegistrationDate").val();
    let data = new FormData();
    let file = $('#fileIndicador')[0];
    data.append("file", file.files[0]);
    data.append("idArea", idArea);
    data.append("typeIndicator", typeIndicator);
    data.append("valorOptenido", valorOptenido);
    data.append("fechaRegistro", fechaRegistro);
    console.log(data);

    //data.append("file", $('#fileIndicador')[0]);
    //$("#formRegisterIndicador").serialize()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/indicators/create",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        //dataType: 'json',
        success: function(data) {

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#ModalRegisterIndicator").modal('hide');

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

function minMax() {
    let indicatorType = $("#inputIndicatorType").val();

    /*$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });*/
    console.log(indicatorType);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/indicators/create/minMax",
        data: { "indicatorType": indicatorType, _token: $('meta[name="csrf-token"]').attr('content') },
        //dataType: 'json',
        success: function(data) {
            console.log(data);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {

                $("#minimo").val(data.minMax[0].min);

                $("#maximo").val(data.minMax[0].max);

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

function graficaIndicador() {
    $.ajax({
        type: "POST",
        url: "/indicators/grafica",
        data: $("#formGraficaIndicador").serialize(),
        //dataType: 'json',
        success: function(data) {
            console.log(data.minMax.max);

            if (data.error == true) {
                messageAlert(data.msg, "error", "");
            } else {
                let valores = [];
                data.grafica.forEach(element => {
                    valores.push(element.value);
                });
                console.log(valores);

                $("#ModalGraficaIndicator").modal('hide');
                var ctx = document.getElementById('chartIndicator').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        datasets: [{
                            label: 'Indicador',
                            data: valores,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    min: 0,
                                    max: Number.parseInt(data.minMax.max)
                                }
                            }],
                            xAxes: []
                        }
                    }
                });

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