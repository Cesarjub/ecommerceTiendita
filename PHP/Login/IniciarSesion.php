<?php

session_start();

date_default_timezone_set("America/Mexico_City");

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$telefonoUsuario = $_POST['telefono-inciar'];
$claveUsuario = $_POST['clave-iniciar'];

//Consulta
$sqlIniciarSesion = "SELECT * FROM `usuarios` WHERE TELEFONO = ? AND CLAVE = ?;";

//Verificacion de la consulta
$query =  $dbh -> prepare($sqlIniciarSesion); 

//Ejecucion de la consulta
$query -> execute([$telefonoUsuario, $claveUsuario]);

//Datos de la consulta
$userData = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

//Comprueba si la consulta tiene datos
if($userData === FALSE)
{
    echo json_encode ('INCORRECTO');
}
//Comprueba si la consulta tiene datos
else if($query -> rowCount() == 1) 
{
    //Se extrae el tipo del rol del usuario
    $rol = $userData[5];
    $nombre = $userData[1];
    $id = $userData[0];

    //Variables de la sesion
    $_SESSION['rolUsuario'] = $rol;
    $_SESSION['idUsuario'] = $id;
    $_SESSION['usuarioNombre'] = strtolower($nombre);

    if($rol == 1)
        $_SESSION['rolUsuario'] = "ADMINISTRADOR";
    else if ($rol == 2)
        $_SESSION['rolUsuario'] = "EMPLEADO";
    else if ($rol == 3)
        $_SESSION['rolUsuario'] = "REPARTIDOR";
    else if ($rol == 4)
        $_SESSION['rolUsuario'] = "CLIENTE";
    else
        $_SESSION['rolUsuario'] = "NO";

    $fechaIngreso = date('Y-m-d');

    //Actualizar ulrimo ingreso
    $actualizarIngreso = "UPDATE usuarios u SET u.ULTIMO = ? WHERE u.TELEFONO = ?;";
    
    //Verificacion de la consulta
    $queryIngreso =  $dbh -> prepare($actualizarIngreso); 
    
    //Ejecucion de la consulta
    $queryIngreso -> execute([$fechaIngreso, $id]); 

    echo json_encode ('CORRECTO');
}
else
    echo json_encode ('INCORRECTO');

//Cierra la conexion a la base de datos
unset($dbh);

?>