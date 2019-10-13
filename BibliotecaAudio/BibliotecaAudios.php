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

//Paginación

//Se especifica la cantidad de audios por página
$audios_por_pagina = 5;

//Se calcula la cantidad de páginas necesarias según el total de audios dividido 5
$cant_paginas = $totalRegistros / 5;

//ceil método que sirve para redondear para arriba
//si sale 4,3 redondear a 5 páginas
$cant_paginas = ceil($cant_paginas);

//si existe una página en la url
if (isset($_GET['pagina'])) {

    //se obtiene la página actual
    $_SESSION['paginaActual'] = $_GET['pagina'];
}

//si se ingresa una url sin especificar ninguna página o supera el numero de páginas existentes y existe 1 audio mínimo
//Lo direcciona a la página uno por defecto
if ((!$_GET || $_GET['pagina'] > $cant_paginas || $_GET['pagina'] < 1) && $totalRegistros != 0) {
    header("Location:/Audify/BibliotecaAudio/BibliotecaAudios.php?pagina=1");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Biblioteca | Audify</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="ConsultaBusqueda.js"></script>
    <script type="text/javascript" src="OrdenamientoAudios.js"></script>
    <script type="text/javascript" src="informacionAudio.js"></script>
    <script type="text/javascript" src="confirmacionMensaje.js"></script>

    <link href="../Inicio/EstiloInicio.css" rel="stylesheet">
    <link href="EstiloBiblioteca.css" rel="stylesheet">
</head>
<body>
<?php
include('/xampp/htdocs/Audify/cabecera.php');
include('/xampp/htdocs/Audify/ValidarRol.php');

//Si el usuario ordenó la lista de audios se obtiene qué tipo de ordenamiento hizo (asc, desc)
//Esto se hace para cada vez que el usuario ingresa a la página se mantenga el ordenamiento que hizo
if (isset($_SESSION['tipoOrdenamiento'])) {

    $ordenadoPor = $_SESSION['tipoOrdenamiento'];

    //Dependiendo del tipo de ordenamiento se invoca una función especifcándolo
switch ($ordenadoPor) {
case "Ascendente":
    ?>
    <script>
        ordenarAudios("Ascendente");
    </script>
<?php
break;

case "Descendente":
?>
    <script>
        ordenarAudios("Descendente");
    </script>
<?php
break;

case "TamañoAudio":
?>
    <script>
        ordenarAudios("TamañoAudio");
    </script>
<?php
break;

case "fechaSubida":
?>
    <script>
        ordenarAudios("fechaSubida");
    </script>
<?php
break;
}
}

//Si el usuario no lo ha ordenado, entonces se muestra los audios por defecto (sin ordenar)
else{
?>
    <script>
        buscarAudios("");
    </script>
    <?php
}

?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 ColumnaIzquierda">
        </div>
        <div class="col-md-8 ColumnaCentro">

            <h1>Biblioteca de audio</h1>
            <hr>

            <!-- Boton de ordenar, dependiendo del tipo de ordenamiento se invoca una función para ordenar la lista de audios -->
            <!-- Se retorna false en cada enlace para inhabilitar el href -->
            <div class="Ordenamiento btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    Ordenar por <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onclick="ordenarAudios('Ascendente'); return false;" href="#">Ascendente</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a onclick="ordenarAudios('Descendente'); return false;" href="#">Descendente</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a onclick="ordenarAudios('TamañoAudio'); return false;" href="#">Tamaño de audio</a></li>

                    <li role="separator" class="divider"></li>
                    <li><a onclick="ordenarAudios('fechaSubida'); return false;" href="#">Fecha de subida</a></li>
                </ul>
            </div>

            <!-- input de búsqueda -->
            <div class="Busqueda">
                <input type="text" id="input_busqueda" class="form-control" placeholder="Buscar audio...">
            </div>

            <hr>

            <!-- div donde se mostrarán los audios-->
            <div id="Audios">


            </div>

            <!-- Paginación con Bootstrap -->

            <nav class="NavegadorPaginas">

                <ul class="pagination">

                    <!-- PÁGINA ANTERIOR -->
                    <li class="page-item

                    <?php
                    //Si la página actual es 1 entonces se desactiva el botón de anterior
                    //disabled es uan atributo de HTML y se utiliza para que el boton (<a>) no reaccione a los eventos del puntero
                    if ($_GET['pagina'] == 1) {
                        echo "disabled";
                    } else {
                        //Si no, no lo desactiva
                        echo "";
                    } ?>"
                    >
                        <!-- Enlace que direcciona a la página anterior de la actual -->
                        <a class="page-link" href="BibliotecaAudios.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                    </li>

                    <!-- Se muestran todos los botones según la cantidad de páginas a mostrar -->
                    <?php for ($i = 0; $i < $cant_paginas; $i++): ?>

                        <!-- Si la página actual es igual a alguna de las páginas existentes se activa el color azul en el botón-->
                        <!-- Si no, se activa el color gris -->
                        <li class="page-item
                        <?php
                        if ($_GET['pagina'] == $i + 1) {
                            echo "active";
                        } else {
                            echo "noactive";
                        } ?>">
                            <!-- Se muestra el número de página, y si se hace click se direcciona a la página que se dio clic -->
                            <a class="page-link" href="BibliotecaAudios.php?pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                        </li>
                        <!-- Termina el bucle -->
                    <?php endfor ?>

                    <!-- PÁGINA SIGUIENTE -->

                    <li class="page-item
                    <?php
                    //Si la página actual es igual a la cantidad de páginas (la última) entonces se desactiva el botón de siguiente
                    //disabled es un atributo de HTML y se utiliza para que el boton (<a>) no reaccione a los eventos del puntero
                    if ($_GET['pagina'] == $cant_paginas) {
                        echo 'disabled';
                    } else {
                        //Si no, no lo desactiva
                        echo "";
                    } ?>">

                        <!-- Enlace que direcciona a la página siguiente de la actual -->
                        <a class="page-link" href="BibliotecaAudios.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                    </li>

                </ul>
            </nav>
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