<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$tipoEmpleado = $_POST['combo-tipo-empleado'];
$telefonoEmpleado = $_POST['telefono-empleado'];
$nombreEmpleado = $_POST['nombre-empleado'];
$apellidoEmpleado = $_POST['apellido-empleado'];
$claveEmpleado = $_POST['clave-empleado'];

//Consulta
$sqlComprobarTelefono = "SELECT * FROM `usuarios` WHERE TELEFONO = ?;";

//Verificacion de la consulta
$queryValidar =  $dbh -> prepare($sqlComprobarTelefono); 

//Ejecucion de la consulta
$queryValidar -> execute([$telefonoEmpleado]);

//Comprueba si la consulta tiene datos
if($queryValidar -> rowCount() == 1) 
    echo json_encode ('EXISTE');
else
{

    //Consulta
    $sqlAgregarEmpleado = "INSERT INTO `usuarios` (`TELEFONO`, `NOMBRE`, `APELLIDO`, `CLAVE`, `ID_ROL`) 
    VALUES ('$telefonoEmpleado', '$nombreEmpleado', '$apellidoEmpleado', '$claveEmpleado', '$tipoEmpleado');";

    //Verificacion de la consulta
    $queryAgregarEmpleado =  $dbh -> prepare(strtoupper($sqlAgregarEmpleado)); 

    //Ejecucion de la consulta
    if($queryAgregarEmpleado -> execute()) 
    {
        echo json_encode ('CORRECTO');
    }
    else
        echo json_encode ('INCORRECTO');
}

    //Cierra la conexion a la base de datos
    unset($dbh);

?>