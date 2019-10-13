function mostrarInfoAudio(id) {

    //Se utiliza ajax para mostrar una ventana emergente sin recargar la página
    //Se envía por post el id del audio que se desea consultar información
    //Resultado devuelto en formato HTML
    $.ajax({
        url: '/Audify/BibliotecaAudio/informacionAudio.php',
        type: 'POST',
        dataType: 'html',
        data: {'id': id},
    })

    //Si se ejecutó correctamente se muestra la información del audio en una ventana emergente (modal)
        .done(function (resultado) {
            //Se le indica mediante el id en qué contenedor debería mostrar el resultado y en qué modal
            $('#mostrarInfoAudio').html(resultado);
            $('#InformacionAudio').modal("show");
        })

        //Si falla entonces se muestra mensaje de error
        .fail(function () {
            alert("Error al mostrar información del audio..");
        })
}

