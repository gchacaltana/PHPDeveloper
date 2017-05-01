<?php
/**
 * ArrayHelper (class)
 * Clase utilitario para manejar arrays.
 * @author Gonzalo Chacaltana Buleje <gchacaltanab@outlook.com>
 * @name ArrayHelper
 * @package Helper
 * @version 1.0
 */
namespace Helper;

class ArrayHelper
{

    /**
     * Constructor de ArrayHelper.
     * @name __construct
     * @access public
     */
    public function __construct()
    {
        null;
    }

    /**
     * Convierte un array en un dato XML.
     * @name convertArrayXml
     * @param array $array Estructura de datos
     * @param xml $xml Estructura de datos XML
     * @access public
     */
    public function convertArrayXml($array, &$xml)
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                if (!is_numeric($k)) {
                    $s_node = $xml->addChild("$k");
                    $this->convertArrayXml($v, $s_node);
                } else {
                    $this->convertArrayXml($v, $xml);
                }
            } else {
                $xml->addChild("$k", "$v");
            }
        }
    }
}
