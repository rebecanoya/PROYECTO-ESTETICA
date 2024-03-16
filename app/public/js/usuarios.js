function llenarFormularioUsuario() {
    var tablaUsuarios = document.getElementById("usuarios");
    var filaSeleccionada = tablaUsuarios.querySelector("tr.selected");

    if (filaSeleccionada) {
        var correo = filaSeleccionada.cells[0].innerText;
        var rol = filaSeleccionada.cells[1].innerText;

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
        }
        document.querySelector('input[name="rol"][value="' + rol + '"]').checked = true;
    }
}