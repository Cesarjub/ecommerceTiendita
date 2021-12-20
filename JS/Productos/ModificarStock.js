import {enviarPHP, modificarStock} from '../Modelo/Modelo.js'

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
            
            modificarStockProducto(this.id)
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

        modificarStockProducto(this.id)
    }

    //Modificar Stock
    function  modificarStockProducto(seleccion)
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
        enviarPHP(formData,"./PHP/Productos/ModificarStock.php", modificarStock)      
        //console.log(idProducto)  
    }