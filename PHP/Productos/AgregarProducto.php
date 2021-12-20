<?php

    if(isset($_FILES['imagen-producto']['name']))
    {
        //Conexion
        $dbh = mysqli_connect("localhost", "root", "", "tiendita");

        //Datos del formulario
        $nombreProducto = $_POST['nombre-producto'];
        $tipoProducto = $_POST['select-tipo'];
        $marcaProducto = $_POST['select-marca'];
        $stockProducto = $_POST['stock-producto'];
        $precioProducto = $_POST['precio-producto'];

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
        $sqlGuardarProducto = "INSERT INTO `productos` (`NOMBRE_P`, `PRECIO_PUBLICO`, `STOCK`, `IMAGEN`, `ID_CT`, `ID_MARCAS`) 
        VALUES ('$nombreProducto', '$precioProducto', '$stockProducto', '$binariosImagen', '$tipoProducto', '$marcaProducto');";        

        $resultado = mysqli_query($dbh, $sqlGuardarProducto);

        if($resultado)
        {
            echo json_encode ('CORRECTO');
        }
        else
            echo json_encode ('INCORRECTO');

        //Cierra la conexion
        //mysql_close($dbh);
        $dbh->close();
    }

?>