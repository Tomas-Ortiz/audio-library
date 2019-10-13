<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//Se obtiene el comentario al cual se ha dado like y al usuario que lo dió
$commentId = $_POST['comentario_id'];
$usuario = $_SESSION['usuario'];
$totalLikes = "";

//Se recibe como post el valor que representa si dió like o lo quitó
//1 significa que dio like y 0 significa que quitó el like
if ($_POST['like_unlike'] == 1) {
    $likeOrUnlike = 1;
} else {
    $likeOrUnlike = 0;
}

//Se busca si ya existe un registro de like de ese usuario para ese comentario
$query = "SELECT * FROM megusta_nomegusta WHERE user = '$usuario' AND  comentario_id = '$commentId'";

$result = $conex->prepare($query);
$result->execute();

//Se obtiene el número de registros devueltos
$row = $result->rowCount();

//si ya existe un registro de like de ese usuario para ese comentario, se lo actualiza (1 ó 0)
if ($row > 0) {

    $query = "UPDATE megusta_nomegusta SET like_unlike = '$likeOrUnlike' WHERE user = '$usuario' AND  comentario_id = '$commentId'";

    //si no existe ningún registro de like para ese comentario y usuario, se lo registra
} else {
    $query = "INSERT INTO megusta_nomegusta(user,comentario_id,like_unlike) VALUES ('" . $usuario . "','" . $commentId . "','" . $likeOrUnlike . "')";
}

//se ejecuta la consulta (cualquiera de las 2)
$result = $conex->prepare($query);
$result->execute();

//Se suma todos los likes de un comentario específico (mediante el id) y el valor se obtiene a partir de la variable likesCount
$query = "SELECT SUM(like_unlike) AS likesCount FROM megusta_nomegusta WHERE comentario_id=" . $commentId;

$result = $conex->prepare($query);
$result->execute();

$likes = $result->fetch(PDO::FETCH_ASSOC);

$totalLikes = $likes['likesCount'];

//Finalmente se devuelve a ajax el total de likes de un comentario
echo $totalLikes;

