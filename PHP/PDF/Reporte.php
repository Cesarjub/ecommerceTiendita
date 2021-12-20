<?php

include_once "../Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

//require "../../FPDF/fpdf.php";
require "../PDF/Plantilla.php";

//Instancia - FPDF / Orientacion PDF - unidad de medida - medida
$pdf = new PDF("p", "mm", "letter");

//Numero de paginas
$pdf->AliasNbPages();

$pdf->SetMargins(10, 10, 10);

//Consulta SQL
$sqlVentas = "SELECT v.*, u.NOMBRE, u.APELLIDO FROM ventas v INNER JOIN usuarios u ON v.TELEFONO = u.TELEFONO;";

//Verificacion de la consulta
$queryPedidos =  $dbh -> prepare($sqlVentas); 

//Ejecucion de la consulta
$queryPedidos -> execute();

//Nueva hoja
$pdf->AddPage();

foreach($queryPedidos as $datosPedidos)
{

    $pdf->SetFont("Arial", "B", 9);

    //Header de tabla
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(20, 5, "#", 1, 0, "C", "true");
    $pdf->Cell(80, 5, "Cliente", 1, 0, "C", "true");
    $pdf->Cell(40, 5, "Estatus", 1, 0, "C", "true");
    $pdf->Cell(56, 5, "Realizado", 1, 1, "C", "true");

    $pdf->SetFont("Arial", "", 9);
    $pdf->SetTextColor(0,0,0);

    //////////////// Pedidos

    //Datos del pedido
    $pdf->Cell(20, 5, $datosPedidos['ID_V'], 1, 0, "C");
    $pdf->Cell(80, 5, utf8_decode($datosPedidos['NOMBRE'].' '.$datosPedidos['APELLIDO']), 1, 0, "C");
    $pdf->Cell(40, 5, $datosPedidos['ESTATUS'], 1, 0, "C");
    $pdf->Cell(56, 5, $datosPedidos['FECHA_V'], 1, 1, "C");   
    
    //////////////// Repartidor
    if($datosPedidos['REPARTIDOR'] == null)
    {
        $pdf->Cell(0, 6, "Repartidor asignado: no asignado", 1, 1, 'L');
    }
    else
    {
        //Consulta
        $sqlRepartidor = "SELECT * FROM usuarios u WHERE u.TELEFONO = ?;";

        //Verificacion de la consulta
        $queryRepartidor =  $dbh -> prepare($sqlRepartidor); 

        //Ejecucion de la consulta
        $queryRepartidor -> execute([$datosPedidos['REPARTIDOR']]);

        //Datos de la consulta
        $repartidorDatos = $queryRepartidor->fetch(PDO::FETCH_ORI_LAST);

        $pdf->Cell(0, 6, "Repartidor asignado: ".utf8_decode($repartidorDatos[1].' '.$repartidorDatos[2]), 1, 1, 'L');
    }

    //////////////// Detalles del pedido

    //Consulta Detalles del pedido
    //$pdf->SetFillColor(82,82,82);
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont("Arial", "B", 9);
    $pdf->Cell(0, 6, "Detalles del pedido", 1, 1, 'C','true');

    //Consulta SQL
    $sqlDetalles = " SELECT o.*, p.* FROM orden_repartidor o INNER JOIN productos p ON p.ID_P = o.ID_P WHERE o.ID_V = ?;";

    //Verificacion de la consulta
    $queryDetalles =  $dbh -> prepare($sqlDetalles); 

    //Ejecucion de la consulta
    $queryDetalles -> execute([$datosPedidos['ID_V']]);    
    $pdf->SetFont("Arial", "", 9);
    $pdf->SetTextColor(0,0,0);

    //Detalles del pedido
    foreach($queryDetalles as $datosDetalles)
    {
        //Productos
        $pdf->Cell(0, 6, utf8_decode($datosDetalles['NOMBRE_P']).'   x'.$datosDetalles['CANTIDAD_P'].'  -  $ '.$datosDetalles['TOTAL_P'], 1, 1, 'L');
    }

    //Total de la compra
    $pdf->Cell(0, 6, "Total de la compra: $ ".$datosPedidos['COSTO_TOTAL'], 1, 1, 'R');

    //Salto de linea
    $pdf->Ln(6);

}

    //Generar PDF
    $pdf->Output();

?>