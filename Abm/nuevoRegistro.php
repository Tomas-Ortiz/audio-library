<?php
include '\xampp\htdocs\Audify\Sesion\validarSesion.php';
include '\xampp\htdocs\Audify\validarRol.php';

//la variable rol se obtiene a partir del archivo ValidarRol, incluido arriba
//si ingresa un admin entonces se muestra el contenido, de lo contrario (user) lo direcciona la inicio
if ($rol == "admin") {
    ?>
    <!-- Se implementa un script, que es el que valida el registro-->
    <script src="../Registro/ValidacionRegistro.js"></script>

    <!--Se lleva a cabo un registro de un nuevo usuario, se valida la entrada con javascript y
    posteriormente se lo envía con post a un archivo para agregarlo -->

    <form action="../Registro/ValidacionRegistro.php" method="POST" onsubmit="return validarRegistro();">

        <h1>Agregar usuario</h1>
        <hr>
        <label>Nombre completo</label>
        <input id="nombre" name="nombre" placeholder="Nombre completo" required autofocus>
        <br>
        <br>

        <label>Apellido</label>
        <input id="apellido" name="apellido" placeholder="Apellido" required>
        <br>
        <br>

        <label>Nombre de usuario</label>
        <input id="user" name="nombreUsuario" placeholder="Nombre de usuario" required>
        <br>
        <br>

        <label>Contraseña</label>
        <input id="password" type="password" name="contraseña" required placeholder="Contraseña">
        <br>
        <br>

        <label>Correo electrónico</label>
        <input id="correo" type="text" name="correo" required placeholder="exampletest@hotmail.com">
        <br>
        <br>

        <label>Fecha de nacimiento</label>
        <input id="fechaNac" type="date" name="fechaNacimiento" max="2018-12-31" required>
        <br>
        <br>

        <label>Sexo</label>
        <label>Masculino</label><input type="radio" id="m" name="sexo" value="M" checked>
        <label>Femenino</label><input type="radio" id="f" name="sexo" value="F">
        <br>
        <br>

        <button type="submit">Agregar registro</button>
    </form>

    <?php
} else {
    header("Location: /Audify/Inicio/Inicio.php");
}
?>