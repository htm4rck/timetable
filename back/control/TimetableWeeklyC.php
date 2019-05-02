<?php
class TimetableWeeklyC
{
    private $data;
    private $parameters;
    private $timetableweekly;
    private $action;

    public function __construct()
    {
        try {
            $this->data = file_get_contents('php://input');
            $this->data = json_decode($this->data);
            $this->timetableweekly = TimetableWeekly::getTimetableWeekly($this->data);
            $this->parameters = array();
            $this->action = $_GET['action'];
            $this->main();
        } catch (Exception $th) {
            echo $th;
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
                echo '{"error": "Metodo no Permitido}';
                break;
        }
    }
    public function read()
    {
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ';
        echo json_encode(TimetableWeeklyM::readM($this->parameters)->getResponse());
    }

    public function create()
    {
        echo json_encode(TimetableWeeklyM::createM($this->timetableweekly));
    }
    public function update()
    {
        echo json_encode(TimetableWeeklyM::updateM($this->timetableweekly));
    }
    public function delete()
    {
        echo json_encode(TimetableWeeklyM::deleteM($this->timetableweekly));
    }
}
new TimetableWeeklyC();
