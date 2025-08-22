<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body text-dark">
            <div class="d-flex flex-column align-items-center ">
                <i class="bi bi-kanban fs-1 text-danger"></i>
                <h1 class="card-title text-center mb-3">Registro</h1>
            </div>
            <p class="text-center text-muted mb-4" id="pingreso"><strong>Por favor completa el formulario para registrarte</p></strong>
            <form class="" method="post">

                <div class="row">
                    <div class="col-md mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope-fill text-secondary"></i></span>
                        <input type="email" class="form-control" id="emailRegistro" name="email"
                            placeholder="Email" required>
                    </div>
                    <div class="col-md mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person-fill text-secondary"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Usuario" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-secondary"></i></span>

                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                            placeholder="Contraseña" required>
                    </div>
                    <div class="col-md-2 mb-3 input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-gender-ambiguous text-secondary"></i>
                        </span>
                        <select id="genero" name="genero" name="genero" class="form-control" required>
                            <option value="" disabled selected>Género</option>
                            <option>Masculino</option>
                            <option>Femenino</option>
                            <option>Otro</option>
                        </select>
                    </div>
                    <div id="alerta"> </div>
                </div>
            
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
                <?php ControladorFormularios::ctrRegistro(); ?>
                <p class="text-center mb-0">
                    ¿Ya tienes una cuenta?
                    <a href="index.php?ruta=ingreso" class="link-primary">Inicia sesión aquí</a>
                </p>
            </form>
          

        </div>
    </div>
</div>
