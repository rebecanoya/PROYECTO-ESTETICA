/**
 * Aqui obtenemos la fila selecionada con el boton del lapiz de la tabla lineasCosmeticas,
 * la cual usaremos en la funcion llenarFormularioLineaCosmetica();  
 */
document.getElementById("lineasCosmeticas").addEventListener("click", function(event) {
    var filaSeleccionada = event.target.closest("tr");
    if (filaSeleccionada) {
        llenarFormularioLineaCosmetica(filaSeleccionada);
    }
});

/**
 * Con esta funcion estableceremos como valores del formulario
 */
function llenarFormularioLineaCosmetica(filaSeleccionada) {
    if (filaSeleccionada) {
        var id = filaSeleccionada.cells[0].innerText;
        var nombre = filaSeleccionada.cells[1].innerText;
        var color = "#" + filaSeleccionada.cells[2].innerText;
        var musica = filaSeleccionada.cells[3].innerText;
        var descripcion = filaSeleccionada.cells[4].innerText;
        var activo = filaSeleccionada.cells[5].innerText;
        switch (activo) {
            case "Si":
                activo = 1;
                break;
            case "No":
                activo = 2;
                break;
        }
        document.getElementById("idL").value = id;
        document.getElementById("nombre").value = nombre;
        document.getElementById("color").value = color;
        document.getElementById("musica").value = musica;
        document.getElementById("descripcion").value = descripcion;
        document.querySelector('input[name="activoL"][value="' + activo + '"]').checked = true;
        document.getElementById("lineasActionButton").disabled = true;
        document.getElementById("lineasModButton").disabled = false;
    }
}

function limpiarFormularioLineas() {
    document.getElementById("lineaCosmeticaForm").reset();
    document.getElementById("lineasActionButton").disabled = false;
    document.getElementById("lineasModButton").disabled = true;
}