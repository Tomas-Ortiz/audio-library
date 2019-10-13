<?php
include 'conexion.php';

//la sesión ya ha sido iniciada, por lo que no se especifica session_start

//se obtiene el usuario que está actualmente logeado y se verifica el rol del usuario (admin o user)

$usuario = $_SESSION['usuario'];

$query = "SELECT * FROM usuariosaudify WHERE nombreUsuario = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($usuario));

$resultado = $preparado->fetch(PDO::FETCH_ASSOC);

$rol = $resultado['rol'];

//si el rol del usuario es admin, entonces se habilita el icono de ABM en la parte superior izquierda (con js)

if ($rol == "admin") {
    ?>

    <script>
        document.getElementById('opcionABM').style.display = 'block';
    </script>

    <?php

}