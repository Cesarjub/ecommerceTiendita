
import {mensajeAlertaCorrecto, alertaVerde, eliminarHTML} from '../Modelo/Modelo.js'

(function() 
{
    //Comprobar sesion - mensaje de bienvenida
    if(localStorage.getItem('sesion') == "activa") 
    {
        //limpiar localStorage
        localStorage.clear()

        //Alerta de bienvenida
        mensajeAlertaCorrecto("¡Bienvenido! Ha iniciado sesión.", "mensajeAlerta")
    }
    else if(localStorage.getItem('compra') == "realizada") 
    {
        //limpiar localStorage
        localStorage.clear()

        //Alerta de bienvenida
        alertaVerde("Su compra se ha realizado exitosamente.")  
        
        //Eliminar alerta
        setTimeout(function() { eliminarHTML("mensajeAlerta", ".alert") }, 7000)
    }

})()