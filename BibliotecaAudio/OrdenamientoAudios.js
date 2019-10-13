function ordenarAudios(ordenarPor) {

    //Se utiliza ajax para ordenar los audios de forma dinámica sin recargar la página
    //Se envía por post cómo se quiere ordenar los audios (asc, desc)
    //El resultado es devuelto en formato HTML

    $.ajax({
        url: 'OrdenarAudios.php',
        type: 'POST',
        dataType: 'html',
        data: {"ordenarPor": ordenarPor},
    })

    //Si se ejecutó correctamente se muestra en el div Audios la lista de audios ordenada
        .done(function (resultado) {
            $('#Audios').html(resultado);
        })

        //Si falla entonces se muestra un mensaje de error
        .fail(function () {
            alert("Error al ordenar.");
        })
}