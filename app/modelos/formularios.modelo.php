<?php
require_once "conexion.php";

class ModeloFormularios
{
    public static function mdlRegistro($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email");
        $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return "existe";
        }

        $hashPassword = password_hash($datos['contrasena'], PASSWORD_DEFAULT); //guardo el hash de la contraseña para pasarlo como parámetro en stmt

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email, contrasena, genero) VALUES (:nombre, :email, :contrasena, :genero)");
        $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $hashPassword, PDO::PARAM_STR);
        $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    public static function mdlSeleccionarRegistros($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY id DESC LIMIT 1");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Email buscado: " . $valor);
            error_log("Resultado SQL: " . print_r($resultado, true));

            return $resultado;
        }
    }

    public static function eliminarPorId(int $id): bool
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
