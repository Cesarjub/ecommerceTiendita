<?php

session_start();

include_once "../Conexion.php";

if(isset($_SESSION['rolUsuario']))
{
    if($_SESSION['rolUsuario'] == 'CLIENTE')   
    {
        //Instancia a la clase conexion
        $nuevaConexion = new conexion();

        //Conexion a la base de datos
        $dbh = $nuevaConexion -> conectar();        

        //Datos del formulario
        $idProducto = $_POST['producto-agregar'];
        $cantidadProducto = $_POST['cantidad-agregar'];
        $idUsuario = $_SESSION['idUsuario'];

        //Verificar si el producto esta ingresado en el carrito

        $sqlComprobarCarrito = "SELECT c.CANTIDAD_P FROM carrito c WHERE c.ID_P = '$idProducto' AND c.TELEFONO = '$idUsuario';";

        //Verificacion de la consulta
        $queryComprobar =  $dbh -> prepare($sqlComprobarCarrito); 

        //Ejecucion de la consulta
        if($queryComprobar -> execute())
        {

            //Obtener cantidad en carrito
            foreach($queryComprobar as $data)
            {
                $cantidadCarritoProductosCarritoo = $data['CANTIDAD_P'];
            }

            //echo $cantidadCarritoProductosCarritoo;

            if($queryComprobar -> rowCount() > 0) 
            {
                //echo "ye";

                $sqlStockProductos = "SELECT p.STOCK FROM productos p WHERE p.ID_P = ?;";

                //Verificacion de la consulta
                $queryStockProductos =  $dbh -> prepare($sqlStockProductos); 
    
                //Ejecucion de la consulta
                $queryStockProductos -> execute([$idProducto]);
    
                //Validar stock
                foreach($queryStockProductos as $data)
                {
                    $cantidadCarritoProductos = $data['STOCK'];
                }

                $cantidadNueva = 0;

                $cantidadNueva = $cantidadCarritoProductosCarritoo + $cantidadProducto;

                //echo  ("|".$cantidadNueva."|");

                if($cantidadCarritoProductos > $cantidadNueva)
                {
                    $sqlActualizarCarrito = "UPDATE carrito c SET c.CANTIDAD_P = ? WHERE c.ID_P = ?  AND c.TELEFONO = ?;";

                    //Verificacion de la consulta
                    $queryActualizar =  $dbh -> prepare($sqlActualizarCarrito); 

                    //Ejecucion de la consulta
                    if($queryActualizar -> execute([$cantidadNueva, $idProducto, 9381510496]))
                    {
                        echo json_encode ('CORRECTO');
                    }
                    else
                        echo json_encode ('INCORRECTO');

                }
                else
                echo json_encode ('NODISPONIBLE');
            }
            else
            {

            //Consulta
            //$sqlStock = "SELECT if(p.STOCK > '$cantidadProducto', verdadero, falso) as stock_disponible from productos p where p.ID_P = '$idProducto';";
           
            $sqlStock = "SELECT p.STOCK FROM productos p WHERE ID_P = ?";

            //Verificacion de la consulta
            $queryStock =  $dbh -> prepare($sqlStock); 

            //Ejecucion de la consulta
            $queryStock -> execute([$idProducto]);

            //Validar stock
            foreach($queryStock as $data)
            {
                $cantidadCarrito = $data['STOCK'];
            }

            //Validar stock
            if( $cantidadCarrito > $cantidadProducto)
            {

                //Consulta
                $sqlAgregarProducto = "INSERT INTO `carrito` (`CANTIDAD_P`, `ID_P`, `TELEFONO`) 
                VALUES ('$cantidadProducto', '$idProducto', '$idUsuario');";

                //Verificacion de la consulta
                $query =  $dbh -> prepare(strtoupper($sqlAgregarProducto)); 

                //Ejecucion de la consulta
                if($query -> execute()) 
                {
                    echo json_encode ('CORRECTO');
                }
                else
                    echo json_encode ('INCORRECTO');

            }
            else
                echo json_encode ('NODISPONIBLE');

            }

        }
        else
            echo json_encode ('INCORRECTO');

        //Cierra la conexion a la base de datos
        unset($dbh);

    }
    else
        echo json_encode ('DESCONECTADO');
}
else
    echo json_encode ('DESCONECTADO');

?>