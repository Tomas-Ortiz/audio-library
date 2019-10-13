function validarRegistro() {

    var nombre, apellido, correo, usuario, clave, fechaNacimiento;

    //Se reciben los valores de los input ingresados por el usuario en el registro
    nombre = document.getElementById("nombre").value;
    apellido = document.getElementById("apellido").value;
    correo = document.getElementById("correo").value;
    usuario = document.getElementById("user").value;
    clave = document.getElementById("password").value;
    fechaNacimiento = document.getElementById("fechaNac").value;

    //Se establecen las REGEXP necesarias para validar la entrada de datos
    var formatoCorreo = /\w+@\w+\.+[a-z]/;

    var tieneEspacio = /^\s+$/;

    var soloLetras = /^[A-Za-z \s]+$/;

    var alfaNumerico = /^[\w \.]+$/;

    //si algún campo está vacío
    //test es una función que contiene la cadena a comparar con la expresion regular, retorna true si existe coincidencia entre la
    //expresion regular y la cadena, de lo contrario retorna false.

    if (nombre === "" || tieneEspacio.test(nombre) || apellido === "" || tieneEspacio.test(apellido) || correo === "" || usuario === "" || tieneEspacio.test(usuario) || clave === "" || fechaNacimiento === "") {

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

        //si el usuario ingresa caracteres especiales
        //Si es diferente a alfaNumerico (true) entra, sino si es alfanumerico devuelve false y no entra
    } else if (!alfaNumerico.test(usuario)) {

        alert("El usuario no puede contener carácteres especiales.");

        return false;

    } else if (apellido.length > 30 || clave.length > 30) {

        alert("Apellido y contraseña no pueden sobrepasar los 30 carácteres.");

        return false;
    } else if (correo.length > 35) {
        alert("El correo no puede sobrepasar los 35 carácteres.");

        return false;

    } else if (!formatoCorreo.test(correo)) {
        alert("Introduzca un formato correcto para el correo.");

        return false;
    }

}