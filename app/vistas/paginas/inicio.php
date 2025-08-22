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
    <?php include 'app/components/sidebar.php'; ?>
    <div class="flex-grow-1 d-flex flex-column">
        <?php include 'app/components/header.php'; ?>
        <div class="container-fluid p-4 flex-grow-1">
            <div class="row g-4">
                <?php
                $usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);
                $total = count($usuarios);

                $productos = ControladorFormularios::ctrSeleccionarProductos(null, null);
                $totalProdu = count($productos);

                $valorInventario = ControladorFormularios::ctrValorInventarioProductos();
                $valorInventarioFmt = number_format($valorInventario, 2, ',', '.');
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
                                    <h6 class="card-title mb-1">Valor Inventario</h6>
                                    <h3 class="mb-0">$ <?= $valorInventarioFmt ?></h3>
                                </div>
                                <i class="bi bi-cash-stack fs-1 text-success responsive-icon"></i>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Total Productos</h6>
                                    <h3 class="mb-0"><?= $totalProdu ?></h3>
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
                            <th scope="col">Acciones</th>
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
                                    <td class="d-flex gap-4 justify-content-center"><a href="index.php?ruta=editar&id=<?php echo $usuario["id"]; ?>" class="btn btn-primary">Editar</a>
                                        <form method="POST">
                                            <input type="hidden" value="<?php echo $usuario["id"] ?>" name="eliminarRegistro">
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                            <?php
                                            $eliminar = new ControladorFormularios();
                                            $eliminar->ctrEliminarUsuario();
                                            ?>
                                        </form>
                                    </td>

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