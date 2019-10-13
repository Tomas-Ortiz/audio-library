function validarInicioSesion() {

    var usuario, contraseña;

    //Se obtienen los valores ingresados de los input del formulario
    usuario = document.getElementById("usuario").value;
    contraseña = document.getElementById("contraseña").value;

    //Se utiliza una REGEXP para verificar si la entrada de datos tiene espacios
    tieneEspacio = /^\s+$/;

    //Si el usuario ingresó espacio/s o la contraseña que ingresó está vacía
    if (tieneEspacio.test(usuario) || contraseña === "") {
        alert("Todos los campos son obligatorios.");

        return false;

    } else if (usuario.length > 20) {

        alert("El usuario no debe tener más de 20 carácteres.");

        return false;

    } else if (contraseña.length > 30) {
        alert("La contraseña no debe tener más de 30 carácteres.");
        return false;
    }

}