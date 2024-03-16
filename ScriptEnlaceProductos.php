<script>
    const productos = document.getElementsByClassName("producto");
    for (const producto of productos) {
        producto.addEventListener("click", () => {

            location.href = `ProductoVista.php?id=${producto.dataset.idproducto}`;

        });

    }
</script>