/**
 * funcion que actualiza la cantidad de productos
 *
 * @param   {object}  event    objeto evento
 * @param   {int}  cantidad    cantidad a incrementar
 * @param   {int}  id          id del producto
 *
 * @return  {boolean}          verdadero si se actualizó la cantidad
 */
function actualizarCantidad(event, cantidad, id) {
    event.preventDefault();
    let elementoInput = document.getElementById(id);
    let cantidadInput = parseInt(elementoInput.value);

    if (cantidadInput + cantidad >= 1) {
        elementoInput.value = cantidadInput + cantidad;
        return true;


    } return false;
}