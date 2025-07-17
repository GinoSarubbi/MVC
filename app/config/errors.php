<?php

//visto en clase martes 15 
ini_set('display_errors', 0); //desactivo los errores
ini_set('log_errors',    1); //activo el log de errores
ini_set('error_log',  __DIR__ . '/../../logs/warnings.log'); //guardo los errores en el log warnings.log
error_reporting(E_ALL); //reporto todos los errores

set_error_handler(function ($err_normal, $err_sintaxis, $err_de_archivos, $err_en_linea) { 
    if ($err_normal === E_WARNING) {
        static $mostrar = false;  //para evitar imprimir el mensaje varias veces

        $error_mensaje = sprintf(
            "[%s] Warning [%d]: %s in %s on line %d\n",
            date('Y-m-d H:i:s'),
            $err_normal,
            $err_sintaxis,
            $err_de_archivos,
            $err_en_linea
        );
        error_log($error_mensaje);

        if (!$mostrar) {
            echo '<img src="./assets/img/error.png" alt="Error" class="img-fluid mx-auto d-block" style="max-width: 300px;">';
            echo "<div class='alert alert-danger'>Se ha producido un error. Por favor, revise el Log.</div>";
            $mostrar = true;
        }

        return true;
    }
    return false;
});
