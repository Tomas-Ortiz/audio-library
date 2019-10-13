<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//Se obtiene el usuario que está navegando actualmente y el id de la publicación
$usuario = $_SESSION['usuario'];
$publi_id = $_GET['publi_id'];

//CONSULTA A DOS TABLAS A LA VEZ (comentariosaudify y megusta_nomegusta)

//se obtiene la lista de comentarios padres e hijos ordenada, concatenada con sus respectivos likes
//Se seleccionan solo los comentarios de una publicacion especifica, que viene dada por el id
$query = "SELECT comentariosaudify.*,megusta_nomegusta.like_unlike FROM comentariosaudify LEFT JOIN megusta_nomegusta ON comentariosaudify.comentario_id = megusta_nomegusta.comentario_id AND user ='$usuario' WHERE publicacion_id = '$publi_id' ORDER BY parent_comentario_id asc, comentario_id asc";

$result = $conex->prepare($query);

$result->execute();

//se declara un array de los registros obtenidos
$record_set = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    //A partir del resultado de la consulta se ordenan los registros
    //Se insertan los registros (row) al final del array (record_set)
    array_push($record_set, $row);
}

//El resultado del array record_set ya ordenado se codifica y devuelve en formato JSON para ser mostrado
echo json_encode($record_set);
