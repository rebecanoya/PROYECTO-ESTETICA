<?php

include 'src/iniciarPHP.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Blog | Aromusicoterapia</title>
</head>

<body>

    <img src="img/banner.jpg" class="banner">
    <?php

    include "src/templates/header.php"

    ?>

    <div class="content">
        <div>

            <main>
                <article>
                    <section>
                        <?php
                        $BBDD = new BBDD();
                        $sql = "SELECT titulo from blog order by fecha desc limit 1";
                        // Verificamos si se ha enviado el formulario

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Verificamos qué botón se ha presionado
                            if (isset($_POST['btn1'])) {
                                $sql = 'SELECT titulo from blog where id = 1'; // Actualiza la consulta según tus necesidades
                            } elseif (isset($_POST['btn2'])) {
                                $sql = 'SELECT titulo from blog where id = 2'; // Actualiza la consulta según tus necesidades
                            } elseif (isset($_POST['btn3'])) {
                                $sql = 'SELECT titulo from blog where id = 3'; // Actualiza la consulta según tus necesidades
                            }
                            // Puedes ejecutar la consulta SQL aquí o realizar otras acciones según tu aplicación
                        }
                        $resultado = $BBDD->select($sql);
                        $resultado = $resultado[0];
                        $titulo = $resultado["titulo"];
                        echo "<header>" . $titulo . "</header>";
                        ?>
                        <div class="entradaCompleta">
                            <img src="img/imagenEjemploBlog.jpg">
                            <?php
                            $BBDD = new BBDD();
                            $sql = "SELECT entrada from blog order by fecha desc limit 1";
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Verificamos qué botón se ha presionado
                                if (isset($_POST['btn1'])) {
                                    $sql = 'SELECT entrada from blog where id = 1'; // Actualiza la consulta según tus necesidades
                                } elseif (isset($_POST['btn2'])) {
                                    $sql = 'SELECT entrada from blog where id = 2'; // Actualiza la consulta según tus necesidades
                                } elseif (isset($_POST['btn3'])) {
                                    $sql = 'SELECT entrada from blog where id = 3'; // Actualiza la consulta según tus necesidades
                                }
                                // Puedes ejecutar la consulta SQL aquí o realizar otras acciones según tu aplicación
                            }
                            $resultado = $BBDD->select($sql);
                            $resultado = $resultado[0];
                            $entrada = $resultado["entrada"];
                            echo "<div class=entrada>" . $entrada . "</div>";
                            ?>
                        </div>
                    </section>
                </article>
            </main>

            <aside id="menuLateral">
                <form method="post">
                    <?php
                    $BBDD = new BBDD();
                    $sql = "SELECT titulo from blog order by fecha asc";
                    // $param = ["titulo" =>  "Primera Entrada"];
                    $resultado = $BBDD->select($sql);
                    for ($i = 0; $i < count($resultado); $i++) {
                        $fila = $resultado[$i];
                        echo "<button class=btnBlog type=submit name=btn" . $i + 1 . ">" . $fila["titulo"] . "</button>";
                    }
                    ?>
                </form>
            </aside>
        </div>
    </div>

    <?php

    include "src/templates/footer.php"

    ?>


</body>

</html>