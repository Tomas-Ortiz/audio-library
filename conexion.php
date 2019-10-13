<?php

/*
$conexion = mysqli_connect("localhost", 'root', '', 'mibasededatos');

if (mysqli_connect_error()) {

    die("Error en la conexión: " . mysqli_connect_error());
}
*/
try {
    //Crea una instancia de PDO que representa una conexión a una base de datos
    //el atributo conex guarda la conexión a la BD, y mediante él se puede acceder a los métodos de la clase PDO
    $conex = new PDO('mysql:host=localhost; dbname=mibasededatos', 'root', '');

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}