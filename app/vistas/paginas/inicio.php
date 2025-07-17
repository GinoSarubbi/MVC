<div class="container d-flex justify-content-center align-items-center vh-100">
    <section>
        <h1>Bienvenido al inicio</h1>
        <p>Aqui vas a encontrar un mini ejemplo de lo que veras cuando inicies sesion</p>
        <br />
        <h2>Ejemplo de tabla con Usuarios</h2>
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../app/modelos/usuario.php";
                session_start();

                if (!isset($_SESSION['usuarios'])) {
                    $_SESSION['usuarios'] = [];
                }

                foreach ($_SESSION['usuarios'] as $index => $usuario) : ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo htmlspecialchars($usuario->getNombre()); ?></td>
                    <td><?php echo htmlspecialchars($usuario->getEmail()); ?></td>
                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                    <td>    
                        <form action="modelos/eliminar_usuario.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $index; ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </section>
</div>