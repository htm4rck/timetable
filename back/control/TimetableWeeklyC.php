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
            case 'delclean':
                $this->delClean();
                break;
            case 'delall':
                $this->delAll();
                break;
            default:
                echo '{"error": "Metodo no Permitido}';
                break;
        }
    }
    public function read()
    {
        $_GET['filter'] != '' ? $this->parameters['filter'] = '%' . $_GET['filter'] . '%' : $this->parameters['filter'] = '%%';
        $_GET['estate'] != -1 ? $this->parameters['estate'] = " AND ESTATE = '" . $_GET["estate"] . "' " : $this->parameters['estate'] = '';
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY ESTATE DESC';
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
    public function delClean()
    {
        echo json_encode(TimetableWeeklyM::delCleanM($this->timetableweekly));
    }
    public function delAll()
    {
        echo json_encode(TimetableWeeklyM::delAllM($this->timetableweekly));
    }
}
new TimetableWeeklyC();
