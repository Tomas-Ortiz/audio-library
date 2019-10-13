function validarActualizacion() {

    var nombre, apellido, correo, usuario, rol, fechaNacimiento, claveActual;

    //se obtienen los valores ingresados en el formulario

    nombre = document.getElementById("name").value;
    apellido = document.getElementById("apell").value;
    correo = document.getElementById("Mail").value;
    usuario = document.getElementById("usuario").value;
    claveActual = document.getElementById("pass").value;
    fechaNacimiento = document.getElementById("nac").value;
    rol = document.getElementById("Rol").value;

    //se establecen las expresiones regulares que se van a utilizar para validar los datos

    var formatoCorreo = /\w+@\w+\.+[a-z]/;

    var tieneEspacio = /^\s+$/;

    var soloLetras = /^[A-Za-z \s]+$/;

    var alfaNumerico = /^[\w \.]+$/;

    //si algún campo está vacío
    //test es una función que contiene la cadena a comparar con la expresion regular, retorna true si existe coincidencia entre la
    //expresion regular y la cadena, de lo contrario retorna false.
    if (nombre === "" || tieneEspacio.test(nombre) || apellido === "" || tieneEspacio.test(apellido) || correo === "" || usuario === "" || tieneEspacio.test(usuario) || fechaNacimiento === "") {

        alert("Todos los campos son obligatorios.");

        return false;

        //si ingresa caracteres que no son letras
    } else if (!soloLetras.test(nombre) || !soloLetras.test(apellido)) {

        alert("Para nombre y apellidos solo se permiten letras.");

        return false;

        //si el tamaño del nombre o el usuario supera los 20 caracteres
    } else if (nombre.length > 20 || usuario.length > 20) {
        alert("Nombre y usuario no pueden sobrepasar los 20 carácteres.");

        return false;
        //si el usuario ingresa caracteres que no sean letras ni numeros
    } else if (!alfaNumerico.test(usuario)) {

        alert("El usuario no puede contener caracteres especiales.");

        return false;

    } else if (apellido.length > 30) {

        alert("El Apellido no pueden sobrepasar los 30 carácteres.");

        return false;
    } else if (correo.length > 35) {
        alert("El correo no puede sobrepasar los 35 carácteres.");

        return false;

    } else if (!formatoCorreo.test(correo)) {
        alert("Introduzca un formato correcto para el correo.");

        return false;
    }

    //Si el usuario quiere modificar la clave y ésta no cumple con el tamaño indicado
    if (claveActual != "" && (claveActual.length<5 || claveActual.length > 30)) {

        alert("La contraseña debe tener entre 5 y 30 caracteres.");
        return false;
    }

    //Si no ingresa uno de estos roles especificados
    if (rol != "admin" && rol != "user") {
        alert("El rol solo puede ser 'admin' o 'user'.");
        return false;
    }

}