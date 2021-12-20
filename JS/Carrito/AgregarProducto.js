import {validarCampoVacio, comprobarAgregarCarrito, enviarPHP} from '../Modelo/Modelo.js'

//Formulario de Carrito
var formularioAgregarCarrito = document.getElementById('form-agregarCarrito')

/////////////////////////////////////////////////////////////////////////////

//Detectar formulario - clic en el boton
formularioAgregarCarrito.addEventListener('submit', function(e) 
{

    //Evita que se ejecute el evento por defecto
    e.preventDefault()

    //Inputs del formulario
    var idProducto = document.getElementById("producto-agregar").value
    var cantidadProducto = document.getElementById("cantidad-agregar").value

    //Validar si los campos ingresados son correctos
    if(validarCampoVacio(idProducto) && validarCampoVacio(cantidadProducto)) 
    {

        //Instancia - datos del formulario
        var formData = new FormData(formularioAgregarCarrito)

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Carrito/AgregarProducto.php", comprobarAgregarCarrito)

    }

})