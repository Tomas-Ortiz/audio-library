<?php

//reanuda la sesión existente del usuario, para utilizar la variable global $_SESSION (array asociativo)
//Devuelve true si la sesion fue iniciada correctamente, de lo contrario false

session_start();

//Si la sesión del usuario no está seteada (no ha iniciado sesión) entonces lo direcciona al inicio de sesión

if (!isset($_SESSION['usuario'])) {

    header("Location: ../inicioSesion/InicioSesion.php");

}