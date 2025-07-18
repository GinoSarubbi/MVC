<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body bg-dark2 text-light">
            <h1 class="card-title text-center mb-3">Registro</h1>
            <p class="text-center text-muted mb-4" id="pingreso">Por favor completa el formulario para registrarte</p>
            <form action="../../../curso/php/app/modelos/procesar_registro.php" method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@ejemplo.com"
                        required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="contrasena" name="contrasena"
                        placeholder="Tu contraseña" required>
                </div>

                <div class="mb-3">
                    <input type="genero" class="form-control" id="genero" name="genero"
                        placeholder="Tu genero" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>

                <p class="text-center mb-0">
                    Ya tiene una cuenta?
                    <a href="index.php?ruta=ingreso" class="link-primary">Inicia sesion aqui!</a>
                </p>
            </form>
        </div>
    </div>
</div>