<?php
include('/xampp/htdocs/Audify/conexion.php');
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <link href="EstiloCompartirAudio.css" rel="stylesheet">
    <link href="../Inicio/EstiloInicio.css" rel="stylesheet">
    <link href="EstiloComentario.css" rel="stylesheet">

    <script src="validarEntradaPublicacion.js"></script>

    <title>Compartir audios | Audify</title>

    <?php
    include('/xampp/htdocs/Audify/cabecera.php');
    include('/xampp/htdocs/Audify/ValidarRol.php');

    ?>
</head>
<body>

<h3>¡Comparte tus audios con toda la comunidad!</h3>
<hr>

<?php
//Si la URL especifica un error de que un audio ya está incluido en tu biblioteca
if (isset($_GET['error'])) {
    ?>
    <script>
        //Se muestra el modal con el mensaje de error
        $(document).ready(function () {
            $("#modalError").modal("show");
        })
    </script>

    <div class="modal fade" id="modalError">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Advertencia</h3>
                </div>
                <div class="modal-body">
                    <p style="text-align: center;">El audio que seleccionaste ya se encuentra en tu biblioteca.</p>
                </div>
                <div class="modal-footer">
                    <button type='button' class='closed btn-primary' data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2">

        </div>

        <!-- PATRON MVC (modelo - vista - controlador)-->

        <div class="PublicarAudio col-md-8">

            <!-- -Antes de enviar el form se lo manda a validar y posteriormente al php para subir la publicación-->
            <form action="SubePublicacion.php" method="post" enctype="multipart/form-data" onsubmit="return validarEntrada();">

                <textarea style="left: 0%" class="input-field" name="comentario" id="textoPublicacion" maxlength="175"
                          placeholder="Ingrese un comentario..." autofocus></textarea>

                <!-- Se aceptan todas las extensiones de audio y un tamaño máximo de 10MB-->
                <input type="file" name="ArchivoAudio" id="audioCompartido" accept="audio/*" maxlength="10000000"
                       required>

                <button style="top: -20px" type="submit">Publicar</button>
            </form>

            <h3>Publicaciones</h3>

            <hr style="margin-bottom: 8%">

            <?php

            //Si se recibe en la url una publicación determinada entonces se debería mostrar dicha publicación con sus comentarios
            if (isset($_GET['publicacion'])) {

                //Se obtiene el id de la publicación y se selecciona el reigstro
                $idPublicacion = $_GET['publicacion'];
                $query = "SELECT * FROM publicacionesaudify WHERE id = '$idPublicacion'";

                //Si no se recibe en la url ninguna publicación determinada entonces se deberían mostrar todas las publicaciones
            } else {
                $query = "SELECT * FROM publicacionesaudify ORDER BY horaFecha DESC";
            }

            //Se ejecuta cualquiera de las 2 consultas
            $resultado = $conex->prepare($query);

            $resultado->execute();

            //Si devuelve al menos 1 registro o más se los muestra
            if ($resultado->rowCount() > 0) {

                //Bucle que se encarga de mostrar todas las publicaciones obtenidas en la consulta
                while ($resul = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="row">

                        <div class="Publicaciones">

                            <b><?php echo $resul['usuario'] ?></b>
                            <br>
                            <p id="horaFecha"><?php echo $resul['horaFecha'] ?></p>
                            <hr>
                            <p id="comment" style="width: 80%"><?php echo $resul['comentario'] ?></p>

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                                    <i style="font-size: 15px;"><?php echo $resul['nombreAudio'] ?></i>
                                    <span class="caret"></span>

                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a href="<?php echo $resul['ruta'] ?>" download="<?php $resul['nombreAudio'] ?>">Descargar</a>
                                    </li>

                                    <li>
                                        <a href="incluyeAudioBiblioteca.php?id=<?php echo $resul['id'] ?>">Incluir en mi biblioteca</a>
                                    </li>
                                </ul>

                            </div>

                            <div id="mostrarInfoAudio">

                            </div>
                        </div>

                        <!-- Se envía por get el id de la publicación-->
                        <a href="comparteAudio.php?publicacion=<?php echo $resul['id'] ?>"><label id="verComentarios">Ver comentarios</label></a>
                    </div>

                    <!-- Si existe el id de una publicación en la url entonces se muestran los comentarios de la misma-->
                    <?php if (isset($_GET['publicacion'])) {
                        ?>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="panel-body">

                                    <!-- div donde se muestra los comentarios-->
                                    <div id="output">

                                    </div>

                                    <div class="comment-form-container">

                                        <form id="frm-comment">

                                            <div class="input-row">

                                                <!-- Se envía de forma oculta el id del comentario mediante el form -->
                                                <input type="hidden" name="comentario_id" id="commentId"/>

                                                <!-- Se envía de forma oculta el id de la publicación mediante el form -->
                                                <input type="hidden" name="publi_id" id="publi_id" value="<?php echo $resul['id'] ?>"/>

                                            </div>

                                            <div class="input-row">

                                                <textarea style="left: 0%" class="input-field" name="comment" id="comment" placeholder="Agregar comentario"></textarea>

                                            </div>

                                            <div>
                                                <input type="button" class="btn-submit" id="submitButton"
                                                       value="Comentar"/>

                                                <!-- Mensaje que se muestra cuando se hace click en comentar-->
                                                <div id="comment-message">Comentario ha sido agregado exitosamente!</div>

                                            </div>

                                            <div style="clear:both"></div>
                                        </form>
                                    </div>


                                    <script>
                                        //Se resetea la variable
                                        var totalLikes = 0;

                                        //cuando se hace click en responder se ejecuta dicha función,
                                        // que recibe como parámetro el id del comentario
                                        function postReply(commentId) {
                                            //se le asigna al input hidden del form el id del comentario padre que se está respondiendo
                                            //Si no se está respondiendo ningún comentario padre, entonces vale 0
                                            $('#commentId').val(commentId);

                                            //Se hace focus al text area para agregar un comentario
                                            $('textarea[name= "comment"]').focus();
                                        }

                                        //cuando se hace click en el botón comentar
                                        $("#submitButton").click(function () {

                                            //se muestra el mensaje de agregado con éxito
                                            $("#comment-message").css('display', 'inline-block');

                                            //se obtienen todos los valores del formulario serializandolo, y se almacenan en una sola variable
                                            //Se recibe el id del comentario, el id de la publicación y el contenido del text area
                                            var str = $("#frm-comment").serialize();

                                            //Ajax que se encarga de agregar un comentario
                                            $.ajax({
                                                url: "AgregarComentario.php",
                                                data: str,
                                                type: 'post',

                                                //si se ejecuta correctamente
                                                success: function (response) {

                                                    var result = eval('(' + response + ')');

                                                    if (response) {

                                                        //si se agregó el comentairo correctamente se reinician los valores del form
                                                        // (contenido y id del coment)
                                                        $("#comment").val("");
                                                        $("#commentId").val("");

                                                        //funcion para listar todos los comentarios
                                                        listComment();

                                                    } else {
                                                        //si no se comentó correctametne al agregar un comentario
                                                        alert("Error al agregar el comentario.");
                                                        return false;
                                                    }
                                                }
                                            });
                                        });

                                        //Si no se agrega el comentario igualmente se muestra toda la lista de comentarios
                                        $(document).ready(function () {
                                            listComment();
                                        });

                                        //Función que muestra los comentarios
                                        function listComment() {

                                            //se envia por get el id de la publicación
                                            $.post("ListaDeComentarios.php?publi_id=<?php echo $resul['id']?>",

                                                //Se devuelven todos los comentarios de dicha publicación
                                                function (data) {

                                                    //se recbie la lista de comentarios (texto) y la convertimos en formato JSON
                                                    var data = JSON.parse(data);

                                                    //si no hay comentarios devueltos
                                                    if (data == 0) {

                                                        //Se almacena el mensaje en una variable y se muestra en el div output
                                                        comments = "\<h3 style='margin-left: 8%; margin-top: -15%'>Sin comentarios (0)</h3>";

                                                        $("#output").html(comments);

                                                        //Si hay comentarios devueltos
                                                    } else {

                                                        //Se reinican las variables para evitar errores
                                                        var comments = "";
                                                        var replies = "";
                                                        var item = "";
                                                        var parent = -1;

                                                        //La variable list almacena la etiqueta <ul> con su respectiva clase
                                                        //<ul> no cierra nunca, se permiten infinitos comentarios
                                                        var list = $("<ul class='outer-comment'>");

                                                        //se recorren todos los comentarios (data) para mostrarlos
                                                        for (var i = 0; (i < data.length); i++) {

                                                            //se guarda el id del comentario y el id del comentario padre en caso de que tenga
                                                            var commentId = data[i]['comentario_id'];
                                                            parent = data[i]['parent_comentario_id'];

                                                            //si el comentario no tiene un comentario padre
                                                            if (parent == "0") {

                                                                //me gusta = azul
                                                                //no me gusta = gris

                                                                //Si el comentario tiene un like o más
                                                                if (data[i]['like_unlike'] >= 1) {
                                                                    //si hay registros de likes, se oculta el icono de no me gusta (gris) y se muestra el de me gusta (azul)
                                                                    //Los dos iconos son guardadas en la carpeta img
                                                                    //En caso de que se de like o se quite se activa una función (likeOrDisLike) que envía el id del comentario y un 1 (me gusta) o -1 (no me gusta)
                                                                    //Los dos codigos HTML se almacenan en una variable de js (like_icon), que posteriormente se va a utilizar para mostrar un icono u otro
                                                                    //Se establece el id de forma dinámica, dependiendo del id del comentario, para posteriormente poder identificar el icono de un comentario
                                                                    like_icon = "<img src='../img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                                    like_icon += "<img style='display:none;' src='../img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                                                } else {
                                                                    //si no hay registros de likes, se oculta el icono de me gusta (azul) y se muestra el de no me gusta (gris)
                                                                    //En caso de que se de like o se quite se activa una función (likeOrDisLike) que envía el id del comentario y un 1 (me gusta) o -1 (no me gusta)
                                                                    like_icon = "<img style='display:none;' src='../img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                                    like_icon += "<img src='../img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                                                                }

                                                                //se obtienen los likes de un comentario específico (totalLikes)
                                                                getLikesUnlikes(commentId);

                                                                //se establece el formato de cómo se van a mostrar los comentarios y se lo guarda en la variable comments
                                                                //Se muestra usuario, hora, contenido, likes y el icono correspondiente de like o dislike
                                                                //Si se responde el comentario se activa una función (postReply) y se envía el id del comentario

                                                                comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De</span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                                \
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + commentId + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'>\ " + like_icon + "&nbsp;\
                                                <span id='likes_" + commentId + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";
                                                                //Cada comentario se muestra como un listado <li>, que serán almacenados en la variable item
                                                                var item = $("<li>").html(comments);

                                                                //méotod append agrega contenido al final de un elemento
                                                                //Después de <ul>, especificado por list, se agregan los comentarios (item) como <li>
                                                                list.append(item);

                                                                //La variable reply_list almacena una etiqueta <ul>
                                                                //Su función es crear otra lista (<ul>) para mostrar la lista de respuestas
                                                                //y que se pueda diferenciar de los comentarios padres
                                                                var reply_list = $('<ul>');

                                                                //Al final de un comentario padre, se especifica otra etiqueta ul para las respuestas
                                                                item.append(reply_list);

                                                                //Por último se invoca la función para listar las respuestas a un comentario
                                                                //Se envía como argumento el id del comentario, la lista de comentarios (data)
                                                                // y reply_list que lleva la etiqueta <ul>
                                                                listReplies(commentId, data, reply_list);

                                                            }
                                                        }
                                                        //Cuando se terminan de recorrer todos los comentarios
                                                        // se muestra la lista de comentarios (padres e hijos) en el div output
                                                        $("#output").html(list);
                                                    }
                                                });
                                        }

                                        //Se muestran las respuestas a un comentario recibiendo algunos argumentos a utilizar
                                        function listReplies(commentId, data, list) {

                                            //se recorren un comentario (data) para verificar los comentarios hijos que tiene
                                            for (var i = 0; (i < data.length); i++) {

                                                //se verifica si el comentario tiene comentarios hijos en toda la BD (125 == 125)
                                                //si la condicion es false entonces el comentario no tiene un comentario hijo y no se muestra nada
                                                if (commentId == data[i].parent_comentario_id) {

                                                    //me gusta = azul
                                                    //no me gusta = gris

                                                    //Si el comentario tiene un like o más
                                                    if (data[i]['like_unlike'] >= 1) {
                                                        //si hay registros de likes, se oculta el icono de no me gusta (gris) y se muestra el de me gusta (azul)
                                                        //Los dos iconos son guardadas en la carpeta img
                                                        //En caso de que se de like o se quite se activa una función (likeOrDisLike) que envía el id del comentario y un 1 (me gusta) o -1 (no me gusta)
                                                        //Los dos codigos HTML se almacenan en una variable de js (like_icon), que posteriormente se va a utilizar para mostrar un icono u otro
                                                        //Se establece el id de forma dinámica, dependiendo del id del comentario, para posteriormente poder identificar el icono de un comentario
                                                        like_icon = "<img src='../img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                        like_icon += "<img style='display:none;' src='../img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                                    } else {
                                                        //si no hay registros de likes, se oculta el icono de me gusta (azul) y se muestra el de no me gusta (gris)
                                                        //En caso de que se de like o se quite se activa una función (likeOrDisLike) que envía el id del comentario y un 1 (me gusta) o -1 (no me gusta)
                                                        like_icon = "<img style='display:none;' src='../img/NoMeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                        like_icon += "<img src='../img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                                    }
                                                    //se obtienen los likes del comentario hijo
                                                    getLikesUnlikes(data[i].comentario_id);

                                                    //se establece el formato de cómo se van a mostrar los comentarios y se lo guarda en la variable comments
                                                    //Se muestra usuario, hora, contenido, likes y el icono correspondiente de like o dislike
                                                    //Si se responde el comentario se activa una función (postReply) y se envía el id del comentario

                                                    var comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De </span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + data[i]['comentario_id'] + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'> " + like_icon + "&nbsp;\
                                                <span id='likes_" + data[i]['comentario_id'] + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                                    //Cada comentario se muestra como un listado <li>, que serán almacenados en la variable item
                                                    var item = $("<li>").html(comments);

                                                    //método append agrega contenido al final de un elemento
                                                    //Después de <ul>, especificado por list, se agregan los comentarios (item) como <li>
                                                    list.append(item);

                                                    //La variable reply_list almacena una etiqueta <ul>, en este caso <ul>
                                                    //Su función es crear otra lista (<ul>) para mostrar la lista de respuestas
                                                    //y que se pueda diferenciar de los comentarios padres
                                                    var reply_list = $('<ul>');

                                                    //Al final de un comentario padre, se especifica otra etiqueta ul para las respuestas al comentario
                                                    item.append(reply_list);

                                                    //recursividad hasta mostrar todos los comentarios hijos de un comentario padre
                                                    listReplies(data[i].comentario_id, data, reply_list);
                                                }
                                            }
                                        }

                                        //se obtienen los likes de un comentario específico
                                        function getLikesUnlikes(commentId) {

                                            //Se envía el id del comentario al archivo php y éste devuelve el total de likes del comentair
                                            $.ajax({
                                                type: 'POST',
                                                async: false,
                                                url: 'Envio_MeGusta.php',
                                                data: {comentario_id: commentId},

                                                //Si se ejecuta correctamente se almacena el data (likes) en la variable totalLikes
                                                success: function (data) {
                                                    totalLikes = data;
                                                }
                                            });
                                        }

                                        //Se actualizan los likes de un comentario específico
                                        //Además de recibir como argumento el id del comentario, se recibe 1 ó -1 (like o dislike)
                                        function likeOrDislike(comentario_id, like_unlike) {

                                            //Se utiliza ajax para que los likes y dislikes se muestren en tiempo real
                                            //Se envía el id del comentario y el like o dislike y se devuelve en formato JSON
                                            $.ajax({
                                                url: 'MeGusta_NoMeGusta.php',
                                                async: false,
                                                type: 'post',
                                                data: {comentario_id: comentario_id, like_unlike: like_unlike},
                                                dataType: 'json',

                                                //Si se ejecutó correctamente se obtienen los likes actualizados del comentario
                                                success: function (data) {

                                                    //Se muestran los likes
                                                    $("#likes_" + comentario_id).text(data + " Me Gusta");

                                                    //si dió like al comentario se muestra el icono de like en azul y se oculta el icono de like en gris
                                                    if (like_unlike == 1) {
                                                        $("#like_" + comentario_id).css("display", "none");
                                                        $("#unlike_" + comentario_id).show();
                                                    }
                                                    //si se quitó el like al comentario se muestra el icono de like en gris y se oculta el icono de like en azul
                                                    else if (like_unlike == -1) {
                                                        $("#unlike_" + comentario_id).css("display", "none");
                                                        $("#like_" + comentario_id).show();
                                                    }

                                                },
                                                //si hay error al dar like
                                                error: function (data) {
                                                    alert("Error: " + data);
                                                }
                                            });
                                        }

                                    </script>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                //Si no hay publicaciones
            } else {
                ?>
                <h2>No hay publicaciones a mostrar.</h2>
                <?php
            }
            ?>
        </div>

        <div class="col-md-2">

        </div>
    </div>
</div>

<?php
include('/xampp/htdocs/Audify/PiePagina.php');
?>
</body>
</html>