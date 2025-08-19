<?php

$usuario = null;
if (isset($_GET["id"])) {
    $item  = 'id';
    $valor = (int)$_GET["id"];
    $usuario = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
}

// Procesar POST (Actualizar) — PRG
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estado = ControladorFormularios::ctrActualizarRegistro();
    if ($estado === "ok") {
        header("Location: index.php?ruta=inicio");
        exit;
    }
  
}
?>
<div class="container vh-100 d-flex align-items-center justify-content-center">
    <div>
        <div class="card-body text-dark">
            <div class="d-flex flex-column align-items-center">
                <i class="bi bi-kanban fs-1 text-danger"></i>
                <h1 class="card-title text-center mb-3">Actualizar Usuario</h1>
            </div>
            <p class="text-center text-muted mb-4" id="pingreso">
                <strong>Por favor actualice su usuario</strong>
            </p>

            <?php if (!$usuario): ?>
                <div class="alert alert-danger">Usuario no encontrado.</div>
            <?php else: ?>
            <form method="POST">
                <div class="row">
                    <div class="col-md mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope-fill text-secondary"></i></span>
                        <input type="email" class="form-control" id="email" name="actualizarEmail"
                               value="<?= htmlspecialchars($usuario["email"]) ?>" placeholder="Actualiza tu Email" required>
                    </div>
                    <div class="col-md mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person-fill text-secondary"></i></span>
                        <input type="text" class="form-control" id="nombre" name="actualizarNombre"
                               value="<?= htmlspecialchars($usuario["nombre"]) ?>" placeholder="Actualice su Usuario" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-secondary"></i></span>
                        <input type="password" class="form-control" id="contrasena" name="actualizarContrasena"
                               placeholder="Dejar vacío para no cambiar">
                    </div>
                    <div class="col-md-4 mb-3 input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-gender-ambiguous text-secondary"></i></span>
                        <select id="genero" name="actualizarGenero" class="form-control" required>
                            <option value="">Género</option>
                            <option value="Masculino" <?= ($usuario["genero"] === 'Masculino' ? 'selected' : '') ?>>Masculino</option>
                            <option value="Femenino"  <?= ($usuario["genero"] === 'Femenino'  ? 'selected' : '') ?>>Femenino</option>
                            <option value="Otro"      <?= ($usuario["genero"] === 'Otro'      ? 'selected' : '') ?>>Otro</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="idUsuario" value="<?= (int)$usuario["id"] ?>">

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
