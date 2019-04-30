<?php
class TimetableEmployee implements JsonSerializable
{
    private $idtimetable_employee;
    private $day;
    private $start_hour;
    private $start_minute;
    private $number_hours;
    private $number_minutes;
    private $idemployee;

    public static function getTimetableEmployee($std)
    {
        $timetableEmployee = new TimetableEmployee();
        try {
            $timetableEmployee->setIdtimetable_employee(@$std->idtimetable_employee);
            $timetableEmployee->setDay(@$std->day);
            $timetableEmployee->setStart_hour(@$std->start_hour);
            $timetableEmployee->setStart_minute(@$std->start_minute);
            $timetableEmployee->setNumber_hours(@$std->number_hours);
            $timetableEmployee->setNumber_minutes(@$std->number_minutes);
            $timetableEmployee->setIdemployee(@$std->idemployee);
            return $timetableEmployee;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function __construct($idtimetable_employee = 0)
    {
        $this->idtimetable_employee = $idtimetable_employee;
    }

    public function getIdtimetable_employee()
    {
        return $this->idtimetable_employee;
    }

    public function setIdtimetable_employee($idtimetable_employee)
    {
        $this->idtimetable_employee = $idtimetable_employee;
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

    public function jsonSerialize()
    {
        return
            [
                'idtimetable_employee' => $this->idtimetable_employee,
                'day' => $this->day,
                'start_hour' => $this->start_hour,
                'start_minute' => $this->start_minute,
                'extra_minutes' => $this->extra_minutes,
                'number_hours' => $this->number_hours,
                'number_minutes' => $this->number_minutes,
                'idemployee' => $this->idemployee

            ];
    }
}
