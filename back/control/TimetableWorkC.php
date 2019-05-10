<?php
class TimetableWorkC
{
    private $data;
    private $parameters;
    private $timetablework;
    private $action;

    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
        $this->timetablework = TimetableWork::getTimetableWork($this->data);
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
            default:
                echo json_encode('{"Error": "Metodo no permitido"}');
                break;
        }
    }
    public function read()
    {
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ';
        echo json_encode(TimetableWorkM::readM($this->parameters)->getResponse());
    }

    public function create()
    {
        echo json_encode(TimetableWorkM::createM($this->timetablework));
    }
    public function update()
    {
        echo json_encode(TimetableWorkM::updateM($this->timetablework));
    }
    public function delete()
    {
        echo json_encode(TimetableWorkM::deleteM($this->timetablework));
    }
}
new TimetableWorkC();
