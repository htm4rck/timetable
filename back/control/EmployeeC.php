<?php
class EmployeeC
{
    private $data;
    private $parameters;
    private $employee;
    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
        $this->employee = Employee::getEmployee($this->data);
        $this->parameters = array();
        //echo ($data['idcliente']);
    }
    public function listar()
    {
        $_GET['filter']!=''?$this->parameters['filter'] = '%' . $_GET['filter'] . '%':$this->parameters['filter'] = '';
        $this->parameters['filter'] = '%' . $_GET['filter'] . '%';
        if ($_GET['gender'] != -1) {
            $this->parameters['gender'] = " AND GENDER = '" . $_GET["gender"] . "' ";
        } else {
            $this->parameters['gender'] = '';
        }
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY PATERNAL ';
        echo json_encode(EmployeeM::listarM($this->parameters)->getResponse());
    }

    public function insert()
    {
        echo json_encode(EmployeeM::insertM($this->employee));
        echo '<script>';
        echo 'console.log('+'aaa'+')';
        echo '</script>';
    }
    public function imprimir()
    {
        try {
            echo json_encode($this->employee);
        } catch (Exception $th) {
            echo json_encode($th);
        }
    }
}
$action = $_GET['action'];
$e = new EmployeeC();
switch ($action) {
    case 'paginate':

        $e->listar();
        break;
    case 'insert':
        $e->insert();
        break;

    default:
        # code...
        break;
}
