<?php
/**
 * EmployeeController (class)
 * @author Gonzalo Chacaltana Buleje <gchacaltanab@outlook.com>
 * @name EmployeeController
 * @package App\Controller
 * @version 1.0
 */

namespace App\Controller;

require APP_ROOT.'/src/App/Model/EmployeeModel.php';
require APP_ROOT.'/src/Helper/ArrayHelper.php';

class EmployeeController
{
    /**
     * @var Slim\Views\Twig Objeto para renderizar una vista
     * @access private
     */
    private $view;

    /**
     * @var string Ruta de la fuente de datos .JSON.
     * @access private
     */
    private $path_json_data = APP_ROOT."/database/employees.json";

    /**
     * @var string Almacena data del archivo .JSON
     * @access private
     */
    private $data;

    /**
     * Constructor de EmployeeController.
     * Se encarga de carga la fuente de datos .JSON en atributo "data"
     * @name __construct
     * @param $view Slim\Views\Twig
     * @access public
     */
    public function __construct($view)
    {
        $this->view = $view;
        $this->loadJsonData();
    }

    /**
     * Método que responde al evento de listar todos los colaboradores.
     * @name index
     * @param $request Request
     * @param $response Response
     * @param $args Array de valores enviados.
     * @access public
     * @return mixed
     */
    public function index($request, $response, $args)
    {
        return $this->view->render($response, 'employees/index.twig', ['employees' => $this->getAll()]);
    }

    /**
     * Método que responde al evento de visualizar la información detallada
     * de un colaborador por su ID.
     * @name detailById
     * @param $request Request
     * @param $response Response
     * @param $args Array de valores enviados.
     * @access public
     * @return mixed
     */
    public function detailById($request, $response, $args)
    {
        $oEmp = $this->getbyID($request->getAttribute('id'));
        return $this->view->render($response, 'employees/detail.twig', ['employee' => $oEmp]);
    }

    /**
     * Método que responde al evento de buscar un colaborador por su email.
     * @name searchByEmail
     * @param $request Request
     * @param $response Response
     * @param $args Array de valores enviados.
     * @access public
     * @return mixed
     */
    public function searchByEmail($request, $response, $args)
    {
        $oEmp = $this->getByEmail(addcslashes($request->getParam('email')));
        return $this->view->render($response, 'employees/detail.twig', ['employee' => $oEmp]);
    }

    /**
     * Método que responde al evento de buscar colaboradores que se encuentre
     * en un rango de salario. Devuelve la información en XML.
     * @name searchBySalary
     * @param $request Request
     * @param $response Response
     * @param $args Array de valores enviados.
     * @access public
     * @return xml
     */
    public function searchBySalary($request, $response, $args)
    {
        $s_min       = $request->getParam('min');
        $s_max       = $request->getParam('max');
        $data        = $this->getAllBySalary($s_min, $s_max);
        $xml         = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Salaries></Salaries>");
        $node        = $xml->addChild('request');
        $arrayHelper = new \Helper\ArrayHelper();
        $arrayHelper->convertArrayXml($data, $node);
        $res         = $response->withHeader('Content-type', 'text/xml');
        $res->getBody()->write($xml->asXML());
        return $res;
    }

    /**
     * Método que devuelve lista de colaboradores.
     * @name getAll
     * @access private
     * @return array
     */
    private function getAll()
    {
        $total     = count($this->data);
        $employees = array();
        for ($i = 0; $i < $total; $i++) {
            $obj = new \App\Model\EmployeeModel();
            array_push($employees, $obj->getInfo($this->data[$i]));
        }
        return $employees;
    }

    /**
     * Método que devuelve la información de un colaborador.
     * @name getbyID
     * @param string $id ID de Colaborador.
     * @access private
     * @return object
     */
    private function getbyID($id)
    {
        $index = array_search($id, array_column($this->data, 'id'));
        if (is_bool($index)) {
            return null;
        } else {
            $obj = new \App\Model\EmployeeModel();
            return $obj->getInfo($this->data[$index]);
        }
    }

    /**
     * Método que devuelve la información de un colaborador por
     * correo electrónico.
     * @name getByEmail
     * @param string $email Email de Colaborador.
     * @access private
     * @return object
     */
    private function getByEmail($email)
    {
        $idx = array_search($email, array_column($this->data, 'email'));
        if (is_bool($idx)) {
            return null;
        } else {
            $obj = new \App\Model\EmployeeModel();
            return $obj->getInfo($this->data[$idx]);
        }
    }

    /**
     * Método que devuelve la información de un colaborador por
     * rango salarial.
     * @name getAllBySalary
     * @param int $s_min Salario mínimo
     * @param int $s_max Salario máximo
     * @access private
     * @return array
     */
    private function getAllBySalary($s_min, $s_max)
    {
        $len  = count($this->data);
        $objs = array();
        for ($i = 0; $i < $len; $i++) {
            //Almacenamos el salario
            $s = substr($this->data[$i]['salary'], 1);
            $s = str_replace(',', '', $s);
            if ($s >= $s_min && $s <= $s_max) {
                array_push($objs, array('item' => $this->data[$i]));
            }
        }
        return $objs;
    }

    /**
     * Método que carga el contenido del .JSON en un atributo de la clase.
     * @name loadJsonData
     * @access private
     */
    private function loadJsonData()
    {
        $this->data = json_decode(file_get_contents($this->path_json_data), true);
    }
}
