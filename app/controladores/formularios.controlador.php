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

    static public function ctrEliminarUsuario()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $respuesta = ModeloFormularios::eliminarPorId($id);
            if ($respuesta) {
                header("Location: index.php?ruta=inicio");
                exit;
            } else {
                $_SESSION["error_message"] = "Error al eliminar el usuario.";
            }
        }
    }
}
