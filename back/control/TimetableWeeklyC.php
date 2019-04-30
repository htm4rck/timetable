<?php
class TimetableWeeklyC
{
    private $data;
    private $parameters;
    private $timetableweekly;
    private $action;

    public function __construct()
    {
        $this->data = file_get_contents('php://input');
        $this->data = json_decode($this->data);
        $this->timetableweekly = Timetableweekly::getTimetableWeekly($this->data);
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
        }
    }
    public function read()
    {
        $_GET['filter'] != '' ? $this->parameters['filter'] = '%' . $_GET['filter'] . '%' : $this->parameters['filter'] = '%%';
        $_GET['gender'] != -1 ? $this->parameters['gender'] = " AND GENDER = '" . $_GET["gender"] . "' " : $this->parameters['gender'] = '';
        $this->parameters['paginate'] = ' LIMIT ' . $_GET['size'] . ' OFFSET ' . (((int)$_GET['page'] - 1) * (int)$_GET['size']) . ' ';
        $this->parameters['orderby'] = ' ORDER BY PATERNAL ';
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
