function incrementar(event) {
    event.preventDefault();
    var cantidadInput = document.getElementById('cantidad');
    var cantidad = parseInt(cantidadInput.value, 10);
    cantidadInput.value = cantidad + 1;
}

function decrementar(event) {
    event.preventDefault();
    var cantidadInput = document.getElementById('cantidad');
    var cantidad = parseInt(cantidadInput.value, 10);
    if (cantidad > 1) {
        cantidadInput.value = cantidad - 1;
    }
}