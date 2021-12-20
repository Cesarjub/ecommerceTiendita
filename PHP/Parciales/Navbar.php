
<?php

if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}

if(isset($_SESSION['rolUsuario']))
{
    include_once "./PHP/Conexion.php";

    //Instancia a la clase conexion
    $nuevaConexion = new conexion();
    
    //Conexion a la base de datos
    $dbh = $nuevaConexion -> conectar();

    $idUser = $_SESSION['idUsuario'];

    //Consulta
    $sqlCarrito =  "SELECT COUNT(*) as TotalElementos FROM carrito WHERE TELEFONO = '$idUser';";
    
    //Verificacion de la consulta
    $queryCarrito =  $dbh -> prepare($sqlCarrito); 

    //Ejecucion de la consulta
    $queryCarrito -> execute();

    //Datos de la consulta
    $datosCarrito = $queryCarrito->fetch(PDO::FETCH_ORI_LAST);

    $cantidadCarrito = $datosCarrito[0];

    /*foreach($queryCarrito as $data)
    {
        $cantidadCarrito = $data['TotalElementos'];
    }*/
}
else
    $cantidadCarrito = 0;


if(isset($_SESSION['rolUsuario']))
{

    if($_SESSION['rolUsuario'] == 'ADMINISTRADOR') 
    {
        $imagenUsuario = '
        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-emoji-sunglasses" viewBox = "0 0 16 16">
        <path d = "M4.968 9.75a.5.5 0 1 0-.866.5A4.498 4.498 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.498 3.498 0 0 1 8 11.5a3.498 3.498 0 0 1-3.032-1.75zM7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A2.99 2.99 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.22 4.22 0 0 0 8 5c-.35 0-.69.04-1 .116z"/>
        <path d = "M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0z"/>
      </svg>       
        ';
    }
    else if($_SESSION['rolUsuario'] == 'CLIENTE') 
    {
        $imagenUsuario = '
        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-emoji-smile icon-user" viewBox = "0 0 16 16">
        <path d = "M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d = "M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
      </svg>        
        ';
    }
    else if($_SESSION['rolUsuario'] == 'EMPLEADO') {
        $imagenUsuario = '
        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height="16" fill="currentColor" class = "bi bi-person icon-user" viewBox = "0 0 16 16">
        <path d = "M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
      </svg>         
        ';    
    }
    else if($_SESSION['rolUsuario'] == 'REPARTIDOR') {
        $imagenUsuario = '
        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-truck icon-user" viewBox = "0 0 16 16">
        <path d = "M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
      </svg>        
        ';    
    }
    else 
    {
        $imagenUsuario = '
        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-person-x icon-user" viewBox = "0 0 16 16">
        <path d = "M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        <path fill-rule = "evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
      </svg>        
        ';      
    }

    $opcionUsuario = '
    <li class = "nav-item dropdown">
    <a href = "#" class = "nav-link dropdown-toggle text-capitalize">

    '.$imagenUsuario.'

    Hola, '.$_SESSION['usuarioNombre'].'</a>
    <ul class = "dropdown-menu mb-3">
        <li><a href = "./PanelUsuario.php" class = "dropdown-item">Mi cuenta</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a href = "./PHP/Sesiones/CerrarSesion.php" class = "dropdown-item">Cerrar sesión</a></li>
    </ul>
    </li>        
    ';
}
else
{
    $opcionUsuario = '
    <!-- Iniciar sesion / menu usuarios -->
    <li class = "nav-item" id = "opcionUsuario">
        <a class = "nav-link seleccion" 
        data-bs-toggle = "modal" 
        data-bs-target = "#modalIniciarSesion">Iniciar sesión</a>
    </li>  
    ';
}
    $navbar = '
    
        <nav id = "navbar" class = "navbar navbar-expand-lg p-md-3 bg-navbar shadow-sm">
            <div class = "container">

            <!-- Logo - negocio -->
            <a class = "navbar-brand" href = "./index.php"> 
                <img src = "Imagenes/logo-tienda.png" width = "32" alt = "Logotipo" class = "me-1"/> 
                Tiendita</a>

            <!-- Toggle -->
            <button
                class = "navbar-toggler shadow-none mt-1 mb-1"
                type = "button"
                data-bs-toggle = "collapse"
                data-bs-target = "#navbarNav"
                aria-controls = "navbarNav"
                aria-expanded = "false"
                aria-label = "Toggle navigation"
            >
                <span class = "mt-1 mb-1"></span>
                <span class = "mb-1"></span>
                <span class = "mb-1"></span>
            </button>
      
            <div class = "collapse navbar-collapse" id = "navbarNav">
                <ul class = "navbar-nav justify-content-start">

                    <!-- Dropdown - departamentos -->
                    <li class = "nav-item dropdown me-2">
                        <a href = "#" class = "nav-link dropdown-toggle">Departamentos </a>
                        <ul class = "dropdown-menu mb-3">
                            <li><a href = "./Productos.php" class = "dropdown-item">Cervezas</a></li>
                            <li><a href = "#" class = "dropdown-item">Otros</a></li>
                        </ul>
                    </li>

                    <!-- Promociones -->
                    <li class = "nav-item">
                        <a class = "nav-link seleccion" href = "./Promociones.php">Promociones</a>
                    </li>                        
                </ul>

                <!-- Formulario de busqueda -->
                <div class = "mx-auto">
                    <form class = "d-flex form-buscar">
                        <input class = "form-control shadow-none me-1" type = "search" placeholder = "Buscar" aria-label = "Search">
                        <button class = "btn btn-danger shadow-none me-1" type = "submit">
                            <i class = "bi bi-search"></i>
                        </button>
                      </form>
                </div>

            <ul class = "navbar-nav">  

                <!-- Iniciar sesion / menu usuarios -->
                '.$opcionUsuario.'

            <!-- Carrito de productos -->
            <li class = "nav-item">
                <a class = "nav-link" href = "./Carrito.php">
                    <svg xmlns = "http://www.w3.org/2000/svg" width = "20" height = "20" fill = "currentColor" class = "bi bi-cart" viewBox = "0 0 16 16">
                        <path d = "M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span id = "totalCarrito" class = "badge rounded-pill bg-danger">'.$cantidadCarrito.'</span>
                </a>
            </li>
        </ul>

        </div>
        </div>
        </nav>
 
    ';
   
    echo ($navbar);

?> 