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

    <link href="../Inicio/EstiloInicio.css" rel="stylesheet">

    <link href="EstiloPerfilUsuario.css" rel="stylesheet">

    <title>Mi perfil | Audify</title>

    <script src="ValidacionActualizarPerfil.js"></script>

</head>

<script type="text/javascript">

    //Por defecto, al ingresar en la página se muestra la información de perfil
    mostrarInformacionPerfil();

    //Función de js que se encarga de obtener los 2 section mediante el id y mostrarlo u ocultarlo en función de lo seleccionado
    function mostrarInformacionPerfil() {
        document.getElementById("EditarPerfil").style.display = "none";
        document.getElementById("InformaciónPerfil").style.display = "block";
    }

    function mostrarEditarPerfil() {
        document.getElementById("InformaciónPerfil").style.display = "none";
        document.getElementById("EditarPerfil").style.display = "block";
    }

    function confirmarActualizacion() {

        //Confirm devuelve un valor booleano, true si aceptó y false si canceló
        var respuesta = confirm("¿Estás seguro que deseas actualizar el perfil?");

        if (respuesta) {
            alert("Tu información se ha actualizado correctamente");
            return true;
        } else {
            return false;
        }
    }

</script>

<body>

<?php
//Se obtiene el usuario que está navegando actualmente
$usuario = $_SESSION['usuario'];

include('/xampp/htdocs/Audify/cabecera.php');
include('/xampp/htdocs/Audify/ValidarRol.php');
include('/xampp/htdocs/Audify/conexion.php');

//Se obtiene toda la información de dicho usuario

$query = "SELECT * FROM usuariosaudify WHERE nombreUsuario = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($usuario));

$resultado = $preparado->fetch(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-2 ColumnaIzquierda">

        </div>
        <div class="col-md-8 ColumnaCentro">

            <br>
            <h1>Perfil de usuario</h1>

            <!-- Si se hace click en uno se oculta el otro-->
            <nav id="NavPerfil">
                <ul>
                    <li><a href="#" onclick="mostrarInformacionPerfil(); return false;">Información de Perfil</a></li>
                    <li><a href="#" onclick="mostrarEditarPerfil(); return false;">Editar perfil</a></li>
                </ul>
            </nav>

            <!-- Si el usuario desea ver su información de perfil se activa dicha sección -->

            <section id="InformaciónPerfil">
                <h3>Nombre</h3> <br>
                <label><?php echo $resultado['nombre'] ?></label>
                <h3>Apellido</h3><br>
                <label><?php echo $resultado['apellido'] ?></label>
                <h3>Nombre de usuario</h3><br>
                <label><?php echo $resultado['nombreUsuario'] ?></label>
                <h3>Contraseña</h3><br>
                <label>*************************</label>
                <h3>Correo electrónico</h3><br>
                <label><?php echo $resultado['correo'] ?></label>
                <h3>Fecha de nacimiento</h3><br>
                <label><?php echo $resultado['fechaNacimiento'] ?></label>
                <h3>Sexo</h3><br>
                <label><?php echo $resultado['sexo'] ?></label>
            </section>

            <!-- Si el usuario desea modificar su información de perfil se activa dicha sección-->

            <section id="EditarPerfil">

                <!-- Se valida la entrada de datos con js y posteriormente se envía a php para actualizar-->
                <!-- Los input se muestran con la información del usuario-->
                <form action="ActualizarPerfil.php" method="post" onsubmit="return validarActualizacionPerfil();">

                    <h3>Nombre</h3> <br>
                    <input id="nomb" name="nombre" value=" <?php echo $resultado['nombre'] ?>" required>

                    <h3>Apellido</h3><br>
                    <input id="apell" name="apellido" value="<?php echo $resultado['apellido'] ?>" required>

                    <h3>Nombre de usuario</h3><br>
                    <input id="nombreUsuario" name="usuario" value="<?php echo $resultado['nombreUsuario'] ?>" required>

                    <h3>Contraseña actual</h3><br>
                    <input id="contraseñaActual" type="password" name="claveActual" placeholder="Tu contraseña actual">

                    <h3>Nueva contraseña</h3><br>
                    <input id="nuevaContraseña" type="password" name="nuevaClave" placeholder="Tu nueva contraseña">

                    <h3>Correo electrónico</h3><br>
                    <input id="mail" type="email" name="correo" value="<?php echo $resultado['correo'] ?>" required>

                    <h3>Fecha de nacimiento</h3><br>

                    <input id="fecha_nac" type="date" name="fechaNacimiento"
                           value="<?php echo $resultado['fechaNacimiento'] ?>" required>

                    <h3>Sexo</h3><br>
                    <label>Masculino</label><input type="radio" id="m" name="sexo" value="M" checked>
                    <label>Femenino</label><input type="radio" id="f" name="sexo" value="F">

                    <br><br>
                    <!-- En el momento de actualizar se requiere la confirmación del usuario -->
                    <!-- Si devuelve false el formulario no se envía -->
                    <button type="submit" onclick="return confirmarActualizacion();">Actualizar</button>
                </form>
            </section>
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