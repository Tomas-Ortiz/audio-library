<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');
include('/xampp/htdocs/Audify/ValidarRol.php');

//la variable rol se obtiene a partir del archivo ValidarRol, incluido arriba
//si ingresa un admin entonces se muestra el contenido, de lo contrario (user) lo direcciona al inicio

if ($rol == "admin") {
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

        <script src="../BibliotecaAudio/confirmacionMensaje.js"></script>

        <link href="estiloABM.css" rel="stylesheet">

    </head>
    <body>

    <!-- Los usuarios se muestran a través de una tabla-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <u><h2>ABM de usuarios</h2></u>
                <h3>Permisos de administrador</h3>
                <hr>
                <table>
                    <tr>
                        <!-- colspan define el numero de columnas que debe abarcar una celda-->
                        <th colspan="10" style="text-align: center">Usuarios registrados</th>
                    </tr>
                    <tr>
                        <!-- columnas-->
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Correo electrónico</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Rol</th>
                        <th style="background-color: lightgray"><a class="Agregar" href="nuevoRegistro.php">Nuevo</a></th>
                    </tr>

                    <?php
                    //se seleccionan y se muestran todos los usuarios con respectiva información
                    $query = "SELECT * FROM usuariosaudify";
                    $resultado = $conex->prepare($query);
                    $resultado->execute();

                    while ($registros = $resultado->fetch(PDO::FETCH_ASSOC)) {

                        ?>
                        <tr>
                            <td><?php echo $registros['id'] ?></td>

                            <td><?php echo $registros['nombre'] ?></td>

                            <td><?php echo $registros['apellido'] ?></td>

                            <td><?php echo $registros['nombreUsuario'] ?></td>

                            <td><?php echo $registros['clave'] ?></td>

                            <td><?php echo $registros['correo'] ?></td>

                            <td><?php echo $registros['fechaNacimiento'] ?></td>

                            <td><?php echo $registros['sexo'] ?></td>

                            <td><?php echo $registros['rol'] ?></td>

                            <!--Se envia el id del registro en la Url (get) -->

                            <td style="background-color: lightgray"><a class="Modificar" href="modificacionRegistro.php?id=<?php echo $registros['id'] ?>">Modificar</a>
                            </td>
                            <td style="background-color: lightgray"><a class="Eliminar" href="eliminaRegistro.php?id=<?php echo $registros['id'] ?>" onclick="return confirmarEliminacion();">Eliminar</a>
                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button class="irInicio"><a href="../Inicio/Inicio.php">Ir a inicio</a></button>
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