import {validarComboBox, validarTexto, validarCampoVacio, eliminarHTML, 
    agregarEmpleado, enviarPHP, alertaRoja, limpiarFormulario} from '../Modelo/Modelo.js'

//Formularios
var formularioEmpleados = document.getElementById('form-empleado')

//Boton del formulario
var btnFormulario = document.getElementById('btn-form-empleado')

//Detectar formulario - clic en el boton
formularioEmpleados.addEventListener('submit', function(e) 
{
    
    //Evita que se ejecute el evento por defecto
    e.preventDefault()

    //Inputs del formulario
    var telefonoEmpleado = document.getElementById("telefono-empleado").value
    var nombreEmpleado = document.getElementById("nombre-empleado").value
    var apellidoEmpleado = document.getElementById("apellido-empleado").value
    var claveEmpleado = document.getElementById("clave-empleado").value

    //Obtener id del combobox
    var tipoEmpleado = document.getElementById("combo-tipo-empleado").value 

    //Validar si los campos ingresados son correctos
    if(validarComboBox(tipoEmpleado) && validarCampoVacio(telefonoEmpleado) && validarCampoVacio(claveEmpleado)
     && validarTexto(nombreEmpleado) && validarTexto(apellidoEmpleado))
    {
        //Eliminar la alerta despues de un tiempo determinado
        setTimeout(function() { eliminarHTML("mensajeAlerta", ".alert") }, 0)

        //Instancia - datos del formulario
        var formData = new FormData(formularioEmpleados)

        if(btnFormulario.innerText == 'Guardar empleado')
        {
            //Enviar datos a PHP
            enviarPHP(formData,"./PHP/Empleados/AgregarEmpleado.php", agregarEmpleado)

            //Limpiar formulario
            limpiarFormulario(formularioEmpleados)
        }
        else if(btnFormulario.innerText == 'Modificar empleado')
        {
            var idEmpleado = document.getElementById("id-empleado").value
            
            formData.append("id-empleado", idEmpleado);
            
            //Enviar datos a PHP
            enviarPHP(formData,"./PHP/Empleados/ModificarEmpleado.php", agregarEmpleado)

            //Actualizar pagina
            //setTimeout(function() { location.reload()  }, 4000)
            
        }

    }
    else
        alertaRoja("Los campos ingresados son incorrectos.")

})