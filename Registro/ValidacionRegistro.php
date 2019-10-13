<?php
include('/xampp/htdocs/Audify/conexion.php');

//Se reciben los datos del registro mediante post

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['nombreUsuario'];
$contraseña = $_POST['contraseña'];
$correo = $_POST['correo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$sexo = $_POST['sexo'];

//Se ecnripta la contraseña con el algoritmo md5

$claveEncriptada = md5($contraseña);

//Se hace la consulta para verificar que no exista un usuario con el mismo nombre de usuario

$query = "SELECT nombreUsuario FROM `usuariosaudify` WHERE nombreUsuario = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($usuario));

//Se obtienen la cantidad de filas que devolvió la consulta
$filas = $preparado->rowCount();

//Si no hay un usuario registrado con el nombre de usuario ingresado
if ($filas == 0) {

    //Se agrega un nuevo registro al a BD
    $query = "INSERT INTO usuariosaudify (id,nombre,apellido,nombreUsuario,clave,correo,fechaNacimiento,sexo, rol) VALUES(null,:nombre,:apellido,:usuario,:claveEncriptada,:correo,:fechaNacimiento,:sexo, :rol)";

    $preparado = $conex->prepare($query);

    $preparado->execute(array(":nombre" => $nombre, ":apellido" => $apellido, ":usuario" => $usuario, ":claveEncriptada" => $claveEncriptada, ":correo" => $correo, ":fechaNacimiento" => $fechaNacimiento, ":sexo" => $sexo, ":rol" => "user"));

    //Se inicia la sesión para utilizar $_SESSION
    session_start();

    //si no existe una sesión entonces se lo direcciona al inicio de sesión
    if (!isset($_SESSION['usuario'])) {
        header("Location: /Audify/inicioSesion/InicioSesion.php");
    } else {
        //si existe entonces un admin está agregando registros, y después de registrarlo lo direcciona al Abm
        header("Location: /Audify/Abm/AbmUsuarios.php");
    }

    //Si ya existe un usuario registrado con el nombre de usuario ingresado, lo devuelve al registro
} else {
    header("Location: Registro.html");
}
