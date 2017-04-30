<?php
require_once 'CompleteRange.php';

//Instanciamos la clase CompleteRange en $obj
$obj = new \ArrayTools\CompleteRange();
//Array de números que ingresaremos al método build.
$range = array(33,41,49);
//Invocamos al método build pasandole el array $range
$obj->build($range);

/**
 * Ejemplo de como usarlo
 * > php test_CompleteRange.php
 */
