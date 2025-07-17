<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="../../../../curso/php/public/assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-dark2 text-light ">
    <header class="d-flex justify-content-around align-items-center h-10 position-absolute w-100 ">
        <h1>
            <strong>UserManager</strong>
        </h1>
        <nav>
            <ul class="d-flex justify-content-center gap-3 list-unstyled m-0 p-0">
                <li>
                    <a href="index.php?ruta=inicio" class="nav-link"> Inicio</a>
                </li>
                <li>
                    <a href="index.php?ruta=registro" class="nav-link"> Registrarse</a>
                </li>
                <li>
                    <a href="index.php?ruta=ingreso" class="nav-link"> Iniciar Sesion </a>
                </li>
                <li>
                    <a href="index.php?ruta=nosotros" class="nav-link"> Nosotros</a>
                </li>
                <li>
                    <a href="index.php?ruta=salir" class="nav-link"> Salir</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container d-flex justify-content-center align-items-center">
        <section id="contenido">
            <?php
            $rutas = ['inicio', 'registro', 'ingreso', 'salir', 'nosotros'];

            if (in_array($_GET['ruta'] ?? '', $rutas)) {
                include "paginas/" . $_GET['ruta'] . ".php";
            } else {
                include "paginas/error404.php";
            }
           
            ?>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

</body>

</html>