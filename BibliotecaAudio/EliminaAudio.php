<?php
include('/xampp/htdocs/Audify/conexion.php');

//Se obtiene por la url el id del audio a eliminar
$id = $_GET['id'];

$query = "SELECT * FROM audiosaudify WHERE id = '$id'";

$preparado = $conex->prepare($query);

$preparado->execute();

//se obtiene la información del audio y se guarda en la variable resultado
$resultado = $preparado->fetch(PDO::FETCH_ASSOC);

//se borra el fichero de la ruta especificada del audio
unlink($resultado['ruta']);

//Se elimina el audio de la BD
$query = "DELETE FROM audiosaudify WHERE id ='$id'";

$preparado = $conex->prepare($query);

$preparado->execute();

//Finalmente lo direcciona a la página 1
header('location: BibliotecaAudios.php?pagina=1');