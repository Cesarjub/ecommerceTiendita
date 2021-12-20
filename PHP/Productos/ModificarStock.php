<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$productoSeleccionado = $_POST['idProducto'];
$cantidadSeleccionado = $_POST['cantidadProducto'];

    //Consulta
    $sqlModificarCantidad = "UPDATE `productos` SET `STOCK` = '$cantidadSeleccionado' WHERE ID_P = '$productoSeleccionado';";

    //Verificacion de la consulta
    $queryValidar =  $dbh -> prepare($sqlModificarCantidad); 

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