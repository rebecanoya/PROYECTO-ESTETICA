/**
 * Aqui obtenemos la fila selecionada con el boton del lapiz de la tabla tablaProductos,
 * la cual usaremos en la funcion llenarFormularioProducto();  
 */
document.getElementById("tablaProductos").addEventListener("click", function(event) {
    var filaSeleccionada = event.target.closest("tr");
    if (filaSeleccionada) {
        llenarFormularioProducto(filaSeleccionada);
    }
});
/**
 * Con esta funcion estableceremos los valores de los inputs del formulario de los productos
 * con la informacion de las celdas de la fila que hemos selecionado anteriormente
 */
function llenarFormularioProducto(filaSeleccionada) {
    /**
     * Aqui comprobamos que exista dicha fila selecionada
     */
    if (filaSeleccionada) {
        /**
         * Creamos variables cuyos valores son los obtenidos de las diferentes celdas de la fila
         */
        var id = filaSeleccionada.cells[0].innerText;
        var nombre = filaSeleccionada.cells[1].innerText;
        var precio = parseFloat(filaSeleccionada.cells[2].innerText);
        var descripcion = filaSeleccionada.cells[3].innerText;
        var linea = parseInt(filaSeleccionada.cells[4].innerText);
        var stock = parseInt(filaSeleccionada.cells[5].innerText);
        var activoP = filaSeleccionada.cells[6].innerText;
        /**
         * Dado que la celda de Activo se muestra como si o no pero su valor, tanto en la BD como en el input, es 1 o 2,
         * hacemos un switch que le asigne el valor 1 si es Si o el valor 2 si es No, para que en el formulario aparezca selecionada
         * la opción correspondiente
         */
        switch (activoP) {
            case "Si":
                activoP = 1;
                break;
            case "No":
                activoP = 2;
                break;
        }
        /**
         * Por ultimo, asignamos los valores a los diferentes inputs con un getElementById,más el id de cada
         * input, y un value
         */
        document.getElementById("idP").value = id;
        document.getElementById("nombreProducto").value = nombre;
        document.getElementById("precio").value = precio;
        document.getElementById("descripcionP").value = descripcion;
        document.getElementById("linea").value = linea;
        document.getElementById("stock").value = stock;
        document.querySelector('input[name="activoP"][value="' + activoP + '"]').checked = true;
        /**
         * Se desactiva el boton de Agregar (para que no se pueda agregar un producto que ya existe 2 veces)
         * y se activa el boton de Modificar
         */
        document.getElementById("productoActionButton").disabled = true;
        document.getElementById("productoModButton").disabled = false;
    }
}
/**
 * Con esta funcion se resetean los valores del formulario y se
 * desactiva el boton Modificar y se activa el boton Agregar 
 */
function limpiarFormularioProducto() {
    document.getElementById("productoForm").reset();
    document.getElementById("productoActionButton").disabled = false;
    document.getElementById("productoModButton").disabled = true;
}