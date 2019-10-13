<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//Se obtiene la nueva información que desea actualizar el usuario

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$claveActual = $_POST['claveActual'];
$nuevaClave = $_POST['nuevaClave'];
$correo = $_POST['correo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];

//Se obtiene el id del usuario que está navegando actualmente, ya que al cambiar su nombre de usuario no se lo encontraría en la BD
$id = $_SESSION['id'];

//Se verifica si ya existe un registro con el nombre de usuario ingresado

$query = "SELECT * FROM `usuariosaudify` WHERE nombreUsuario = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($usuario));

//Se obtienen la cantidad de registros devueltos
$filas = $preparado->rowCount();

//Si no existe ningún usuario con el nombre de usuario ingresado entonces se lo actualiza
if ($filas == 0) {

    // '?' es el parámetro que va a ser reemplazado con los valores especificados en la ejecución

    $query = "UPDATE usuariosaudify SET nombre=?, apellido=?, nombreUsuario=?,correo=?, fechaNacimiento=?,sexo=? WHERE id = '$id'";

    $preparado = $conex->prepare($query);

    $preparado->execute(array($nombre, $apellido, $usuario, $correo, $fechaNacimiento, $sexo));

    //Se actualiza el nombre de usuario de la sesión
    $_SESSION['usuario'] = $usuario;

} else {
    //si hay filas entonces ya existe el nombre de usuario y no se lo actualiza, pero los datos restantes sí

    $query = "UPDATE usuariosaudify SET nombre= :nombre, apellido= :apellido, correo= :correo, fechaNacimiento = :fechaNacimiento,sexo= :sexo WHERE id = '$id'";

    $preparado = $conex->prepare($query);

    $preparado->execute(array(":nombre" => $nombre, ":apellido" => $apellido, ":correo" => $correo, ":fechaNacimiento" => $fechaNacimiento, ":sexo" => $sexo));
}

//si ha ingresado la clave actual entonces desea cambiarla

if ($claveActual != null) {

    //Se encripta la clave actual para compararla posteriormente con la almacenada en la BD
    $claveActualEncriptada = md5($claveActual);

    //Se busca un registro donde el nombre de usuario y la clave coincidan

    $query = "SELECT nombreUsuario,clave FROM usuariosaudify WHERE nombreUsuario = ? AND clave = ?";

    $preparado = $conex->prepare($query);

    $preparado->execute(array($usuario, $claveActualEncriptada));

    $resultado = $preparado->fetch(PDO::FETCH_ASSOC);


    //Se verifica que la clave ingresada por el usuario y el nombre de usuario coincidan con el registro devuelto
    if ($claveActualEncriptada == $resultado['clave'] && $usuario == $resultado['nombreUsuario']) {

        //si ha ingresado la nueva clave entonces y supera los 2 carácteres

        if ($nuevaClave != null && strlen($nuevaClave) > 2) {

            //Se encripta la nueva clave y se setea para ese usuario

            $nuevaClaveEncriptada = md5($nuevaClave);

            $query = "UPDATE usuariosaudify SET clave= ? WHERE id = '$id'";

            $preparado = $conex->prepare($query);

            $preparado->execute(array($nuevaClaveEncriptada));
        }
    }
}

header('location: PerfilUsuario.php');

