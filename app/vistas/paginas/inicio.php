<style>
    body {
        min-height: 100vh;
        background-color: #f4f6f8;
    }

    .sidebar {
        min-width: 250px;
        max-width: 250px;
        background-color: #343a40;
    }

    .sidebar .nav-link {
        color: #ebe9e9ff;
    }

    .sidebar .nav-link.active {
        background-color: #2c8cecff;
        color: #fff;
    }

    .sidebar .nav-link:hover {
        background-color: #2c8cecff;
        color: #fff;
    }

    .card-stats {
        border: .2px solid #f0f0f0ff;
        border-radius: .5rem;
        transition: transform 0.2s ease-in-out;
        /* evita que su contenido provoque overflow en flex containers */
        min-width: 0;
    }

    .card-stats:hover {
        transform: translateY(-4px);
    }

    /* ajustes móviles */
    @media (max-width: 767px) {
        header h1 {
            font-size: 1.25rem;
            line-height: 1.1;
        }

        table-responsive {
            overflow-x: auto;
            /* ya debería venir de Bootstrap, pero lo reafirmamos */
            -webkit-overflow-scrolling: touch;
            /* scroll suave en iOS */
        }

        /* en pantallas chicas dejá que la tabla sea tan ancha como su contenido para que aparezca el scroll */
        @media (max-width: 992px) {
            .table-responsive>.table {
                width: max-content;
            }
        }

        /* opcional: achicar padding y fuente en celular para que se vea mejor sin romper tanto */
        @media (max-width: 576px) {

            .table-responsive th,
            .table-responsive td {
                padding: .3rem .4rem;
                font-size: .75rem;
                white-space: nowrap;
                /* mantiene todo en una línea para que scrollee y no se desarme */
            }
        }

    }
</style>
<div class="d-flex">
    <nav id="sidebarMenuDesktop"
        class="sidebar d-none d-md-flex vh-100 flex-column p-3 bg-dark">
        <a href="#" class="d-flex align-items-center mb-4 gap-3 text-decoration-none">
            <i class="bi bi-kanban fs-1 text-danger"></i>
            <span class="fs-4 text-white"><strong>UserManager</strong></span>
        </a>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-1">
                <a href="index.php?ruta=inicio" class="nav-link active">
                    <i class="bi bi-house-door-fill me-2"></i> <strong>Inicio</strong>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="index.php?ruta=addUsuario" class="nav-link">
                    <i class="bi bi-person-plus-fill me-2"></i> <strong>Agregar Usuario</strong>
                </a>
            </li>
            <li class="nav-item mb-4">
                <a href="index.php?ruta=productos" class="nav-link">
                    <i class="bi bi-box-seam me-2"></i> <strong>Productos</strong>
                </a>
            </li>
        </ul>
        <div class="mt-auto">
            <a href="index.php?ruta=ingreso" class="btn btn-sm btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 d-flex flex-column">
        <header class="d-flex align-items-center justify-content-between bg-white border-bottom p-3">
            <?php
            $gen    = strtolower($_SESSION['usuario']['genero'] ?? '');
            $saludo = ($gen === 'femenino') ? 'Bienvenida' : 'Bienvenido';
            ?>
            <h1 class="mb-0 text-black fw-semibold">
                <span class="d-block d-sm-inline"><?= $saludo ?>,</span>
                <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong>
            </h1>

            <!-- botón móvil que abre offcanvas -->
            <button class="btn btn-outline-secondary d-md-none" type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenuMobile"
                aria-controls="sidebarMenuMobile"
                aria-label="Mostrar menú">
                <i class="bi bi-list fs-2"></i>
            </button>

            <!-- OFFCANVAS MÓVIL -->
            <section class="offcanvas offcanvas-start d-md-none bg-dark text-white" tabindex="-1" id="sidebarMenuMobile"
                aria-labelledby="sidebarMenuMobileLabel">
                <div class="offcanvas-header">
                    <a href="#" class="d-flex align-items-center mb-4 gap-3 text-decoration-none">
                        <i class="bi bi-kanban fs-1 text-danger"></i>
                        <h5 class="offcanvas-title text-white font-bold" id="sidebarMenuMobileLabel">UserManager</h5>
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Cerrar"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item mb-1">
                            <a href="index.php?ruta=inicio" class="nav-link active">
                                <i class="bi bi-house-door-fill me-2 text-white"></i> <strong>Inicio</strong>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="index.php?ruta=addUsuario" class="nav-link">
                                <i class="bi bi-person-plus-fill me-2 text-white"></i> <strong class="text-white">Agregar Usuario</strong>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a href="index.php?ruta=productos" class="nav-link">
                                <i class="bi bi-box-seam me-2 text-white"></i> <strong class="text-white">Productos</strong>
                            </a>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <a href="index.php?ruta=ingreso" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión
                        </a>
                    </div>
                </div>
            </section>
        </header>

        <!-- DASHBOARD CARDS -->
        <div class="container-fluid p-4 flex-grow-1">
            <div class="row g-4">
                <?php
                $usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);
                $total    = count($usuarios);
                ?>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Total Usuarios</h6>
                                    <h3 class="mb-0"><?= $total ?></h3>
                                </div>
                                <i class="bi bi-people-fill fs-1 text-success responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Activos Hoy</h6>
                                    <h3 class="mb-0">12</h3>
                                </div>
                                <i class="bi bi-activity fs-1 text-primary responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Productos</h6>
                                    <h3 class="mb-0">6</h3>
                                </div>
                                <i class="bi bi-cart2 fs-1 text-danger responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Ventas Hoy</h6>
                                    <h3 class="mb-0">8</h3>
                                </div>
                                <i class="bi bi-currency-dollar fs-1 text-warning responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover caption-top text-center table-bordered">
                    <caption class="text-start small mb-1">Lista de Usuarios</caption>
                    <thead class="text-uppercase align-middle fw-semibold text-white bg-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Género</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $index => $usuario): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                                    <td><?= htmlspecialchars($usuario['genero']) ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-3">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>



            <div class="modal fade text-dark" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres <strong>eliminar</strong> este usuario?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="btnConfirmDelete" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>