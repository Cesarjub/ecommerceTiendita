import {enviarPHP, guardarPedido} from '../Modelo/Modelo.js'

//Comprobar si existe el elemento 
let comprobar = document.body.contains(document.getElementById("tablaCarrito"))

if(comprobar)
{

    //Boton de finalizar compra
    const btnFinalizarCompra = document.querySelector("#btn-finalizar-compra")

    //Si el boton ha sido pulsado
    btnFinalizarCompra.addEventListener("click", function(evento)
    {

    /////////////////////// Guardar pedido ////////////////////////

        //Instancia - datos / informacion del pedido
        var datosPedido = new FormData()

        //Total a pagar
        datosPedido.append("costoTotal", parseFloat(document.getElementById("total-pagar").textContent.slice(1)))

        //Enviar datos a PHP
        fetch('./PHP/Pedidos/GuardarPedido.php', {
            //Indicamos que utilizaremos el metodo POST
            method: 'POST',
            //Mandamos los datos del formulario
            body: datosPedido
        })
    
        //Recibe la informacion del PHP en formato JSON
        .then(res => res.json())
        .then(data => {
    
        /////////////////////// Guardar detalles pedido ////////////////////////

            //console.log(data)

            //Filas de la tabla
            var rows = document.getElementById("tablaCarrito").rows

            //Obtener campos del carrito
            for(var i = 0; i < rows.length-1; i++)
            {
                //Instancia - datos / detalles del pedido
                var detallesPedido = new FormData()

                //Id de cada producto
                detallesPedido.append("idProducto", document.getElementById("producto"+ [i]).value)

                //Cantidad seleccionada de cada producto
                detallesPedido.append("cantidadTotal", document.getElementById("cantidad-carrito"+ [i]).value)

                //Total a pagar de cada producto
                detallesPedido.append("precioFinal", parseFloat(document.getElementById("total-producto"+ [i]).textContent))
            
                //Id del pedido
                detallesPedido.append("idVenta", data)

                //Enviar datos a PHP
                enviarPHP(detallesPedido,"./PHP/Pedidos/GuardarDetallesPedido.php", guardarPedido)                
            }    

            //Comprobar compra - mensaje de bienvenida
            localStorage.setItem('compra', 'realizada')

            window.location.href = "./index.php"
            
            //location.reload()  
        
        })
        .catch(function(e) {
            //alert(e)
        })
    })

        //Filas de la tabla
        /*var rows = document.getElementById("tablaCarrito").rows

        //Obtener campos del carrito
        for(var i = 0; i < rows.length-1; i++)
        {
            //Id de cada producto
            console.log(document.getElementById("producto"+ [i]).value)

            //Cantidad seleccionada de cada producto
            console.log(document.getElementById("cantidad-carrito"+ [i]).value)

            //Total a pagar de cada producto
            console.log(parseFloat(document.getElementById("total-producto"+ [i]).textContent))
        }    */

        //Total a pagar
        //console.log(parseFloat(document.getElementById("total-pagar").textContent.slice(1)))
}