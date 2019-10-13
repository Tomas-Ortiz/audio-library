<?php
include('/xampp/htdocs/Audify/conexion.php');

//Se obtiene el id del comentario que se dió like
$commentId = $_POST['comentario_id'];

//se suman todos los likes de un comentario que viene dado por el id
$query = "SELECT SUM(like_unlike) AS likesCount FROM megusta_nomegusta WHERE comentario_id=" . $commentId;

$resultado = $conex->prepare($query);

$resultado->execute();

$likes = $resultado->fetch(PDO::FETCH_ASSOC);

//Si existe un valor numérico para likesCount significa que hay al menos 1 registro de like para ese comentario (1 ó 0)
if (isset($likes['likesCount'])) {
    $totalLikes = $likes['likesCount'];
    //Si no existen registros donde se puedan sumar los likes entonces likesCount no se setea y por defecto un coment tiene 0 likes
} else {
    $totalLikes = 0;
}
//Finalmente se devuelve a ajax el total de likes de un comentario
echo $totalLikes;
