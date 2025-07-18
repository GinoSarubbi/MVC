<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body bg-dark2 text-light">
            <h1 class="card-title text-center mb-3">Registro</h1>
            <p class="text-center text-muted mb-4" id="pingreso">Por favor completa el formulario para registrarte</p>
            <form action="../../../curso/php/app/modelos/procesar_registro.php" method="POST">
          
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="tucorreo@ejemplo.com" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                </div>

           
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="password" class="form-control" id="contrasena" name="contrasena"
                            placeholder="Tu contraseña" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select id="genero" name="genero" name="genero" class="form-control" required>
                            <option value="" disabled selected>Género...</option>
                            <option>Masculino</option>
                            <option>Femenino</option>
                            <option>Otro</option>
                        </select>
                    </div>
                </div>

              
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>

                <p class="text-center mb-0">
                    ¿Ya tienes una cuenta?
                    <a href="index.php?ruta=ingreso" class="link-primary">Inicia sesión aquí</a>
                </p>
            </form>
        </div>
    </div>
</div>