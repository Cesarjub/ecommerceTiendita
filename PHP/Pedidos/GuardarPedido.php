<?php

session_start();

include_once "../Conexion.php";

date_default_timezone_set("America/Mexico_City");

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$costoTotal = $_POST['costoTotal'];

$estatusPedido = 'PREPARANDO';
$usuarioPedido = $_SESSION['idUsuario'];
$fechaPedido = date('Y-m-d H:i:s');

    //Consulta
    $sqlGuardarPedido = "INSERT INTO `ventas` (`FECHA_V`, `COSTO_TOTAL`, `ESTATUS`, `TELEFONO`) 
    VALUES ('$fechaPedido', '$costoTotal', '$estatusPedido', '$usuarioPedido');";

    //Verificacion de la consulta
    $queryValidar =  $dbh -> prepare($sqlGuardarPedido); 

    //Ejecucion de la consulta
    if($queryValidar -> execute()) 
    {
        //Ultimo id ingresado
        $idPedido = $dbh->lastInsertId();

        echo json_encode ($idPedido);
    }
    else
        echo json_encode ('INCORRECTO');        

    //Cierra la conexion a la base de datos
    unset($dbh);   
        
?>