<?php 
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?ruta=inicio');
    exit;
}
?> 
 
 <header class="d-flex align-items-center justify-content-between bg-white border-bottom p-3">
            <?php
            $gen    = strtolower($_SESSION['usuario']['genero'] ?? '');
            $saludo = ($gen === 'femenino') ? 'Bienvenida' : 'Bienvenido';
            ?>
            <h1 class="mb-0 text-black fw-semibold">
                <span class="d-block d-sm-inline"><?= $saludo ?>,</span>
                <strong><?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></strong>
            </h1>

            <button class="btn btn-outline-secondary d-md-none" type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenuMobile"
                aria-controls="sidebarMenuMobile"
                aria-label="Mostrar menú">
                <i class="bi bi-list fs-2"></i>
            </button>

            <section class="offcanvas offcanvas-start d-md-none bg-dark text-white" tabindex="-1" id="sidebarMenuMobile"
                aria-labelledby="sidebarMenuMobileLabel">
                <div class="offcanvas-header">
                    <div class="d-flex align-items-center mb-4 gap-3 text-decoration-none">
                        <i class="bi bi-kanban fs-1 text-danger"></i>
                        <h5 class="offcanvas-title text-white font-bold" id="sidebarMenuMobileLabel">UserManager</h5>
                    </div>
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