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
        min-width: 0;
    }

    .card-stats:hover {
        transform: translateY(-4px);
    }

    @media (max-width: 767px) {
        header h1 {
            font-size: 1.25rem;
            line-height: 1.1;
        }

        table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        @media (max-width: 992px) {
            .table-responsive>.table {
                width: max-content;
            }
        }

        @media (max-width: 576px) {

            .table-responsive th,
            .table-responsive td {
                padding: .3rem .4rem;
                font-size: .75rem;
                white-space: nowrap;
            }
        }

    }
</style>
<div class="d-flex">
    <?php include 'app/components/sidebar.php'; ?>
    <div class="flex-grow-1 d-flex flex-column">
        <?php include 'app/components/header.php'; ?>

        <?php $productos = ControladorFormularios::ctrSeleccionarProductos(null, null);
        $total = count($productos);

        $valorInventario = ControladorFormularios::ctrValorInventarioProductos();
        $valorInventarioFmt = number_format($valorInventario, 2, ',', '.');

        $bajos = ControladorFormularios::ctrCantidadBajoStock();
        $listaBajos = ControladorFormularios::ctrProductosBajoStock();

        ?>

        <div class="container-fluid p-4 flex-grow-1">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-1">Total Productos</h6>
                                    <h3 class="mb-0"><?= $total ?></h3>
                                </div>
                                <i class="bi bi-cart2 fs-1 text-danger responsive-icon"></i>
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
                                    <h6 class="card-title mb-1">Productos Bajo Stock</h6>
                                    <h3 class="mb-0"><?= $bajos ?></h3>
                                </div>
                                <i class="bi bi-exclamation-triangle-fill fs-1 text-warning responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h6 class="card-title mb-1">Lista de Productos Bajo Stock</h6>
                                    <span class="mb-0"><?= !empty($listaBajos) ? implode(',', array_map(fn($p) => htmlspecialchars($p['nombre']), $listaBajos)) : 'Ninguno' ?></span>
                                </div>
                                <i class="bi bi-list fs-1 text-info responsive-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mt-3 p-4">

                <table class="table table-striped table-hover caption-top text-center table-bordered">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-row">
                        <h3 class="text-start  mb-1 text-secondary">Lista de productos</h3>
                        <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar Producto
                        </button>
                    </div>

                    <thead class="text-uppercase align-middle fw-semibold text-white bg-secondary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach ($productos as $index => $producto): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                                    <td><?= htmlspecialchars($producto['precio']) ?></td>
                                    <td><?= htmlspecialchars($producto['stock']) ?></td>
                                    <td><?= htmlspecialchars($producto['estado']) ?></td>
                                    <td class="d-flex gap-4 justify-content-center">
                                        <form method="POST">
                                            <input type="hidden" value="<?php echo $producto["id"] ?>" name="eliminarRegistro">
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                            <?php
                                            $eliminar = new ControladorFormularios();
                                            $eliminar->ctrEliminarUsuario();
                                            ?>
                                        </form>

                                    </td>

                                </tr>
                            <?php endforeach; ?>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-black" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body justify-content-center align-center">
                                            <form method="POST" action="index.php?ruta=productos">
                                                <div class="mb-3">
                                                    <label for="nombreProducto" class="form-label text-black">Nombre del Producto</label>
                                                    <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="precioProducto" class="form-label text-black">Precio del Producto</label>
                                                    <input type="number" class="form-control" id="precioProducto" name="precioProducto" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="stockProducto" class="form-label text-black">Stock del Producto</label>
                                                    <input type="number" class="form-control" id="stockProducto" name="stockProducto" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="estadoProducto" class="form-label text-black">Estado del Producto</label>
                                                    <select class="form-select" id="estadoProducto" name="estadoProducto" required>
                                                        <option value="activo">Activo</option>
                                                        <option value="inactivo">Inactivo</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex justify-content-center align-center">
                                                    <button type="submit" class="btn btn-success" style="width: 500px;">Agregar Producto</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-3">No hay productos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>