<?php
include('/xampp/htdocs/Audify/conexion.php');

//$_FILES matriz global para el manejo de ficheros

//si el archivo ArchivoAudio ha sido subido correctamente al directorio temporal (tmp_name)

if (is_uploaded_file($_FILES['ArchivoAudio']['tmp_name'])) {

    //se obtiene toda la información del archivo
    $nombreArchivo = $_FILES['ArchivoAudio']['name'];
    $tipoArchivo = $_FILES['ArchivoAudio']['type'];
    $localizacionTemporal = $_FILES['ArchivoAudio']['tmp_name'];
    $tamañoArchivo = $_FILES['ArchivoAudio']['size'];
    $ruta = "../Audios/";

    //Se especifica nueva ruta que tendrá el fichero subido
    $rutaFichero = $ruta . $nombreArchivo;

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

        //finalmente se inserta un nuevo audio a la BD con toda la información correspondiente
        $query = "INSERT INTO audiosaudify (id,usuario,nombre,size,tipo,ruta,fechaSubida) VALUES(null, :usuario, :nombre, :size, :tipo, :ruta, :fechaSubida)";

        $preparado = $conex->prepare($query);

        $preparado->execute(array(":usuario" => $user, ":nombre" => $nombreArchivo, ":size" => $tamañoArchivo, ":tipo" => $tipoArchivo, ":ruta" => $rutaFichero, ":fechaSubida" => $fechaSubida));

    }
    //Si el archivo no se subió correctamente se termina la ejecución con el mensaje del tipo de error
} else {
    die($_FILES['ArchivoAudio']['error']);
}

header('Location: SubirAudio.php');
