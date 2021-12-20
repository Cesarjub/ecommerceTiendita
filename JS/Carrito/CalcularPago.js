import {enviarPHP, eliminarProducto, modificarCantidad} from '../Modelo/Modelo.js'

//Comprobar si existe el elemento 
let comprobar = document.body.contains(document.getElementById("tablaCarrito"))

if(comprobar)
{
    calcularProducto()

    //Calcular nuevo total de productos
    function calcularProducto()
    {
        //Filas de la tabla
        var rows = document.getElementById("tablaCarrito").rows

        //Obtener total de productos
        for(var i = 0; i < rows.length-1; i++)
        {
            //Multiplicar cantidad por precio de producto
            document.getElementById("total-producto"+[i]).innerHTML = 
            (parseFloat(document.getElementById("precio-producto-unitario"+ [i]).textContent.slice(1))
            * parseFloat(document.getElementById("cantidad-carrito"+ [i]).value))
        }
    }      

    calcularTotalFinal()

    //Obtener total del carrito
    function calcularTotalFinal()
    {
        //Filas de la tabla
        var rows = document.getElementById("tablaCarrito").rows

        let totalCarrito = 0;

        //Sumar elementos totales
        for(var i = 0; i < rows.length-1; i++)
        {
            totalCarrito += parseFloat(document.getElementById("total-producto"+ [i]).textContent)
        }

        //Inserar en HTML
        document.getElementById("total-carrito").innerHTML = "$" + totalCarrito
        document.getElementById("total-pagar").innerHTML = "$" + totalCarrito
    }

    //Obtener boton resta
    var botonesResta = document.getElementsByClassName('boton-restar-cantidad')

    for(var i = 0; i < botonesResta.length; i++){
        botonesResta[i].addEventListener('click', capturarResta)
    }
    
    //Realizar resta
    function capturarResta() 
    {
        //console.log(this.id)
        var cantidadProducto = document.getElementById("cantidad-carrito" + this.id).value
        
        if(cantidadProducto != 1)
        {
            document.getElementById("cantidad-carrito" + this.id).value = parseInt(cantidadProducto) - 1
            
            calcularProducto()
            calcularTotalFinal()
            modificarCarrito(this.id)
        }
    }

    //Obtener boton suma
    var botonesSuma = document.getElementsByClassName('boton-sumar-cantidad')

    for(var i = 0; i < botonesSuma.length; i++) {
        botonesSuma[i].addEventListener('click', capturarSuma)
    }

    //Realizar suma
    function capturarSuma() 
    {
        //console.log(this.id)
        var cantidadProducto = document.getElementById("cantidad-carrito" + this.id).value

        document.getElementById("cantidad-carrito" + this.id).value = parseInt(cantidadProducto) + 1

        calcularProducto()
        calcularTotalFinal()
        modificarCarrito(this.id)
    }

    //Obtener boton eliminar producto
    var botonesEliminar = document.getElementsByClassName('remover-producto')

    for(var i = 0; i < botonesEliminar.length; i++) {
        botonesEliminar[i].addEventListener('click', capturarEliminar)
    }

    //Eliminar producto
    function capturarEliminar() 
    {
        //Instancia - datos del formulario
        var formData = new FormData()

        formData.append("idProducto", this.id)

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Carrito/EliminarProducto.php", eliminarProducto)
    }

    function modificarCarrito(seleccion)
    {

        //ID del producto
        var idProducto = document.getElementById("producto" + seleccion).value

        //Cantidad seleccionada
        var cantidadProducto = document.getElementById("cantidad-carrito" + seleccion).value

        //Instancia - datos del formulario
        var formData = new FormData()

        formData.append("idProducto", idProducto)

        formData.append("cantidadProducto", cantidadProducto)

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Carrito/ModificarCantidad.php", modificarCantidad)        
    }

}
