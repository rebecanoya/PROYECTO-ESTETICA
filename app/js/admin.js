/**
 *  Agregar evento de click a las filas de las tablas para marcarlas como seleccionadas
 */
document.addEventListener("DOMContentLoaded", function () {
    var filas = document.querySelectorAll("tbody tr");

    filas.forEach(function (fila) {
        fila.addEventListener("click", function () {
            // Eliminar la clase "selected" de todas las filas
            filas.forEach(function (otraFila) {
                otraFila.classList.remove("selected");
            });

            // Agregar la clase "selected" a la fila seleccionada
            fila.classList.add("selected");
        });
    });
});