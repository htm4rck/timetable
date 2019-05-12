<?php
class TimetableEmployeeC
{
    private $data;
    private $parameters;
    private $timetableEmployee;
    private $action;

    public function __construct()
    {
        try {
            $this->data = file_get_contents('php://input');
            $this->data = json_decode($this->data);
            $this->timetableEmployee = TimetableEmployee::getTimetableEmployee($this->data);
            $this->parameters = array();
            $this->action = $_GET['action'];
            $this->main();
        } catch (Exception $e) {
            echo '{"errorConstructor":"' . $e . '"}';
        }
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
            default:
                echo '{"error": "Metodo no permitido"}';
                break;
        }
    }
    public function read()
    {
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ';
        $this->parameters['idemployee'] = (int)$_GET['idemployee'];
        echo json_encode(TimetableEmployeeM::readM($this->parameters)->getResponse());
    }

    public function create()
    {
        echo json_encode(timetableEmployeeM::createM($this->timetableEmployee));        
    }
    public function update()
    {
        echo json_encode(timetableEmployeeM::updateM($this->timetableEmployee));
    }
    public function delete()
    {
        echo json_encode(timetableEmployeeM::deleteM($this->timetableEmployee));
    }
}
new TimetableEmployeeC();