<?php

/**
 * ChangeString (class)
 *
 * @author Gonzalo Chacaltana Buleje [gchacaltanab@outlook.com]
 * @name ChangeString
 * @package StringTools
 * @version 1.0
 */
namespace StringTools;

class ChangeString
{
    
    /**
     * @name $alphabet
     * @var array Atributo que almacena las letras del abecedario.
     * @access private
     */
    private $alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i",
        "j", "k", "l", "m", "n", "ñ", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z"
    );

    /**
     * @name $total_letters_alphabet
     * @var int Atributo que almacena la cantidad de letras del abecedario.
     * @access private
     */
    private $total_letters_alphabet;

    /**
     * @name $str
     * @var string Atributo que almacena la cadena de texto ha modificar.
     * @access private
     */
    private $str;

    /**
     * @name $str_result
     * @var string Atributo que almacena la cadena de texto resultado.
     * @access private
     */
    private $str_result;

    /**
     * Metodo que convierte una cadena de texto.
     * @name build
     * @access public
     * @param string $str Cadena de texto a modificar.
     * @return string cadena de texto modificada.
     */
    public function build($str)
    {
        try {
            //Validamos cadena ingresada por el usuario
            $this->validate($str);
            //Aplicamos el proceso de conversion
            $this->conversionString();
            //Mostramos el resultado
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
    private function validate($str)
    {
        if (is_array($str)) {
            throw new Exception(utf8_encode("El valor ingresado debe contener texto y/o números."));
        }
        $this->str = trim($str);
    }

    /**
     * Método encargado de aplicar el proceso de conversión de la cadena.
     * @name conversionString
     * @access private
     */
    private function conversionString()
    {
        //Almacenamos la cantidad de caracteres.
        $letters                      = strlen($this->str);
        $this->total_letters_alphabet = count($this->alphabet);
        for ($k = 0; $k <= $letters - 1; $k++) {
            $this->changeLetter($this->str{$k});
        }
    }

    /**
     * Método que convierte letra por letra.
     * @name changeLetter
     * @param mixed $letter
     * @access private
     */
    private function changeLetter($letter)
    {
        //Verificamos si la letra se encuentra en el abecedario.
        if (in_array(strtolower($letter), $this->alphabet)) {
            //Obtenemos la posicion de la letra en el abecedario.
            $k   = array_keys($this->alphabet, strtolower($letter));
            $key = $k[0] + 1;
            //validamos si la posición obtenida corresponde a la ultima letra del abecedario.
            if ($key === $this->total_letters_alphabet) {
                //Almacenamos la letra que le corresponde a la posición siguiente.
                $this->str_result.= (ctype_upper($letter)) ? strtoupper($this->alphabet[0])
                        : $this->alphabet[0];
            } else {
                //Almacenamos la letra que le corresponde a la posición siguiente.
                $this->str_result.= (ctype_upper($letter)) ? strtoupper($this->alphabet[$key])
                        : $this->alphabet[$key];
            }
        } else {
            //Almacenamos la letra sin convertirla.
            $this->str_result.= $letter;
        }
    }

    /**
     * Método que muestra en pantalla el resultado.
     * @name printResult
     * @access private
     */
    private function printResult()
    {
        print $this->str_result.PHP_EOL;
    }

    /**
     * Metodo que muestra en pantalla las excepciones encontradas.
     * @name printException
     * @param Exception $ex Exception
     * @access private
     */
    private function printException($ex)
    {
        print 'Exception: '.$ex->getMessage().PHP_EOL;
    }
}
