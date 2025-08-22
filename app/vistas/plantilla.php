
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CRUD con PHP y MySQL">
    <meta name="keywords" content="PHP, MySQL, CRUD, Bootstrap">
    <meta name="author" content="Gino Fernando Sarubbi">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../../curso/php/assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-muted text-light ">
    <section id="contenido">
        <?php
        $rutas = ['inicio', 'registro', 'ingreso', 'salir', 'nosotros', 'error404', 'editar', 'productos'];
        $ruta = $_GET['ruta'] ?? 'nosotros';

        if (in_array($ruta, $rutas)) {
            if ($ruta === "inicio" && !isset($_SESSION["validarIngreso"])) {
                header("Location: index.php?ruta=ingreso");
                exit;
            }

            include "paginas/" . $ruta . ".php";
        } else {
            include "paginas/error404.php";
        }

        ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
</body>
<script src="./app/vistas/js/script.js"></script>
<script src="./app/vistas/js/Pass.js"></script>
<script src="./app/vistas/js/active-link.js"></script>
</html>