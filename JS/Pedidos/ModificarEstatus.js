import {enviarPHP, modificarEstatus, mensajeAlertaError, validarComboBox} from '../Modelo/Modelo.js'

    //Obtener boton cancelar pedido
    var botonesCancelar = document.getElementsByClassName('boton-cancelar-pedido')

    for(var i = 0; i < botonesCancelar.length; i++) {
        botonesCancelar[i].addEventListener('click', capturarEstatusCancelar)
    }
    
    //Establecer estatus cancelar
    function capturarEstatusCancelar() 
    {
        //console.log(this.id)
        //Obtener id del pedido
        var idPedido = document.getElementById("idPedido" + this.id).value

        //console.log(idPedido + "CANCELADO" + null)

        modificarEstatusPedidos(idPedido, 'CANCELADO', null)
    }

    //Obtener boton entregar pedido
    var botonesEntregar = document.getElementsByClassName('boton-entregar-pedido')

    for(var i = 0; i < botonesEntregar.length; i++) {
        botonesEntregar[i].addEventListener('click', capturarEstatusEntregar)
    }
    
    //Establecer estatus entregar
    function capturarEstatusEntregar() 
    {
        //console.log(this.id)
        //Obtener id del pedido
        var idPedido = document.getElementById("idPedido" + this.id).value

        //console.log(idPedido + "ENTREGADO" + null)

        modificarEstatusPedidos(idPedido, 'ENTREGADO', null)
    }


    //Obtener boton enviar pedido
    var botonesEnviar = document.getElementsByClassName('boton-enviar-pedido')

    for(var i = 0; i < botonesEnviar.length; i++) {
        botonesEnviar[i].addEventListener('click', capturarEstatusEnviar)
    }
    
    var obtenerIdSeleccionado = 0

    //Establecer estatus enviar
    function capturarEstatusEnviar() 
    {
        //console.log(this.id)
        //Obtener id del pedido
        //var idPedido = document.getElementById("idPedido" + this.id).value

        obtenerIdSeleccionado = document.getElementById("idPedido" + this.id).value

        //console.log(idPedido + "ENTREGADO" + null)
    }

    //Formulario - Seleccionar repartidor
    var formularioSeleccionarRepartidor = document.getElementById('repartidor-pedido-seleccion')

    //Detectar formulario - clic en el boton
    formularioSeleccionarRepartidor.addEventListener('submit', function(e) 
    {
        
        //Evita que se ejecute el evento por defecto
        e.preventDefault()

        //Obtener id del combobox
        var seleccionRepartidor = document.getElementById("combo-repartidores").value 

        if(validarComboBox(seleccionRepartidor))
        {
            //console.log("si " + obtenerIdSeleccionado)

            modificarEstatusPedidos(obtenerIdSeleccionado, 'ENVIADO', seleccionRepartidor)
        }
        else
            mensajeAlertaError("Debe seleccionar un repartidor para continuar.", "mensajeAlerta")
    })

    //Modificar estatus
    function  modificarEstatusPedidos(seleccion, estatus, repartidor)
    {

        //Instancia - datos del formulario
        var formData = new FormData()

        formData.append("idPedido", seleccion)
        formData.append("estatusPedido", estatus)
        formData.append("repartidorPedido", repartidor)        

        //Enviar datos a PHP
        enviarPHP(formData,"./PHP/Pedidos/ModificarEstatus.php", modificarEstatus)     
    }