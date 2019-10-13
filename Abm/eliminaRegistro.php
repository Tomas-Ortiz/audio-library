<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
include('/xampp/htdocs/Audify/ValidarRol.php');

//la variable rol se obtiene a partir del archivo ValidarRol, incluido arriba
//si ingresa un admin entonces se muestra el contenido, de lo contrario (user) lo direcciona la inicio

if ($rol == "admin") {
//Se obtiene el id del usuario y se obtienen los datos
    $id = $_GET['id'];

    $query = "SELECT * FROM usuariosaudify WHERE id = '$id'";

    $resultado = $conex->prepare($query);

    $resultado->execute();

    $resul = $resultado->fetch(PDO::FETCH_ASSOC);

//Se obtiene el nombre de usuario
    $usuario = $resul['nombreUsuario'];

//Se elimina el usuario
    $query = "DELETE FROM usuariosaudify WHERE id = '$id'";

    $resultado = $conex->prepare($query);

    $resultado->execute();

//Se elimina los audios relacionados al usuario, para ahorrar memoria en el servidor

    $query = "DELETE FROM audiosaudify WHERE usuario = ?";

    $resultado = $conex->prepare($query);

    $resultado->execute(array($usuario));

    header('Location: AbmUsuarios.php');
} else {
    header("Location: /Audify/Inicio/Inicio.php");
}