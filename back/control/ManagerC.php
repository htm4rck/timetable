<?php
class ManagerC
{
    private $data;
    private $parameters;
    private $manager;
    private $action;

    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
        $this->manager = Manager::getManager($this->data);
        $this->parameters = array();
        $this->action = $_GET['action'];
        $this->main();
    }

    public function main()
    {
        switch ($this->action) {
            case 'read':
                $this->read();
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
            case 'login':
                $this->login();
                break;
            default:
                echo json_encode('{"Error": "Metodo no permitido"}');
                break;
        }
    }
    public function read()
    {
        $_GET['filter'] != '' ? $this->parameters['filter'] = '%' . $_GET['filter'] . '%' : $this->parameters['filter'] = '%%';
        $_GET['gender'] != -1 ? $this->parameters['gender'] = " AND GENDER = '" . $_GET["gender"] . "' " : $this->parameters['gender'] = '';
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY PATERNAL ';
        echo json_encode(ManagerM::readM($this->parameters)->getResponse());
    }

    public function create()
    {
        echo $this->manager->getPaternal();
        echo json_encode(ManagerM::createM($this->manager));
    }
    public function update()
    {
        echo json_encode(ManagerM::updateM($this->manager));
    }
    public function delete()
    {
        echo json_encode(ManagerM::deleteM($this->manager));
    }
    public function changePass()
    {
        echo json_encode(ManagerM::changePassM($this->manager));
    }
    public function login()
    {
        echo json_encode(ManagerM::loginM($this->manager));
        
    }
}
new ManagerC();
