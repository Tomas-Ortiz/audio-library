<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//se recibe el id, el contenido del comentario, el id de la publicación y el nobmre del usuario que lo realizó
//El comentario id hace referencia al comentario padre de un comentario, si no tiene entonces es 0
$commentId = $_POST['comentario_id'];
$comment = $_POST['comment'];
$publi_id = $_POST['publi_id'];
$commentSenderName = $_SESSION['usuario'];

//Se establece la zona horaria de Argentina (fecha y hora)

date_default_timezone_set('America/Argentina/Mendoza');

//Se establece el formato de la fecha y hora
$date = date('Y-m-d H:i:s');

//Se agrega un comentairo nuevo asociado a una publicación
$query = "INSERT INTO comentariosaudify(parent_comentario_id,comment,comment_sender_name,date, publicacion_id) VALUES ('" . $commentId . "','" . $comment . "','" . $commentSenderName . "','" . $date . "', ".$publi_id.")";

$result = $conex->prepare($query);

$result->execute();

//Se devuelve el registro (array asociativo) a ajax para mostrarlo

$resultado = $result->fetch(PDO::FETCH_ASSOC);

echo $resultado;
