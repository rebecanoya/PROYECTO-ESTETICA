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
 * Con esta funcion estableceremos los valores de los inputs del formulario de las lineas
 * con la informacion de las celdas de la fila que hemos selecionado anteriormente
 */
function llenarFormularioLineaCosmetica(filaSeleccionada) {
    /**
     * Aqui comprobamos que exista dicha fila selecionada
     */
    if (filaSeleccionada) {
        /**
         * Creamos variables cuyos valores son los obtenidos de las diferentes celdas de la fila
         */
        var id = filaSeleccionada.cells[0].innerText;
        var nombre = filaSeleccionada.cells[1].innerText;
        var color = "#" + filaSeleccionada.cells[2].innerText;
        var musica = filaSeleccionada.cells[3].innerText;
        var descripcion = filaSeleccionada.cells[4].innerText;
        var activo = filaSeleccionada.cells[5].innerText;
        /**
         * Dado que la celda de Activo se muestra como si o no pero su valor, tanto en la BD como en el input, es 1 o 2,
         * hacemos un switch que le asigne el valor 1 si es Si o el valor 2 si es No, para que en el formulario aparezca selecionada
         * la opción correspondiente
         */
        switch (activo) {
            case "Si":
                activo = 1;
                break;
            case "No":
                activo = 2;
                break;
        }
        /**
         * Por ultimo, asignamos los valores a los diferentes inputs con un getElementById,más el id de cada
         * input, y un value
         */
        document.getElementById("idL").value = id;
        document.getElementById("nombre").value = nombre;
        document.getElementById("color").value = color;
        document.getElementById("musica").value = musica;
        document.getElementById("descripcion").value = descripcion;
        document.querySelector('input[name="activoL"][value="' + activo + '"]').checked = true;
        /**
         * Se desactiva el boton de Agregar (para que no se pueda agregar una linea que ya existe 2 veces)
         * y se activa el boton de Modificar
         */
        document.getElementById("lineasActionButton").disabled = true;
        document.getElementById("lineasModButton").disabled = false;
    }
}
/**
 * Con esta funcion se resetean los valores del formulario y se
 * desactiva el boton Modificar y se activa el boton Agregar 
 */
function limpiarFormularioLineas() {
    document.getElementById("lineaCosmeticaForm").reset();
    document.getElementById("lineasActionButton").disabled = false;
    document.getElementById("lineasModButton").disabled = true;
}