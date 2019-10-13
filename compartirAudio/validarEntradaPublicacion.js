function validarEntrada() {

    //Se obtiene el contenido del comentario de una publicación a partir del id del text area
    var texto = document.getElementById('textoPublicacion').value;

    //Se establecen REGEX para validar la entrada de datos
    var alfaNumerico = /^[\w \.]+$/;

    //Si se ingresa un comentario y tiene carácteres especiales
    if (!alfaNumerico.test(texto) && texto != "") {

        alert("Error, solo caracteres alfanumericos.");

        return false;
    }

}

