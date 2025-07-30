<style>
    body {
        min-height: 100vh;
        overflow-x: hidden;
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
    }

    .card-stats:hover {
        transform: translateY(-4px);
    }
</style>
<div class="d-flex">
    <button class="btn btn-outline-light d-md-none m-2" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Mostrar menú">
        <i class="bi bi-list fs-2"></i>
    </button>
    <nav id="sidebarMenu"
        class="sidebar collapse d-sm-block vh-100 d-flex flex-column p-3 bg-dark">
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
            <button class="btn btn-outline-secondary d-md-none" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Mostrar menú">
                <i class="bi bi-list fs-2"></i>
            </button>
            <?php
            $gen    = strtolower($_SESSION['usuario']['genero'] ?? '');
            $saludo = ($gen === 'femenino') ? 'Bienvenida' : 'Bienvenido';
            ?>
            <h1 class=" mb-0 text-black"><?= $saludo ?>, <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong></h1>
        </header>

        <!-- DASHBOARD CARDS -->
        <div class="container-fluid p-4  flex-grow-1">
            <div class="row g-4">
                <?php
                $usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);
                $total    = count($usuarios);
                ?>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Usuarios</h6>
                                    <h3><?= $total ?></h3>
                                </div>
                                <i class="bi bi-people-fill fs-1 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Activos Hoy</h6>
                                    <h3>12</h3>
                                </div>
                                <i class="bi bi-activity fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Productos</h6>
                                    <h3>6</h3>
                                </div>
                                <i class="bi bi-cart2 fs-1 text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-4">
                    <div class="card card-stats bg-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Ventas Hoy</h6>
                                    <h3>8</h3>
                                </div>
                                <i class="bi bi-currency-dollar fs-1 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- USERS TABLE -->
            <table class="table table-bordered table-hover table-responsive rounded">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Género</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td>
                                <?php echo 1 + array_search($u, $usuarios); ?>
                            </td>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= ucfirst($u['genero']) ?></td>
                            <td><?= $u['fecha'] ?></td>
                            <td>
                                <a href="index.php?ruta=editarUsuario&id=<?= $u['id'] ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-href="index.php?ruta=eliminarUsuario&id=<?= $u['id'] ?>">
                                    <i class="bi bi-trash-fill"></i> Eliminar
                                </button>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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
        <button type="button" id="btnConfirmDelete" class="btn btn-danger" >Eliminar</button>
      </div>
    </div>
  </div>
</div>