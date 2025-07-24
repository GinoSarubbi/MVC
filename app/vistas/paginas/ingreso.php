<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body bg-dark2 text-light">
            <h1 class="card-title text-center mb-3">Iniciar Sesión</h1>
            <p class="text-center text-muted mb-4" id="pingreso">Bienvenido! Por favor ingresa tus credenciales</p>

            <form  method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@ejemplo.com"
                        required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="contrasena" name="contrasena"
                        placeholder="Tu contraseña" required>
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
              <?php 
              $ingreso = new ControladorFormularios();
              $ingreso->ctrIngresoUsuario();
                ?>

                <p class="text-center mb-0">
                    ¿No tienes cuenta?
                    <a href="index.php?ruta=registro" class="link-primary">Regístrate</a>
                </p>
            </form>
        </div>
    </div>
</div>