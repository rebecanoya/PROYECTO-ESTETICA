/**
 * funcion que actualiza la cantidad de productos
 *
 * @param   {object}  event    objeto evento
 * @param   {int}  cantidad    cantidad a incrementar
 * @param   {int}  id          id del producto
 *
 * @return  {boolean}          verdadero si se actualizó la cantidad
 */
async function actualizarCantidad(event, cantidad, id) {
    event.preventDefault();

    await fetch("controladorCesta.php", {
        method: "POST",
        mode: "cors",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        body: JSON.stringify({
            "id": id,
            "cantidad": 0,
            "accion": "stock"
        })

    }).then(res => res.json()).then(res => {

        if (!res[0]) {
            return res;
        }

        let elementoInput = document.getElementById(id);
        let cantidadInput = parseInt(elementoInput.value);

        if (cantidadInput + cantidad >= 1) {
            elementoInput.value = Math.min(cantidadInput + cantidad, res[1]);
            return true;

        } return false;
    });

}