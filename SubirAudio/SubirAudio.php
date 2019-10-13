<?php
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <title>Subir audio | Audify</title>

    <link href="../Inicio/EstiloInicio.css" rel="stylesheet">

</head>
<body>
<?php
//cabecera es el archivo que establece el diseño de la cabecera de la página
include('/xampp/htdocs/Audify/cabecera.php');
include('/xampp/htdocs/Audify/ValidarRol.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 ColumnaIzquierda">
        </div>
        <div class="col-md-8 ColumnaCentro">

            <h1>Subir archivos de Audio</h1>

            <!--Cuando el usuario selecciona un archivo de audio y lo agrega, se lo manda a validar y subir el archivo -->
            <!--El atributo enctype especifica cómo se deben codificar los datos de formulario al enviarlos al servidor,
            se lo utiliza para especificar que en el formulario se subirá un archivo -->

            <form action="ValidacionSubida.php" method="post" enctype="multipart/form-data">

                <br>
                <!-- Se aceptan todas las extensiones de audio y el tamaño máximo permitido es de 10MB-->
                <input type="file" name="ArchivoAudio" accept="audio/*" maxlength="10000000" required>
                <br>
                <input style="margin-bottom: 25%; margin-top: 5%; text-align: center" type="submit" name="Enviado" value="Agregar a mi biblioteca">

            </form>
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