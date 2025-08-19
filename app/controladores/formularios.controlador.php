<?php
class ControladorFormularios
{
    static public function ctrRegistro()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["nombre"])) {
            $tabla = "registro";
            $datos = [
                "nombre"   => $_POST["nombre"],
                "email"    => $_POST["email"],
                "contrasena" => $_POST["contrasena"],
                "genero"   => $_POST["genero"]
            ];

            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

            if ($respuesta === "existe") {
                $_SESSION["error_message"] = "Ese email ya está registrado.";
            }
            if ($respuesta === "ok") {
                // Redirige al login
                header("Location: index.php?ruta=ingreso");
                exit;
            }
            return $respuesta;
        }
    }

    static public function ctrSeleccionarRegistros($item, $valor)
    {
        $tabla = "registro";
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrIngresoUsuario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("ctrIngresoUsuario se invocó. POST=" . print_r($_POST, true));
        }
        if (isset($_POST["email"])) {
            $tabla = "registro";
            $item = "email";
            $valor = $_POST["email"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            error_log("Intentando login con: " . $_POST["email"]);

            if ($respuesta && isset($respuesta["contrasena"]) && password_verify($_POST["contrasena"], $respuesta["contrasena"])) {
                error_log("LOGIN OK, redirigiendo");
                $_SESSION["validarIngreso"] = true;
                $_SESSION["usuario"] = $respuesta;
                $_SESSION["genero"] = $respuesta["genero"];
                header("Location: index.php?ruta=inicio");
                exit;
            } else {
                error_log("LOGIN FALLÓ");
                $_SESSION["error_message"] = "Usuario o contraseña incorrectos.";
                header("Location: index.php?ruta=ingreso");
                exit;
            }
        }
    }

    //actualizar registro 
    public static function ctrActualizarRegistro()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return null;

        // Campos esperados del form
        $id     = isset($_POST['idUsuario']) ? (int)$_POST['idUsuario'] : 0;
        $email  = trim($_POST['actualizarEmail'] ?? '');
        $nombre = trim($_POST['actualizarNombre'] ?? '');
        $genero = trim($_POST['actualizarGenero'] ?? '');
        $pass   = trim($_POST['actualizarContrasena'] ?? ''); // puede venir vacío

        if ($id <= 0 || $email === '' || $nombre === '' || $genero === '') {
            return "error";
        }

        $datos = [
            'id'     => $id,
            'email'  => $email,
            'nombre' => $nombre,
            'genero' => $genero
        ];

        if ($pass !== '') {
            $datos['contrasena'] = $pass;
        }

        $tabla = "registro";
        return ModeloFormularios::mdlActualizarRegistro($tabla, $datos);
    }

    //elimianr usuario
    static public function ctrEliminarUsuario()
    {
        if (isset($_POST["eliminarRegistro"])) {
            $tabla = "registro";
            $valor = $_POST["eliminarRegistro"];

            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

            if ($respuesta == "ok") {
                echo '<script>
                    if (window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);                  
                    }
                        window.location = "index.php?ruta=inicio";
               </script>';
            }
        }
    }

    //productos
     static public function ctrSeleccionarProductos($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloFormularios::mdlSeleccionarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    public static function ctrValorInventarioProductos()
    {
        return ModeloFormularios::mdlValorInventarioProductos();
    }

    // ControladorFormularios.php
    public static function ctrProductosBajoStock()
    {
        return ModeloFormularios::mdlProductosBajoStock();
    }
    public static function ctrCantidadBajoStock()
    {
        return ModeloFormularios::mdlCantidadBajoStock();
    }
}
