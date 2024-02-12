<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/quienessomos.css">
    <script src="https://kit.fontawesome.com/dc2d3ea46f.js" crossorigin="anonymous"></script>
    <title>Contacto</title>
</head>

<body>
    <?php

    include "../../src/templates/header.php"

    ?>

    <main>

        
        <article class="info">
            <section class="descripcion">
                <h2>QUIENES SOMOS?</h6>
                <div class="quienes">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                    Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                    est quam labore numquam, quasi laudantium.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                    Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                    est quam labore numquam, quasi laudantium.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                    Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                    est quam labore numquam, quasi laudantium.
                </div>
                <h2>IMAGENES</h6>
                <div class="imagenes">
                    <button id="prev-btn" onclick=""><i class="fa-solid fa-chevron-left"></i></button>
                    <img class="img" src="../img/imagenEjemploBlog.jpg" alt="img1">
                    <button id="next-btn" onclick=""><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </section>
            <section class="datos">
                <div class="container">
                    <div class="button-container">
                        <button class="custom-button">Botón 1</button>
                        <button class="custom-button">Botón 2</button>
                        <button class="custom-button">Botón 3</button>
                    </div>
                    
                    <div class="text-container">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                            Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                            est quam labore numquam, quasi laudantium.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                            Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                            est quam labore numquam, quasi laudantium.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores obcaecati natus rem id accusantium. 
                            Aspernatur nulla, earum tempora dolore recusandae accusamus quo aliquam veritatis, 
                            est quam labore numquam, quasi laudantium.
                        </p>
                    </div>
                </div>
            </section>
        </article>
    </main>

        <?php

        include "../../src/templates/footer.php"

        ?>

</body>
 
</html>