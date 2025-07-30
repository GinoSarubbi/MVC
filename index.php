<?php 
session_start();

require __DIR__ . '/app/controladores/plantilla.controlador.php';
require __DIR__ . '/app/controladores/formularios.controlador.php';
require __DIR__ . '/app/modelos/formularios.modelo.php';
require __DIR__ . '/app/modelos/usuario.php';
require __DIR__ . '/app/config/errors.php';

//Instanciar el objeto 
$plantilla = new ControladorPlantilla();

//Ejecutar el método
$plantilla->ctrGetPlantilla();
