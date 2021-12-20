<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$EmpleadoSeleccionado = $_POST['idEmpleado'];

//$idUsuario = $_SESSION['idUsuario'];

//Consulta
$sqlEliminarEmpleado = "DELETE FROM `usuarios` WHERE `usuarios`.`TELEFONO` = '$EmpleadoSeleccionado';";

//Verificacion de la consulta
$queryEliminarEmpleado =  $dbh -> prepare($sqlEliminarEmpleado); 

    //Ejecucion de la consulta
    if($queryEliminarEmpleado -> execute()) 
    {
        echo json_encode ('CORRECTO');
    }
    else
        echo json_encode ('INCORRECTO');

    //Cierra la conexion a la base de datos
    unset($dbh);

?>