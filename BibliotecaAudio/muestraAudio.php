<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//Se obtiene el usuario que está navegando actualmente
$user = $_SESSION['usuario'];

$query = "SELECT * FROM audiosaudify WHERE usuario = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($user));

//Se obtiene el total de audios que tiene dicho usuario
$totalRegistros = $preparado->rowCount();

//Se especifica la cantidad de audios por página
$audios_por_pagina = 5;

//Se calcula la cantidad de páginas necesarias según el total de audios dividido 5
$cant_paginas = $totalRegistros / 5;

//ceil método que sirve para redondear para arriba
//si sale 4,3 redondear a 5 páginas
$cant_paginas = ceil($cant_paginas);

//Cálculo para saber desde que audio se tiene que traer a la página
//Se va sumando de 5 en 5
$iniciarEn = ($_SESSION['paginaActual'] - 1) * $audios_por_pagina;

//Se hace la consulta con la cláusula LIMIT, especificando desde qué registro inicia y cuántos registros tiene que traer
$query = "SELECT * FROM audiosaudify WHERE usuario = :user LIMIT :iniciarEn, :audios_por_pagina";

$resultado = $conex->prepare($query);

//Se reemplaza los parámetros de la consulta por los valores reales y se convierten al tipo de dato correcto

$resultado->bindParam(":user", $user);
$resultado->bindParam(":iniciarEn", $iniciarEn, PDO::PARAM_INT);
$resultado->bindParam(":audios_por_pagina", $audios_por_pagina, PDO::PARAM_INT);

//si existe la consulta y no está vacía
if (isset($_POST['busqueda']) && !$_POST['busqueda'] == "") {

    //se guarda la búsqueda realizada
    $busqueda = $_POST['busqueda'];

    //Realiza la consulta del audio buscado a la BD de un usuario en concreto
    //la cláusula LIKE se usa para buscar registros
    //Dentro de % % se especifica un patrón de búsqueda
    //Devuelve aquellos registros que contengan la cadena especificada
    $query = "SELECT * FROM audiosaudify WHERE usuario = ? and(nombre LIKE ('%' ? '%'))";

    $resultado = $conex->prepare($query);

    $resultado->execute(array($user, $busqueda));

    //Si se borró totalmente el input de búsqueda se ejecuta la consulta que realiza la paginación de los audios
} else {
    $resultado->execute();
}

//Si existe al menos un registro
if ($resultado->rowCount() > 0) {

    //Se recorren e imprimen los audios con un formato HTML
    while ($resul = $resultado->fetch(PDO::FETCH_ASSOC)) {

        echo "<div class=\"dropdown\">

                        <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\"
                                data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                            <i> $resul[nombre]</i>
                            <span class=\"caret\"></span>
                        </button>
                        
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">
                        
                            <li><a href='$resul[ruta]' download=\" $resul[nombre] \">Descargar</a></li>
                            
                            <li><a href=\"#\">Escuchar</a></li>
                            
                            <li><a href=\"#\" data-toggle =\"modal\" onclick=\"mostrarInfoAudio('$resul[id]'); return false;\" >Información</a></li>
                            
                            <!-- Dependiendo de lo que retorne el script se ejecuta o no el href-->
                            <li role=\"separator\" class=\"divider\"></li>
                            <li><a href=\"EliminaAudio.php?id=$resul[id]\" onclick=\"return confirmarEliminacion();\">Eliminar</a></li>
                        </ul>
                    </div>
                    
        <!-- Div donde se muestra la información de un audio cuando se hace clic en Información -->
        <div id='mostrarInfoAudio'>

            </div>";

    }
    //Si no hay registros
} else {
    ?>
    <h2>No hay coincidencias a mostrar</h2>
    <?php
}

