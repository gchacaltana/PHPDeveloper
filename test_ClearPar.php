<?php
require_once 'ClearPar.php';

//Instanciamos la clase ClearPar en $obj
$obj = new \StringTools\ClearPar();
//Invocamos al método build pasandole el valor ingresado por el usuario.
if (isset($argv[1])) {
    $obj->build($argv[1]);
}

/**
 * Ejemplo de como usarlo
 * > php test_ClearPar.php "(()()y)_)(h2())6))"
 */
