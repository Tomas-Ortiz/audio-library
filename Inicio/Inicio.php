<?php
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <title>Inicio | Audify</title>

    <link href="EstiloInicio.css" rel="stylesheet">

</head>
<body>

<?php
include('/xampp/htdocs/Audify/cabecera.php');
//Se verifica el rol del admin, para activar o no el icono de ABM
include('/xampp/htdocs/Audify/ValidarRol.php');
?>

<!-- Página estática -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 ColumnaIzquierda">
        </div>
        <div class="col-md-8 ColumnaCentro">

            <!-- Cada titulo lleva un name que lo identifica, para que en el pie de página se direccione a un título determinado -->
            <h1>Bienvenido a Audify</h1>
            <hr>
            <a name="Que_es"><h3>¿Qué es?</h3></a>
            <p>Audify es una pagina de almacenamiento, descarga y compartimiento de audios. <br></p>
            <hr>
            <a name="Como_funciona"><h3>¿Cómo funciona?</h3></a>
            <p>Cada usuario para acceder, necesita registrarse previamente.<br>
                En el registro, el nombre de usuario no se puede repetir, y se tienen que ingresar datos validos.<br>
                Una vez iniciado sesion, el usuario tiene a su disposicion una biblioteca personal de audios, donde
                podra almacenar todos sus audios subidos, con cualquier extension, y que no supere los 10MB.<br>
                A su vez, podra compartir publicaciones de audio y ver las de otras personas. Podra descargar o incluir
                en la biblioteca un audio publicado, que no disponga en su biblioteca.<br>
                Tambien podrá acceder al perfil y modificar datos personales.</p>
            <hr>
            <a name="Secciones"><h3>Secciones de la página</h3></a>
            <p>Subir: Seleccionar un archivo y agregarlo a tu biblioteca personal.<br>
                Biblioteca: Almacenar, ver informacion, eliminar,ordenar y buscar audio/s subido/s.<br>
                Compartir: Compartir o ver publicaciones de audios de otras personas. Se permite descargar o incluir a
                tu biblioteca un audio de otra persona. <br>
                Mi perfil: Ver y modificar informacion del usuario.<br>
            </p>
            <hr>
            <a name="Subir_audio"><h3>¿Cómo subir audios?</h3></a>
            <p>Haciendo click en 'Subir', en el menu de navegacion, podras acceder a la seccion
                donde podras subir tus audios. Haciendo click en 'Seleccionar archivo' se te abrira una ventana y te
                mostrara todos los audios almacenados en tu dispositivo. No podras subir audios de tamaño superior a
                10MB.</p>
            <hr>
            <a name="Almacenar_audio"><h3>¿Cómo almacenar audios?</h3></a>
            <p>Después de seleccionar el archivo de audio de su dispositivo, tendá que hacer click en el botón 'Agregar
                a mi biblioteca', ubicado debajo del boton 'Seleccionar archivo'.
                No podrás agregar a un audio a tu biblioteca si no ha seleccionado un archivo de audio previamente.</p>
            <hr>
            <a name="Descargar_audio"><h3>¿Cómo descargar audios?</h3></a>
            <p>Para descargar audios se puede hacer en la seccion de 'biblioteca' o 'compartir', haciendo click
                izquierdo en un audio subido o publicado, y haciendo click en el boton de 'descargar'.
                Automaticamente se descargara dicho audio en su dispositivo.</p>
            <hr>
            <a name="Compartir_audio"><h3>¿Cómo compartir audios?</h3></a>
            <p>Haciendo click en la seccion 'Compartir',ubicado en el menu de navegacion, se te abrira la pagina donde
                podras compartir tus audios con todo el mundo. Tendras que seleccionar un archivo de audio y
                opcionalmente escribir
                un comentario, y hacer click en el boton 'Publicar'.</p>
            <hr>
            <a name="Mas_informacion"><h3>Mas información</h3></a>
            <p>Pagina desarrollada por Tomas Ortiz, como proyecto de Universidad.</p>
            <hr>
        </div>
        <div class="col-md-2 ColumnaDerecha">
        </div>
    </div>

</div>

<?php
include('/xampp/htdocs/Audify/PiePagina.php');
?>

</body>
</html>