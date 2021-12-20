
(function() 
{

    window.addEventListener("load", function(event) 
    {
        var contenido = ""
        
        contenido += ` 
        <div class = "modal-dialog modal-lg modal-dialog-centered">
    
        <div class = "modal-content rounded shadow-lg">
    
          <div class = "modal-body">
    
            <!-- Cerra modal -->
            <button type = "button" class = "btn-close" data-bs-dismiss = "modal" aria-label = "Close"></button>
    
            <!-- Formulario para recuperar cuenta -->
            <section class = "login">
              <div class = "container w-100 mb-lg-6">
                  <div class = "row align-items-stretch">
    
                      <div class = "mb-2 text-center">
                          <h2 class = "fw-bold">¿Olvidaste tu contraseña?</h2>
                          <p>Por favor, introduce tu número de teléfono y recibirás un enlace para crear una contraseña nueva.</p>
                      </div>
    
                      <form id = "form-recuperarCuenta">
                            <!-- Campo de correo electronico -->
                              <div class = "row justify-content-center mb-2">
    
                                  <div class = "col-12 col-md-6">
                                    <label for = "telefono-recuperar" class = "form-label">Número de teléfono:</label>
                                    <input type = "tel" name = "telefono-recuperar" id = "telefono-recuperar" class = "form-control" required>
                                  </div>
          
                              </div>
    
                              <!-- Restablecer contraseña -->
                              <div class = "row justify-content-center d-grid mt-3 mb-3">
                                <div class = "col">
                                  <a href = "#" id = "btn-recuperarCuenta" class = "btn btn-primary">Restablecer contraseña</a>
                                </div>             
                              </div>      
    
                            <!-- Links -->
                              <div class = "row justify-content-center mb-4">
                                  
                                  <div class = "col-12 col-md-6">
                                    <span>¿No tienes cuenta?
                                      <a class = "text-decoration-none enlace" data-bs-dismiss = "modal" data-bs-target = "#modalCrearCuenta" data-bs-toggle = "modal">Crear cuenta</a>
                                    </span>
                                  </div>
          
                              </div>
    
                      </form>
    
                  </div>
              </div>
          </section>
    
          </div>
    
        </div>
      </div>          
        `  
        //Insertar el contenido en HTML
        document.getElementById("modalRecuperarCuenta").innerHTML = contenido                     
    })

})()