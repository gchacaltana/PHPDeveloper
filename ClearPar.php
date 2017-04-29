<?php

/**
 * ClearPar (class)
 *
 * @author Gonzalo Chacaltana Buleje [gchacaltanab@outlook.com]
 * @name ClearPar
 * @package StringTools
 * @version 1.0
 */
class ClearPar {

    /**
     * @name $total_par
     * @var int Atributo que almacena cantidad total de pares de parentesis.
     * @access private
     */
    private $total_par = 0;

    /**
     * @name $str
     * @var string Atributo que almacena cadena de texto ingresada por el usuario.
     * @access private
     */
    private $str = "";

    /**
     * @name $f_par
     * @var string Atributo que almacena simbolo de apertura de parentesis.
     * @access private
     */
    private $f_par = "(";

    /**
     * @name $s_par
     * @var string Atributo que almacena simbolo de cierre de parentesis.
     * @access private
     */
    private $s_par = ")";

    /**
     * @name $result
     * @var string Atributo que almacena los parentesis encontrados.
     * @access private
     */
    private $result = "";

    /**
     * Metodo que recibe una cadena de texto para obtener cantidad de parentesis.
     * @name build
     * @access public
     * @param string $str Cadna de texto ingresada por usuario.
     */
    public function build($str) {
        try {
            //Validamos el dato ingresado.
            $this->validate($str);
            //Buscamos cantidad de pares de parentesis.
            $this->searchPar();
            //Mostramos en pantalla el resultado.
            $this->printResult();
        } catch (Exception $ex) {
            //Mostramos en pantalla las excepciones
            $this->printException($ex);
        }
    }

    /**
     * Método que valida la cadena de texto ingresada por el usuario.
     * @name validate
     * @access private
     * @param string $str Cadena de texto que ingresa el usuario.
     */
    private function validate($str) {
        if (is_array($str)) {
            throw new Exception(utf8_encode("El valor ingresado debe contener texto y/o números."));
        }
        $this->str = trim($str);
    }

    /**
     * Método que busca parentesis dentro del texto
     * por el usuario
     * @name searchPar
     * @access private
     */
    private function searchPar() {
        //Almacenamos la cantidad de caracteres.
        $total = strlen($this->str);
        for ($i = 0; $i <= $total - 1; $i++) {
            if (isset($this->str{$i + 1})) {
                //Invocamos al método que cuenta parentesis (countPar)
                $this->countPar($this->str{$i}, $this->str{$i + 1});
            }
        }
    }

    /**
     * Método que muestra en pantalla los parentesis encontrados.
     * @name printResult
     * @access private
     */
    private function printResult() {
        print $this->result.PHP_EOL;
    }

    /**
     * Método que cuenta los parentesis.
     * @name countPar
     * @access private
     * @param string $f_str primer caracter
     * @param string $s_str segundo caracter
     */
    private function countPar($f_str, $s_str) {
        if ($f_str === $this->f_par && $s_str === $this->s_par) {
            //Almacenamos cantidad de parentesis encontrado en atributo.
            $this->total_par+=1;
            $this->result.="()";
        }
    }

    /**
     * Metodo que muestra en pantalla las excepciones encontradas.
     * @name printException
     * @param Exception $ex Exception
     * @access private
     */
    private function printException($ex) {
        print 'Exception: ' . $ex->getMessage() . PHP_EOL;
    }

}
//Instanciamos la clase ClearPar en $obj
$obj = new ClearPar();
//Invocamos al método build pasandole el valor ingresado por el usuario.
$obj->build($argv[1]);

/**
 * Ejemplo de como usarlo
 * > php ClearPar.php "(()()y)_)(h2())6))"
 */