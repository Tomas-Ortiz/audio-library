<?php
include('/xampp/htdocs/Audify/conexion.php');

//Se recibe el usuario y la contraseña ingresada

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

//Se encripta la contraseña ingresada
$claveEncriptada = md5($contraseña);

//Se realiza la consulta para localizar un registro que coincidan con el nombre de usuario y la contraseña ingresada

$query = "SELECT * FROM usuariosaudify WHERE nombreUsuario = ? AND  clave = ?";

$preparado = $conex->prepare($query);

$preparado->execute(array($usuario, $claveEncriptada));

$filas = $preparado->rowCount();

$resultado = $preparado->fetch(PDO::FETCH_ASSOC);

//Si coincide con algún registro entonces se autentica el usuario correctamente
if ($filas>0) {

    //se inicia una nueva sesión y se asignan los nuevos valores de sesión del usuario
    session_start();

    $_SESSION['usuario'] = $usuario;
    $_SESSION['id'] = $resultado['id'];

    //Si el usuario seleccionó la opción de recordarme

    if (isset($_POST['recordarme'])) {

        //Se realiza una consulta al registro del usuario para obtener su id
        $query = "SELECT * FROM usuariosaudify WHERE nombreUsuario = ?";

        $preparado = $conex->prepare($query);

        $preparado->execute(array($usuario));

        $resultado = $preparado->fetch(PDO::FETCH_ASSOC);

        //se encripta el id del usuario con md5 para generar el token
        $tokenUser = md5($resultado['id']);

        //Se agrega un token para ese usuario
        $query = "UPDATE usuariosaudify SET token ='$tokenUser' WHERE nombreUsuario = ?";

        $preparado = $conex->prepare($query);

        $preparado->execute(array($usuario));

        //Se crea una cookie en el navegador del usuario con su respectivo nombre y valor, y el tiempo de expiración (3600 segundos)

        //La ruta dentro del servidor en la que la cookie estará disponible. Si se utiliza '/',
        // la cookie estará disponible en la totalidad del domain. Si se configura como '/foo/',
        // la cookie sólo estará disponible dentro del directorio /foo/ y todos sus sub-directorios en el domain,
        // tales como /foo/bar/. El valor por defecto es el directorio actual en donde se está configurando la cookie.

        setcookie("token", $tokenUser, time() + 3600, '/');

        //Una vez creada las cookies, se pueden utilizar el array $_COOKIE para acceder al valor de la misma
    }

    //Finalmente se lo direcciona al usuario al inicio de la página
    header("Location: ../Inicio/Inicio.php");

    //Si los datos no coinciden o no encontró ningún registro entonces lo vuelve a direccionar al inicio de sesión
} else {
    header("Location: InicioSesion.php");
}


