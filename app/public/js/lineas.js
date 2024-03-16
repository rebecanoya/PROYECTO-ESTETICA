function llenarFormularioLineaCosmetica() {
    var tablaLineaCosmetica = document.getElementById("lineasCosmeticas");
    var filaSeleccionada = tablaLineaCosmetica.querySelector("tr.selected");

    if (filaSeleccionada) {
        var nombre = filaSeleccionada.cells[0].innerText;
        var color = filaSeleccionada.cells[1].innerText;
        var musica = filaSeleccionada.cells[2].innerText;
        var descripcion = filaSeleccionada.cells[3].innerText;

        document.getElementById("nombre").value = nombre;
        document.getElementById("color").value = color;
        document.getElementById("musica").value = musica;
        document.getElementById("descripcion").value = descripcion;
    }
}