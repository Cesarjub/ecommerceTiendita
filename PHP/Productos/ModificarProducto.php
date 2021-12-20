<?php

    //Conexion
    $dbh = mysqli_connect("localhost", "root", "", "tiendita");

    //Datos del formulario
    $idProducto = $_POST['id-producto'];
    $nombreProducto = $_POST['nombre-producto'];
    $tipoProducto = $_POST['select-tipo'];
    $marcaProducto = $_POST['select-marca'];
    $stockProducto = $_POST['stock-producto'];
    $precioProducto = $_POST['precio-producto'];

    //Validar si se inserto una imagen
    $nombre_imagen = $_FILES['imagen-producto']['name'];

    if($nombre_imagen != " ")
    {
        //Valores de la imagen
        $tipoArchivo = $_FILES['imagen-producto']['type'];
        $nombreArchivo = $_FILES['imagen-producto']['name'];
        $sizeArchivo = $_FILES['imagen-producto']['size'];

        //Extraer binarios de la imagen
        $imagenSubida = fopen($_FILES['imagen-producto']['tmp_name'], 'r');

        $binariosImagen = fread($imagenSubida, $sizeArchivo);

        //Limpiar binarios
        $binariosImagen = mysqli_escape_string($dbh, $binariosImagen);

        //Consulta
        $sqlModificarProducto = "UPDATE `productos` 
        SET `NOMBRE_P` = '$nombreProducto', `PRECIO_PUBLICO` = '$precioProducto', `STOCK` = '$stockProducto', `ID_CT` = '$tipoProducto', 
        `ID_MARCAS` = '$marcaProducto', `IMAGEN` = '$binariosImagen' 
        WHERE `productos`.`ID_P` = '$idProducto';";      
    }

        $resultado = mysqli_query($dbh, $sqlModificarProducto);

        if($resultado)
        {
            echo json_encode ('CORRECTO');
        }
        else
            echo json_encode ('INCORRECTO');

        //Cierra la conexion
        //mysql_close($dbh);
        $dbh->close();
    

?>