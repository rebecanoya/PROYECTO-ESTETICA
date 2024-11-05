/**
 * Aqui obtenemos la fila selecionada con el boton del lapiz de la tabla usuarios,
 * la cual usaremos en la funcion llenarFormularioUsuario();  
 */
document.getElementById("usuarios").addEventListener("click", function(event) {
    var filaSeleccionada = event.target.closest("tr");
    if (filaSeleccionada) {
        llenarFormularioUsuario(filaSeleccionada);
    }
});
/**
 * Con esta funcion estableceremos los valores de los inputs del formulario de los productos
 * con la informacion de las celdas de la fila que hemos selecionado anteriormente
 */
function llenarFormularioUsuario(filaSeleccionada) { 
    /**
     * Aqui comprobamos que exista dicha fila selecionada
     */
    if (filaSeleccionada) {
        /**
         * Creamos variables cuyos valores son los obtenidos de las diferentes celdas de la fila
         */
        var id = filaSeleccionada.cells[0].innerText;
        var correo = filaSeleccionada.cells[1].innerText;
        var rol = filaSeleccionada.cells[2].innerText;
        var activo = filaSeleccionada.cells[3].innerText;
        /**
         * Dado que, tanto la celda de Activo como la de Rol, se muestran, como si o no o como Admin, Alumno o Cliente respectivamente,
         * pero su valor, tanto en la BD como en el input, es 1 o 2 o 1, 2 o 3 respectivamente, hacemos un switch que le asigne el valor
         * 1 si es Si o el valor 2 si es No, para que en el formulario aparezca selecionada la opción correspondiente
         */      
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
        /**
         * Por ultimo, asignamos los valores a los diferentes inputs con un getElementById,más el id de cada
         * input, y un value
         */
        document.getElementById("idU").value = id;
        document.getElementById("email").value = correo;
        document.querySelector('input[name="rol"][value="' + rol + '"]').checked = true;
        document.querySelector('input[name="activoU"][value="' + activo + '"]').checked = true;
        /**
         * Con estos dos llamados a funciones presentes también en este archivo
         * activamos los botones tanto de reset como de modificar y desactivamos el input de contraseña junto con el boton Agregar
         */
        activarBoton();
        desactivarInputs();
    }
}
/**
 * Con esta funcion activo los botones de Modificar y Reset
 */
function activarBoton() {
    document.getElementById('usuarioModButton').removeAttribute('disabled');
    document.getElementById('resetUsuario').removeAttribute('disabled');
}

/**
 * Con esta funcion desactivo los inputs de Contraseña, Repetir Contraseña y el boton Agregar
 */
function desactivarInputs() {
    var inputs = document.querySelectorAll('#usuarioForm input:not([name="rol"],[name="activoU"],[name="email"], [name="idU"])');
    inputs.forEach(function(input) {
        input.disabled = true;
    });
    document.getElementById('usuarioActionButton').disabled = true;
}
/**
 * Aqui reactivo los inputs de Contraseña, Repetir Contraseña
 */
function activarInputs() {
    var inputs = document.querySelectorAll('#usuarioForm input:not([name="rol"],[name="activoU"],[name="email"], [name="idU"])');
    inputs.forEach(function(input) {
        input.disabled = false;
    });
}
/**
 * Con esta funcion se resetean los valores del formulario y se
 * desactiva el boton Modificar, Reset, se activa el boton Agregar y los inputs de Contraseña y Repetir Contraseña
 */
function limpiarFormularioUsuario() {
    document.getElementById("usuarioForm").reset();
    document.getElementById('usuarioModButton').disabled = true
    document.getElementById('usuarioActionButton').removeAttribute('disabled');
    activarInputs();
}