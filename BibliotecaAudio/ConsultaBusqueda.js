//se activa cuando el usuario presiona una tecla (keyup) en el input de búsqueda
$(document).on('keyup', '#input_busqueda', function () {

    //Se obtiene y almacena la entrada de datos (búsqueda realizada)
    //this hace referencia al input del id input_busqueda
    var busqueda = $(this).val();

    //Se envía como argumento la búsqueda realizada para buscar audios
    buscarAudios(busqueda);
});

function buscarAudios(busqueda) {

    //Se utiliza ajax para buscar y mostrar audios de forma dinámica según se escriba en el buscador
    //Se envía por post la búsqueda realizada a un php y el resultado es devuelto en formato HTML
    $.ajax({
        url: 'muestraAudio.php',
        type: 'POST',
        dataType: 'html',
        data: {'busqueda': busqueda},
    })

    //Si se ejecuta correctamente, la funcion recibe los resultados de la busqueda (array)
        .done(function (resultado) {
            //Los resultados se muestran en formato HTML en el div Audios
            $('#Audios').html(resultado);
        })

        //Si falla muestra mensaje de error
        .fail(function () {
            alert("Error.");
        })
}