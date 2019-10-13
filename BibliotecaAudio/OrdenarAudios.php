<?php
include('/xampp/htdocs/Audify/conexion.php');
include('/xampp/htdocs/Audify/Sesion/validarSesion.php');

//Si el usuario eligió algún tipo de ordenamiento
if (isset($_POST['ordenarPor'])) {

    //Se obtiene el usuario que está navegando actualmente
    $user = $_SESSION['usuario'];

    //Se obtienen todos los audios asociados a ese usuario
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


    //Dependiendo del tipo de ordenamiento se invoca una función especifcándolo
    //ordena todos los registros pero se van mostrando de 5 en 5

    switch ($_POST['ordenarPor']) {

        case "Ascendente":
            $query = "SELECT * FROM audiosaudify WHERE usuario = :user ORDER BY nombre ASC LIMIT :iniciarEn, :audios_por_pagina ";
            //Se almacena el tipo de ordenamiento que seleccionó el usuario, para luego mantenerlo
            $_SESSION['tipoOrdenamiento'] = "Ascendente";
            break;

        case "Descendente":

            $query = "SELECT * FROM audiosaudify WHERE usuario = :user ORDER BY nombre DESC LIMIT :iniciarEn, :audios_por_pagina ";

            $_SESSION['tipoOrdenamiento'] = "Descendente";

            break;

        case "TamañoAudio":
            $query = "SELECT * FROM audiosaudify WHERE usuario = :user ORDER BY size DESC LIMIT :iniciarEn, :audios_por_pagina ";

            $_SESSION['tipoOrdenamiento'] = "TamañoAudio";

            break;

        case "fechaSubida":
            $query = "SELECT * FROM audiosaudify WHERE usuario = :user ORDER BY fechaSubida DESC LIMIT :iniciarEn, :audios_por_pagina ";

            $_SESSION['tipoOrdenamiento'] = "fechaSubida";

            break;

    }

    //se reemplaza los parámetros de la consulta por los valores reales
    $resultado = $conex->prepare($query);

    $resultado->bindParam(":user", $user);
    $resultado->bindParam(":iniciarEn", $iniciarEn, PDO::PARAM_INT);
    $resultado->bindParam(":audios_por_pagina", $audios_por_pagina, PDO::PARAM_INT);

    //Finalmente se ejecuta la consulta
    $resultado->execute();

    //Se recorren e imprimen los audios ya ordenados con un formato HTML

    while ($resul = $resultado->fetch(PDO::FETCH_ASSOC)) {

        echo "<div class=\"dropdown\">

                        <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu1\"
                                data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                            <i> $resul[nombre]</i>
                            <span class=\"caret\"></span>
                        </button>
                        
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenu1\">
                            <li>
                            <a href='$resul[ruta]' download=\" $resul[nombre] \">Descargar</a>
                            </li>
                            <li><a href=\"#\">Escuchar</a></li>
                            
                            <li><a href=\"#\" onclick=\"mostrarInfoAudio('$resul[id]'); return false;\">Información</a></li>
                            
                            <!-- Dependiendo de lo que retorne el script se ejecuta o no el href-->
                            <li role=\"separator\" class=\"divider\"></li>
                            <li><a href=\"EliminaAudio.php?id=$resul[id]\" onclick=\"return confirmarEliminacion();\">Eliminar</a></li>
                        </ul>
                        
                    </div>
           
           <!-- Div donde se muestra la información de un audio cuando se hace clic en Información -->
        <div id='mostrarInfoAudio'>

            </div>";
    }
}