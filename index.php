<?php 
require_once "./app/controladores/plantilla.controlador.php";
require_once "./app/controladores/formularios.controlador.php";
require_once "./app/modelos/formularios.modelo.php";
require_once "./app/config/errors.php";


//Instanciar el objeto 
$plantilla = new ControladorPlantilla();

//Ejecutar el método
$plantilla->ctrGetPlantilla();
