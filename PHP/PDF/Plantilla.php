<?php

require "../../FPDF/fpdf.php";

class PDF extends FPDF
{
    //Cabecera de la pagina
    function Header()
    {
        //Imagen
        $this->Image("../../Imagenes/logo-tienda.png", 16, 8);

        $this->SetFont("Arial", "B", 12);

        $this->Cell(25);

        //Contenido 
        $this->Cell(140, 5, "Reporte de ventas", 0, 0, "C");

        $this->SetFont("Arial", "", 10);

        //Fecha
        $this->Cell(25, 5, "Fecha: ".date("d/m/y"), 0, 1, "C");

        //Salto de linea
        $this->Ln(8);
    }

    //Pie de pagina 
    function Footer()
    {
        //Posicion a 1.5 cm del final
        $this->SetY(-15);

        //
        $this->SetFont("Arial", "I", 8);

        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().' /{nb}', 0, 0, 'C');
    }
}


?>