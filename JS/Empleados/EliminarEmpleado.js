import {enviarPHP, eliminarEmpleado} from '../Modelo/Modelo.js'

    //Obtener boton eliminar empleado
    var botonesEliminar = document.getElementsByClassName('remover-empleado')

    for(var i = 0; i < botonesEliminar.length; i++) {
        botonesEliminar[i].addEventListener('click', capturarEliminar)
    }

    //Eliminar producto
    function capturarEliminar() 
    {

        //Confirmar si desea eliminar al empleado
        if(confirm("¿Seguro desea eliminar a " + (document.getElementById("nombre-empleado"+ [this.value]).textContent) + "?"))
        {
            //Instancia - datos del formulario
            var formData = new FormData()

            formData.append("idEmpleado", this.id)

            //Enviar datos a PHP
            enviarPHP(formData,"./PHP/Empleados/EliminarEmpleado.php", eliminarEmpleado)
        }
        
    }