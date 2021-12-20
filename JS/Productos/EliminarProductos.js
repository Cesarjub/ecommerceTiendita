import {enviarPHP, eliminarProducto} from '../Modelo/Modelo.js'

    //Obtener boton eliminar empleado
    var botonesEliminar = document.getElementsByClassName('remover-producto')

    for(var i = 0; i < botonesEliminar.length; i++) {
        botonesEliminar[i].addEventListener('click', capturarEliminar)
    }

    //Eliminar producto
    function capturarEliminar() 
    {

        //Confirmar si desea eliminar al empleado
        if(confirm("¿Seguro desea eliminar " + (document.getElementById("nombre-producto"+ [this.value]).textContent) + "?"))
        {
            //Instancia - datos del formulario
            var formData = new FormData()

            formData.append("idProducto", this.id)

            //Enviar datos a PHP
            enviarPHP(formData,"./PHP/Productos/EliminarListaProducto.php", eliminarProducto)
        }
        
    }