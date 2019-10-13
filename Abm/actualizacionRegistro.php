<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
include ('\xampp\htdocs\Audify\validarRol.php');

if ($rol == "admin") {

//se recibe el id del usuario como get y toda la información restante como post del form
    $id = $_GET['id'];

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $claveActual = $_POST['claveActual'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $sexo = $_POST['sexo'];
    $rol = $_POST['rol'];

    $query = "SELECT * FROM `usuariosaudify` WHERE nombreUsuario = ?";

    $preparado = $conex->prepare($query);

    $preparado->execute(array($usuario));

//se obtiene el número de filas que tengan como nombre de usuario el ingresado
    $filas = $preparado->rowCount();

//si no hay filas entonces no existe ningún usuario con ese nombre, entonces puede usar dicho nombre de usuario
    if ($filas == 0) {

        //se actualizan los datos del usuario
        $query = "UPDATE usuariosaudify SET nombre=?, apellido=?, nombreUsuario=?,correo=?, fechaNacimiento=?,sexo=?, rol =? WHERE id = '$id'";

        $preparado = $conex->prepare($query);

        $preparado->execute(array($nombre, $apellido, $usuario, $correo, $fechaNacimiento, $sexo, $rol));

    } else {

        //si hay filas entonces ya existe el nombre de usuario y no se lo actualiza, pero los datos restantes sí

        $query = "UPDATE usuariosaudify SET nombre= :nombre, apellido= :apellido, correo= :correo, fechaNacimiento = :fechaNacimiento,sexo= :sexo, rol = :rol WHERE id = '$id'";

        $preparado = $conex->prepare($query);

        $preparado->execute(array(":nombre" => $nombre, ":apellido" => $apellido, ":correo" => $correo, ":fechaNacimiento" => $fechaNacimiento, ":sexo" => $sexo, ":rol" => $rol));
    }

//si ha ingresado la clave actual entonces desea cambiarla
    if ($claveActual != null) {

        //si la cantidad de caracteres es mayor a 5 se puede actualizar
        if (strlen($claveActual) > 5) {

            //no se verifica que la clave actual sea correcta ya que lo hace el admin

            //se obtiene la clave actual del usuario y se la encripta en md5
            $claveActualEncriptada = md5($claveActual);

            //finalmente se actualiza la clave para ese usuario
            $query = "UPDATE usuariosaudify SET clave= ? WHERE id = '$id'";

            $preparado = $conex->prepare($query);

            $preparado->execute(array($claveActualEncriptada));
        }
    }

    header("Location: /Audify/Abm/abmUsuarios.php");
} else{
    header("Location: /Audify/Inicio/Inicio.php");
}