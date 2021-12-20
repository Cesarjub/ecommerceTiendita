<?php

session_start();

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//Datos del formulario
$idEmpleado = $_POST['id-empleado'];
$tipoEmpleado = $_POST['combo-tipo-empleado'];
$telefonoEmpleado = $_POST['telefono-empleado'];
$nombreEmpleado = $_POST['nombre-empleado'];
$apellidoEmpleado = $_POST['apellido-empleado'];
$claveEmpleado = $_POST['clave-empleado'];

//Verificar si el numero ya esta registrado
if($telefonoEmpleado != $idEmpleado)
{
    //Consulta
    $sqlComprobarTelefono = "SELECT * FROM `usuarios` WHERE TELEFONO = ?;";

    //Verificacion de la consulta
    $queryValidar =  $dbh -> prepare($sqlComprobarTelefono); 

    //Ejecucion de la consulta
    $queryValidar -> execute([$telefonoEmpleado]);

    //Comprueba si la consulta tiene datos
    if($queryValidar -> rowCount() == 1) 
        $existenciaUsuario = true;
    else
        $existenciaUsuario = false;
}
else
    $existenciaUsuario = false;

//
if(!$existenciaUsuario)
{

    //Consulta
    $sqlModificarEmpleado = "UPDATE `usuarios` SET `TELEFONO` = '$telefonoEmpleado', `NOMBRE` = '$nombreEmpleado', `APELLIDO` = '$apellidoEmpleado', `CLAVE` = '$claveEmpleado', `ID_ROL` = '$tipoEmpleado' 
    WHERE `usuarios`.`TELEFONO` = '$idEmpleado';";

    //Verificacion de la consulta
    $queryModificarEmpleado =  $dbh -> prepare(strtoupper($sqlModificarEmpleado)); 

    //Ejecucion de la consulta
    if($queryModificarEmpleado -> execute()) 
    {
        echo json_encode ('CORRECTO');
    }
    else
        echo json_encode ('INCORRECTO');
}
else
    echo json_encode ('EXISTE');

    //Cierra la conexion a la base de datos
    unset($dbh);

?>