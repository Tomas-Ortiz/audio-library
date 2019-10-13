function confirmarEliminacion() {

    //el método confirm devuelve valor booleano: true en caso de aceptar y false en caso de cancelar
    //El resultado se almacena en una variable

    var respuesta = confirm("¿Estás seguro que deseas eliminarlo?");

    if (respuesta) {
        alert("Se ha eliminado correctamente");
        return true;
    } else {
        return false;
    }
}
