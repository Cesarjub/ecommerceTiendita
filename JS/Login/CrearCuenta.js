
import {validarCampoVacio, validarTelefono, validarTexto, limpiarFormulario, mensajeAlertaError, mensajeAlertaCorrecto, 
    verificarModal, eliminarHTML, enviarPHP, validarSesionPHP} from '../Modelo/Modelo.js'

//Formulario de iniciar sesion
var formularioCrearCuenta = document.getElementById('form-crearCuenta')

/////////////////////////////////////////////////////////////////////////////

//Detectar formulario - clic en el boton
formularioCrearCuenta.addEventListener('submit', function(e) 
{

    //Evita que se ejecute el evento por defecto
    e.preventDefault()

    //Eliminar mensaje de alerta
    eliminarHTML("mensajeAlerta", ".alert")

    //Inputs del formulario
    var numeroUsuarioCrear = document.getElementById("telefono-crear").value
    var nombreUsuarioCrear = document.getElementById("nombre-crear").value
    var apellidoUsuarioCrear = document.getElementById("apellidos-crear").value    
    var claveUsuarioCrear = document.getElementById("clave-crear").value

    //Validar si los campos ingresados son correctos
    if(validarTelefono(numeroUsuarioCrear) && validarTexto(nombreUsuarioCrear) &&
    validarTexto(apellidoUsuarioCrear) && validarCampoVacio(claveUsuarioCrear)) 
    {

        //Ocultar modal y alertas
        /*$(function() {
            $('.modal').modal( 'hide' ).data( 'bs.modal', null)
            $('.alerta-superior').hide()
        })*/

        //Instancia - datos del formulario
        var formData = new FormData(formularioCrearCuenta)        

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Login/CrearCuenta.php", validarSesionPHP)

        //Comprobar sesion - mensaje de bienvenida
        //localStorage.setItem('sesion', 'activa')

        //Actualizar pagina
        //location.reload()

    }
    else
        mensajeAlertaError("Los datos ingresados son incorrectos.", "mensajeAlerta")

})

//Verificar si el modal se ha cerrado
verificarModal()
