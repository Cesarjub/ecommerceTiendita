<?php

session_start();

date_default_timezone_set("America/Mexico_City");

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$telefonoUsuario = $_POST['telefono-crear'];
$nombreUsuario = $_POST['nombre-crear'];
$apellidoUsuario = $_POST['apellidos-crear'];
$claveUsuario = $_POST['clave-crear'];

//Fecha actual
$fechaIngreso = date('Y-m-d');

//Consulta
$sqlComprobarTelefono = "SELECT * FROM `usuarios` WHERE TELEFONO = ?;";

//Verificacion de la consulta
$queryValidar =  $dbh -> prepare($sqlComprobarTelefono); 

//Ejecucion de la consulta
$queryValidar -> execute([$telefonoUsuario]);

//Datos de la consulta
$userData = $queryValidar->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

//Comprueba si la consulta tiene datos
if($queryValidar -> rowCount() == 1) 
    echo json_encode ('EXISTE');
else
{

    //Consulta
    $sqlCrearCuenta = "INSERT INTO `usuarios` (`TELEFONO`, `NOMBRE`, `APELLIDO`, `CLAVE`, `ULTIMO`, `ID_ROL`) 
    VALUES ('$telefonoUsuario', '$nombreUsuario', '$apellidoUsuario', '$claveUsuario', '$fechaIngreso', '4');";

    //Verificacion de la consulta
    $query =  $dbh -> prepare(strtoupper($sqlCrearCuenta)); 

    //Ejecucion de la consulta
    if($query -> execute()) 
    {
        //Variables de la sesion
        $_SESSION['rolUsuario'] = 'CLIENTE';
        $_SESSION['usuarioNombre'] = $nombreUsuario;
        $_SESSION['idUsuario'] = $telefonoUsuario;

        //
        echo json_encode ('CORRECTO');
    }
    else
        echo json_encode ('INCORRECTO');
}

    //Cierra la conexion a la base de datos
    unset($dbh);

?>