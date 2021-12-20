<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$productoSeleccionado = $_POST['idProducto'];

//Consulta
$sqlEliminarProducto = "DELETE FROM `productos` WHERE `productos`.`ID_P` = '$productoSeleccionado';";

//Verificacion de la consulta
$queryValidar =  $dbh -> prepare($sqlEliminarProducto); 

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