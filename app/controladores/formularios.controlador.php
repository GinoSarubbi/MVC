<?php

class ControladorFormularios
{
    static public function ctrRegistro()
    {
        if (isset($_POST["nombre"])) {
            $tabla = "registro";
            $datos = array(
                "nombre" => $_POST["nombre"],
                "email" => $_POST["email"],
                "password" => $_POST["contrasena"],
                "genero" => $_POST["genero"]
            );

            $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

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
        if (isset($_POST["email"])) {
            $tabla = "registro";
            $item = "email";
            $valor = $_POST["email"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            if ($respuesta && password_verify($_POST["contrasena"], $respuesta["password"])) {
                $_SESSION["validarIngreso"] = true;
                $_SESSION["usuario"] = $respuesta;

                echo '<script>

                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                    window.location = "index.php?ruta=inicio";
                </script>';
                return "ok";

            } else {
                $_SESSION['error_message'] = 'Error: Usuario o contraseña incorrectos.';
                echo '<script>
                    window.location = "index.php?ruta=ingreso";
                </script>';
                return "error";
            }
        }
    }
}
