<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$idVenta = $_POST['idVenta'];
$cantidadTotal = $_POST['cantidadTotal'];
$precioFinal = $_POST['precioFinal'];
$idProducto = $_POST['idProducto'];
$usuarioPedido = $_SESSION['idUsuario'];

    //Consulta
    $sqlGuardarDetallesPedido = "INSERT INTO `orden_repartidor` (`CANTIDAD_P`, `TOTAL_P`, `ID_P`, `ID_V`) 
    VALUES ('$cantidadTotal', '$precioFinal', '$idProducto', '$idVenta');";

    //Verificacion de la consulta
    $queryValidar =  $dbh -> prepare($sqlGuardarDetallesPedido); 

    //Ejecucion de la consulta
    if($queryValidar -> execute()) 
    {
        //Consulta
        $sqlEliminarCarrito = "DELETE FROM `carrito` WHERE `carrito`.`ID_P` = '$idProducto' 
        AND `carrito`.`TELEFONO` = '$usuarioPedido';";

        //Verificacion de la consulta
        $queryEliminar =  $dbh -> prepare($sqlEliminarCarrito); 

        if($queryEliminar -> execute())
        {
            //echo json_encode ('CORRECTO');  
        }
        else
            echo json_encode ('INCORRECTO');     
    }
    else
        echo json_encode ('INCORRECTO');        

    //Cierra la conexion a la base de datos
    unset($dbh);   
        
?>