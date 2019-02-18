<?php
class TimetableWork{

    private $idtimetablework;
    private $day;
    private $start_hour;
    private $start_minute;
    private $number_hours;
    private $number_minutes;
    private $idemployee;
    private $idtimetable_weekly;

    public function __construct($idtimetablework=0)
    {
        $this->idtimetablework=$idtimetablework;
    }

    public function getIdtimetablework()
    {
        return $this->idtimetablework;
    }

    public function setIdtimetablework($idtimetablework)
    {
        $this->idtimetablework = $idtimetablework;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day)
    {
        $this->day = $day;
    }

    public function getStart_hour()
    {
        return $this->start_hour;
    }

    public function setStart_hour($start_hour)
    {
        $this->start_hour = $start_hour;
    }

    public function getStart_minute()
    {
        return $this->start_minute;
    }

    public function setStart_minute($start_minute)
    {
        $this->start_minute = $start_minute;
    }

    public function getNumber_hours()
    {
        return $this->number_hours;
    }

    public function setNumber_hours($number_hours)
    {
        $this->number_hours = $number_hours;
    }

    public function getNumber_minutes()
    {
        return $this->number_minutes;
    }

    public function setNumber_minutes($number_minutes)
    {
        $this->number_minutes = $number_minutes;
    }

    public function getIdemployee()
    {
        return $this->idemployee;
    }

    public function setIdemployee($idemployee)
    {
        $this->idemployee = $idemployee;
    }

    public function getIdtimetable_weekly()
    {
        return $this->idtimetable_weekly;
    }

    public function setIdtimetable_weekly($idtimetable_weekly)
    {
        $this->idtimetable_weekly = $idtimetable_weekly;
    }
}