document.getElementById("usuarios").addEventListener("click", function(event) {
    var filaSeleccionada = event.target.closest("tr");
    if (filaSeleccionada) {
        llenarFormularioUsuario(filaSeleccionada);
    }
});

function llenarFormularioUsuario(filaSeleccionada) { 
        var id = filaSeleccionada.cells[0].innerText;
        var correo = filaSeleccionada.cells[1].innerText;
        var rol = filaSeleccionada.cells[2].innerText;
        var activo = filaSeleccionada.cells[3].innerText;

        document.getElementById("idU").value = id;
        document.getElementById("email").value = correo;
        switch (rol) {
            case "Admin":
                rol = 1;
                break;
            case "Alumno":
                rol = 2;
                break;
            case "Cliente":
                rol = 3;
                break;
        };
        switch (activo) {
            case "Si":
                activo = 1;
                break;
            case "No":
                activo = 2;
                break;
        }
        document.querySelector('input[name="rol"][value="' + rol + '"]').checked = true;
        document.querySelector('input[name="activoU"][value="' + activo + '"]').checked = true;
        activarBoton();
        desactivarInputs();
    }

function activarBoton() {
    document.getElementById('usuarioModButton').removeAttribute('disabled');
    document.getElementById('resetUsuario').removeAttribute('disabled');
}

// Función para desactivar los inputs y el botón Agregar
function desactivarInputs() {
    var inputs = document.querySelectorAll('#usuarioForm input:not([name="rol"],[name="activoU"],[name="email"], [name="idU"])');
    inputs.forEach(function(input) {
        input.disabled = true;
    });
    document.getElementById('usuarioActionButton').disabled = true;
}
function activarInputs() {
    var inputs = document.querySelectorAll('#usuarioForm input:not([name="rol"],[name="activoU"],[name="email"], [name="idU"])');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
}

function limpiarFormularioUsuario() {
    document.getElementById("usuarioForm").reset();
    document.getElementById('usuarioModButton').disabled = true
    document.getElementById('usuarioActionButton').removeAttribute('disabled');
    activarInputs();
}