<?php
require_once "app\modelos\usuario.php";
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: index.php?ruta=ingreso");
    exit;
}

?>

<head>
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        overflow-y: auto;
    }

    .content {
        margin-left: 250px;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        padding: 1rem;
        overflow-y: auto;
        flex: 1;
    }
    </style>
</head>

<nav class="sidebar bg-light border-end d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-4 text-decoration-none">
        <span class="fs-4 ms-2 fw-bold">UserManager</span>
    </a>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="#" class="nav-link active" aria-current="page">
                <i class="bi bi-house-door-fill me-2"></i> Inicio
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-person-add me-2"></i> Agregar Usuario
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link link-dark">
                <i class="bi bi-grid-fill me-2"></i> Productos
            </a>
        </li>
    </ul>
    <hr>
</nav>

<div class="content">

    <header class="bg-light text-dark d-flex justify-content-between align-items-center p-3 border-bottom">

        <?php
        if($_SESSION['usuario']->getGenero() === 'Masculino') {
            echo '<h2 class="mb-0">Bienvenido, ' . htmlspecialchars($_SESSION['usuario']->getNombre()) . '!</h2>';
        } else if($_SESSION['usuario']->getGenero() === 'Femenino') {
            echo '<h2 class="mb-0">Bienvenida, ' . htmlspecialchars($_SESSION['usuario']->getNombre()) . '!</h2>';
        } else {
            echo '<h2 class="mb-0">Hola, ' . htmlspecialchars($_SESSION['usuario']->getNombre()) . '!</h2>';
        }

        ?>

        <div class="dropdown mt-auto">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person" style="font-size: 2em;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Perfil</a></li>
                <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="index.php?ruta=ingreso">Cerrar Sesion</a></li>
            </ul>
        </div>
    </header>
    <main class="main-content">
        <div class="container mt-4">
            <h1 class="mb-4">Panel de Usuarios</h1>
            <p>Usuarios del sistema...</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Género</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['usuarios'])) {
                        foreach ($_SESSION['usuarios'] as $index => $usuario) {
                            echo "<tr>
                                    <th scope='row'>" . ($index + 1) . "</th>
                                    <td>" . htmlspecialchars($usuario->getNombre()) . "</td>
                                    <td>" . htmlspecialchars($usuario->getEmail()) . "</td>
                                    <td>" . htmlspecialchars($usuario->getGenero()) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay usuarios registrados.</td></tr>";
                    }
                    ?>
                </tbody>

        </div>