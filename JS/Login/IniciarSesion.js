
import {validarCampoVacio, validarTelefono, mensajeAlertaError, verificarModal, eliminarHTML, 
    enviarPHP, validarSesionPHP} from '../Modelo/Modelo.js'

//Formulario de iniciar sesion
var formularioIniciarSesion = document.getElementById('form-iniciarSesion')

/////////////////////////////////////////////////////////////////////////////

//Detectar formulario - clic en el boton
formularioIniciarSesion.addEventListener('submit', function(e) 
{

    //Evita que se ejecute el evento por defecto
    e.preventDefault()

    //Eliminar mensaje de alerta
    eliminarHTML("mensajeAlerta", ".alerta-superior")

    //Inputs del formulario
    var numeroUsuarioIniciar = document.getElementById("telefono-inciar").value
    var claveUsuarioIniciar = document.getElementById("clave-iniciar").value

    //Validar si los campos ingresados son correctos
    if(validarTelefono(numeroUsuarioIniciar) && validarCampoVacio(claveUsuarioIniciar)) 
    {

        //Instancia - datos del formulario
        var formData = new FormData(formularioIniciarSesion)        

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Login/IniciarSesion.php", validarSesionPHP)

    }
    else
        mensajeAlertaError("Los datos ingresados son incorrectos.", "mensajeAlerta")

})

//Verificar si el modal se ha cerrado
verificarModal()