<?php
class EmployeeC
{
    private $data;
    private $parameters;
    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data, true);
        $this->parameters = array();
        //echo ($data['idcliente']);
    }
    public function listar()
    {
        $this->parameters['filter'] = '%' . $_GET['filter'] . '%';
        if ($_GET['gender'] != -1) {
            $this->parameters['gender'] = " AND GENDER = '" . $_GET["gender"] . "' ";
        } else {
            $this->parameters['gender'] = '';
        }
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY PATERNAL ';
        echo json_encode(EmployeeM::listarM($this->parameters));
    }
}
$action = "paginate";
$data = file_get_contents('php://input');
switch ($action) {
    case 'paginate':

        $e = new EmployeeC();
        $e->listar();
        break;

    default:
        # code...
        break;
}
