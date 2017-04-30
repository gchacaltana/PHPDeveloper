<?php
require_once './ChangeString.php';

//Instamos la clase ChangeString en el objeto $obj
$obj = new \StringTools\ChangeString();
//Invocamos al metodo build, pasandole como parametro el dato ingresado.
if (isset($argv[1])) {
    $obj->build($argv[1]);
}

/**
 * Ejemplo de como usarlo
 * > php test_ChangeString.php zbgd_23TsF[deHt
 */
