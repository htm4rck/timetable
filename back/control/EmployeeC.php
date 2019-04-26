<?php
class EmployeeC
{
    private $data;
    private $parameters;
    private $employee;
    private $action;

    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
        $this->employee = Employee::getEmployee($this->data);
        $this->parameters = array();
        $this->action = $_GET['action'];
        $this->main();
    }
    public function main()
    {
        switch ($this->action) {
            case 'paginate':
                $this->listar();
                break;
            case 'create':
                $this->create();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'changepass':
                $this->changePass();
                break;
            default:
                # code...
                break;
        }
    }
    public function listar()
    {
        $_GET['filter'] != '' ? $this->parameters['filter'] = '%' . $_GET['filter'] . '%' : $this->parameters['filter'] = '%%';
        $_GET['gender'] != -1 ? $this->parameters['gender'] = " AND GENDER = '" . $_GET["gender"] . "' " : $this->parameters['gender'] = '';
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY PATERNAL ';
        echo json_encode(EmployeeM::listarM($this->parameters)->getResponse());
    }

    public function create()
    {
        echo json_encode(EmployeeM::createM($this->employee));
    }
    public function update()
    {
        echo json_encode(EmployeeM::updateM($this->employee));
    }
    public function delete()
    {
        echo json_encode(EmployeeM::deleteM($this->employee));
    }
    public function changePass()
    {
        echo json_encode(EmployeeM::changePassM($this->employee));
    }
}
new EmployeeC();
