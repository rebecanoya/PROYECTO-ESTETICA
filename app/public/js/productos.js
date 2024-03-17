document.getElementById("tablaProductos").addEventListener("click", function(event) {
    var filaSeleccionada = event.target.closest("tr");
    if (filaSeleccionada) {
        llenarFormularioProducto(filaSeleccionada);
    }
});

function llenarFormularioProducto(filaSeleccionada) {
    var id = filaSeleccionada.cells[0].innerText;
    var nombre = filaSeleccionada.cells[1].innerText;
    var precio = parseFloat(filaSeleccionada.cells[2].innerText);
    var descripcion = filaSeleccionada.cells[3].innerText;
    var linea = parseInt(filaSeleccionada.cells[4].innerText);
    var stock = parseInt(filaSeleccionada.cells[5].innerText);
    var activoP = filaSeleccionada.cells[6].innerText;

    document.getElementById("idP").value = id;
    document.getElementById("nombreProducto").value = nombre;
    document.getElementById("precio").value = precio;
    document.getElementById("descripcionP").value = descripcion;
    document.getElementById("linea").value = linea;
    document.getElementById("stock").value = stock;
    switch (activoP) {
        case "Si":
            activoP = 1;
            break;
        case "No":
            activoP = 2;
            break;
    }
    document.querySelector('input[name="activoP"][value="' + activoP + '"]').checked = true;
    document.getElementById("productoActionButton").disabled = true;
    document.getElementById("productoModButton").disabled = false;
}

function limpiarFormularioProducto() {
    document.getElementById("productoForm").reset();
    document.getElementById("productoActionButton").disabled = false;
    document.getElementById("productoModButton").disabled = true;
    document.getElementById("resetProducto").disabled = true;
}