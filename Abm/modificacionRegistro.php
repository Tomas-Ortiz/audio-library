<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
include('/xampp/htdocs/Audify/ValidarRol.php');

//la variable rol se obtiene a partir del archivo ValidarRol, incluido arriba
//si ingresa un admin entonces se muestra el contenido, de lo contrario (user) lo direcciona la inicio

if ($rol == "admin") {

//se recibe el id del usuario como get
    $id = $_GET['id'];

//se selecciona el registro del usuario
    $query = "SELECT * FROM usuariosaudify WHERE id = '$id'";

    $preparado = $conex->prepare($query);

    $preparado->execute();

//se obtiene la información del registro con fetch assoc
    $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
              integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
              crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
              crossorigin="anonymous">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                crossorigin="anonymous"></script>

        <title>Abm de usuarios | Audify</title>

        <script src="validacionActualizacion.js"></script>

    </head>
    <body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 ColumnaIzquierda">
            </div>
            <div class="col-md-8 ColumnaCentro">

                <!-- Al hacer click en actualizar, se ejecuta un script que valida la entrada de datos-->
                <!-- Después de validarlo, los datos se envían a un arhivo para actualizar la información del usuario -->
                <!-- Si el return del script es falso, los datos no se envían y muestra una ventana de error al usuario-->

                <form action="actualizacionRegistro.php?id=<?php echo $resultado['id'] ?>" method="post" onsubmit="return validarActualizacion();">

                    <h3>Nombre</h3> <br>
                    <input id="name" name="nombre" value=" <?php echo $resultado['nombre'] ?>" required>

                    <h3>Apellido</h3><br>
                    <input id="apell" name="apellido" value="<?php echo $resultado['apellido'] ?>" required>

                    <h3>Nombre de usuario</h3><br>
                    <input id="usuario" name="usuario" value="<?php echo $resultado['nombreUsuario'] ?>" required>

                    <h3>Contraseña</h3><br>
                    <input id="pass" type="password" name="claveActual">

                    <h3>Correo electrónico</h3><br>
                    <input id="Mail" type="email" name="correo" value="<?php echo $resultado['correo'] ?>" required>

                    <h3>Fecha de nacimiento</h3><br>
                    <input id="nac" type="date" name="fechaNacimiento"
                           value="<?php echo $resultado['fechaNacimiento'] ?>" required>

                    <h3>Rol</h3><br>
                    <input id="Rol" type="text" name="rol" value="<?php echo $resultado['rol'] ?>" required>

                    <h3>Sexo</h3><br>
                    <label>Masculino</label><input type="radio" id="M" name="sexo" value="M" checked>
                    <label>Femenino</label><input type="radio" id="F" name="sexo" value="F">

                    <br><br>
                    <button type="submit">Actualizar</button>

                </form>
            </div>
            <div class="col-md-2 ColumnaDerecha">
            </div>
        </div>
    </div>

    </body>
    </html>

    <?php
} else {
    header("Location: /Audify/Inicio/Inicio.php");
}
?>

