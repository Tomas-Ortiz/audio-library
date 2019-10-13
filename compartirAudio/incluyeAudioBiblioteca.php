<?php
include('\xampp\htdocs\Audify\conexion.php');
include('\xampp\htdocs\Audify\Sesion\validarSesion.php');

//Se obtiene el id de la publicación del audio que se desea incluir
$id = $_GET['id'];

//Se obtiene el usuario que está navegando actualmente en la página
$usuario = $_SESSION['usuario'];

$query = "SELECT * FROM publicacionesaudify WHERE id = '$id'";

$resultado = $conex->prepare($query);

$resultado->execute();

$resul = $resultado->fetch(PDO::FETCH_ASSOC);

//Se obtiene toda la información relacionada al audio que se desea incluir
$nombreArchivo = $resul['nombreAudio'];
$tamañoArchivo = $resul['size'];
$tipoArchivo = $resul['tipo'];
$rutaFichero = $resul['ruta'];

//Se verifica que el usuario no tenga ya ese audio en su biblioteca
$query = "SELECT * FROM audiosaudify WHERE usuario = ? AND nombre = ?";

$resultado = $conex->prepare($query);

$resultado->execute(array($usuario, $nombreArchivo));

//Si hay un registro que coincide con el audio y el usuario entonces se envía un error
if ($resultado->rowCount() > 0) {

    header('Location: comparteAudio.php?error=1');

    //Si no hay ningún registro que coincida con el audio y el usuario
} else {

    //Se establece la zona horaria de Argentina (hora y fecha)
    date_default_timezone_set('America/Argentina/Mendoza');

    //Se establece el formato de fecha y hora con la función date
    $fechaSubida = date('d-m-Y H:i:s');

    //Se inserta ese audio para el usuario, con toda la información correspondiente
    $query = "INSERT INTO audiosaudify (id,usuario,nombre,size,tipo,ruta,fechaSubida) VALUES(null, :usuario, :nombre, :size, :tipo, :ruta, :fechaSubida)";

    $preparado = $conex->prepare($query);

    $preparado->execute(array(":usuario" => $usuario, ":nombre" => $nombreArchivo, ":size" => $tamañoArchivo, ":tipo" => $tipoArchivo, ":ruta" => $rutaFichero, ":fechaSubida" => $fechaSubida));

    //Si lo incluye, lo direcciona a la página 1 de su biblioteca
    header('Location:\Audify\BibliotecaAudio\BibliotecaAudios.php?pagina=1');
}