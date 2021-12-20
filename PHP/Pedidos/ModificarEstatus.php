<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$idPedido = $_POST['idPedido'];
$estatusPedido = $_POST['estatusPedido'];
$repartidorPedido = $_POST['repartidorPedido'];

    //Fecha actual
    $fechaFinalizado = date('Y-m-d');

    //Consulta
    if($estatusPedido == 'CANCELADO')
        $sqlModificarEstatus = "UPDATE `ventas` SET `ESTATUS` = '$estatusPedido', `REPARTIDOR` = null, `FINALIZADO` = '$fechaFinalizado' WHERE `ventas`.`ID_V` = '$idPedido';";
    else if($estatusPedido == 'ENVIADO')
        $sqlModificarEstatus = "UPDATE `ventas` SET `ESTATUS` = '$estatusPedido', `REPARTIDOR` = '$repartidorPedido' WHERE `ventas`.`ID_V` = '$idPedido';";
    else if($estatusPedido == 'ENTREGADO')
        $sqlModificarEstatus = "UPDATE `ventas` SET `ESTATUS` = '$estatusPedido', `FINALIZADO` = '$fechaFinalizado' WHERE `ventas`.`ID_V` = '$idPedido';";

    //Verificacion de la consulta
    $queryValidar =  $dbh -> prepare($sqlModificarEstatus); 

    //Ejecucion de la consulta
    if($queryValidar -> execute()) 
    {
        echo json_encode ('CORRECTO');
    }
    else
        echo json_encode ('INCORRECTO');        

    //Cierra la conexion a la base de datos
    unset($dbh);   
        
?>