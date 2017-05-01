<?php
/**
 * EmployeeModel (class)
 * @author Gonzalo Chacaltana Buleje <gchacaltanab@outlook.com>
 * @name EmployeeModel
 * @package App\Model
 * @version 1.0
 */

namespace App\Model;

class EmployeeModel
{
    private $obj = array();

    public function __construct()
    {
        null;
    }

    /**
     * Metodo que asigna formatea los datos a una instancia de EmpleadoModel
     * @name getData
     * @param array $array Array de datos
     * @return array
     */
    public function getData($array)
    {
        $this->obj['id']       = $array['id'];
        $this->obj['name']     = $array['name'];
        $this->obj['email']    = $array['email'];
        $this->obj['position'] = $array['position'];
        $this->obj['salary']   = $array['salary'];
        return $this->obj;
    }

    /**
     * Metodo que asigna formatea los datos a una instancia de EmpleadoModel
     * @name getInfo
     * @param array $array Array de datos
     * @return array
     */
    public function getInfo($array)
    {
        $this->obj['id']       = $array['id'];
        $this->obj['name']     = $array['name'];
        $this->obj['email']    = $array['email'];
        $this->obj['phone']    = $array['phone'];
        $this->obj['address']  = $array['address'];
        $this->obj['address']  = $array['address'];
        $this->obj['position'] = $array['position'];
        $this->obj['salary']   = $array['salary'];
        $this->obj['skills']   = $array['skills'];
        return $this->obj;
    }
}
