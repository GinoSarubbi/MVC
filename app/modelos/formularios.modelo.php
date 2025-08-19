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

    public static function mdlActualizarRegistro($tabla, $datos)
    {
        // Whitelist para evitar inyección en nombre de tabla
        $tablasPermitidas = ['registro', 'usuarios'];
        if (!in_array($tabla, $tablasPermitidas, true)) {
            error_log("[mdlActualizarRegistro] Tabla no permitida: $tabla");
            return "error";
        }

        try {
            $pdo = Conexion::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 1) Chequeo de email duplicado excluyendo al propio id
            $sqlDup = "SELECT id FROM $tabla WHERE email = :email AND id <> :id";
            $stDup  = $pdo->prepare($sqlDup);
            $stDup->bindParam(':email', $datos['email'], PDO::PARAM_STR);
            $stDup->bindParam(':id', $datos['id'], PDO::PARAM_INT);
            $stDup->execute();
            if ($stDup->fetch(PDO::FETCH_ASSOC)) {
                return "existe";
            }

            // 2) Armado dinámico de UPDATE (sin tocar contraseña si viene vacía)
            $campos = [
                "nombre = :nombre",
                "email = :email",
                "genero = :genero",
            ];

            $params = [
                ':nombre' => [$datos['nombre'], PDO::PARAM_STR],
                ':email'  => [$datos['email'], PDO::PARAM_STR],
                ':genero' => [$datos['genero'], PDO::PARAM_STR],
                ':id'     => [$datos['id'], PDO::PARAM_INT],
            ];

            if (isset($datos['contrasena']) && trim($datos['contrasena']) !== '') {
                $hash = password_hash($datos['contrasena'], PASSWORD_DEFAULT);
                $campos[] = "contrasena = :contrasena";
                $params[':contrasena'] = [$hash, PDO::PARAM_STR];
            }

            $sql = "UPDATE $tabla SET " . implode(', ', $campos) . " WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            foreach ($params as $k => [$v, $type]) {
                $stmt->bindValue($k, $v, $type);
            }

            return $stmt->execute() ? "ok" : "error";
        } catch (Throwable $e) {
            error_log("[mdlActualizarRegistro] " . $e->getMessage());
            return "error";
        }
    }

    public static function mdlEliminarRegistro($valor, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt->closeCursor();
        $stmt = null;
    }


    //productos
    public static function mdlSeleccionarProductos($tabla, $item, $valor)
    {
        if ($item == null && $valor == null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC LIMIT 1");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Email buscado: " . $valor);
            error_log("Resultado SQL: " . print_r($resultado, true));

            return $resultado;
        }
    }

    public static function mdlValorInventarioProductos()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT COALESCE(SUM(precio * stock),0) AS valor FROM productos WHERE estado='activo'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (float)$row['valor'];
    }

    public static function mdlProductosBajoStock()
    {
        $pdo = Conexion::conectar();
        $sql = "SELECT id, nombre, precio, stock, stock_minimo
            FROM productos
            WHERE estado='activo' AND stock < stock_minimo
            ORDER BY (stock_minimo - stock) DESC, nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlCantidadBajoStock()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query("SELECT COUNT(*) bajos FROM productos WHERE estado='activo' AND stock < stock_minimo");
        return (int)$stmt->fetchColumn();
    }
}
