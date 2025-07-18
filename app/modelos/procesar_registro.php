<?php
session_start();
require_once "usuario.php";

$nombre   = $_POST['nombre']   ?? '';
$email    = $_POST['email']    ?? '';
$password = $_POST['password'] ?? '';

$usuario = new Usuario($nombre, $email, '');
$usuario->setPassword($password);

$_SESSION['usuarios'][] = $usuario;

header("Location: ../../index.php?ruta=ingreso");
exit;
