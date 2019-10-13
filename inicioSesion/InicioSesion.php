<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <title>Iniciar sesión | Audify</title>
    <link rel="stylesheet" href="EstiloInicioSesion.css">

    <script src="ValidacionInicioSesion.js"></script>
</head>

<body>

<?php

//Si existe el token en la cookie del navegador del usuario significa que seleccionó la opción de recordar usuario

if (isset($_COOKIE['token'])) {

    include('/xampp/htdocs/Audify/conexion.php');

    //Se obtiene el token del usuario que por ahora no está identificado

    $tokenUser = $_COOKIE["token"];

    //Se obtiene el usuario a partir del token almacenado en el navegador del mismo

    $query = "SELECT * FROM usuariosaudify WHERE token = '$tokenUser'";

    $preparado = $conex->prepare($query);

    $preparado->execute();

    $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

    //Una vez identificado se asignan los valores de sesión del usuario (nombre de usuario - id)
    $_SESSION['usuario'] = $resultado['nombreUsuario'];
    $_SESSION['id'] = $resultado['id'];

    //Se lo direcciona al inicio de la página
    header("Location: ../Inicio/Inicio.php");
}
?>
<div class="container-fluid">

    <div class="row">

        <div class="col-md-2">

        </div>

        <div class="col-md-6">

            <!-- Se valida la entrada de datos mediante js y posteriormente se lo envía a php-->
            <form id="InicioSesion" action="ValidacionInicioSesion.php" method="POST" onsubmit="return validarInicioSesion();">

                <br>
                <div class="tituloConIcono">
                    <i class="far fa-user-circle fa fa-5x"></i>
                </div>
                <br><br>

                <h1><b>Iniciar sesión</b></h1>

                <p style="color:grey">_________________________</p>

                <label id="LblUsuario">Nombre de usuario</label> <br>
                <div class="inputConIcono">
                    <input id="usuario" type="text" name="usuario" placeholder="Nombre de usuario"
                           required value="" autofocus>
                    <i class="fa fa-user fa-lg fa-x2"></i>
                </div>

                <br>

                <label id="LblContraseña">Contraseña</label> <br>
                <div class="inputConIcono">
                    <input id="contraseña" type="password" name="contraseña" placeholder="Introduzca su contraseña"
                           required value="">
                    <i class="fa fa-lock fa-lg fa-lg"></i>
                </div>

                <div class="Recordar">
                    <label id="LblRecordarme">Recordarme</label>
                    <input name="recordarme" style="position:absolute;height: 20px; right: 75px; top: 409px;" type="checkbox">
                </div>

                <br><br>

                <div class="botonConIcono">
                    <button type="submit">Iniciar sesión</button>
                    <i class="fas fa-sign-in-alt fa-lg fa-x3"></i>
                </div>

            </form>
        </div>

        <div class="col-md-4">
            <div class="Registro">
                <h1>¿No tienes una cuenta?</h1>
                <hr>
                <h3>¡Regístrate, es gratis!</h3>

                <div class="botonConIcono2">
                    <form action="../Registro/Registro.html">
                        <button type="submit">Registrarse</button>
                        <i class="fas fa-user-plus fa-lg fa-x3"></i>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>