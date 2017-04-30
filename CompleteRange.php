<?php
/**
 * CompleteRange (class)
 *
 * @author Gonzalo Chacaltana Buleje [gchacaltanab@outlook.com]
 * @name CompleteRange
 * @package ArrayTools
 * @version 1.0
 */

namespace ArrayTools;

class CompleteRange
{
    /**
     * @name $total_numbers
     * @var int Atributo que almacena cantidad de números del array ingresado.
     * @access private
     */
    private $total_numbers;

    /**
     * @name $range
     * @var array Atributo que almacena el array de números ingresado.
     * @access private
     */
    private $range = array();

    /**
     * @name $nrange
     * @var array Atributo que almacena el array resultado.
     * @access private
     */
    private $nrange = array();

    /**
     * Metodo que recibe un array de números ingresado por el usuario.
     * @name build
     * @access public
     * @param array $range Array de números
     * @return array Nuevo array completado de números.
     */
    public function build($range)
    {
        try {
            //Validamos array recibido
            $this->validate($range);
            //Completamos el array con los números que faltan
            $this->completeNumbers();
            //Mostramos el nuevo array completo.
            $this->printRange();
        } catch (Exception $ex) {
            //Mostramos en pantalla las excepciones
            $this->printException($ex);
        }
    }

    /**
     * Metodo que completa los números del array.
     * @name completeNumbers
     * @access private
     */
    private function completeNumbers()
    {
        //Almacenamos el primer número en $fn
        $fn = $this->range[0];
        //Almacenamos ultimo número en $ln
        $ln = $this->range[$this->total_numbers - 1];
        //Completamos el nuevo array con los numeros comprendidos entre $fn y $ln
        for ($k = $fn; $k <= $ln; $k++) {
            $this->nrange[] = $k;
        }
    }

    /**
     * Metodo que muestra en pantalla nuevo array de números completados.
     * @name printRange
     * @access private
     */
    private function printRange()
    {
        print_r($this->nrange).PHP_EOL;
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

    /**
     * Metodo que valida dato ingresado.
     * @name validate
     * @param array $range Array de números
     * @access private
     */
    private function validate($range)
    {
        //Validamos que el dato ingresado sea un array.
        if (!is_array($range)) {
            throw new Exception(utf8_encode("El valor ingresado no es un array."));
        }
        //Validamos que el array contenga más de un elemento.
        $this->total_numbers = count($range);
        if ($this->total_numbers <= 1) {
            throw new Exception(utf8_encode("El array debe tener al menos 2 números enteros positivos."));
        }

        //Validamos que los elementos del array sean números.
        for ($k = 0; $k <= $this->total_numbers - 2; $k++) {
            if ($range[$k + 1] < $range[$k]) {
                throw new Exception(utf8_encode("El array no contiene números ordenados de manera ascendente"));
            }
        }
        $this->range = $range;
    }
}
