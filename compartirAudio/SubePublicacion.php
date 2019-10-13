<?php
include('/xampp/htdocs/Audify/conexion.php');

//$_FILES array asociativo para el manejo de ficheros

//si el archivo ArchivoAudio ha sido subido correctamente al directorio temporal (tmp_name)
if (is_uploaded_file($_FILES['ArchivoAudio']['tmp_name'])) {

    $nombreArchivo = $_FILES['ArchivoAudio']['name'];
    $tipoArchivo = $_FILES['ArchivoAudio']['type'];
    $localizacionTemporal = $_FILES['ArchivoAudio']['tmp_name'];
    $tamañoArchivo = $_FILES['ArchivoAudio']['size'];
    $ruta = "../Audios/";

    //Se especifica nueva ruta que tendrá el fichero subido
    $rutaFichero = $ruta . $nombreArchivo;
    //Se obtiene el contenido del comentario recibido con post
    $comentario = $_POST['comentario'];

    //Si el tamaño del archivo supera el limite (10MB) muestra un mensaje de error
    if ($tamañoArchivo > 10000000) {

        echo "Error, archivo muy grande.";

        //sino, se mueve el archivo subido a la ruta especificada anteriormente (rutaFichero)
    } else if (move_uploaded_file($localizacionTemporal, $rutaFichero)) {

        //Se inicia la sesión para obtener el usuario que está navegando actualmente
        session_start();

        $user = $_SESSION['usuario'];

        //Se establece la zona horaria de Argentina para la fecha y hora
        date_default_timezone_set('America/Argentina/Mendoza');

        //Se establece el formato de fecha y hora con la función date
        $fechaSubida = date('d-m-Y H:i:s');

        //finalmente se inserta una nueva publicación a la BD con toda la información correspondiente
        $query = "INSERT INTO publicacionesaudify (id,usuario,comentario,nombreAudio,ruta,horaFecha,size, tipo) VALUES(null, :usuario, :comentario, :nombreAudio, :ruta, :horaFecha, :size, :tipo)";

        $preparado = $conex->prepare($query);

        $preparado->execute(array(":usuario" => $user, ":comentario" => $comentario, ":nombreAudio" => $nombreArchivo, ":ruta" => $rutaFichero, ":horaFecha" => $fechaSubida, ":size" => $tamañoArchivo, ":tipo" => $tipoArchivo));

    }
    //Si el archivo no se subió correctamente se termina la ejecución con el mensaje del tipo de error
} else {
    die($_FILES['ArchivoAudio']['error']);
}

//Se refresca la página para mostrar la nueva publicación
header('Location: comparteAudio.php');