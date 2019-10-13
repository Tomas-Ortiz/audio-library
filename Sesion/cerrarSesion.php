<?php

//reanuda la sesión existente del usuario, para utilizar la variable global $_SESSION (array asociativo)
//Devuelve true si la sesion fue iniciada correctamente, de lo contrario false

session_start();

//se destruye la sesión actual existente del usuario, se ejecuta cuando el mismo cierra sesión

session_destroy();

//Una vez cerrada la sesión, se destruye la cookie, por lo que ya no se va a recordar al usuario cuando inicie sesión
//token es el nombre de la cookie, que se la asigna un valor nulo y se indica que ya ha expirado
//path / significa que la destrucción de la cookie va afectará a todos los archivos de la página

setcookie('token',null,-1,'/');

header("Location: ../inicioSesion/InicioSesion.php");