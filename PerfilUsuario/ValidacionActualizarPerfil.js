function validarActualizacionPerfil() {

    var nombre, apellido, correo, usuario, contraseñaActual, nuevaContraseña, fechaNacimiento;

    //se obtienen los valores ingresados en el formulario

    nombre = document.getElementById("nomb").value;
    apellido = document.getElementById("apell").value;
    correo = document.getElementById("mail").value;
    usuario = document.getElementById("nombreUsuario").value;
    contraseñaActual = document.getElementById("contraseñaActual").value;
    nuevaContraseña = document.getElementById("nuevaContraseña").value;
    fechaNacimiento = document.getElementById("fecha_nac").value;

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

    } else if (nombre.length > 20 || usuario.length > 20) {
        alert("Nombre y usuario no pueden sobrepasar los 20 carácteres.");

        return false;

        //si el usuario ingresa caracteres que no sean letras ni numeros (caracteres especiales)
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

    //Si se ha introducido la contraseña actual y ha dejado dejado vacío el campo de la nueva contraseña
    if (contraseñaActual != "" && nuevaContraseña === "") {
        alert("Si desea cambiar su contraseña, introduzca una nueva contraseña.");
        return false;

        //Si no se ha introducido la contraseña actual pero ha introducido nueva contraseña
    } else if (contraseñaActual === "" && nuevaContraseña != "") {

        alert("Si desea cambiar su contraseña, introduzca su contraseña actual.");
        return false;

        //Si se han rellenado los dos campos pero la nueva contraseña supera los 30 caracteres
    } else if (contraseñaActual != "" && nuevaContraseña != "") {

        if (nuevaContraseña.length > 30) {
            alert("La contraseña no puede sobrepasar los 30 carácteres.");
            return false;
        }
    }

}