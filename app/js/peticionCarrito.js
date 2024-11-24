const cartCount = document.getElementById("cartCount");

/**
 * peticion para modificacion del carrito
 *
 * @param   {int}  id        id del producto
 * @param   {int}  cantidad  cantidad del producto
 * @param   {string}  accion    tipo de accion a realizar
 *
 */
async function peticionCarrito(id, cantidad, accion) {

    return await fetch("controladorCesta.php", {
        method: "POST",
        mode: "cors",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        body: JSON.stringify({
            "id": id,
            "cantidad": cantidad,
            "accion": accion
        })

    }).then(res => res.json()).then(res => {

        if (!res[0]) {
            return res;
        }
        var actual = cartCount.innerText;
        if (actual == "") {
            actual = 0;
        }
        var amount = parseInt(res[1]);
        cartCount.innerText = parseInt(actual) + amount;

        if (amount > 0) {
            animacion();
        }
        return res;
    });


}

function animacion() {
    cartCount.parentNode.classList.remove("animar");
    void cartCount.parentNode.offsetWidth;
    cartCount.parentNode.classList.add("animar");
}
