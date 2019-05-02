<?php
class TimetableWeekly implements JsonSerializable
{
    private $idtimetable_weekly;
    private $description;
    private $date;
    private $estate;
    private $idmanager;

    public function __construct($idtimetable_weekly = 0)
    {
        $this->idtimetable_weekly = $idtimetable_weekly;
        $this->description = '';
        $this->date = '';
        $this->estate = '';
        $this->idmanager = 0;
    }

    public static function getTimetableWeekly($std)
    {
        $timetableWeekly = new TimetableWeekly();
        try {
            $timetableWeekly->setIdtimetable_weekly(@$std->idtimetable_weekly);
            $timetableWeekly->setDescription(@$std->description);
            $timetableWeekly->setDate(@$std->date);
            $timetableWeekly->setEstate(@$std->estate);
            $timetableWeekly->setIdmanager(@$std->idmanager);
            return $timetableWeekly;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function jsonSerialize()
    {
        return
            [
                'idtimetable_weekly' => $this->idtimetable_weekly,
                'description' => $this->description,
                'date' => $this->date,
                'estate' => $this->estate,
                'idmanager' => $this->idmanager

            ];
    }

    public function getIdtimetable_weekly()
    {
        return $this->idtimetable_weekly;
    }

    public function setIdtimetable_weekly($idtimetable_weekly)
    {
        $this->idtimetable_weekly = $idtimetable_weekly;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getEstate()
    {
        return $this->estate;
    }

    public function setEstate($estate)
    {
        $this->estate = $estate;
    }

    public function getIdmanager()
    {
        return $this->idmanager;
    }

    public function setIdmanager($idmanager)
    {
        $this->idmanager = $idmanager;
    }
}