<?php
ControladorFormularios::ctrIngresoUsuario();
?>

<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body text-dark">
            <div class="d-flex flex-column align-items-center ">
                <i class="bi bi-kanban fs-1 text-danger"></i>
                <h1 class="card-title text-center mb-3">Iniciar Sesión</h1>
            </div>
            <p class="text-center mb-4" id="pingreso"><strong>Bienvenido! Por favor ingresa tus credenciales</p></strong>
            <form method="POST" action="index.php?ruta=ingreso">

                <div class="mb-3 input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope-fill text-secondary"></i></span>
                    <input type="email"
                        class="form-control"
                        name="email"
                        placeholder="tucorreo@ejemplo.com"
                        required
                        aria-label="Correo electrónico">
                </div>

                <div class="mb-3 input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-secondary"></i></span>
                    <input type="password"
                        class="form-control"
                        id="contrasena"
                        name="contrasena"
                        placeholder="Tu contraseña"
                        required
                        aria-label="Contraseña">
                    <span class="input-group-text bg-white contrasena-cambiar">
                        <i id="icon-password" class="bi bi-eye-fill text-secondary"></i>
                    </span>
                </div>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger py-2">
                        <?= $_SESSION['error_message']; ?>
                    </div>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
                <p class="text-center mb-0">
                    ¿No tienes cuenta?
                    <a href="index.php?ruta=registro" class="link-primary">Regístrate</a>
                </p>
            </form>
        </div>
    </div>
</div>
<script src="../../js/Pass.js"></script>