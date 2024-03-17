async function peticionCarrito(id, cantidad, accion) {

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
            "cantidad": cantidad,
            "accion": accion
        })

    }

    ).then(res => res.text()).then(res => console.log(res))
}
