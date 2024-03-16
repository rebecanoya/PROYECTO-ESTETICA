function llenarFormularioProducto() {
    var tablaProductos = document.getElementById("tablaProductos");
    var filaSeleccionada = tablaProductos.querySelector("tr.selected");

    if (filaSeleccionada) {
        var nombreProducto = filaSeleccionada.cells[0].innerText;
        var precio = filaSeleccionada.cells[1].innerText;
        var descripcion = filaSeleccionada.cells[2].innerText;
        var linea = filaSeleccionada.cells[3].innerText;
        var stock = filaSeleccionada.cells[4].innerText;

        document.getElementById("nombreProducto").value = nombreProducto;
        document.getElementById("precio").value = precio;
        document.getElementById("descripcionP").value = descripcion;
        document.getElementById("linea").value = linea;
        document.getElementById("stock").value = stock;
    }
}