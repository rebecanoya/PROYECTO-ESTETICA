
function actualizarCantidad(event, cantidad, id) {
    event.preventDefault();
    let elementoInput = document.getElementById(id);
    let cantidadInput = parseInt(elementoInput.value);

    if (cantidadInput + cantidad >= 1) {
        elementoInput.value = cantidadInput + cantidad;
        return true;


    } return false;
}