<?php 

include_once "./PHP/Conexion.php";

//Instancia a la clase conexion
$nuevaConexion = new conexion();

//Conexion a la base de datos
$dbh = $nuevaConexion -> conectar();

if(isset($_GET['ref'])) 
{
  $idProducto = $_GET['ref'];

  //Consulta
  $sqlProductos =  "SELECT p.*, m.NOMBRE_MARCAS  FROM productos p INNER JOIN marcas m ON m.ID_MARCAS = p.ID_MARCAS WHERE p.ID_P = $idProducto;";
  
  //Verificacion de la consulta
  $queryProductos =  $dbh -> prepare($sqlProductos); 

  //Ejecucion de la consulta
  $queryProductos -> execute();

  //Datos de la consulta
  $datosProductos = $queryProductos->fetch(PDO::FETCH_ORI_LAST);

  $imagenProducto = base64_encode($datosProductos[4]);
  $nombreProducto = $datosProductos[1];
  $precioProducto = $datosProductos[2];
  $marcaProducto = strtolower($datosProductos[8]);

  //while($datosProductos = $sqlProductos->fetch(PDO::FETCH_ASSOC))
/*  foreach($queryProductos as $datosProductos)
  {
    $imagenProducto = base64_encode($datosProductos['IMAGEN']);
    $nombreProducto = $datosProductos['NOMBRE_P'];
    $precioProducto = $datosProductos['PRECIO_PUBLICO'];
    $marcaProducto = strtolower($datosProductos['NOMBRE_MARCAS']);
  }*/

}

  //Cierra la conexion a la base de datos
  unset($dbh);

?> 

<html>
  <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width", initial-scale = 1.0>

    <!-- Titulo de la pagina -->
    <title>Tiendita | <?php echo $nombreProducto ?></title>

    <!-- Icono de la pagina -->
    <link rel = "icon" type = "image/png" href = "Imagenes/icon-fav.png">
    <link rel = "apple-touch-icon" href = "Imagenes/apple-touch-icon.png">

    <!-- Color de la pestaña en moviles -->
    <meta name = "theme-color" content = "#f4f1de">

    <!-- Bootstrap 5 -->
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
      rel = "stylesheet" integrity = "sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin = "anonymous">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" 
      integrity = "sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin = "anonymous"></script>

    <!-- Jquery -->  
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Iconos de Bootstrap -->  
    <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Navbar -->
    <script src = "JS/Parciales/AlertaBienvenida.js" type = "module"></script>

    <!-- Estilos -->
    <link rel = "stylesheet" href = "CSS/Estilos.css">
    
    </head>
<body>

        <!-- Barra superior -->
        <section id = "topbar" class = "d-flex align-items-center fixed-top">
            <div class = "container d-flex align-items-center justify-content-center justify-content-md-between">
               
                <!-- Horario - negocio -->
                <div class = "align-items-center d-none d-md-flex">
                  <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-clock me-2" viewBox = "0 0 16 16">
                      <path d = "M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                      <path d = "M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg> Lunes - Domingo, 9AM a 10PM
                </div>

                <!-- Telefono - negocio -->
                <div class = "d-flex align-items-center">
                  <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-phone me-2" viewBox = "0 0 16 16">
                      <path d = "M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                      <path d = "M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg> Llámanos +52 938 1657 762
                </div>
            </div>
        </section>

        <!-- Boton ir hacia arriba -->
        <section>
            <div class = "ir-arriba">
                <a class = "item botonArriba">
                  <svg xmlns = "http://www.w3.org/2000/svg" width = "27" height = "27" fill = "currentColor" class = "bi bi-arrow-up-short" viewBox = "0 0 16 16">
                    <path fill-rule = "evenodd" d = "M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
                </svg>
                </a>
            </div>
        </section>

        <!-- Barra de navegacion -->
        <header id = "header" class = "fixed-top">      
            <?php
                include_once "./PHP/Parciales/Navbar.php";
            ?>  
        </header>    

        <!-- Modal - Iniciar sesion -->
        <section class = "modal fade" id = "modalIniciarSesion" tabindex = "-1" aria-labelledby = "modalIniciarSesion" aria-hidden = "true">
            <div class = "modal-dialog modal-lg modal-dialog-centered">
            <div class = "modal-content rounded shadow-lg">
                
                <div class = "modal-body">

                <!-- Boton de cerrar modal -->
                <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
        
                <!-- Iniciar sesion -->
                <section  id = "login-iniciarSesion" class = "login">
                    <div class = "container w-100">
                        <div class = "row align-items-stretch">
                            
                        <!-- Contenedor del login (Izquierda) -->
                        <div class = "col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
                        </div>
        
                            <!-- Contenedor del login (Derecha) -->
                            <div class = "col bg-white rounded-end">
                                
                                <div class = "text-end">
                                <!---->
                                    <h2 class = "fw-bold text-center">Iniciar sesión</h2>
                                </div> 
        
                                    <!-- Formulario de inicio de sesion -->
                                    <div class = "container py-3"> 
                                        <form id = "form-iniciarSesion"> 
        
                                            <!-- Campo de correo electronico -->
                                            <div class = "mb-4 mt-1">
                                                <label for = "telefono-inciar" class = "form-label">Número de teléfono:</label>
                                                <input type = "tel" class = "form-control" name = "telefono-inciar" 
                                                id = "telefono-inciar" pattern = "[0-9]{10}" size = "10" 
                                                title = "El número de teléfono debe de consistir en 10 dígitos." required>
                                            </div>
                                                
                                            <!-- Campo de contraseña -->
                                            <div class = "mb-4">
                                                <label for = "clave-iniciar" class = "form-label">Contraseña:</label>
                                                <input type = "password" class = "form-control" id = "clave-iniciar" name = "clave-iniciar" required>
                                            </div>
            
                                            <!-- Checkbox de recordar cuenta -->
                                            <div class = "mb-4">
                                                <input type = "checkbox" class = "form-check-input" name = "check-sesion">
                                                <label for = "connected" class = "form-check-label">Recordarme</label>
                                            </div>
            
                                            <!-- Boton de iniciar sesion -->
                                            <div class = "d-grid">
                                                <button type = "submit"  id = "btn-iniciarSesion"  class = "btn btn-primary">Iniciar sesión</button>
                                            </div>
                                            
                                            <!-- Boton de crear cuenta -->
                                            <div class = "d-grid mt-3">
                                                <span class = "mb-2">¿Todavía no tienes cuenta?</span>
                                                <button class = "btn btn-outline-dark" data-bs-dismiss = "modal" data-bs-target = "#modalCrearCuenta" data-bs-toggle = "modal">Crear cuenta</button>
                                            </div>
            
                                            <!-- Link de recuperar contraseña -->
                                            <div class = "my-3">
                                                <span>¿Olvidaste tu contraseña? <a class = "enlace text-decoration-none" data-bs-dismiss = "modal" data-bs-target = "#modalRecuperarCuenta" data-bs-toggle = "modal" class = "text-decoration-none">Recupérala</a></span>
                                            </div>
                                        </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </section>
        
                </div>
        
            </div>
            </div>
        </section>

        <!-- Modal - Crear cuenta -->
        <section class = "modal fade" id = "modalCrearCuenta" tabindex = "-1" aria-labelledby = "modalCrearCuenta" aria-hidden = "true">

            <div class = "modal-dialog modal-lg modal-dialog-centered">
            <div class = "modal-content rounded shadow-lg">
                <div class = "modal-body">
        
                <!-- Cerra modal -->
                <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
        
                <!-- Crear cuenta -->
                <section id = "login-crearCuenta" class = "login">
                    <div class = "container w-100">
                        <div class = "row align-items-stretch">
                            
                        <!-- Contenedor del login (Izquierda) -->
                        <div class = "col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
                        </div>
        
                            <!-- Contenedor del login (Derecha) -->
                            <div class = "col bg-white rounded-end">
                                <div class = "text-end">
                                    <h2 class = "fw-bold text-center">Crear cuenta</h2>
                                </div> 
        
                                    <!-- Formulario de inicio de sesion -->
                                    <div class = "container mt-1"> 
                                        <form id = "form-crearCuenta"> 
        
                                            <!-- Campo de correo electronico -->
                                            <div class = "mb-3 mt-1">
                                                <label for = "telefono-crear" class = "form-label">Número de teléfono:</label>
                                                <input type = "tel" class = "form-control" name = "telefono-crear" 
                                                id = "telefono-crear" pattern = "[0-9]{10}" size = "10" 
                                                title = "El número de teléfono debe de consistir en 10 dígitos." required>
                                            </div>
                                            
                                            <!-- Campo de  -->
                                            <div class = "mb-3">
                                                <label for = "nombre-crear" class = "form-label">Nombre:</label>
                                                <input type = "text" class = "form-control" id = "nombre-crear" name = "nombre-crear" required>
                                            </div>
            
                                            <!-- Campo de  -->
                                            <div class = "mb-3">
                                                <label for = "apellidos-crear" class = "form-label">Apellidos:</label>
                                                <input type = "text" class = "form-control" id = "apellidos-crear" name = "apellidos-crear" required>
                                            </div>                              
            
                                            <!-- Campo de contraseña -->
                                            <div class = "mb-3">
                                                <label for = "clave-crear" class = "form-label">Contraseña: <span class = "fst-italic">(Mínimo 6 caracteres)</span> </label>
                                                <input type = "password" class = "form-control" id = "clave-crear" name = "clave-crear" 
                                                pattern = ".{6,}" title = "La contraseña debe de ser de 6 caracteres mínimo." required>
                                            </div>
            
                                            <!-- Boton de iniciar sesion -->
                                            <div class = "d-grid">
                                                <button type = "submit" id = "btn-crearCuenta" class = "btn btn-primary">Registrarse</button>
                                            </div>
                                            
                                            <!-- Boton de crear cuenta -->
                                            <div class = "d-grid mb-2 mt-2">
                                                <span class = "mb-2">¿Ya tienes una cuenta?</span>
                                                <button class = "btn btn-outline-dark" data-bs-dismiss = "modal" data-bs-target = "#modalIniciarSesion" data-bs-toggle = "modal">Iniciar sesión</button>
                                            </div>
                                        </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </section>
        
                </div>
        
            </div>
            </div>
        </section>

        <!-- Modal - Recuperar cuenta -->
        <div class = "modal fade" id = "modalRecuperarCuenta" tabindex = "-1" aria-labelledby = "modalRecuperarCuenta" aria-hidden = "true">
        </div>        

        <!-- Alerta -->
        <span id = "mensajeAlerta" class = "mb-0">   
        </span>

    <!-- Detalles de producto -->
    <div class = "container detalles-producto">
		<div class = "card shadow border-0">
			<div class = "container-fliud">
				<div class = "wrapper row">

          <!-- Imagen producto -->
					<div class = "preview col-md-5">
						
						<div class = "preview-pic tab-content">
						  <div class = "tab-pane active">
                <img src = "data:image/jpg;base64,<?php echo  $imagenProducto ?>" width = "400px" height = "400px" alt = "Producto" />
              </div>
						</div>
					</div>

          <!-- Informacion producto -->
					<div class = "details col-md-6">
						<div class = "rating">
							<span class = "review-no text-capitalize"><?php echo $marcaProducto ?></span>
						</div>

						<h3 class = "product-title"> <?php echo $nombreProducto ?> </h3>
                        
					    <h4 class = "price mb-5"><span>$<?php echo $precioProducto ?></span></h4>

                        <p class = "vote">¡<strong>91%</strong> de las personas han disfrutado este producto!</p>

                        <form id = "form-agregarCarrito">                       

                        <div class = "row g-lg-3 align-items-center mb-5">

                            <!-- Cantidad de producto -->
                            <div class = "col-auto">
                                <label for = "inputPassword6" class = "col-form-label fs-5">Cantidad:</label>
                            </div>

                            <input type = "text" id = "producto-agregar" name = "producto-agregar" class = "form-control d-none" value = "<?php echo $idProducto ?>"/>

                            <!-- Formulario de cantidad -->
                            <div class = "input-group">
										
                                <div class = "button minus">
                                    
                                    <button type = "button" class = "btn btn-primary btn-number" data-type = "minus" data-field = "quant[1]" id = "boton-restar">
                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-dash-lg" viewBox = "0 0 16 16">
                                            <path fill-rule = "evenodd" d = "M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                                          </svg>
                                    </button>

                                </div>

                                <input type = "text" id = "cantidad-agregar" name = "cantidad-agregar" class = "input-number"  data-min = "1" data-max = "100" value = "1" readonly/>
                               
                                <div class = "button plus">
                                    
                                    <button type = "button" class="btn btn-primary btn-number" data-type = "plus" data-field = "quant[1]"  id = "boton-sumar">
                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-plus-lg" viewBox = "0 0 16 16">
                                            <path fill-rule = "evenodd" d = "M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                          </svg>
                                    </button>
                                    
                                </div>

                            </div>

                        </div>

                        <!-- Agregar al carrito -->
                        <div class = "action d-grid gap-2 col-9 mt-1">
                          <button  type = "submit" class = "btn btn-dark" id = "btn-agregarCarrito">Agregar al carrito</button>
                        </div>

                      </form>

                        <!-- Compartir producto -->
                        <div class = "share mt-3">
                            <h6>Compartir: 

                                <span>
                                    <a href = "#" class = "text-decoration-none text-secondary">
                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-facebook ms-1 me-1" viewBox = "0 0 16 16">
                                            <path d = "M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                          </svg>                                    
                                    </a>

                                    <a href = "#" class = "text-decoration-none text-secondary">
                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-whatsapp me-1" viewBox = "0 0 16 16">
                                            <path d = "M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                          </svg>                             
                                    </a>

                                    <a href = "#" class = "text-decoration-none text-secondary">
                                        <svg xmlns = "http://www.w3.org/2000/svg" width = "16" height = "16" fill = "currentColor" class = "bi bi-twitter" viewBox = "0 0 16 16">
                                            <path d = "M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                          </svg>                                 
                                    </a>
                                </span>


                            </h6>
                          </div>

                    </div>
					</div>
				</div>
			</div>
		</div>

        <!-- Footer de la pagina -->
        <footer class = "footer bg-dark text-white pt-5 pb-4">
            <div class = "container text-center text-md-left">
                <div class = "row text-center text-md-left">
  
                  <!-- Tienda - info -->
                  <div class = "col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class = "text-uppercase mb-4 font-weight-bold text-danger">Tiendita</h5>
                    <p>Compra desde nuestro sitio web y recibe tus productos en la puerta de tu casa.</p>
                  </div>
  
                  <!-- Tienda - Ayuda -->
                  <div class = "col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class = "text-uppercase mb-4 font-weight-bold text-danger">Ayuda</h5>
                    <p>
                      <a href = "#" class = "text-white" style = "text-decoration: none;">Como comprar</a>
                    </p>
                    <p>
                      <a href = "#" class = "text-white" style = "text-decoration: none;">Métodos de envió</a>
                    </p>
                    <p>
                      <a href = "#" class = "text-white" style = "text-decoration: none;">Métodos de pago</a>
                    </p>
                  </div>
  
                  <!-- Tienda - negocio -->
                  <div class = "col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class = "text-uppercase mb-4 font-weight-bold text-danger">Nosotros</h5>
                    <p>
                      <a href = "#" class = "text-white" style = "text-decoration: none;">Quienes somos</a>
                    </p>
                    <p>
                      <a href = "#" class = "text-white" style = "text-decoration: none;">Política de privacidad</a>
                    </p>
                  </div>
  
                  <!-- Contacto -->
                  <div class = "col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class = "text-uppercase mb-4 font-weight-bold text-danger">Contacto</h5>
                    <p>
                        <svg xmlns = "http://www.w3.org/2000/svg" width = "15" height = "15" fill = "currentColor" class = "bi bi-geo-alt-fill" viewBox = "0 0 16 16">
                            <path d = "M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                        Ciudad del Carmen, Campeche, México.
                    </p>
                    <p>
                        <svg xmlns = "http://www.w3.org/2000/svg" width = "15" height = "15" fill = "currentColor" class = "bi bi-telephone-fill" viewBox = "0 0 16 16">
                            <path fill-rule = "evenodd" d = "M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                        9380000000
                    </p>
                  </div>
  
                </div>
  
                <hr class = "mb-4">
                <div class = "row align-items-center">
  
                  <!-- Derechos reservados -->
                  <div class = "col-md-7 col-lg-8">
                    <p> &#169; 2021 - Todos los derechos reservados 
                      <a href = "./index.php" style = "text-decoration: none;">
                        <strong class = "text-danger">Tiendita</strong>
                      </a>
                    </p>
                  </div>
  
                <div class = "col-md-5 col-lg-4">
                  <div class = "text-center text-md-right">
                    <ul class = "list-unstyled list-inline">
  
                      <!-- Perfil de Facebook -->
                      <li class = "list-inline-item">
                        <a href = "#" target = "_blank" 
                          class = "btn-floating btn-sm text-white">
                          <svg xmlns = "http://www.w3.org/2000/svg" width = "23" height = "23" fill = "currentColor" class = "bi bi-facebook sel-footer mb-2" viewBox = "0 0 16 16">
                            <path d = "M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                          </svg>
                        </a>
                      </li>
  
                      <!-- Perfil de Instagram -->
                      <li class = "list-inline-item">
                        <a href = "#" target = "_blank" 
                          class = "btn-floating btn-sm text-white">
                          <svg xmlns = "http://www.w3.org/2000/svg" width = "23" height = "23" fill = "currentColor" class = "bi bi-instagram sel-footer mb-2" viewBox = "0 0 16 16">
                            <path d = "M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                          </svg>
                        </a>
                      </li>
  
                      <!-- Perfil de Instagram -->
                      <li class = "list-inline-item">
                        <a href = "#" class = "btn-floating btn-sm text-white" 
                          target = "_blank">
                          <svg xmlns = "http://www.w3.org/2000/svg" width = "23" height = "23" fill="currentColor" class = "bi bi-whatsapp sel-footer mb-2" viewBox = "0 0 16 16">
                            <path d = "M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                          </svg>
                        </a>
                      </li>
  
                    </ul>
                  </div>
                </div>
              </div>
        </footer>    

    <!-- JavaScript - Login -->
    <script src = "./JS/Login/IniciarSesion.js" type = "module"></script>
    <script src = "./JS/Login/CrearCuenta.js" type = "module"></script>
    <script src = "./JS/Parciales/FormRecuperarCuenta.js" type = "text/javascript"></script>

    <!-- JavaScript - Agregar producto carrito -->
    <script src = "./JS/Carrito/AgregarProducto.js" type = "module"></script>

    <!-- JavaScript - Top bar -->
    <script src = "JS/Interfaz/TopBar.js" type = "text/javascript"></script>

    <!-- JavaScript - Cantidad productos -->
    <script src = "JS/Carrito/CantidadProductos.js" type = "text/javascript"></script>    

    <!-- JavaScript - Boton subir -->
    <script src = "JS/Interfaz/BtnSubir.js" type = "text/javascript"></script>
</body>    
</html>