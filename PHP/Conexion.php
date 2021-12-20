<?php 

class conexion {


    public function conectar() 
    {
        $hostname = "localhost"; 

        $dbname = "tiendita"; 
        
        $username = "root"; 
        
        $pw = ""; 

        try 
        {

            //Conexion a la base de datos
            $dbh = new PDO("mysql:host=$hostname; dbname=$dbname; charset=utf8", $username, $pw);

            //echo "Conexion correcta";

            return $dbh;

        }
        catch(PDOException $error)
        {
            echo "Ha ocurrido un error". $error -> getMessage();
            exit();
        }    
    }
}

?> 