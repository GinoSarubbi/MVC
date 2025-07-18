<?php
require_once "usuario.php";
session_start();


$emailIngresado = $_POST['email'] ?? '';
$passwordIngresado = $_POST['password'] ?? '';
$nombreIngresado = $_POST['nombre'] ?? '';

if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
} 
$usuarioEncontrado = null;

foreach ($_SESSION['usuarios'] as $usuario) {
    if ($usuario->getEmail() === $emailIngresado && $usuario->verificarPassword($passwordIngresado)) {
        $usuarioEncontrado = $usuario;
        break;
    }
}

if ($usuarioEncontrado) {
    $_SESSION['usuario'] = $usuarioEncontrado;
    header("Location: ../../index.php?ruta=inicio");
} else {
    $_SESSION['error_message'] = "Credenciales incorrectas. Por favor, intenta de nuevo.";
    header("Location: ../../index.php?ruta=ingreso");
}
exit;
?>