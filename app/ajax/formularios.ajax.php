<?php
require_once "../controladores/formularios.controlador.php";
require_once "../modelos/formularios.modelo.php";

class AjaxRegistro {
    public $validarEmail;

    public function ajaxValidarEmail() {
        $item = "email";
        $valor = $this->validarEmail;

        $respuesta = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);
        echo json_encode ($respuesta);
    }
}

if (isset($_POST["validarEmail"])) {
    $valEmail = new AjaxRegistro();
    $valEmail->validarEmail = $_POST["validarEmail"];
    $valEmail->ajaxValidarEmail();
}
